<?php

declare(strict_types = 1);

namespace Src\Context\User\Application;

use Src\Context\User\Domain\UserRepository;
use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\ValueObjects\UserName;
use Src\Context\User\Domain\ValueObjects\UserSurname;
use Src\Context\User\Domain\ValueObjects\UserEmail;
use Src\Context\User\Domain\ValueObjects\UserPassword;

final class CreateUser
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function handle(CreateUserDTO $userDTO): string
    {
        $user = User::create(
            new UserName($userDTO->name),
            new UserEmail($userDTO->email),
            new UserPassword($userDTO->password),
            $userDTO->surname ? new UserSurname($userDTO->surname) : null
        );

        $this->repository->create($user);

        return $user->id()->value();
    }
}
