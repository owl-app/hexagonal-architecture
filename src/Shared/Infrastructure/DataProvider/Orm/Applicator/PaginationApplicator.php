<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Applicator;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Request\RequestParamsInterface;
use Owl\Shared\Infrastructure\DataProvider\Type\OrmDataProviderTypeInterface;

class PaginationApplicator implements ApplicatorInterface
{
    public function apply(QueryBuilder $queryBuilder, OrmDataProviderTypeInterface $collectionType, CollectionRequestParamsInterface|RequestParamsInterface $collectionRequestParams) : void
    {
        if (!$collectionRequestParams->hasPagination()) {
            return;
        }

        $limit = $collectionRequestParams->getPerPage();
        $offset = $collectionRequestParams->getOffset();

        $queryBuilder
            ->setFirstResult($offset)
            ->setMaxResults($limit);
    }
}
