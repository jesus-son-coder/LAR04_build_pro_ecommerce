<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

/* Category Controller : */
Route::get('/category/all',[CategoryController::class, 'AllCat'])->name('all.categories');

Route::post('/category/add',[CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class, 'Edit']);

Route::post('/category/update/{id}',[CategoryController::class, 'Update']);

Route::get('/category/softdelete/{id}',[CategoryController::class, 'SoftDelete']);





// Dashboard :
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // Eloquent ORM mode :
    //$users = User::all();

    // Query Builder mode :
    $users = DB::table('users')->get();

    return view('dashboard', compact('users'));
})->name('dashboard');


