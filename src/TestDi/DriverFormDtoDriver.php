<?php

declare(strict_types=1);

namespace Gt\TestDi;

use Symfony\Component\Validator\Constraints as Assert;
use Gt\Validator as GtValidators;

class DriverFormDtoDriver
{
    public function __construct(
        #[Assert\NotBlank(message: 'Телефон не должен быт пустым')]
        #[GtValidators\PhoneNumAvailable()]
        public readonly ?string $phoneNumber="",
    ) {
    }
}
