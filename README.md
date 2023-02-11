# Entity Validation Component

This component helps entity validation, but it also works for DTOs...

## Install
### Composer
```shell
composer require atournayre/entity-validation
```

## Add validation to a class
### Entity / DTO / ...
```php
namespace App\Entity;

use Atournayre\EntityValidation\ValidableEntityTrait;

class YourEntity implements ValidableEntityInterface
{
    // Your code
    
    use ValidableEntityTrait;
}
```

### Constraint
Create ```YourEntityConstraint``` (name is important); it has to be located in the same directory of your Entity / DTO ..., 

### ConstraintValidator
Create ```YourEntityConstraintValidator``` (name is important); it has to be located in the same directory of your Entity / DTO ...,

## Example
### ConstraintValidator
```php
<?php

namespace App\Entity\YourEntity;

use Atournayre\EntityValidation\ConstraintViolationListCollectionBuilder;
use Atournayre\EntityValidation\ConstraintValidator;
use Atournayre\EntityValidation\ConstraintViolationListCollection;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class YourEntityConstraintValidator extends ConstraintValidator
{
    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->throwExceptionIfConstraintClassDoNotExists(__CLASS__);
    }

    /**
     * @param YourEntity $value
     * @param Constraint|null $constraint
     * @return ConstraintViolationListCollection
     */
    public function validate($value, Constraint $constraint = null): ConstraintViolationListCollection
    {
        $constraintViolationListCollectionBuilder = ConstraintViolationListCollectionBuilder::create();

        if (!$value instanceof YourEntity) {
            return $constraintViolationListCollectionBuilder->build();
        }

        return $constraintViolationListCollectionBuilder
            // Suppose YourEntity has method getEmail()
            ->add($value->getEmail(), new Assert\Email())
            ->build();
    }
}
```

## Usages
### Standalone
```php
$entity = new YourEntity();

// To perform manual validation
/** @var ConstraintViolationListCollection $constraintViolationListCollection */
$constraintViolationListCollection = $entity->validate();

// Check if entity has violations
$hasViolations = $constraintViolationListCollection->count() != 0;

// To get only messages
$messages = $constraintViolationListCollection->getMessages();

// To get only invalid properties
$invalidProperties = $constraintViolationListCollection->getPropertiesPaths();

// To get only invalid properties without brackets
$invalidProperties = $constraintViolationListCollection->getPropertiesPaths(true);
```

### Symfony Forms
```php
// Before $form->isValid(), call the line below, it will add errors to form for invalid values
EntityValidationHelper::form($form);
```

## Contributing
Of course, open source is fueled by everyone's ability to give just a little bit
of their time for the greater good. If you'd like to see a feature or add some of
your *own* happy words, awesome! Tou can request it - but creating a pull request
is an even better way to get things done.

Either way, please feel comfortable submitting issues or pull requests: all contributions
and questions are warmly appreciated :).
