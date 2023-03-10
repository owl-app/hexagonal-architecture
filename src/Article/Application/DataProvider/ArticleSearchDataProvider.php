<?php

declare(strict_types=1);

namespace Owl\Article\Application\DataProvider;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Builder\FilterBuilderInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Filter\StringFilter;
use Owl\Shared\Infrastructure\DataProvider\Type\OrmDataProviderTypeInterface;

final class ArticleSearchDataProvider implements OrmDataProviderTypeInterface
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
}
