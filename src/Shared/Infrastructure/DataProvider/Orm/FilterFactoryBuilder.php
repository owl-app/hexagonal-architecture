<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm;

use Owl\Shared\Domain\DataProvider\Filter\FilterBuilderInterface;
use Owl\Shared\Domain\DataProvider\Filter\FilterFactoryBuilderInterface;
use Owl\Shared\Domain\DataProvider\Registry\FilterRegistryInterface;
use Owl\Shared\Domain\DataProvider\Type\DataProviderTypeInterface;

class FilterFactoryBuilder implements FilterFactoryBuilderInterface
{
    public function __construct(private readonly FilterRegistryInterface $registry)
    {
    }

    public function create(DataProviderTypeInterface $dataProviderType): FilterBuilderInterface
    {
        $filterBuilder = new FilterBuilder($this->registry);

        $dataProviderType->buildFilters($filterBuilder);

        return $filterBuilder;
    }
}
