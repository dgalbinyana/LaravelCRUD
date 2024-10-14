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

    public function handle(CreateUserDTO $userDTO): User
    {
        $userName     = new UserName($userDTO->name);
        $userSurname  = new UserSurname($userDTO->surname);
        $userEmail    = new UserEmail($userDTO->email);
        $userPassword = new UserPassword($userDTO->password);

        $user = $this->repository->create($userName, $userSurname, $userEmail, $userPassword);

        return $user;
    }
}
