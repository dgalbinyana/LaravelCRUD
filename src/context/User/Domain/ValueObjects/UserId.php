<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use Illuminate\Support\Str;
use InvalidArgumentException;

final class UserId
{
    private function __construct(private readonly string $value)
    {
        $this->ensureIsValidUuid($value);
    }

    private function ensureIsValidUuid(string $value): void
    {
        if (!Str::isUuid($value)) {
            throw new InvalidArgumentException("Invalid UUID: $value");
        }
    }

    public static function create(): self
    {
        return new self((string)Str::uuid());
    }

    public static function fromDatabase(string $uuid): self
    {
        return new self($uuid);
    }

    public function value(): string
    {
        return $this->value;
    }
}
