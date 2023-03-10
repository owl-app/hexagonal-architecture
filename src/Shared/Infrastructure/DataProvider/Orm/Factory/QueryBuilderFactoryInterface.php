<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Factory;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Infrastructure\DataProvider\Orm\Type\CollectionTypeInterface;

interface QueryBuilderFactoryInterface
{
    public function create(string $dataClass, CollectionTypeInterface $collectionType): QueryBuilder;
}
