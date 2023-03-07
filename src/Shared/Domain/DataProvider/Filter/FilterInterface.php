<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Filter;

use Owl\Shared\Domain\DataProvider\Builder\FilterBuilderInterface;

interface FilterInterface
{
    public function getPath(): string;

    public function setPath(string $path): void;

    public function getOptions(): array;

    public function setOptions(array $options): void;

    public function buildFilter(FilterBuilderInterface $filterBuilder): void;

    public function buildQuery(mixed $queryBuilder, $data): void;
}
