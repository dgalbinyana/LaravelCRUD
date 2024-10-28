<?php
declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserEmail
{
    private string $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format", 422);
        }
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}