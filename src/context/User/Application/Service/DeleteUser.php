<?php

declare(strict_types = 1);

namespace Src\Context\User\Application\Service;

use Src\Context\User\Application\DTO\DeleteUserDTO;
use Src\Context\User\Domain\Exceptions\UserNotFoundException;
use Src\Context\User\Domain\Repository\UserRepository;
use Src\Context\User\Domain\ValueObjects\UserId;

final class DeleteUser
{
    public function __construct(private readonly UserRepository $repository) { }

    /**
     * @throws UserNotFoundException
     */
    public function handle(DeleteUserDTO $deleteUserDTO): void
    {
        $user = $this->repository->find(new UserId($deleteUserDTO->id));

        if (null === $user) {
            throw new UserNotFoundException($deleteUserDTO->id);
        }

        $this->repository->delete($user->id());
    }
}

