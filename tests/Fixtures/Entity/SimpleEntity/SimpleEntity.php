<?php

namespace Atournayre\EntityValidation\Tests\Fixtures\Entity\SimpleEntity;

use Atournayre\EntityValidation\ValidableEntityInterface;
use Atournayre\EntityValidation\ValidableEntityTrait;

class SimpleEntity implements ValidableEntityInterface
{
    public function __construct(
        public ?string $email = null,
    )
    {
    }

    use ValidableEntityTrait;
}