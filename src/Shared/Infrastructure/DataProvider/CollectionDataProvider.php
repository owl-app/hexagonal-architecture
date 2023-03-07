<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider;

use Owl\Shared\Domain\DataProvider\Builder\DataProviderTypeBuilderInterface;
use Owl\Shared\Domain\DataProvider\CollectionDataProviderInterface;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Type\CollectionTypeInterface;
use Owl\Shared\Domain\Persistence\RepositoryInterface;

final class CollectionDataProvider implements CollectionDataProviderInterface
{
    public function __construct(
        private DataProviderTypeBuilderInterface $collectionTypeBuilder
    ) {
    }

    public function get(RepositoryInterface $repository, CollectionTypeInterface $collectionType, CollectionRequestParamsInterface $collectionRequestParams): array
    {
        return $this->collectionTypeBuilder->build($repository, $collectionType, $collectionRequestParams);
    }
}