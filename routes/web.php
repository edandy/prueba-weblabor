<?php

use App\Livewire\Portfolio\Create;
use App\Livewire\Portfolio\Edit;
use App\Livewire\Portfolio\Home;
use App\Livewire\Portfolio\Index;
use App\Livewire\Portfolio\Read;
use Illuminate\Support\Facades\Route;

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

Route::get('/', Home::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'portfolios', 'middleware' => 'auth', 'as' => 'portfolio.'], function() {
    Route::get('/', Index::class)->name('index');

    Route::get('/create', Create::class)->name('create');

    Route::get('/{portfolio}/edit', Edit::class)->name('edit');
});
