<?php

declare(strict_types = 1);

namespace Src\Context\User\Application\Service;

use Src\Context\User\Application\DTO\ReadUserDTO;
use Src\Context\User\Domain\Entity\User;
use Src\Context\User\Domain\Exceptions\UserNotFoundException;
use Src\Context\User\Domain\Repository\UserRepository;
use Src\Context\User\Domain\ValueObjects\UserId;

final class ReadUser
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function handle(ReadUserDTO $DTO): array
    {
        $response = $this->repository->find(new UserId($DTO->id));

        if (null === $response) {
            throw new UserNotFoundException($DTO->id);
        }

        return $response;
    }
}