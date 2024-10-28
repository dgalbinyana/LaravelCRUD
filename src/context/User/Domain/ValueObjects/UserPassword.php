<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserPassword
{
    private const MAX_LENGTH = 255;
    private const MIN_LENGTH = 6;

    public function __construct(private readonly string $password)
    {
        $this->ensureIsNotEmpty($password);
        $this->ensureMaxLength($password);
        $this->ensureMinLength($password);
    }

    private function ensureIsNotEmpty(string $password): void
    {
        if (empty($password)) {
            throw new InvalidArgumentException('Password cannot be empty', 400);
        }
    }

    private function ensureMaxLength(string $password): void
    {
        if (strlen($password) > self::MAX_LENGTH) {
            throw new InvalidArgumentException('Password cannot exceed ' . self::MAX_LENGTH . ' characters', 422);
        }
    }

    private function ensureMinLength(string $password): void
    {
        if (strlen($password) < self::MIN_LENGTH) {
            throw new InvalidArgumentException('Password must be at least ' . self::MIN_LENGTH . ' characters long', 422);
        }
    }

    public function value(): string
    {
        return $this->password;
    }
}