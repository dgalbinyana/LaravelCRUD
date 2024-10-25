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
    public function __construct(
        private readonly UserId $id,
        private readonly UserName $name,
        private readonly UserEmail $email,
        private readonly UserPassword $password,
        private readonly ?UserSurname $surname = null
    ) {
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

    public static function fromArray(array $user): self
    {
        return new self(
            new UserId($user['id']),
            new UserName($user['name']),
            new UserEmail($user['email']),
            new UserPassword($user['password']),
            new UserSurname($user['surname'])
        );
    }

    public function toResponse(): array
    {
        return [
            'id'      => $this->id->value(),
            'name'    => $this->name->value(),
            'email'   => $this->email->value(),
            'surname' => $this->surname?->value(),
        ];
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

