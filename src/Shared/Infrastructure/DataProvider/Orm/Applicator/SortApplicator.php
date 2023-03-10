<?php

declare(strict_types=1);

namespace Owl\Shared\Infrastructure\DataProvider\Orm\Applicator;

use Doctrine\ORM\QueryBuilder;
use Owl\Shared\Domain\DataProvider\Builder\SortBuilder;
use Owl\Shared\Domain\DataProvider\Request\CollectionRequestParamsInterface;
use Owl\Shared\Domain\DataProvider\Validation\SortingParametersValidator;
use Owl\Shared\Domain\DataProvider\Validation\SortingParametersValidatorInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Resolver\FieldResolverInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Type\CollectionTypeInterface;

class SortApplicator implements CollectionApplicatorInterface
{
    private SortingParametersValidatorInterface $sortingValidator;

    public function __construct(private readonly FieldResolverInterface $fieldResolver, ?SortingParametersValidatorInterface $sortingValidator = null)
    {
        $this->sortingValidator = $sortingValidator ?? new SortingParametersValidator();
    }

    public function applyToCollection(QueryBuilder $queryBuilder, CollectionTypeInterface $collectionType, CollectionRequestParamsInterface $collectionRequestParams) : void
    {
        $sortBuilder = new SortBuilder($collectionRequestParams->getSorting());
        $collectionType->buildSort($sortBuilder);

        $sorts = $collectionRequestParams->getSort($sortBuilder->getParamName());

        if($sorts) {
            foreach($sorts as $property => $sort) {
                if($this->sortingValidator->validateSortingParameters($sortBuilder->getAvailable(), $property, $sort)) {
                    $field = $this->fieldResolver->resolveFieldByAddingJoins($queryBuilder, $property);
                    $queryBuilder->addOrderBy($field, $sort);
                }
            }
        }
    }
}
