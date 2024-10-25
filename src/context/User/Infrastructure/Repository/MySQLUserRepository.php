<?php

declare(strict_types = 1);

namespace Src\Context\User\Infrastructure\Repository;

use App\Models\User as EloquentUser;
use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\Repository\UserRepository;
use Src\Context\User\Domain\ValueObjects\UserEmail;
use Src\Context\User\Domain\ValueObjects\UserId;

final class MySQLUserRepository implements UserRepository
{
    public function create(
        User $user
    ): void {
        $eloquentUser           = new EloquentUser();
        $eloquentUser->id       = $user->id()->value();
        $eloquentUser->name     = $user->name()->value();
        $eloquentUser->surname  = $user->surname()->value();
        $eloquentUser->email    = $user->email()->value();
        $eloquentUser->password = bcrypt($user->password()->value());
        $eloquentUser->save();
    }

    public function findByEmail(UserEmail $email): ?User
    {
        $eloquentUser = EloquentUser::where('email', $email->value())->first();

        if (null === $eloquentUser) {
            return null;
        }

        return User::fromArray(
            $eloquentUser->toArray()
        );
    }

    public function find(UserId $id): ?User
    {
        $eloquentUser = EloquentUser::where('id', $id->value())->first();

        if (null === $eloquentUser) {
            return null;
        }

        return User::fromArray(
            $eloquentUser->toArray()
        );
    }
}