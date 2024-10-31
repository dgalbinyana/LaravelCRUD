<?php

declare(strict_types = 1);

namespace Src\Context\Notification\Application\Service;

use Src\Context\Notification\Domain\Repository\MailerRepository;
use Src\Context\User\Domain\Entity\User;

final class SendWelcomeEmail
{
    public function __construct(private readonly MailerRepository $mailerRepository) { }

    public function handle(User $user): void
    {
        $this->mailerRepository->sendWelcomeEmail($user);
    }
}