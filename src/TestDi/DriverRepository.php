<?php

declare(strict_types=1);

namespace Gt\TestDi;

class DriverRepository
{
    public function __construct(public readonly string $value="test value")
    {
    }
}
