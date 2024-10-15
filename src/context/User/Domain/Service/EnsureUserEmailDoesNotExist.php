<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Service;

use Src\Context\User\Domain\Exceptions\DuplicateEmailException;
use Src\Context\User\Domain\UserRepository;

final class EnsureUserEmailDoesNotExist
{
    public function __construct(
        private readonly UserRepository $repository
    ) {
    }

    /**
     * @throws DuplicateEmailException
     */
    public function handle(string $email): void
    {
        $user = $this->repository->find('email', $email);

        if ($user !== null) {
            throw new DuplicateEmailException;
        }
    }
}
