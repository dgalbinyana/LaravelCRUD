<?php

declare(strict_types = 1);

namespace Src\Context\User\Application\Service;

use Src\Context\User\Application\DTO\FindUserDTO;
use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\Exceptions\UserNotFoundException;
use Src\Context\User\Domain\Repository\UserRepository;
use Src\Context\User\Domain\ValueObjects\UserId;

final class FindUser
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function handle(FindUserDTO $findUserDTO): User
    {
        $user = $this->repository->find(new UserId($findUserDTO->id));

        if (null === $user) {
            throw new UserNotFoundException($findUserDTO->id);
        }

        return $user;
    }
}