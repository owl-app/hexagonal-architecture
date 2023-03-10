<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Type;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Type\DataProviderTypeInterface;

interface OrmDataProviderTypeInterface extends DataProviderTypeInterface
{
    public function buildQueryBuilder(QueryBuilder $queryBuilder): void;
}
