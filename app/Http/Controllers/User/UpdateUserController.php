<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Src\Context\User\Application\DTO\UpdateUserDTO;
use Src\Context\User\Application\Service\UpdateUser;
use Src\Context\User\Domain\Exceptions\DuplicateEmailException;
use Src\Context\User\Domain\Exceptions\UserPasswordDoesNotMatch;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class UpdateUserController extends Controller
{
    public function __construct(private readonly UpdateUser $updateUser) { }

    public function handle(string $id, Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'name'                      => 'required|string|max:255',
                'email'                     => 'sometimes|email|unique:users,email,' . $id,
                'actual_password'           => 'required|string|min:6|max:255',
                'new_password'              => 'required_with:new_password_confirmation|string|min:6|max:255|confirmed',
                'new_password_confirmation' => 'sometimes|string|min:6|max:255',
                'surname'                   => 'nullable|string|max:255',
            ]);

            $user = $this->updateUser->handle(
                new UpdateUserDTO(
                    $id,
                    $request->input('name'),
                    $request->input('actual_password'),
                    $request->input('email'),
                    $request->input('new_password'),
                    $request->input('surname'),
                )
            );

            return response()->json($user->toResponse());
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], $e->status);
        } catch (DuplicateEmailException|UserPasswordDoesNotMatch $e) {
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