<?php

namespace Atournayre\EntityValidation;

interface ValidableEntityInterface
{
    public function getConstraintValidator(): ConstraintValidator;

    public function validate(): ConstraintViolationListCollection;
}
