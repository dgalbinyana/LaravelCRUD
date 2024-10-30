<?php

namespace Src\Context\Notification\Domain\Mail;

use Src\Context\User\Domain\Entity\User;

interface UserNotificationEmail
{
    public function sendWelcomeEmail(User $user): void;
}