<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Factory;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Infrastructure\DataProvider\Type\OrmDataProviderTypeInterface;

interface QueryBuilderFactoryInterface
{
    public function create(string $dataClass, OrmDataProviderTypeInterface $collectionType): QueryBuilder;
}
