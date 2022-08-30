<?php

declare(strict_types=1);

namespace Gt\Validator;

use Symfony\Component\Validator\Attribute\HasNamedArguments;
use Symfony\Component\Validator\Constraint;

/**
 * Проверяет не занят ли телефонный номер другими водителями
 * @psalm-suppress PropertyNotSetInConstructor
 */
#[\Attribute]
class PhoneNumAvailable extends Constraint
{
    public string $message = 'Телефон "{{ string }}" уже занят водителем с id {{driverId}}.';

    public string $mode;

    /**
     * @param string $mode
     * @param array<array-key, string>|null $groups
     * @param mixed $payload
     */
    #[HasNamedArguments]
    public function __construct(string $mode='loose', array $groups = null, mixed $payload = null)
    {
        parent::__construct([], $groups, $payload);

        $this->mode = $mode;
    }
}
