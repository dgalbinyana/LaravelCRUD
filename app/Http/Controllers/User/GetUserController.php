<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Src\Context\User\Application\DTO\FindUserDTO;
use Src\Context\User\Application\Service\FindUser;
use Src\Context\User\Domain\Exceptions\UserNotFoundException;
use Throwable;

final class GetUserController extends Controller
{
    public function __construct(private readonly FindUser $findUser) { }

    public function handle(string $id): JsonResponse
    {
        try {
            $user = $this->findUser->handle(new FindUserDTO($id));

            return response()->json($user->toResponse());
        } catch (UserNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], $e->getCode());
        }
    }
}