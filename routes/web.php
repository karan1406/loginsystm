<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;


use App\Models\Category;


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

Route::get('/', function () {
    return view('index');
})->name('login');

Route::get('/admin',function(){
  return view('admin');
})->middleware('auth');

Route::post('/login',[AdminController::class,'create']);
Route::get('/register',[RegisterController::class,'create']);
Route::post('/register',[RegisterController::class,'store']);


Route::resource('posts', PostController::class)->middleware('auth');

Route::get('/category',[CategoryController::class,'create'])->middleware('auth');
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store')->middleware('auth');
Route::delete('/category/delete/{category}',[CategoryController::class,'destroy'])->name('category.destroy')->middleware('auth');
Route::patch('/category/update/{category}',[CategoryController::class,'update'])->name('category.update')->middleware('auth');



