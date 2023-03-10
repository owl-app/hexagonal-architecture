<?php

 namespace Owl\Shared\Domain\DataProvider\Builder;

use Owl\Shared\Domain\DataProvider\Exception\InvalidArgumentException;
use Owl\Shared\Domain\DataProvider\Filter\FilterInterface;

class SortBuilder implements SortBuilderInterface
{
    private string $paramName;

    private array $available;

    public function __construct(private readonly array $defaultParameters)
    {
        $this->paramName = $defaultParameters['param_name'] ?? 'sort';
    }

    public function getParamName(): string
    {
        return $this->paramName;
    }

    public function withParamName(string $paramName): self
    {
        $this->paramName = $paramName;

        return $this;
    }

    public function getAvailable(): array
    {
        return $this->available;
    }

    public function withAvailable(array $available): self
    {
        $this->available = $available;

        return $this;
    }
}
