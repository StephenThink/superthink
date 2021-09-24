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

// Route::statamic('core/{core-service}', 'pages.services');
// Route::get('core/{slug}', function($slug) {
//     dd($slug);
// });

Route::redirect('/core/{slug}', '/services/core/{slug}', 301);
Route::redirect('/case_studies/core/{slug}', '/services/core/{slug}', 301);




Route::get('/work/{service}/all', 'CaseStudyController@index');

Route::post('/secret-santa-results', 'SecretSantaController');

Route::statamic('/apply/{role}', 'jobs.application_form');
