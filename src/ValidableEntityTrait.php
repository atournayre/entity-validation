<?php

namespace Atournayre\EntityValidation;

use Exception;

trait ValidableEntityTrait
{
    /**
     * @throws Exception
     */
    public function getConstraintValidator(): ConstraintValidator
    {
        $constraintValidatorClassName = __CLASS__.'ConstraintValidator';

        if (!class_exists($constraintValidatorClassName)) {
            throw new Exception(sprintf('Class %s is missing.', $constraintValidatorClassName));
        }

        return new $constraintValidatorClassName();
    }

    /**
     * @throws Exception
     */
    public function validate(): ConstraintViolationListCollection
    {
        return $this->getConstraintValidator()->validate($this);
    }
}
