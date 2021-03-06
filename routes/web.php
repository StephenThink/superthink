<?php

use App\Http\Livewire\frontend\Frontpage;
use App\Models\Client;
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

]], function () {

    Route::get('/dashboard', function () {
        $clients = Client::all();
        return view('dashboard', ['clients' => $clients]);
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

    Route::get('/users/trash', function () {
        return view('admin.trashed.users');
    })->name('users-trashed');

    Route::get('/holidays', function () {
        return view('admin.holidays');
    })->name('holidays');

    Route::get('/holidays/overview', function () {
        return view('admin.holidays-overview');
    })->name('holidays-overview');

    Route::get('/roles', function () {
        return view('admin.roles');
    })->name('roles');

    Route::get('/workingdays', function () {
        return view('admin.workingdays');
    })->name('workingdays');

    Route::get('/clients', function () {
        return view('clients.clients');
    })->name('clients');

    Route::get('/vaults', function () {
        return view('clients.vaults');
    })->name('vaults');

    Route::get('/clients/profile/{id}', function ($id) {
        return view('clients.profile', ['id' => $id]);
    })->name('client-profile');

    Route::get('/clients/contacts', function () {
        return view('clients.contacts');
    })->name('client-contacts');

    Route::get('/messages', function () {
        return view('messages.centre');
    })->name('messages-centre');

    Route::get('/messages/trash', function () {
        return view('admin.trashed.messages');
    })->name('messages-trashed');

    Route::get('/reset/holidays', function () {
        return view('reset.holidays');
    })->name('reset-holidays');

    Route::get('/settings/address-types', function () {
        return view('settings.address-types');
    })->name('settings-address-types');
});


Route::get('/{urlslug}', Frontpage::class);
Route::get('/', Frontpage::class);
