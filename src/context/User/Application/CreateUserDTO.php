<?php

declare(strict_types = 1);

namespace Src\Context\User\Application;

final class CreateUserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $surname,
        public readonly string $email,
        public readonly string $password
    ) {
    }
}