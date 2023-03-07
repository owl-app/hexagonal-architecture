<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Builder;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Builder\DataProviderTypeBuilderInterface;
use Owl\Shared\Domain\DataProvider\Builder\FilterBuilder;
use Owl\Shared\Domain\DataProvider\Registry\FilterRegistryInterface;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Type\DataProviderTypeInterface;
use Owl\Shared\Domain\Persistence\RepositoryInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Applicator\FilterApplicator;

class CollectionTypeBuilder implements DataProviderTypeBuilderInterface
{
    public function __construct(
        private readonly FilterRegistryInterface $registry
    ) {
    }

    public function build(RepositoryInterface $repository, DataProviderTypeInterface $dataProviderType, CollectionRequestParamsInterface $collectionRequestParams): array
    {
        $queryBuilder = $repository->createQueryBuilder('o');

        $this->buildFilters($queryBuilder, $dataProviderType, $collectionRequestParams->getDataFilters());

        return $queryBuilder->getQuery()->getResult();
    }

    private function buildFilters(QueryBuilder $queryBuilder, DataProviderTypeInterface $dataProviderType, array $dataFilters): void
    {
        $filterBuilder = new FilterBuilder($this->registry);
        $filterApplicator = new FilterApplicator($queryBuilder);

        $dataProviderType->buildFilters($filterBuilder);
        $filterApplicator->apply($filterBuilder->all(), $dataFilters);
    }
}
