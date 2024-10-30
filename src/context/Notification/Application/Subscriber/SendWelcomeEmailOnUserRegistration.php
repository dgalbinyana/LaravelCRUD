<?php

declare(strict_types = 1);

namespace Src\Context\Notification\Application\Subscriber;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Src\Context\Notification\Domain\Mail\UserNotificationEmail;
use Src\Context\User\Domain\Event\UserCreated;

final class SendWelcomeEmailOnUserRegistration implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(private readonly UserNotificationEmail $welcomeEmail) { }

    public function handle(UserCreated $event): void
    {
        $this->welcomeEmail->sendWelcomeEmail($event->user());
    }
}