<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm;

use Owl\Shared\Domain\DataProvider\Filter\FilterBuilderInterface;
use Owl\Shared\Domain\DataProvider\Filter\FilterFactoryBuilderInterface;
use Owl\Shared\Domain\DataProvider\Registry\FilterRegistryInterface;

class FilterFactoryBuilder implements FilterFactoryBuilderInterface
{
    public function __construct(private readonly FilterRegistryInterface $registry)
    {
    }

    public function create(string $filter): FilterBuilderInterface
    {
        $filterBuilder = new FilterBuilder($this->registry);

        if ($filter) {
            $filterBuilder->add(null, $filter);
        }


        return $filterBuilder;
    }
}
