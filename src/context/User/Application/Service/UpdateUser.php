<?php

declare(strict_types = 1);

namespace Src\Context\User\Application\Service;

use Src\Context\User\Application\DTO\UpdateUserDTO;
use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\Exceptions\DuplicateEmailException;
use Src\Context\User\Domain\Exceptions\UserNotFoundException;
use Src\Context\User\Domain\Exceptions\UserPasswordDoesNotMatch;
use Src\Context\User\Domain\Repository\UserRepository;
use Src\Context\User\Domain\Service\EnsureUserEmailDoesNotExist;
use Src\Context\User\Domain\Service\VerifyUserPassword;
use Src\Context\User\Domain\ValueObjects\UserEmail;
use Src\Context\User\Domain\ValueObjects\UserId;
use Src\Context\User\Domain\ValueObjects\UserName;
use Src\Context\User\Domain\ValueObjects\UserPassword;
use Src\Context\User\Domain\ValueObjects\UserSurname;

final class UpdateUser
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly VerifyUserPassword $verifyUserPassword,
        private readonly EnsureUserEmailDoesNotExist $ensureUserEmailDoesNotExist
    ) {
    }

    /**
     * @throws UserNotFoundException
     * @throws DuplicateEmailException
     * @throws UserPasswordDoesNotMatch
     */
    public function handle(UpdateUserDTO $updateUserDTO): User
    {
        $user = $this->repository->find(new UserId($updateUserDTO->id));

        if (null === $user) {
            throw new UserNotFoundException($updateUserDTO->id);
        }

        $this->verifyUserPassword->handle(
            new UserPassword($updateUserDTO->actualPassword),
            $user->password()
        );

        if (null !== $updateUserDTO->email && $updateUserDTO->email !== $user->email()->value()) {
            $this->ensureUserEmailDoesNotExist->handle(new UserEmail($updateUserDTO->email));
        }

        $user->update(
            new UserName($updateUserDTO->name ?? $user->name()->value()),
            new UserEmail($updateUserDTO->email ?? $user->email()->value()),
            new UserPassword(null !== $updateUserDTO->newPassword
                ? bcrypt($updateUserDTO->newPassword)
                : $user->password()->value()),
            new UserSurname($updateUserDTO->surname),
        );

        $this->repository->update($user);

        return $user;
    }
}