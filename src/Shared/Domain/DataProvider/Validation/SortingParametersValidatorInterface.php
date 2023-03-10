<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Validation;

interface SortingParametersValidatorInterface
{
    public function validateSortingParameters(string $typeSorting): bool;
}
