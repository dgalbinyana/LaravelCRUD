<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use InvalidArgumentException;
use Src\Context\Shared\Domain\ValueObjects\StringValueObject;
use Symfony\Component\HttpFoundation\Response;

final class UserEmail extends StringValueObject
{
    public function __construct(string $email)
    {
        $this->ensureIsValidEmail($email);

        parent::__construct($email);
    }

    public function ensureIsValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}