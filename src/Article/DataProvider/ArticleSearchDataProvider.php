<?php

declare(strict_types=1);

namespace Owl\Article\Application\DataProvider;

use Owl\Shared\Domain\DataProvider\Builder\FilterBuilderInterface;
use Owl\Shared\Domain\DataProvider\Type\CollectionTypeInterface;
use Owl\Shared\Infrastructure\DataProvider\Orm\Filter\StringFilter;

final class ArticleSearchDataProvider implements CollectionTypeInterface
{
    public function buildFilters(FilterBuilderInterface $filterBuilder): void
    {
        $filterBuilder
            ->add('name', StringFilter::class)
        ;
    }

    public function getFields(): array
    {

    }

    // public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    // {
    //     $expressionBuilder = $dataSource->getExpressionBuilder();

    //     $value = is_array($data) ? $data['value'] ?? null : $data;
    //     $type = $data['type'] ?? ($options['type'] ?? self::TYPE_CONTAINS);
    //     $fields = $options['fields'] ?? [$name];

    //     if (!in_array($type, [self::TYPE_NOT_EMPTY, self::TYPE_EMPTY], true) && '' === trim((string) $value)) {
    //         return;
    //     }

    //     if (1 === count($fields)) {
    //         $dataSource->restrict($this->getExpression($expressionBuilder, $type, current($fields), $value));

    //         return;
    //     }

    //     $expressions = [];
    //     foreach ($fields as $field) {
    //         $expressions[] = $this->getExpression($expressionBuilder, $type, $field, $value);
    //     }

    //     if (self::TYPE_NOT_EQUAL === $type) {
    //         $dataSource->restrict($expressionBuilder->andX(...$expressions));

    //         return;
    //     }

    //     $dataSource->restrict($expressionBuilder->orX(...$expressions));
    // }

    // /**
    //  * @param mixed $value
    //  *
    //  * @return mixed
    //  *
    //  * @throws \InvalidArgumentException
    //  */
    // private function getExpression(
    //     ExpressionBuilderInterface|MemberOfAwareExpressionBuilderInterface $expressionBuilder,
    //     string $type,
    //     string $field,
    //     $value,
    // ) {
    //     switch ($type) {
    //         case self::TYPE_EQUAL:
    //             return $expressionBuilder->equals($field, $value);
    //         case self::TYPE_NOT_EQUAL:
    //             return $expressionBuilder->notEquals($field, $value);
    //         case self::TYPE_EMPTY:
    //             return $expressionBuilder->isNull($field);
    //         case self::TYPE_NOT_EMPTY:
    //             return $expressionBuilder->isNotNull($field);
    //         case self::TYPE_CONTAINS:
    //             return $expressionBuilder->like($field, '%' . $value . '%');
    //         case self::TYPE_NOT_CONTAINS:
    //             return $expressionBuilder->notLike($field, '%' . $value . '%');
    //         case self::TYPE_STARTS_WITH:
    //             return $expressionBuilder->like($field, $value . '%');
    //         case self::TYPE_ENDS_WITH:
    //             return $expressionBuilder->like($field, '%' . $value);
    //         case self::TYPE_IN:
    //             return $expressionBuilder->in($field, array_map('trim', explode(',', $value)));
    //         case self::TYPE_NOT_IN:
    //             return $expressionBuilder->notIn($field, array_map('trim', explode(',', $value)));
    //         case self::TYPE_MEMBER_OF:
    //             if (method_exists($expressionBuilder, 'memberOf')) {
    //                 return $expressionBuilder->memberOf($value, $field);
    //             }

    //             throw new \InvalidArgumentException(sprintf('The memberOf method is not supported by %s', get_class($expressionBuilder)));
    //         default:
    //             throw new \InvalidArgumentException(sprintf('Could not get an expression for type "%s"!', $type));
    //     }
    // }
}
