<?php

namespace App\Http\Controllers;

use App\Repository\BookRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;

class BookController extends Controller
{
    private $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        if($request->ajax()) {
            $this->validate([
                $this->book_name => 'required',
                $this->authors => 'required',
                $this->book_date => 'required',
            ]);  
            $requestParams = [$this->book_name,  $this->book_desc, $this->book_image, $this->authors, $this->book_date ];
            $auth = $this->authors;
            $requestParams[$this->authors] = '';
            foreach($auth as $item) {
                $requestParams[$this->authors] .= $item . "<br>";
            }
            $image = $request->file($this->book_image)->store('uploads', 'public');
            $requestParams[$this->book_image] = basename($image);
            if(!$requestParams[$this->book_name]){
                echo "You have to fill the Book Name!";
            } 
            if(!$requestParams[$this->book_date]){
                echo "You have to fill the Book Publication Date!";
            } 
            if(!$requestParams[$this->book_desc]){
                $requestParams[ $this->book_desc] = '';
            }
            if(!$requestParams[$this->book_image]){
                $requestParams[$this->book_image] = '';
            } 
        } else {
            $this->validate(request(), [
                'book_name' => 'required',
                'authors' => 'required',
                'book_date' => 'required',
            ]);  
            $requestParams = request(['book_name',  'book_desc', 'book_image', 'authors', 'book_date' ]);
            $auth = request('authors');
            $requestParams['authors'] = '';
            foreach($auth as $item) {
                $requestParams['authors'] .= $item . "<br>";
            }
            $image = $request->file('book_image')->store('uploads', 'public');
            $requestParams['book_image'] = basename($image);
            if(!$requestParams['book_name']){
                echo "You have to fill the Book Name!";
            } 
            if(!$requestParams['book_date']){
                echo "You have to fill the Book Publication Date!";
            } 
            if(!$requestParams['book_desc']){
                $requestParams['book_desc'] = NULL;
            }
            if(!$requestParams['book_image']){
                $requestParams['book_image'] = '';
            } 
        }
        $newBook = $this->bookRepository->addBook($requestParams);
        return redirect('/books'); 
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Book::where('id', $id)) {
            $book = $this->bookRepository->editBook($id);
            $newBook = $book['data']->toArray();
            $newAuthors = $book['authors']->toArray();
            return view('books/show', ['id'=> $id, 'newBook' => $newBook, 'newAuthors' => $newAuthors]); 
        } else {
            return 'Such book couldn`t be found.';
        }        
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
            $params = [];
        if($request->ajax()) {
            if(!empty($this->id)) {
                $params['id'] = $this->id;
            } else {
                return 'Such book couldn`t be found.';
            }

            if(!empty($this->new_book_name)) {
                $params['name'] = $this->new_book_name;
            } else {
                return "You have to write Book name!";
            }

            if(!empty($this->new_book_desc)) {
                $params['description'] = $this->new_book_desc;
            }

            if(!empty($this->new_book_date)) {
                $params['publication'] = $this->new_book_date;
            } else {
                return "You have to write Book publication date!";
            }

            if(!empty($this->new_book_image)) {
                $params['image'] = $this->new_book_image;
            }

            if(!empty($this->authors)) {
                $auth = $this->authors;
                $params['authors'] = '';
                foreach($auth as $item){
                    $params['authors'] .= $item . "<br>";
                }
            }
        } else {
            if(!empty(request('id'))) {
                $params['id'] = request('id');
            } else {
                return 'Such book couldn`t be found.';
            }

            if(!empty(request('new_book_name'))) {
                $params['name'] = request('new_book_name');
            } else {
                return "You have to write Book name!";
            }

            if(!empty(request('new_book_desc'))) {
                $params['description'] = request('new_book_desc');
            }

            if(!empty(request('new_book_date'))) {
                $params['publication'] = request('new_book_date');
            } else {
                return "You have to write Book publication date!";
            }

            if(!empty(request('new_book_image'))) {
                $params['image'] = request('new_book_image');
            }

            if(!empty(request('authors'))) {
                $auth = request('authors');
                $params['authors'] = '';
                foreach($auth as $item){
                    $params['authors'] .= $item . "<br>";
                }
            }
        }
        $book = $this->bookRepository->updateBook($id, $params);
        return redirect('/books');
    }

    /**
     * Display a found by name resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {        
        $string = request('find_button');
        $books = $this->bookRepository->findBook($string);
        $bookData = $books->toArray();
        return view('books/show', ['books' => $bookData]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->bookRepository->viewAllBooks();
        $bookData = $books['books']->toArray();
        $bookAuthData = $books['authors']->toArray();
        return view('books/show', ['books' => $bookData['data'], 'authors' => $bookAuthData]);
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
            return redirect('/books');
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
        return view('books/show', ['books' => $bookData]);
    }
}
