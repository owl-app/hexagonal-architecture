<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Applicator;

interface FilterApplicatorInterface
{
    public function apply(array $filters): void;
}
