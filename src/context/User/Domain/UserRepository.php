<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain;

use Src\Context\User\Domain\Entity\User;

interface UserRepository
{
    public function create(User $user): void;

    public function find(string $field, string $value): ?User;

}