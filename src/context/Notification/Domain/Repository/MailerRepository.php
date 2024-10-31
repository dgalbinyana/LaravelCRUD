<?php

namespace Src\Context\Notification\Domain\Repository;

use Src\Context\User\Domain\Entity\User;

interface MailerRepository
{
    public function sendWelcomeEmail(User $user): void;
}