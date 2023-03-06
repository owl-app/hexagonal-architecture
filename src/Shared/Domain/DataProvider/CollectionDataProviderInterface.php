<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider;

use Owl\Shared\Domain\DataProvider\Type\CollectionTypeInterface;
use Owl\Shared\Domain\Persistence\RepositoryInterface;

interface CollectionDataProviderInterface
{
    public function get(RepositoryInterface $repository, CollectionTypeInterface $filterBuilder, array $sorting = [], bool $isPaginated = false): array;
}
