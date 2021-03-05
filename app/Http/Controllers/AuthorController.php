<?php

namespace App\Http\Controllers;

use App\Repository\AuthorRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\View;

class AuthorController extends Controller
{
    private $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // DONE
    public function index()
    {
        $authors = $this->authorRepository->viewAllAuthors();
        $authData = $authors->toArray();
        return view('authors/show', ['authors' => $authData['data'], 'books' => $authData['data']]);
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
            'fname' => 'required|min:3',
        ]);

        $author = $this->authorRepository->addauthor([
            'fname' => request('fname'),
            'lname' => request('lname'),
            'fathername' => request('fathername'),
        ]);

        return 'Your book wad created successfully' . $author;
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

        if (Author::table('authors')->where('id', $id)) {
            $this->validate(request(), [
                'fname' => 'required|min:3',
            ]);
            // Поискать детали к этому методу
            $requestParams = request(['fname', 'lname', 'fathername']);
            $author = $this->authorRepository->updateAuthor($id, $requestParams);
            // $author->update($request->all());

            return 'Your author wad updated successfully';
        } else {
            return 'Such author couldn`t be found.';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Author::where('id', $id)) {
            $author = $this->authorRepository->deleteAuthor($id);
            return 'Your author wad deleted successfully';
        } else {
            return 'Such author couldn`t be found.';
        }
    }

    /**
     * Display a sorted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort()
    {
        $authors = $this->authorRepository->sortAuthors();
        $authData = $authors->toArray();
        return view('authors/show', ['authors' => $authData]);
    }

    /**
     * Display a found by name resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
       if ($request->ajax()) {
           $output = "";
           $authors = Author::where('fname','LIKE', '%'.$request->search.'%')
               ->orwhere('lname', 'LIKE', '%'. $request->search .'%')
               ->get();
       }

       if ($authors) {
           foreach($authors as $key => $author){
               $output .= '<li>'.$author['fname'].' '.$author['lname'].' '.$author['fathername']
                           .'<a class="edit-author">Edit author</a>'
                           .'<a href="deleteAuthor/'.$author['id'].'"  class="delete-author">Delete author</a>'
                       .'</li>';

           }
       }

       return Response($output);
    }

}
