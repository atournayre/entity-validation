<?php

namespace Atournayre\EntityValidation;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validation;

class ConstraintViolationListCollectionBuilder
{
    private array $inputs = [];
    private array $constraints = [];

    /**
     * This class cannot be instantiated.
     */
    private function __construct()
    {
    }

    public static function create(): ConstraintViolationListCollectionBuilder
    {
        return new self();
    }

    public function add($input, $constraint, ?string $propertyPath = null): static
    {
        $key = $propertyPath ?? md5($input.microtime());
        $this->inputs[$key] = $input;
        $this->constraints[$key] = $constraint;

        return $this;
    }

    public function build(): ConstraintViolationListCollection
    {
        if ($this->constraints === []) {
            return self::constraintViolationListCollection(new ConstraintViolationList());
        }

        $constraints = new Assert\Collection($this->constraints);

        $constraintViolationList = Validation::createValidator()
            ->validate($this->inputs, $constraints);

        return self::constraintViolationListCollection($constraintViolationList);
    }

    private static function constraintViolationListCollection(iterable $elements): ConstraintViolationListCollection
    {
        return new ConstraintViolationListCollection($elements);
    }
}
