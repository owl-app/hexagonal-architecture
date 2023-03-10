<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Applicator;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Request\RequestParamsInterface;
use Owl\Shared\Infrastructure\DataProvider\Type\OrmDataProviderTypeInterface;

interface ApplicatorInterface
{
    public function apply(QueryBuilder $queryBuilder, OrmDataProviderTypeInterface $collectionType, RequestParamsInterface $collectionRequestParams) : void;
}
