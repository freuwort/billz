<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::middleware('verified')->group(function () {
        Route::prefix('companies')->group(function () {
            Route::get('/', [CompanyController::class, 'index'])->name('companies.index');
            Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
            Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
            Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
            Route::patch('/{company}', [CompanyController::class, 'update'])->name('companies.update');
            Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');
        });

        Route::prefix('customers')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
            Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
            Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
            Route::patch('/{customer}', [CustomerController::class, 'update'])->name('customers.update');
            Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
        });
        
        Route::prefix('invoices')->group(function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('invoices.index');
            Route::get('/create', [InvoiceController::class, 'create'])->name('invoices.create');
            Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store');
            Route::get('/{invoice}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
            Route::patch('/{invoice}', [InvoiceController::class, 'update'])->name('invoices.update');
            Route::delete('/{invoice}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
            Route::get('/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');
        });
    });
});

require __DIR__.'/auth.php';
