<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Validation;

final class SortingParametersValidator implements SortingParametersValidatorInterface
{
    public function validateSortingParameters(string $typeSorting): bool
    {
        if (!in_array($typeSorting, ['asc', 'desc'])) {
            return false;
        }

        return true;
    }
}
