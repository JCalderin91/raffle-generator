<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Auth\LoginController;
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
    return redirect()->route('participants.index');
});

Route::get('/login', function () {
    return view('pages.auth.login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.show');
Route::post('login', [LoginController::class,'login'])->name('login');
Route::post('logout', [LoginController::class,'logout'])->name('logout');

Route::resource('participants', ParticipantController::class);
Route::resource('raffles', RaffleConfigurationController::class);
Route::get('tickets/{ticketId}/print', [TicketController::class,'print'])->name('tickets.print');
Route::get('tickets/print-all', [TicketController::class,'printAll'])->name('tickets.print.all');
Route::resource('tickets', TicketController::class);
