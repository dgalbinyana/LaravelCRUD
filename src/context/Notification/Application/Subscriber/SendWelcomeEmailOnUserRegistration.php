<?php

declare(strict_types = 1);

namespace Src\Context\Notification\Application\Subscriber;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Src\Context\Notification\Application\DTO\SendWelcomeEmailDTO;
use Src\Context\Notification\Application\Service\SendWelcomeEmail;
use Src\Context\User\Domain\Event\UserCreated;

final class SendWelcomeEmailOnUserRegistration implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(private readonly SendWelcomeEmail $sendWelcomeEmail) { }

    public function handle(UserCreated $event): void
    {
        $this->sendWelcomeEmail->handle(new SendWelcomeEmailDTO($event->user()));
    }
}