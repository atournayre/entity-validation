<?php

namespace Atournayre\EntityValidation\Tests\Fixtures\Form;

use Atournayre\EntityValidation\Tests\Fixtures\Entity\EntityWithNoInterface\EntityWithNoInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityWithNoInterfaceFormType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', EntityWithNoInterface::class);
    }
}
