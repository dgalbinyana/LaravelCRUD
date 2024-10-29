<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use Src\Context\Shared\Domain\ValueObjects\StringValueObject;

final class UserName extends StringValueObject
{
    private const MAX_LENGTH = 255;
    private const FIELD_NAME = "Name";

    public function __construct(string $name)
    {
        $this->ensureIsNotEmpty($name, self::FIELD_NAME);
        $this->ensureMaxLength($name, self::FIELD_NAME, self::MAX_LENGTH);
        parent::__construct($name);
    }
}