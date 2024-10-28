<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Src\Context\User\Application\DTO\DeleteUserDTO;
use Src\Context\User\Application\Service\DeleteUser;
use Src\Context\User\Domain\Exceptions\UserNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class DeleteUserController extends Controller
{
    public function __construct(private readonly DeleteUser $deleteUser)
    {
    }

    public function handle(string $id): JsonResponse
    {
        try {
            $this->deleteUser->handle(new DeleteUserDTO($id));

            return response()->json(null,Response::HTTP_NO_CONTENT);
        } catch (UserNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], $e->getCode());
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}