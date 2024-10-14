<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain;

use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\ValueObjects\UserName;
use Src\Context\User\Domain\ValueObjects\UserSurname;
use Src\Context\User\Domain\ValueObjects\UserEmail;
use Src\Context\User\Domain\ValueObjects\UserPassword;

interface UserRepository
{
    public function create(
        UserName $name,
        UserSurname $surname,
        UserEmail $email,
        UserPassword $password
    ): User;

}