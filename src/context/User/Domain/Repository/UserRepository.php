<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Repository;

use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\ValueObjects\UserEmail;
use Src\Context\User\Domain\ValueObjects\UserId;

interface UserRepository
{
    public function create(User $user): void;

    public function findByEmail(UserEmail $email): ?User;

    public function find(UserId $id): ?User;

    public function update(User $user): void;

    public function delete(UserId $id): void;
}