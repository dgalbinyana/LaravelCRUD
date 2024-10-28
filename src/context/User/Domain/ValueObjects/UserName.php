<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserName
{
    private const MAX_LENGTH = 255;

    public function __construct(private readonly string $name)
    {
        $this->ensureIsNotEmpty($name);
        $this->ensureMaxLength($name);
    }

    private function ensureIsNotEmpty(string $name): void
    {
        if (empty($name)) {
            throw new InvalidArgumentException('User name cannot be empty', 400);
        }
    }

    private function ensureMaxLength(string $name): void
    {
        if (strlen($name) > self::MAX_LENGTH) {
            throw new InvalidArgumentException('User name cannot exceed ' . self::MAX_LENGTH . ' characters', 422);
        }
    }

    public function value(): string
    {
        return $this->name;
    }
}