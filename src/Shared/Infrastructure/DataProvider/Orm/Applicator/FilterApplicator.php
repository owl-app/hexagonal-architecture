<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Applicator;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Shared\DataProvider\Applicator\FilterApplicatorInterface;

class FilterApplicator implements FilterApplicatorInterface
{
    public function __construct(private QueryBuilder $queryBuilder)
    {
    }

    public function apply(array $filters, array $data): void
    {
        foreach ($filters as $filter) {
            $path = $filter->getPath();
            $filterName = $filter->getOptions()['filter_name'] ?? $path;
            $this->resolveFieldByAddingJoins($path);

            $filter->buildQuery($this->queryBuilder, $data[$filterName] ?? null);
        }
    }

    private function resolveFieldByAddingJoins(string $field): string
    {
        [$field, $className] = $this->getFieldDetails($field);
        $metadata = $this->queryBuilder->getEntityManager()->getClassMetadata($className);

        while (count($explodedField = explode('.', $field, 3)) === 3) {
            [$rootField, $associationField, $remainder] = $explodedField;

            if (isset($metadata->embeddedClasses[$associationField])) {
                break;
            }

            $metadata = $this->queryBuilder->getEntityManager()->getClassMetadata(
                $metadata->getAssociationMapping($associationField)['targetEntity'],
            );
            $rootAndAssociationField = sprintf('%s.%s', $rootField, $associationField);

            /** @var Join[] $joins */
            $joins = array_merge([], ...array_values($this->queryBuilder->getDQLPart('join')));
            foreach ($joins as $join) {
                if ($join->getJoin() === $rootAndAssociationField) {
                    $field = sprintf('%s.%s', (string) $join->getAlias(), $remainder);

                    continue 2;
                }
            }

            // Association alias can't start with a number
            // Mapping numbers to letters will not increase the collision probability and not lower the entropy
            $associationAlias = str_replace(
                ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                ['g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p'],
                md5($rootAndAssociationField),
            );

            $this->queryBuilder->innerJoin($rootAndAssociationField, $associationAlias);
            $field = sprintf('%s.%s', $associationAlias, $remainder);
        }

        return $field;
    }

    /**
     * This method returns an absolute path of a property path and the FQCN of the root element.
     *
     * Given the following query:
     *
     * SELECT bo FROM App\Book bo INNER JOIN App\Author au ON bo.author_id = au.id
     *
     * It will behave as follows:
     *
     * bo.title => [book.title, App\Book]
     * title => [book.title, App\Book]
     * au => [book.author, App\Book]
     * au.name => [book.author.name, App\Book]
     */
    private function getFieldDetails(string $field): array
    {
        $rootField = explode('.', $field)[0];
        if (!in_array($rootField, $this->queryBuilder->getAllAliases(), true)) {
            $field = sprintf('%s.%s', $this->queryBuilder->getRootAliases()[0], $field);
        }

        /** @var Join[] $joins */
        $joins = array_merge([], ...array_values($this->queryBuilder->getDQLPart('join')));
        while ($explodedField = explode('.', $field, 2)) {
            $rootField = $explodedField[0];
            $remainder = $explodedField[1] ?? '';

            if (in_array($rootField, $this->queryBuilder->getRootAliases(), true)) {
                break;
            }

            foreach ($joins as $join) {
                if ($join->getAlias() === $rootField) {
                    $joinSubject = $join->getJoin();

                    if (class_exists($joinSubject)) {
                        return [$field, $joinSubject];
                    }

                    $field = rtrim(sprintf('%s.%s', $joinSubject, $remainder), '.');

                    continue 2;
                }
            }

            throw new \RuntimeException(sprintf('Could not get mapping for "%s".', $field));
        }

        /** @var From[] $froms */
        $froms = $this->queryBuilder->getDQLPart('from');
        foreach ($froms as $from) {
            if ($from->getAlias() === $rootField) {
                return [$field, $from->getFrom()];
            }
        }

        throw new \RuntimeException(sprintf('Could not get metadata for "%s".', $rootField));
    }
}
