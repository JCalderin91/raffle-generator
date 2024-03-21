<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RaffleConfigurationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('participants', ParticipantController::class);
Route::resource('raffles', RaffleConfigurationController::class);
Route::get('tickets/{ticketId}/print', [TicketController::class,'print'])->name('tickets.print');
Route::resource('tickets', TicketController::class);
