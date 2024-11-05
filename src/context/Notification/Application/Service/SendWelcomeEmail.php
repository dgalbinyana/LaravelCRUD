<?php

declare(strict_types = 1);

namespace Src\Context\Notification\Application\Service;

use Src\Context\Notification\Application\DTO\SendWelcomeEmailDTO;
use Src\Context\Notification\Domain\Repository\MailerRepository;
use Src\Context\User\Domain\Exceptions\UserNotFoundException;
use Src\Context\User\Domain\Repository\UserRepository;
use Src\Context\User\Domain\ValueObjects\UserId;

final class SendWelcomeEmail
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly MailerRepository $mailerRepository
    )
    {
    }

    /**
     * @throws UserNotFoundException
     */
    public function handle(SendWelcomeEmailDTO $sendWelcomeEmailDTO): void
    {
        $user = $this->userRepository->find(new UserId($sendWelcomeEmailDTO->id));

        if (null === $user) {
            throw new UserNotFoundException($sendWelcomeEmailDTO->id);
        }

        $this->mailerRepository->sendWelcomeEmail($user);
    }
}