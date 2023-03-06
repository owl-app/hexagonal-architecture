<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Builder;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Builder\DataProviderTypeBuilderInterface;
use Owl\Shared\Domain\DataProvider\Filter\FilterBuilderInterface;
use Owl\Shared\Domain\DataProvider\Registry\FilterRegistryInterface;
use Owl\Shared\Domain\DataProvider\Type\DataProviderTypeInterface;
use Owl\Shared\Domain\Persistence\RepositoryInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Applicator\FilterApplicator;
use Owl\Shared\Infrastructure\DataProvider\Orm\Applicator\FilterApplicatorInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\FilterBuilder;

class CollectionTypeBuilder implements DataProviderTypeBuilderInterface
{
    public function __construct(
        private readonly FilterRegistryInterface $registry
    ) {
    }

    public function build(RepositoryInterface $repository, DataProviderTypeInterface $dataProviderType): array
    {
        $queryBuilder = $repository->createQueryBuilder('o');

        $this->buildFilters($queryBuilder, $dataProviderType);

        return $queryBuilder->getQuery()->getResult();
    }

    private function buildFilters(QueryBuilder $queryBuilder, DataProviderTypeInterface $dataProviderType): void
    {
        $filterBuilder = new FilterBuilder($this->registry);
        $filterApplicator = new FilterApplicator($queryBuilder);

        $dataProviderType->buildFilters($filterBuilder);
        $filterApplicator->apply($filterBuilder->all());
    }
}
