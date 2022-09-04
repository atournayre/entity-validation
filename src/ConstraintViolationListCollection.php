<?php

namespace Atournayre\EntityValidation;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\ConstraintViolation;
use Traversable;

class ConstraintViolationListCollection extends ArrayCollection
{
    /**
     * @param iterable $elements
     */
    public function __construct(iterable $elements = [])
    {
        if ($elements instanceof Traversable) {
            $elements = iterator_to_array($elements);
        }
        parent::__construct($elements);
    }

    public function getMessages(): array
    {
        $messages = $this->map(
            fn(ConstraintViolation $violation) => $violation->getMessage()
        );
        return array_unique($messages->toArray());
    }

    public function getPropertiesPaths($skipBrackets = false): array
    {
        return $this
            ->map(
                fn(ConstraintViolation $violation) => $skipBrackets
                    ? str_replace(str_split('[]'), '', $violation->getPropertyPath())
                    : $violation->getPropertyPath()
            )->toArray();
    }
}
