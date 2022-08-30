<?php

declare(strict_types=1);

namespace Gt\TestDi;

use Exception;
use Gt\Validator\Validator;
use Gt\Http\Middleware\ValidationExceptionHandler;
use Gt\Validator\ValidationException;
use Gt\TestDi\DriverRepository;
use Gt\TestDi\DriverFormDtoDriver;

use function Gt\mydump;

final class SaveDriverFormAction
{
    public function __construct(
        private readonly Validator $validator,
    ) {
    }

    public function handle(DriverFormDtoDriver $formCommand): void
    {
        
        try {            
            
            $this->validator->validate($formCommand);
            
        } catch (ValidationException $exception) {
            // echo $exception->getMessage();
            echo $exception->getViolations();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        } catch (\Error $error) {
            echo $error->getMessage();
        }
    }
}
