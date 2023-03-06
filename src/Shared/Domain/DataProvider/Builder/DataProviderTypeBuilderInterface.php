<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Builder;

use Owl\Shared\Domain\DataProvider\Type\DataProviderTypeInterface;
use Owl\Shared\Domain\Persistence\RepositoryInterface;

interface DataProviderTypeBuilderInterface
{
    public function build(RepositoryInterface $repository, DataProviderTypeInterface $dataProviderType): array;
}
