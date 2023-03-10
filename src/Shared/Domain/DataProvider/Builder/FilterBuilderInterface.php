<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Builder;

interface FilterBuilderInterface
{
    public function add(string $name = null, string $filter, string|array $fields = null, array $options = []): self;

    public function get(string $name);

    public function remove(string $name);

    public function has(string $name);

    public function all();
}
