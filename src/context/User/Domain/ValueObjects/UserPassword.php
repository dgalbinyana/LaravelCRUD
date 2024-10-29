<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use InvalidArgumentException;
use Src\Context\Shared\Domain\ValueObjects\StringValueObject;
use Symfony\Component\HttpFoundation\Response;

final class UserPassword extends StringValueObject
{
    private const MAX_LENGTH = 255;
    private const MIN_LENGTH = 6;
    private const FIELD_NAME = "Password";

    public function __construct(string $password)
    {
        $this->ensureIsNotEmpty($password, self::FIELD_NAME);
        $this->ensureMaxLength($password, self::FIELD_NAME, self::MAX_LENGTH);
        $this->ensureMinLength($password);

        parent::__construct($password);
    }

    private function ensureMinLength(string $password): void
    {
        if (strlen($password) < self::MIN_LENGTH) {
            throw new InvalidArgumentException('Password must be at least ' . self::MIN_LENGTH . ' characters long',
                Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}