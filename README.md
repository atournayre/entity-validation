# Entity Validation Component

This component helps entity validation.

## Install
### Composer
```shell
composer require atournayre/entity-validation
```

## Add validation to Entity
Entity have to:
1. implements ```ValidableEntityInterface```
2. use ```ValidableEntityTrait```

That's it!

## What's next?
### Constraint
Create ```YourEntityConstraint``` (name is important); it has to be located in the same directory of your Entity, 

### ConstraintValidator
Create ```YourEntityConstraintValidator``` (name is important); it has to be located in the same directory of your Entity,

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
