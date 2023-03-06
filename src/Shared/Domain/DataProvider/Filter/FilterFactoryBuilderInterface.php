<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Filter;

interface FilterFactoryBuilderInterface
{
    public function create(string $filter): FilterBuilderInterface;
}
