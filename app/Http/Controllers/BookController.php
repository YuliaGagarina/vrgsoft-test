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
        $books = $this->bookRepository->findBook($requestParams);
        // Передать данные в представление
        return view('book');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
           'name' => 'required',
           'author' => 'required',
           'publication' => 'required'
        ]);

        $requestParams = request(['name', 'description', 'image', 'author', 'publication']);
        $path = $request->file('image')->store('uploads', 'public');
        $storageLink = basename($path);
        $requestParams['image'] = $storageLink;

        $book = $this->bookRepository->addBook($requestParams);

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
       if (Book::table('books')->where('id', $id)) {
            $this->validate(request(), [
                'name' => 'required',
                'author' => 'required',
                'publication' => 'required'
            ]);
           
            $requestParams = request(['name', 'description', 'image', 'author', 'publication']);
            $path = $request->file('image')->store('uploads', 'public');
            $storageLink = basename($path);
            $requestParams['image'] = $storageLink;
            $book = $this->bookRepository->updateBook($id, $requestParams);
            // $book->update($request->all());

           return 'Your book wad updated successfully';
       } else {
           return 'Such book couldn`t be found.';
       }
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
}
