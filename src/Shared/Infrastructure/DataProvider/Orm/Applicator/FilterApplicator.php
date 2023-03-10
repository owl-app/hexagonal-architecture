<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Applicator;

use Doctrine\ORM\QueryBuilder;
use Owl\Infrasctructure\Domain\DataProvider\Orm\Util\QueryNameGenerator;
use Owl\Shared\Domain\DataProvider\Builder\FilterBuilder;
use Owl\Shared\Domain\DataProvider\Registry\FilterRegistryInterface;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Request\RequestParamsInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Resolver\FieldResolverInterface;
use Owl\Shared\Infrastructure\DataProvider\Type\OrmDataProviderTypeInterface;

class FilterApplicator implements ApplicatorInterface
{
    public function __construct(private readonly FieldResolverInterface $fieldResolver, private readonly FilterRegistryInterface $registry)
    {
        
    }

    public function apply(QueryBuilder $queryBuilder, OrmDataProviderTypeInterface $collectionType, CollectionRequestParamsInterface|RequestParamsInterface $collectionRequestParams) : void
    {
        $filterBuilder = new FilterBuilder($this->registry);
        $queryNameGenerator = new QueryNameGenerator();
        $data = $collectionRequestParams->getDataFilters();
        $collectionType->buildFilters($filterBuilder);

        foreach($filterBuilder->all() as $name => $filter) {
            $resolvedFields = [];

            foreach($filter->getFields() as $field) {
                $resolvedFields[$field] = $this->fieldResolver->resolveFieldByAddingJoins($queryBuilder, $field);
            }

            $filter->buildQuery($queryBuilder, $queryNameGenerator, $data[$name] ?? null, $resolvedFields);
        }
    }
}
