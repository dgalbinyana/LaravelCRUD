<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Entity;

final class User
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $surname,
        private readonly string $email
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function surname(): string
    {
        return $this->surname;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'surname' => $this->surname,
            'email'   => $this->email,
        ];
    }
}
