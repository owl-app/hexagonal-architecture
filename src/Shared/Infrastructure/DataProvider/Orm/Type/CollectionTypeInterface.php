<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Type;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Type\CollectionTypeInterface as DomainCollectionTypeInterface;

interface CollectionTypeInterface extends DomainCollectionTypeInterface
{
    public function buildQueryBuilder(QueryBuilder $queryBuilder): void;
}
