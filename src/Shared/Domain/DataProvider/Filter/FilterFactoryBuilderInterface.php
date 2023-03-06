<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Filter;

use Owl\Shared\Domain\DataProvider\Type\DataProviderTypeInterface;

interface FilterFactoryBuilderInterface
{
    public function create(DataProviderTypeInterface $dataProviderType): FilterBuilderInterface;
}
