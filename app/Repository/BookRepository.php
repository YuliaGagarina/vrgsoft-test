<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 07.11.2020
 * Time: 11:16
 */

namespace App\Repository;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = app(Book::class);
    }

    public function viewAllBooks()
    {
        $books = Book::paginate(15);
        return $books;
    }

    public function findBook(str $bookName)
    {
        $books = Book::where('name')->like("%" . $bookName . "%")->get();
        return $books;
    }


    public function sortBooks()
    {
        $books = Book::orderBy('name', 'asc')->get();
        return $books;
    }

    public function addBook(array $data)
    {
        $this->model->fill($data)->save();
        return $this->model->id;
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete($book->all());
        return $book;
    }

    public function updateBook($id, array $data)
    {
        $book = Book::findOrFail($id);
        $book->update($data);
        return $book;
    }

}