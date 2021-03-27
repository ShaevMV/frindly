<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketController;
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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/register', function () {
    return redirect('/');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/', [TicketController::class, 'view'])->name('viewAddTickets');
Route::middleware(['auth:sanctum', 'verified'])->post('/', [TicketController::class, 'add'])->name('addTickets');
Route::middleware(['admin', 'verified'])->get('/admin', [AdminController::class, 'view'])->name('adminView');
