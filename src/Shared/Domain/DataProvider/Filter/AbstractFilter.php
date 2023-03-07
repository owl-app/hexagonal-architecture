<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Filter;

use Owl\Shared\Domain\DataProvider\Builder\FilterBuilderInterface;

abstract class AbstractFilter implements FilterInterface
{
    private string $path;

    private array $options = [];

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    public function buildFilter(FilterBuilderInterface $filterBuilder): void
    {
    }

    public function buildQuery(mixed $queryBuilder, $data): void
    {
    }
}
