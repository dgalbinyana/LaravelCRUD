<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

final class UserId
{
    public function __construct(private readonly string $value)
    {
        $this->ensureIsValidUuid($value);
    }

    private function ensureIsValidUuid(string $value): void
    {
        if (!Str::isUuid($value)) {
            throw new InvalidArgumentException("Invalid UUID: $value", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public static function create(): self
    {
        return new self((string)Str::uuid());
    }

    public function value(): string
    {
        return $this->value;
    }
}
