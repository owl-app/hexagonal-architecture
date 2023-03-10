<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Builder;

interface SortBuilderInterface
{
    public function getParamName(): string;

    public function withParamName(string $paramName): self;

    public function getAvailable(): array;

    public function withAvailable(array $available): self;
}
