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
    public function create(User $user): void
    {
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
        $eloquentUser = EloquentUser::query()->where('email', $email->value())->first();

        if (null === $eloquentUser) {
            return null;
        }

        return User::fromArray(
            $eloquentUser->toArray()
        );
    }

    public function find(UserId $id): ?User
    {
        $eloquentUser = EloquentUser::query()->where('id', $id->value())->first();

        if (null === $eloquentUser) {
            return null;
        }

        return User::fromArray(
            $eloquentUser->toArray()
        );
    }

    public function update(User $user): void
    {
        EloquentUser::query()
                    ->where('id', $user->id()->value())
                    ->update([
                        'name'     => $user->name()->value(),
                        'email'    => $user->email()->value(),
                        'password' => $user->password()->value(),
                        'surname'  => $user->surname()->value(),
                    ]);
    }
}