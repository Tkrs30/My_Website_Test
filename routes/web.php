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

Route::resource('houses', HousesController::class , [
    'names' => [
        'index' => 'houses',
        'create' => 'house-create',
        'edit' => 'house-edit',
]]);

Route::get('/houses/{house}/delete',  [HousesController::class, 'delete'])->name('house-delete');
Route::get('/houses/{house}/duplicate', [HousesController::class, 'duplicate'])->name('house-duplicate');
Route::get('/data/houses', [HousesController::class, 'data']);
Route::post('/data/deleted', [HousesController::class, 'deleteselected']);


require __DIR__.'/auth.php';