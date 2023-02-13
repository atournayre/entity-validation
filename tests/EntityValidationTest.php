<?php

namespace Atournayre\EntityValidation\Tests;

use Atournayre\EntityValidation\Tests\Fixtures\Entity\EntityWithNoConstraint\EntityWithNoConstraint;
use Atournayre\EntityValidation\Tests\Fixtures\Entity\SimpleEntity\SimpleEntity;
use PHPUnit\Framework\TestCase;

class EntityValidationTest extends TestCase
{
    /**
     * @covers
     */
    public function testThrowExceptionOnValidationOnEntityWithNoConstraint()
    {
        $this->expectExceptionMessage(sprintf('Class %s is missing.', 'Atournayre\EntityValidation\Tests\Fixtures\Entity\EntityWithNoConstraint\EntityWithNoConstraintConstraint'));
        $entity = new EntityWithNoConstraint();
        $entity->validate();
    }

    /**
     * @covers
     */
    public function testManualValidation()
    {
        $simpleEntity = new SimpleEntity('test');
        $constraintViolationListCollection = $simpleEntity->validate();

        $messages = $constraintViolationListCollection->getMessages();
        $invalidProperties = $constraintViolationListCollection->getPropertiesPaths();
        $invalidPropertiesWithoutBrackets = $constraintViolationListCollection->getPropertiesPaths(true);

        $this->assertNotEquals(0, $constraintViolationListCollection->count());
        $this->assertEquals('This value is not a valid email address.', current($messages));
        $this->assertEquals('[email]', current($invalidProperties));
        $this->assertEquals('email', current($invalidPropertiesWithoutBrackets));
    }
}
