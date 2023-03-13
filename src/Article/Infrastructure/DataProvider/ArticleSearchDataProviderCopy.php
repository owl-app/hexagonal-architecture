<?php

declare(strict_types=1);

namespace Owl\Article\Infrastructure\DataProvider;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Builder\FilterBuilderInterface;
use Owl\Shared\Domain\DataProvider\Builder\PaginationBuilderInterface;
use Owl\Shared\Domain\DataProvider\Builder\SortBuilderInterface;
use Owl\Shared\Domain\DataProvider\Type\AbstractCollectionType;
use Owl\Shared\Infrastructure\DataProvider\Orm\Filter\StringFilter;
use Owl\Shared\Infrastructure\DataProvider\Orm\Type\BuildableQueryBuilderInterface;

final class ArticleSearchDataProviderCopy extends AbstractCollectionType implements BuildableQueryBuilderInterface
{
    public function buildFilters(FilterBuilderInterface $filterBuilder): void
    {
        $filterBuilder
            ->add('search', StringFilter::class, ['title', 'description'])
        ;
    }

    public function buildQueryBuilder(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->select('o.id, o.title');
    }

    public function buildSort(SortBuilderInterface $sortBuilder): void
    {
        $sortBuilder
            ->setParamName('sort')
            ->setAvailable(['id'])
        ;
    }

    public function buildPagination(PaginationBuilderInterface $paginationBuilder): void
    {
        $paginationBuilder
            ->setHasPagination(false);
    }
}
