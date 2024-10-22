<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Src\Context\User\Application\DTO\CreateUserDTO;
use Src\Context\User\Application\Service\CreateUser;
use Src\Context\User\Domain\Exceptions\DuplicateEmailException;
use Throwable;

final class CreateUserController extends Controller
{
    public function __construct(private readonly CreateUser $createUser) { }

    public function handle(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'name'     => 'required|string|max:255',
                'surname'  => 'nullable|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|max:255',
            ]);

            $userId = $this->createUser->handle(
                new CreateUserDTO(
                    $request->input('name'),
                    $request->input('email'),
                    $request->input('password'),
                    $request->input('surname')
                )
            );

            return response()->json($userId, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);
        } catch (DuplicateEmailException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 409);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}