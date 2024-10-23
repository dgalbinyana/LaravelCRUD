<?php

declare(strict_types = 1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Src\Context\User\Application\DTO\ReadUserDTO;
use Src\Context\User\Application\Service\ReadUser;
use Src\Context\User\Domain\Exceptions\UserNotFoundException;
use Throwable;

class ReadUserController extends Controller
{
    public function __construct(private readonly ReadUser $readUser) { }

    public function handle(string $id): JsonResponse
    {
        try {
            $this->validate(
                new Request(['id' => $id]),
                ['id' => 'uuid']
            );

            $response = $this->readUser->handle(new ReadUserDTO($id));

            return response()->json($response);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);
        }catch (UserNotFoundException $e){
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
