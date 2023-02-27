<?php

declare(strict_types=1);

namespace Owl\Shared\Domain;

interface UuidGenerator
{
    public function generate(): string;
}
