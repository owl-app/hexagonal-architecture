<?php

declare(strict_types=1);

namespace Owl\Shared\Shared\DataProvider\Applicator;

interface FilterApplicatorInterface
{
    public function apply(array $filters, array $data): void;
}
