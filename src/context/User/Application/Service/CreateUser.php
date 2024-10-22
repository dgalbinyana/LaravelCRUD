<?php

declare(strict_types = 1);

namespace Src\Context\User\Application\Service;

use Src\Context\User\Application\DTO\CreateUserDTO;
use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\Exceptions\DuplicateEmailException;
use Src\Context\User\Domain\Repository\UserRepository;
use Src\Context\User\Domain\Service\EnsureUserEmailDoesNotExist;
use Src\Context\User\Domain\ValueObjects\UserEmail;
use Src\Context\User\Domain\ValueObjects\UserName;
use Src\Context\User\Domain\ValueObjects\UserPassword;
use Src\Context\User\Domain\ValueObjects\UserSurname;

final class CreateUser
{
    public function __construct(
        private readonly EnsureUserEmailDoesNotExist $ensureUserEmailDoesNotExist,
        private readonly UserRepository $repository,
    ) {
    }

    /**
     * @throws DuplicateEmailException
     */
    public function handle(CreateUserDTO $userDTO): string
    {
        $this->ensureUserEmailDoesNotExist->handle(new UserEmail($userDTO->email));

        $user = User::create(
            new UserName($userDTO->name),
            new UserEmail($userDTO->email),
            new UserPassword($userDTO->password),
            new UserSurname($userDTO->surname)
        );

        $this->repository->create($user);

        return $user->id()->value();
    }
}
