<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Controllers\UserController;

Route::apiResource('users', UserController::class);