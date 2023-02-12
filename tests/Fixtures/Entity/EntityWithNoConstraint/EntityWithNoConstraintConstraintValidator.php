<?php

namespace Atournayre\EntityValidation\Tests\Fixtures\Entity\EntityWithNoConstraint;

use Atournayre\EntityValidation\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class EntityWithNoConstraintConstraintValidator extends ConstraintValidator
{
    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->throwExceptionIfConstraintClassDoNotExists(__CLASS__);
    }

    public function validate($value, Constraint $constraint = null)
    {
        // TODO: Implement validate() method.
    }
}
