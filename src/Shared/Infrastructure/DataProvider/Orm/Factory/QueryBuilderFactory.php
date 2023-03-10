<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Factory;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Infrastructure\DataProvider\Orm\Type\CollectionTypeInterface;
use Doctrine\Persistence\ManagerRegistry;
use Owl\Shared\Domain\DataProvider\Exception\RuntimeException;

class QueryBuilderFactory implements QueryBuilderFactoryInterface
{
    public function __construct(private readonly ManagerRegistry $managerRegistry)
    {
    }

    public function create(string $dataClass, CollectionTypeInterface $collectionType): QueryBuilder
    {
        /** @var EntityManagerInterface $manager */
        $manager = $this->managerRegistry->getManagerForClass($dataClass);

        $repository = $manager->getRepository($dataClass);
        if (!method_exists($repository, 'createQueryBuilder')) {
            throw new RuntimeException('The repository class must have a "createQueryBuilder" method.');
        }

        $queryBuilder = $repository->createQueryBuilder('o');

        $collectionType->buildQueryBuilder($queryBuilder);

        return $queryBuilder;
    }
}
