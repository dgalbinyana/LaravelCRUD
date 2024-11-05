<?php

declare(strict_types = 1);

namespace Src\Context\Notification\Application\Subscriber;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Src\Context\Notification\Application\DTO\SendWelcomeEmailDTO;
use Src\Context\Notification\Application\Service\SendWelcomeEmail;
use Src\Context\User\Domain\Event\UserCreated;
use Src\Context\User\Domain\Exceptions\UserNotFoundException;

final class SendWelcomeEmailOnUserRegistration implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(private readonly SendWelcomeEmail $sendWelcomeEmail) { }

    public function handle(UserCreated $event): void
    {
        try {
            $this->sendWelcomeEmail->handle(new SendWelcomeEmailDTO($event->userId()));
        } catch (UserNotFoundException $e) {
            Log::info('User not found for sending welcome email', [
                'userId'           => $event->userId(),
                'exceptionMessage' => $e->getMessage()
            ]);
        }
    }
}