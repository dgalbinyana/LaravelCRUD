<?php

use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\User\GetUserController;
use App\Http\Controllers\User\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/users'], function () {
    Route::post('', [CreateUserController::class, 'handle']);
    Route::get('/{id}', [GetUserController::class, 'handle']);
    Route::put('/{id}',[UpdateUserController::class, 'handle']);
    Route::delete('/{id}',[DeleteUserController::class, 'handle']);
});
