<?php

declare(strict_types = 1);

namespace Src\Context\User\Infrastructure;

use Src\Context\User\Domain\UserRepository;
use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\ValueObjects\UserName;
use Src\Context\User\Domain\ValueObjects\UserSurname;
use Src\Context\User\Domain\ValueObjects\UserEmail;
use Src\Context\User\Domain\ValueObjects\UserPassword;
use App\Models\User as EloquentUser;

final class MySQLUserRepository implements UserRepository
{
    public function create(
        UserName $name,
        UserSurname $surname,
        UserEmail $email,
        UserPassword $password
    ): User {
        $eloquentUser           = new EloquentUser();
        $eloquentUser->name     = $name->value();
        $eloquentUser->surname  = $surname->value();
        $eloquentUser->email    = $email->value();
        $eloquentUser->password = bcrypt($password->value());
        $eloquentUser->save();

        return new User(
            $eloquentUser->id,
            $name->value(),
            $surname->value(),
            $email->value()
        );
    }
}