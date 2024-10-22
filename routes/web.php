<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CreateUserController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/users'], function () {
    Route::post('', [CreateUserController::class, 'handle']);
});
