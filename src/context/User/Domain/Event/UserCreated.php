<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Event;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Src\Context\User\Domain\Entity\User;

final class UserCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(private readonly User $user)
    {
    }

    public function user(): User
    {
        return $this->user;
    }
}