<?php

declare(strict_types=1);

namespace Gt\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use Gt\TestDi\DriverRepository;
use Gt\Driver\Driver;

/**
 * Проверяет занятость номера телефона
 * https://symfony.com/doc/current/validation/custom_constraint.html
 */
class PhoneNumAvailableValidator extends ConstraintValidator
{
    

// private DriverRepository $driverRepo
public function __construct(
    private DriverRepository $driverRepo
    )
{
}

    public function validate(mixed $value, Constraint $constraint): void
    {
        
        if (!$constraint instanceof PhoneNumAvailable) {
            throw new UnexpectedTypeException($constraint, PhoneNumAvailable::class);
        }

        

        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) to take care of that
        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            // throw this exception if your validator cannot handle the passed type so that it can be marked as invalid
            throw new UnexpectedValueException($value, 'string');

            // separate multiple types using pipes
            // throw new UnexpectedValueException($value, 'string|int');
        }

        // access your configuration options like this:
        if ('strict' === $constraint->mode) {
            // ...
        }

        
        if (\strlen($value) <15) {
            // the argument must be a string or an object implementing __toString()
            $this->context->buildViolation("Длина номера телефона \"{{ string }}\" менее 18 символов")
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        // if (($driver=$this->driverRepo->findByPhone(trim($value))) !== null) {
        //     // the argument must be a string or an object implementing __toString()
        //     $this->context->buildViolation("Телефон \"{{ string }}\" занят водителем {{ driverFIO }} с ID {{ driverId }}")
        //         ->setParameter('{{ string }}', $value)
        //         ->setParameter('{{ driverId }}', (string)$driver->id)
        //         ->setParameter('{{ driverFIO }}', $driver->getDriverFIO())
        //         ->setParameter('{{ driverLink }}', '{{href}}'.'?route=driver&id='.$driver->id)
        //         ->addViolation();
        // }
    }
}
