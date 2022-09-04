<?php

namespace Atournayre\EntityValidation;

use Exception;
use Symfony\Component\Form\Extension\Validator\ViolationMapper\ViolationMapper;
use Symfony\Component\Form\FormInterface;

abstract class ConstraintValidator extends \Symfony\Component\Validator\ConstraintValidator
{
    /**
     * @throws Exception
     */
    public function throwExceptionIfConstraintClassDoNotExists(string $constraintValidatorClassName)
    {
        $constraintClass = str_replace('Validator', '', $constraintValidatorClassName);

        if (class_exists($constraintClass)) return;

        throw new Exception(sprintf('Class %s is missing.', $constraintClass));
    }

    public function ajouterLesErreursAuForm(FormInterface $form): void
    {
        $violationMapper = new ViolationMapper();
        foreach ($this->validate($form->getData()) as $violation) {
            $violationMapper->mapViolation($violation, $form);
        }
    }
}
