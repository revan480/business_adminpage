<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('landing');
});

// Customers Routes
Route::prefix('customers')->group(function () {
    Route::get('/', [CustomersController::class, 'index'])->name('customers.index');
    Route::get('/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::post('/store', [CustomersController::class, 'store'])->name('customers.store');
    Route::get('/{customer}', [CustomersController::class, 'show'])->name('customers.show');
    Route::get('/{customer}/edit', [CustomersController::class, 'edit'])->name('customers.edit');
    Route::put('/{customer}', [CustomersController::class, 'update'])->name('customers.update');
    Route::delete('/{customer}', [CustomersController::class, 'destroy'])->name('customers.destroy');
});


// Expenses Routes
Route::prefix('expenses')->group(function () {
    Route::get('/', [ExpensesController::class, 'index'])->name('expenses.index');
    Route::get('/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::post('/store', [ExpensesController::class, 'store'])->name('expenses.store');
    Route::get('/{expense}/edit', [ExpensesController::class, 'edit'])->name('expenses.edit');
    Route::put('/{expense}', [ExpensesController::class, 'update'])->name('expenses.update');
    Route::delete('/{expense}', [ExpensesController::class, 'destroy'])->name('expenses.destroy');
});

// Reports Routes
Route::prefix('reports')->group(function () {
    Route::get('/financial', [ReportsController::class, 'financial'])->name('reports.financial');
    Route::match(['get', 'post'], '/reports/financial-report', [ReportsController::class, 'financialReport'])->name('reports.financialReport');
});

Route::get('/whatsapp', [CustomersController::class, 'whatsapp'])->name('whatsapp');
Route::post('/customers/{customer}/send-whatsapp', [CustomersController::class, 'sendWhatsApp'])->name('whatsapp.send');
