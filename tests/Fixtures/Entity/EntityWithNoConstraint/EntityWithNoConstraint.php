<?php

namespace Atournayre\EntityValidation\Tests\Fixtures\Entity\EntityWithNoConstraint;

use Atournayre\EntityValidation\ValidableEntityInterface;
use Atournayre\EntityValidation\ValidableEntityTrait;

class EntityWithNoConstraint implements ValidableEntityInterface
{
    use ValidableEntityTrait;
}
