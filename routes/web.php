<?php

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

// Route::statamic('example', 'example-view', [
//    'title' => 'Example'
// ]);
Route::get('/work/{service}/all', 'CaseStudyController@index');

// Route::get('/tea-roulette', function() {

//     return (new \Statamic\View\View)
//             ->template('tea-roulette.index')
//             ->layout('layout');
//             // ->with(['data' => $byService]);

// });
