<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::middleware('auth')->post('/user', function (Request $request) {
          return Auth::user();
        });

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
          ->middleware('guest')
          ->name('login');

    Route::post('/register', [RegisteredUserController::class, 'store'])
          ->middleware('guest')
          ->name('register');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
          ->middleware('auth')
          ->name('logout');

    Route::get('/get_sections', [ApiController::class, 'get_sections'])
          ->middleware('auth')
          ->name('get_sections');

    Route::get('/get_topics', [ApiController::class, 'get_topics'])
          ->middleware('auth')
          ->name('get_topics');
        
    Route::get('/get_lecture', [ApiController::class, 'get_lecture'])
          ->middleware('auth')
          ->name('get_lecture');

    Route::get('/orders', [ApiController::class, 'orders'])
          ->middleware('auth')
          ->name('orders');

    Route::post('/send_comment', [ApiController::class, 'send_comment'])
          ->middleware('auth')
          ->name('send_comment');

    Route::get('/get_Quiz', [ApiController::class, 'get_Quiz'])
          ->middleware('auth')
          ->name('post_Quiz');

    Route::post('/order', [ApiController::class, 'order'])
          ->middleware('auth')
          ->name('get_Quiz');
});


