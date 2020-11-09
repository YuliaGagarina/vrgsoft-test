<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;


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

Route::get('books', [BookController::class, 'index']);
Route::get('/sortBooks', [BookController::class, 'sort']);
Route::get('deleteBook/{id}', [BookController::class, 'destroy']);
Route::post('search', [BookController::class, 'find']);
//Route::post('addBook', [BookController::class, 'store']);
//Route::put('editBook/{id}', [BookController::class, 'edit']);

Route::get('authors', [AuthorController::class, 'index']);
Route::get('/sortAuthors', [AuthorController::class, 'sort']);
Route::get('deleteAuthor/{id}', [AuthorController::class, 'destroy']);
Route::get('search', [AuthorController::class, 'find']);
//Route::post('addAuthor', [AuthorController::class, 'store']);
//Route::put('editAuthor/{id}', [AuthorController::class, 'edit']);
