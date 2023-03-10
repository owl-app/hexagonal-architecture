<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider;

use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Type\DataProviderTypeInterface;
use Owl\Shared\Domain\Persistence\RepositoryInterface;

interface CollectionDataProviderInterface
{
    public function get(string $dataClass, DataProviderTypeInterface $collectionType, CollectionRequestParamsInterface $collectionRequestParams): array;
}
