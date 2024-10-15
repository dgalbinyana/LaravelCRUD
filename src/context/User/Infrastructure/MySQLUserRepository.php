<?php

declare(strict_types = 1);

namespace Src\Context\User\Infrastructure;

use Src\Context\User\Domain\UserRepository;
use Src\Context\User\Domain\Entity\User;
use App\Models\User as EloquentUser;
use Src\Context\User\Domain\ValueObjects\UserEmail;
use Src\Context\User\Domain\ValueObjects\UserId;
use Src\Context\User\Domain\ValueObjects\UserName;
use Src\Context\User\Domain\ValueObjects\UserPassword;
use Src\Context\User\Domain\ValueObjects\UserSurname;

final class MySQLUserRepository implements UserRepository
{
    public function create(
        User $user
    ): void {
        $eloquentUser           = new EloquentUser();
        $eloquentUser->id       = $user->email()->value();
        $eloquentUser->name     = $user->name()->value();
        $eloquentUser->surname  = $user->surname()?->value();
        $eloquentUser->email    = $user->email()->value();
        $eloquentUser->password = bcrypt($user->password()->value());
        $eloquentUser->save();
    }

    public function find(string $field, string $value): ?User
    {
        $eloquentUser = EloquentUser::where($field, $value)->first();

        if ($eloquentUser === null) {
            return null;
        }

        return User::fromDatabase(
            UserId::fromDatabase($eloquentUser->id),
            new UserName($eloquentUser->name),
            new UserEmail($eloquentUser->email),
            new UserPassword($eloquentUser->password),
            $eloquentUser->surname ? new UserSurname($eloquentUser->surname) : null
        );
    }
}