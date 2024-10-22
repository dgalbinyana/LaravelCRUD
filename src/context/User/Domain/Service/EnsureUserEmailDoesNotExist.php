<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Service;

use Src\Context\User\Domain\Exceptions\DuplicateEmailException;
use Src\Context\User\Domain\Repository\UserRepository;
use Src\Context\User\Domain\ValueObjects\UserEmail;

final class EnsureUserEmailDoesNotExist
{
    public function __construct(
        private readonly UserRepository $repository
    ) {
    }

    /**
     * @throws DuplicateEmailException
     */
    public function handle(UserEmail $email): void
    {
        $user = $this->repository->findByEmail($email);

        if (null !== $user) {
            throw new DuplicateEmailException;
        }
    }
}
