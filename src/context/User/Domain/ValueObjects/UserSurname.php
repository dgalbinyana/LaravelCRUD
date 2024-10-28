<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use Src\Context\Shared\Domain\ValueObjects\StringNullableValueObject;

final class UserSurname extends StringNullableValueObject
{
    private const MAX_LENGTH = 255;
    private const FIELD_NAME = "Surname";

    public function __construct(?string $surname)
    {
        if (null !== $surname) {
            $this->ensureIsNotEmpty($surname, self::FIELD_NAME);
            $this->ensureMaxLength($surname, self::FIELD_NAME, self::MAX_LENGTH);
        }

        parent::__construct($surname);
    }
}