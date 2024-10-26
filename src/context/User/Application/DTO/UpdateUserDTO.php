<?php

declare(strict_types = 1);

namespace Src\Context\User\Application\DTO;

final class UpdateUserDTO
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $email = null,
        public ?string $actualPassword = null,
        public ?string $newPassword = null,
        public ?string $surname = null
    ) {
    }
}