<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\HousesController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/houses', function () {
    return view('index');
})->middleware(['auth'])->name('houses');

Route::resource('houses', HousesController::class , [     
    'names' => [
        'index' => 'houses',
]]);

Route::post('/houses/{id}/destroy', [HousesController::class, 'destroy']);

Route::post('/houses/{id}/duplicate', [HousesController::class, 'duplicate']);

Route::post('/houses/{id}/update', [HousesController::class, 'update']);

Route::post('/houses/sort/{sort}', [HousesController::class, 'index']);

require __DIR__.'/auth.php';