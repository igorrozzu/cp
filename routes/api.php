<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'users'], function () {
    Route::get('/', UserController::class . '@testAction');
    Route::get('/register', UserController::class . '@register');
});

Route::group(['middleware' => ['jwt']], function () {
    Route::group(['prefix' => 'cinemas'], function () {
        Route::get('/', CinemaController::class . '@readAll');
        Route::get('/{cinema}/showing-movies', CinemaController::class . '@showingMovies');
        Route::get('/{cinema}/reviews', CinemaController::class . '@reviews');
        Route::get('/{cinema}/seats/free',  SeatController::class . '@freeSeats');
    });
    Route::group(['prefix' => 'bookings'], function () {
        Route::post('/', BookingController::class . '@bookSeat');
    });
    Route::group(['prefix' => 'seances'], function () {
        Route::get('/', SeanceController::class . '@readAll');
    });

    Route::group(['prefix' => 'movies'], function () {
        Route::get('/', MovieController::class . '@readAll');
        Route::get('/showing', MovieController::class . '@readAllShown');
        Route::get('/{movie}/showing', MovieController::class . '@readAllShown');
    });
});
    
