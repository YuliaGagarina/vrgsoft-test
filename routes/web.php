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
    return view('home');
});

Route::get('books', [BookController::class, 'index']);
Route::get('deleteBook/{id}', [BookController::class, 'destroy']);
Route::get('sortBooks', [BookController::class, 'sort']);
Route::get('searchBook', [BookController::class, 'find']);
Route::post('addBook', [BookController::class, 'store']);
Route::get('editBook/{id}', [BookController::class, 'edit']); 
// Здесь должен был быть метод PATCH, но что-то пошло не так, и, кроме как с GET, работать не захотел. 
// Ошибку самостоятельно обнаружить не удалось 
Route::get('editionBook/{id}', [BookController::class, 'update']);

Route::get('authors', [AuthorController::class, 'index']);
Route::get('deleteAuthor/{id}', [AuthorController::class, 'destroy']);
Route::get('sortAuthors', [AuthorController::class, 'sort']);
Route::get('searchAuthor', [AuthorController::class, 'find']);
Route::post('addAuthor', [AuthorController::class, 'store']);
Route::get('editAuthor/{id}', [AuthorController::class, 'edit']);
// Здесь должен был быть метод PATCH, но что-то пошло не так, и, кроме как с GET, работать не захотел. 
// Ошибку самостоятельно обнаружить не удалось 
Route::get('editionAuthor/{id}', [AuthorController::class, 'update']);
