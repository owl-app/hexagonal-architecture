<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Type;

use Owl\Shared\Domain\DataProvider\Builder\FilterBuilderInterface;

interface DataProviderTypeInterface
{
    public function getFields(): array;

    public function buildFilters(FilterBuilderInterface $filterBuilder): void;
}
