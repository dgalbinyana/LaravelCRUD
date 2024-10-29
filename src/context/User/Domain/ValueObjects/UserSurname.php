<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

final class UserSurname
{
    private const MAX_LENGTH = 255;

    public function __construct(private readonly ?string $surname)
    {
        if (null !== $this->surname) {
            $this->ensureIsNotEmpty($surname);
            $this->ensureMaxLength($surname);
        }
    }

    private function ensureIsNotEmpty(string $surname): void
    {
        if (empty($surname)) {
            throw new InvalidArgumentException('User surname cannot be empty', Response::HTTP_BAD_REQUEST);
        }
    }

    private function ensureMaxLength(string $surname): void
    {
        if (strlen($surname) > self::MAX_LENGTH) {
            throw new InvalidArgumentException('User surname cannot exceed ' . self::MAX_LENGTH . ' characters', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function value(): ?string
    {
        return $this->surname;
    }
}