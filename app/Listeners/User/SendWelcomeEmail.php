<?php

declare(strict_types = 1);

namespace App\Listeners\User;

use App\Events\User\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Src\Context\User\Application\Service\WelcomeEmail;

final class SendWelcomeEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserCreated $event): void
    {
        $user = $event->user();

        Mail::to($user->email()->value())->send(new WelcomeEmail($user));
    }
}