<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Request;

interface CollectionRequestParamsInterface
{
    public function getDataFilters(): array;

    public function getSort(): array;
}
