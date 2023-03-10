<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Builder;

use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Type\DataProviderTypeInterface;

interface DataProviderTypeBuilderInterface
{
    public function build(string $dataClass, DataProviderTypeInterface $dataProviderType, CollectionRequestParamsInterface $collectionRequestParams): array;
}
