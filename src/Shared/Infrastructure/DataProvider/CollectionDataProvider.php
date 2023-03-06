<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider;

use Owl\Shared\Domain\DataProvider\Builder\DataProviderTypeBuilderInterface;
use Owl\Shared\Domain\DataProvider\CollectionDataProviderInterface;
use Owl\Shared\Domain\DataProvider\Filter\FilterFactoryBuilderInterface;
use Owl\Shared\Domain\DataProvider\Type\CollectionTypeInterface;
use Owl\Shared\Domain\Persistence\RepositoryInterface;

final class CollectionDataProvider implements CollectionDataProviderInterface
{
    public function __construct(
        // private ResourceFilterApplicatorInterface $resourceFilterApplicator,
        // private QueryBuilderApplicatorInterface $queryBuilderApplicator,
        private DataProviderTypeBuilderInterface $collectionTypeBuilder
    ) {
    }

    public function get(RepositoryInterface $repository, CollectionTypeInterface $collectionType, array $sorting = [], bool $isPaginated = false): array
    {
        $queryBuilder = $repository->createQueryBuilder('o');

        return $this->collectionTypeBuilder->build($repository, $collectionType);

        // $filterBuilder = $this->filterFactory->create($filterBuilder);

        // $all = $filterBuilder->all();

        // $result = $queryBuilder->getQuery()->getResult();

        // // if ($criteria) {
        // //     $this->queryBuilderApplicator->applyFilters($queryBuilder, $repository->getClassName(), $criteria);
        // // }

        // // if ($sorting) {
        // //     $this->queryBuilderApplicator->applySort($queryBuilder, $repository->getClassName(), $sorting);
        // // }

        // // $this->resourceFilterApplicator->apply($queryBuilder, $repository->getClassName(), self::TYPE);

        // // if ($isPaginated) {
        // //     return new Pagerfanta(new QueryAdapter($queryBuilder, false, false));
        // // }

        // return $result;
    }
}