<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Exceptions;

use Exception;

final class DuplicateEmailException extends Exception
{
    public function __construct()
    {
        parent::__construct("This email is already registered.");
    }
}