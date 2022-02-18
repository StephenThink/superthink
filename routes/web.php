<?php

use App\Http\Livewire\Frontpage;
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



// This will only allow people who are authicated and have verfied their emails
Route::group(['middleware' => [
    'auth:sanctum',
    'verified',
    'accessrole'
]], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/pages', function () {
        return view('admin.pages');
    })->name('pages');

    Route::get('/navigation-menus', function () {
        return view('admin.navigation-menus');
    })->name('navigation-menus');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');

    Route::get('/user-permissions', function () {
        return view('admin.user-permissions');
    })->name('user-permissions');

    Route::get('/holidays', function () {
        return view('admin.holidays');
    })->name('holidays');

    Route::get('/holidays/overview', function () {
        return view('admin.holidays-overview');
    })->name('holidays-overview');

});


Route::get('/{urlslug}', Frontpage::class);
Route::get('/', Frontpage::class);
