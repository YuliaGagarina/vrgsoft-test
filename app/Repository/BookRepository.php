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
use App\Models\Author;

class BookRepository implements BookRepositoryInterface
{
    public function addBook(array $data)
    {
        DB::insert('insert into books (name, description, image, author, publication) values (?, ?, ?, ?, ? )', 
            [
                $data['book_name'], 
                $data['book_desc'], 
                $data['book_image'], 
                $data['authors'], 
                $data['book_date'],
            ]
        );
    }

    public function updateBook($id, array $data)
    {
        $book = Book::findOrFail($id);
        $book->update($data);
        return $book;
    }

    public function editBook($id)
    {
        $book['data'] = Book::findOrFail($id);
        $book['authors'] = Author::all();
        return $book;
    }
    
    public function viewAllBooks()
    {
        $books['books'] = Book::paginate(15);
        $books['authors'] = Author::all();
        return $books;
    }

    public function findBook($request)
    {
        $books = Book::where('name', 'like', '%' . $request . '%')
                    ->orWhere('author', 'like', '%' . $request . '%')
                    ->get();
        return $books;
    }

    public function sortBooks()
    {
        $books = Book::orderBy('name', 'asc')->get();
        return $books;
    }

    public function deleteBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete($book->all());
        return $book;
    }
}