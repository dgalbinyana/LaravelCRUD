<?php

declare(strict_types = 1);

namespace Src\Context\Shared\Domain\ValueObjects;

abstract class StringValueObject extends BaseStringValueObject
{
    public function __construct(protected readonly string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}