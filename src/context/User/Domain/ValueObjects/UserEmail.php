<?php
declare(strict_types = 1);

namespace Src\Context\User\Domain\ValueObjects;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

final class UserEmail
{
    private string $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}