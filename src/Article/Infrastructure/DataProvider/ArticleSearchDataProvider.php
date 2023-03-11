<?php

declare(strict_types=1);

namespace Owl\Article\Infrastructure\DataProvider;

use Doctrine\ORM\QueryBuilder;
use Owl\Article\Domain\DataProvider\ArticleSearchDataProviderInterface;
use Owl\Shared\Domain\DataProvider\Builder\FilterBuilderInterface;
use Owl\Shared\Domain\DataProvider\Builder\SortBuilderInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Filter\StringFilter;
use Owl\Shared\Infrastructure\DataProvider\Orm\Type\BuildableQueryBuilderInterface;

final class ArticleSearchDataProvider implements BuildableQueryBuilderInterface, ArticleSearchDataProviderInterface
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
            ->withParamName('sort')
            ->withAvailable(['id'])
        ;
    }
}
