<?php

use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\auth\AuthLogin;
use App\Http\Controllers\transaktions\TransaktionsConroller;
use App\Http\Controllers\drivers\DriversController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tickets\TicketsController;
use App\Http\Controllers\UserManagementController;



Route::get('/login', [AuthLogin::class, 'index'])->name('login');
Route::post('/login', [AuthLogin::class, 'login'])->name('login.auth');
Route::post('/logout', [AuthLogin::class, 'logout'])->name('logout.auth');
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::resource('users', UserManagementController::class);
});


// Route::get('/', function () {
//     return view('index');
// })->middleware('auth')->name('dashboard');

Route::get('/', [DashboardController::class, 'CountTransactions'])->middleware('auth')->name('dashboard');

Route::get('/drivers', [DriversController::class, 'index'])->middleware('auth')->name('drivers.index');
Route::post('/drivers/store', [DriversController::class, 'store'])->middleware('auth')->name('drivers.store');
Route::get('/drivers/edit/{id}', [DriversController::class, 'edit'])->middleware('auth')->name('drivers.edit');
Route::put('/drivers/update/{id}', [DriversController::class, 'update'])->middleware('auth')->name('drivers.update');
Route::post('/drivers/delete/{id}', [DriversController::class, 'delete'])->middleware('auth')->name('drivers.deleted');

Route::get('/tickets', [TicketsController::class, 'index'])->middleware('auth')->name('tickets.index');
Route::post('/tickets/store', [TicketsController::class, 'store'])->middleware('auth')->name('tickets.store');
Route::get('/tickets/edit/{id}', [TicketsController::class, 'edit'])->middleware('auth')->name('tickets.edit');
Route::put('/tickets/update/{id}', [TicketsController::class, 'update'])->middleware('auth')->name('tickets.update');
Route::post('/tickets/destroy/{id}', [TicketsController::class, 'destroy'])->middleware('auth')->name('tickets.destroy');

Route::get('/transations', [TransaktionsConroller::class, 'transations'])->middleware('auth')->name('transations');
Route::get('/transations/pdf', [TransaktionsConroller::class, 'exportPDF'])->middleware('auth')->name('transations.pdf');
Route::get('/transations/excel', [TransaktionsConroller::class, 'exportExcel'])->middleware('auth')->name('transations.excel');
