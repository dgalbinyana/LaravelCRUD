<?php

declare(strict_types = 1);

namespace Src\Context\Notification\Application\Service;

use Src\Context\Notification\Application\DTO\SendWelcomeEmailDTO;
use Src\Context\Notification\Domain\Repository\MailerRepository;

final class SendWelcomeEmail
{
    public function __construct(private readonly MailerRepository $mailerRepository) { }

    public function handle(SendWelcomeEmailDTO $sendWelcomeEmailDTO): void
    {
        $this->mailerRepository->sendWelcomeEmail($sendWelcomeEmailDTO->user);
    }
}