<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider;

use Owl\Shared\Domain\DataProvider\CollectionDataProviderInterface;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Type\CollectionTypeInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Factory\QueryBuilderFactoryInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Type\BuildableQueryBuilderInterface;

final class CollectionDataProvider implements CollectionDataProviderInterface
{
    public function __construct(
        private readonly QueryBuilderFactoryInterface $queryBuildeFactory,
        private readonly iterable $applicators
    ) {
    }

    public function get(string $dataClass, CollectionTypeInterface $dataProviderType, CollectionRequestParamsInterface $collectionRequestParams): array
    {
        $queryBuilder = $this->queryBuildeFactory->create($dataClass, $dataProviderType);

        foreach($this->applicators as $applicator) {
            $applicator->applyToCollection($queryBuilder, $dataProviderType, $collectionRequestParams);
        }

        $requltQuery = $queryBuilder->getQuery();

        $result = $queryBuilder->getQuery()->getResult();

        return $queryBuilder->getQuery()->getResult();
    }
}