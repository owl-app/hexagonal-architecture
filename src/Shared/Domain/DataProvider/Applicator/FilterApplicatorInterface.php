<?php

declare(strict_types=1);

namespace Owl\Shared\Domain\DataProvider\Applicator;

use Owl\Shared\Domain\DataProvider\Filter\FilterBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

interface FilterApplicatorInterface
{
    public function apply(FilterBuilderInterface $filterBuilder):  void;
}
