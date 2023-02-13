<?php

namespace Atournayre\EntityValidation\Tests;

use Atournayre\EntityValidation\EntityValidationHelper;
use Atournayre\EntityValidation\Tests\Fixtures\Form\EntityWithNoInterfaceFormType;
use Atournayre\EntityValidation\Tests\Fixtures\Form\SimpleEntityFormType;
use Symfony\Component\Form\Test\TypeTestCase;

class EntityValidationFormTypeTest extends TypeTestCase
{
    /**
     * @covers
     */
    public function testThrowExceptionForEntityWithNoInterface()
    {
        $exceptionMessage = 'Class Atournayre\EntityValidation\Tests\Fixtures\Entity\EntityWithNoInterface\EntityWithNoInterface must implements Atournayre\EntityValidation\ValidableEntityInterface.';
        $this->expectExceptionMessage($exceptionMessage);
        $model = new Fixtures\Entity\EntityWithNoInterface\EntityWithNoInterface();
        $form = $this->factory->create(EntityWithNoInterfaceFormType::class, $model);
        EntityValidationHelper::form($form);
    }

    /**
     * @covers
     */
    public function testFormHasError()
    {
        $formData = [
            'email' => 'test',
        ];
        $model = new Fixtures\Entity\SimpleEntity\SimpleEntity('test@example.com');
        $form = $this->factory->create(SimpleEntityFormType::class, $model);
        $form->submit($formData);

        EntityValidationHelper::form($form);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals(1, $form->getErrors()->count());
    }

    /**
     * @covers
     */
    public function testFormHasNoError()
    {
        $formData = [
            'email' => 'new.email@example.com',
        ];
        $model = new Fixtures\Entity\SimpleEntity\SimpleEntity('test@example.com');
        $form = $this->factory->create(SimpleEntityFormType::class, $model);
        $form->submit($formData);

        EntityValidationHelper::form($form);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals(0, $form->getErrors()->count());
    }
}
