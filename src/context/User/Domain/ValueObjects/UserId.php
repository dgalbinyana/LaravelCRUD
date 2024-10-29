<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Src\Context\Shared\Domain\ValueObjects\StringValueObject;
use Symfony\Component\HttpFoundation\Response;

final class UserId extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsValidUUID($value);
        parent::__construct($value);
    }

    private function ensureIsValidUUID(string $value): void
    {
        if (!Str::isUuid($value)) {
            throw new InvalidArgumentException("Invalid UUID: $value", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public static function create(): self
    {
        return new self((string)Str::uuid());
    }
}