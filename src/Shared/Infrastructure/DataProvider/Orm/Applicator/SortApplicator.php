<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Applicator;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Request\RequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Validation\SortingParametersValidator;
use Owl\Shared\Domain\DataProvider\Validation\SortingParametersValidatorInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Resolver\FieldResolverInterface;
use Owl\Shared\Infrastructure\DataProvider\Type\OrmDataProviderTypeInterface;

class SortApplicator implements ApplicatorInterface
{
    private SortingParametersValidatorInterface $sortingValidator;

    public function __construct(private readonly FieldResolverInterface $fieldResolver, ?SortingParametersValidatorInterface $sortingValidator = null)
    {
        $this->sortingValidator = $sortingValidator ?? new SortingParametersValidator();
    }

    public function apply(QueryBuilder $queryBuilder, OrmDataProviderTypeInterface $collectionType, CollectionRequestParamsInterface|RequestParamsInterface $collectionRequestParams) : void
    {
        $sorts = $collectionRequestParams->getSort();

        if($sorts) {
            foreach($sorts as $property => $sort) {
                if($this->sortingValidator->validateSortingParameters($sort)) {
                    $field = $this->fieldResolver->resolveFieldByAddingJoins($queryBuilder, $property);
                    $queryBuilder->addOrderBy($field, $sort);
                }
            }
        }
    }
}
