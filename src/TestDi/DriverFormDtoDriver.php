<?php

declare(strict_types=1);

namespace Gt\TestDi;

use Symfony\Component\Validator\Constraints as Assert;
use Gt\Validator as GtValidators;

class DriverFormDtoDriver
{
    
    public ?int $id;


    #[Assert\NotBlank(message: 'Телефон не должен быт пустым')]
    #[GtValidators\PhoneNumAvailable(driverId: $this->id)]
    public ?string $phoneNumber;

    
    // public function __construct(
    //     public readonly ?int $id,
    //     #[Assert\NotBlank(message: 'Телефон не должен быт пустым')]
    //     #[GtValidators\PhoneNumAvailable(driverId: $id)]
    //     public readonly ?string $phoneNumber="",
    // ) {
    // }

    public function __construct(
        ?int $id,        
        ?string $phoneNumber,
    ) {
        $this->id = $id;
        $this->phoneNumber = $phoneNumber;
    }
}
