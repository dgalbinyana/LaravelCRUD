<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Exceptions;

use Exception;

final class UserNotFoundException extends Exception
{
    public function __construct(string $id)
    {
        parent::__construct("User with ID $id not found.", 404);
    }
}