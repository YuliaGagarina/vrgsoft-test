<?php

namespace App\Http\Controllers;

use App\Repository\BookRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Routing\Controller as BaseController;

class BookController extends Controller
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->bookRepository->viewAllBooks();
        $bookData = $books->toArray();
        return view('book', ['books' => $bookData['data']]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'value' => 'required'
//        ]);
        $book = $this->bookRepository->addBook([
            'name' => request('name'),
            'description' => request('description'),
            //Загрузка картинок
            'image' => request('image'),
            'author' => [request('author')],
            'author_id' => $this->getAuthor()->id,
            'publication' => request('publication')
        ]);

        return 'Your book wad created successfully' . $book;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        if (Book::table('books')->where('id', $id)) {
//
//            // Поискать детали к этому методу
//            $book = $this->bookRepository->updateBook($id);
//            $book->update($request->all());
//
//            return 'Your book wad updated successfully';
//        } else {
//            return 'Such book couldn`t be found.';
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Book::where('id', $id)) {
            $book = $this->bookRepository->deleteBook($id);
            return 'Your book wad deleted successfully';
        } else {
            return 'Such book couldn`t be found.';
        }
    }

    /**
     * Display a sorted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort()
    {
        $books = $this->bookRepository->sortBooks();
        $bookData = $books->toArray();
        dd($bookData);
        return view('book', ['books' => $bookData]);
    }

    /**
     * Display a found by name resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        $books = $this->bookRepository->findBook();
        // Передать данные в представление
        return view('book');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "<h1>you want to see the book</h1>";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        "<h1>you want to edit book</h1>";
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "<h1>you are creating book!</h1>";
    }
}
