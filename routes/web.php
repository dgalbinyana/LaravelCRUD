<?php

use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\User\GetUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/users'], function () {
    Route::post('', [CreateUserController::class, 'handle']);
    Route::get('/{id}', [GetUserController::class, 'handle']);
});
