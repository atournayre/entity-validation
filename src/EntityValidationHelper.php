<?php

namespace Atournayre\EntityValidation;

use Exception;
use Symfony\Component\Form\FormInterface;

class EntityValidationHelper
{
    /**
     * @throws Exception
     */
    public static function form(FormInterface $form): void
    {
        $data = $form->getData();

        if (!$data instanceof ValidableEntityInterface) {
            throw new Exception(sprintf('Class %s must implements %s.', get_class($data), ValidableEntityInterface::class));
        }

        $data->getConstraintValidator()->ajouterLesErreursAuForm($form);
    }
}
