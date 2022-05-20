<?php

use App\Http\Controllers\courseController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\MyController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('course', courseController::class);
Route::resource('student', studentController::class);


Route::get('export',[MyController::class,'export']);
  
Route::get('importExportView', 'MyController@importExportView');
Route::post('import', 'MyController@import')->name('import');