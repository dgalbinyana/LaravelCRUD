<?php
declare(strict_types = 1);

namespace Src\Context\User\Domain\Exceptions;

use Exception;

final class UserPasswordDoesNotMatch extends Exception
{
    public function __construct()
    {
        parent::__construct("User password does not match.", 401);
    }
}