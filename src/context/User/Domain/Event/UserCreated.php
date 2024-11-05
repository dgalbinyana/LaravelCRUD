<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Event;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class UserCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public readonly string $userId)
    {
    }
}