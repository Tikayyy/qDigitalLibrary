<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
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

Route::get('/', function(){
    return redirect()->route('register');
});

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'create']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'check']);

Route::prefix('/books')->name('books.')->middleware('cookie.token')->group(function(){
    Route::get('/search', [BooksController::class, 'search'])->name('search');
    Route::get('/library', [BooksController::class, 'library'])->name('library');
    Route::get('/library/{book_id}', [BooksController::class, 'info'])->name('info');

    Route::post('/add/{book_id}', [BooksController::class, 'add'])->name('add');
    Route::post('/delete/{book_id}', [BooksController::class, 'delete'])->name('delete');
    Route::post('/change-favorite/{book_id}', [BooksController::class, 'changeFavorite'])->name('change.favorite');
});
