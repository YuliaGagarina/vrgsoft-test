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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // DONE
    public function index()
    {
        $books = $this->bookRepository->viewAllBooks();
        $bookData = $books['books']->toArray();
        $bookAuthData = $books['authors']->toArray();
        return view('books/show', ['books' => $bookData['data'], 'authors' => $bookAuthData]);
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
        return view('books/show');
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
            'book_name' => 'required',
            'authors' => 'required',
            'book_date' => 'required',
        ]);    
        $requestParams = request(['book_name',  'book_desc', 'book_image', 'authors', 'book_date' ]);

        // Ниже написана попытка преобразовать множественный выбор селект. Если разберусь, то напишу по-человечески
        // $requestParams['authors'] = '';
        // foreach($authors as $author){
        //     $requestParams['authors'] .= $author;
        //     return $requestParams['authors'];
        // }
        
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

        DB::insert('insert into books (name, description, image, author, publication) values (?, ?, ?, ?, ? )', 
            [
                $requestParams['book_name'], 
                $requestParams['book_desc'], 
                $requestParams['book_image'], 
                $requestParams['authors'], 
                $requestParams['book_date'],
            ]
        );
        return redirect('/books'); 
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
    //    if (Book::table('books')->where('id', $id)) {
        $this->validate(request(), [
            'book_name' => 'required',
            'authors' => 'required',
            'book_date' => 'required',
        ]);    

        dd($request);
        // $requestParams = request(['book_name',  'book_desc', 'book_image', 'authors', 'book_date' ]);
        // $image = $request->file('book_image')->store('uploads', 'public');

        //     $book = $this->bookRepository->updateBook($id, $requestParams);
        //     $book->update($request->all());

    //        return 'Your book wad updated successfully';
    //    } else {
    //        return 'Such book couldn`t be found.';
    //    }
    }

    //DONE
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

    // DONE
    /**
     * Display a sorted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort()
    {
        $books = $this->bookRepository->sortBooks();
        $bookData = $books->toArray();
        // dd($bookData);
        return view('books/show', ['books' => $bookData]);
    }



}
