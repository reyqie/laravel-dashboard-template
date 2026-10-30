<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->group(function (): void {
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/analytics', 'analytics')->name('analytics');
    Route::get('/orders', 'orders')->name('orders');
    Route::get('/customers', 'customers')->name('customers');
    Route::get('/settings', 'settings')->name('settings');
});
