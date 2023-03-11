<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Request;

interface CollectionRequestParamsInterface
{
    public function getDataFilters(): array;

    public function getSorting(): array;

    public function getSort(string $paramName): array;

    public function getPerPage(): int;
 
    public function getPage(): int;
 
    public function getOffset(): int;
}
