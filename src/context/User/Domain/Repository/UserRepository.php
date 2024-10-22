<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain;

use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\ValueObjects\UserEmail;

interface UserRepository
{
    public function create(User $user): void;

    public function findByEmail(UserEmail $email): ?User;

}