<?php

declare(strict_types = 1);

namespace Src\Context\User\Domain\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

final class DuplicateEmailException extends Exception
{
    public function __construct()
    {
        parent::__construct("This email is already registered.", Response::HTTP_CONFLICT);
    }
}