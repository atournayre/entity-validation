<?php

namespace Atournayre\EntityValidation\Tests\Fixtures\Form;

use Atournayre\EntityValidation\Tests\Fixtures\Entity\SimpleEntity\SimpleEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimpleEntityFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', SimpleEntity::class);
    }
}