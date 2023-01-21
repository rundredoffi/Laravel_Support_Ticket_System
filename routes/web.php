<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Authentication related routes */
Auth::routes(['verify' => true]);

/* Home redirect to login */
Route::redirect('/', '/login');

/* Route group accessible only by authenticated users */
Route::middleware('auth')->group(function () {
    /* Dashboard */
    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)
        ->name('dashboard');

    /* Tickets group */
    Route::name('tickets.')->prefix('tickets')->group(function () {
        /* Tickets */
        Route::patch('/{ticket}/close', [\App\Http\Controllers\Ticket\TicketController::class, 'close'])
            ->name('close');
        Route::resource('/', \App\Http\Controllers\Ticket\TicketController::class)
            ->parameter('', 'ticket');

        /* Ticket comments */
        Route::post('comments/{ticket}', [\App\Http\Controllers\Ticket\TicketCommentController::class, 'store'])
            ->name('comments.store');
        Route::resource('comments', \App\Http\Controllers\Ticket\TicketCommentController::class)
            ->only(['edit', 'update', 'destroy'])
            ->parameter('ticketComment', 'comment');
    });

    /* Users */
    Route::resource('users', \App\Http\Controllers\UserController::class)
        ->only(['index', 'edit', 'update']);

    /* Categories */
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)
        ->except(['show']);

    /* Labels */
    Route::resource('labels', \App\Http\Controllers\LabelController::class)
        ->except(['show']);

    /* Priorities */
    Route::resource('priorities', \App\Http\Controllers\PriorityController::class)
        ->except(['show']);

    /* Activities  */
    Route::get('/activities', \App\Http\Controllers\ActivityController::class)
        ->name('activities');
});