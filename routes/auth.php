<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register');

Route::get('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

Route::get('/get_sections', [ApiController::class, 'get_sections'])
                ->middleware('auth')
                ->name('get_sections');

Route::get('/get_topics', [ApiController::class, 'get_topics'])
                ->middleware('auth')
                ->name('get_topics');
        
Route::get('/orders', [ApiController::class, 'orders'])
                ->middleware('auth')
                ->name('orders');

Route::get('/send_comment', [ApiController::class, 'send_comment'])
                ->middleware('auth')
                ->name('send_comment');

Route::get('/get_Quiz', [ApiController::class, 'get_Quiz'])
                ->middleware('auth')
                ->name('get_Quiz');

Route::get('/order', [ApiController::class, 'order'])
                ->middleware('auth')
                ->name('get_Quiz');
