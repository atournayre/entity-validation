<?php

namespace Atournayre\EntityValidation\Tests\Fixtures\Entity\SimpleEntity;

use Atournayre\EntityValidation\ConstraintValidator;
use Atournayre\EntityValidation\ConstraintViolationListCollectionBuilder;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class SimpleEntityConstraintValidator extends ConstraintValidator
{
    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->throwExceptionIfConstraintClassDoNotExists(__CLASS__);
    }

    public function validate($value, Constraint $constraint = null)
    {        $constraintViolationListCollectionBuilder = ConstraintViolationListCollectionBuilder::create();

        if (!$value instanceof SimpleEntity) {
            return $constraintViolationListCollectionBuilder->build();
        }

        return $constraintViolationListCollectionBuilder
            ->add($value->email, new Assert\Email(), 'email')
            ->build();
    }
}
