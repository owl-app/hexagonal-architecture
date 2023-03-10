<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Applicator;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Type\CollectionTypeInterface;

class PaginationApplicator implements CollectionApplicatorInterface
{
    public function applyToCollection(QueryBuilder $queryBuilder, CollectionTypeInterface $collectionType, CollectionRequestParamsInterface $collectionRequestParams) : void
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
