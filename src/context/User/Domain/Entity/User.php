<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Entity;

use Src\Context\User\Domain\ValueObjects\UserId;
use Src\Context\User\Domain\ValueObjects\UserEmail;
use Src\Context\User\Domain\ValueObjects\UserName;
use Src\Context\User\Domain\ValueObjects\UserPassword;
use Src\Context\User\Domain\ValueObjects\UserSurname;

final class User
{
    private function __construct(
        private readonly UserId $id,
        private readonly UserName $name,
        private readonly UserEmail $email,
        private readonly UserPassword $password,
        private readonly ?UserSurname $surname = null
    )
    {
    }

    public static function create(
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        ?UserSurname $surname = null
    ): self {
        return new self(
            UserId::create(),
            $name,
            $email,
            $password,
            $surname
        );
    }

    public static function fromDatabase(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        ?UserSurname $surname = null
    ): self {
        return new self(
            $id,
            $name,
            $email,
            $password,
            $surname
        );
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function surname(): ?UserSurname
    {
        return $this->surname;
    }
}

