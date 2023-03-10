<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Builder;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Builder\DataProviderTypeBuilderInterface;
use Owl\Shared\Domain\DataProvider\Builder\FilterBuilder;
use Owl\Shared\Domain\DataProvider\Registry\FilterRegistryInterface;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Type\DataProviderTypeInterface;

use Doctrine\ORM\EntityManagerInterface;
use Owl\Shared\Domain\DataProvider\Exception\RuntimeException;
use Owl\Shared\Infrastructure\DataProvider\Orm\Factory\QueryBuilderFactoryInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Applicator\FilterApplicator;
use Owl\Shared\Infrastructure\DataProvider\Type\OrmDataProviderTypeInterface;

class CollectionTypeBuilder implements DataProviderTypeBuilderInterface
{
    public function __construct(
        private readonly QueryBuilderFactoryInterface $queryBuildeFactory,
        private readonly iterable $applicators
    ) {
    }

    public function build(string $dataClass, OrmDataProviderTypeInterface|DataProviderTypeInterface $dataProviderType, CollectionRequestParamsInterface $collectionRequestParams): array
    {
        $queryBuilder = $this->queryBuildeFactory->create($dataClass, $dataProviderType);

        foreach($this->applicators as $applicator) {
            $applicator->apply($queryBuilder, $dataProviderType, $collectionRequestParams);
        }

        $requltQuery = $queryBuilder->getQuery();

        $result = $queryBuilder->getQuery()->getResult();

        return $queryBuilder->getQuery()->getResult();
    }
}
