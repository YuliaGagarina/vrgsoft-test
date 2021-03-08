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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        if (Author::where('id', $id)) {
            $author = $this->authorRepository->editAuthor($id);
            // dd($author);
            $newAuthor = $author->toArray();
            return view('authors/show', ['id'=> $id, 'newAuthor' => $newAuthor]); 
        } else {
            return 'Such author couldn`t be found.';
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
        $data = [];
        if(!empty(request('new_author_fname')) && strlen(request('new_author_fname')) > 2){
            $data['fname'] = request('new_author_fname');
        } else {
            return 'This field is required!';
        }

        if(!empty(request('new_author_sname'))){
            $data['lname'] = request('new_author_sname');
        } else {
            return 'This field is required!';
        }

        if(!empty(request('new_author_fathers_name'))){
            $data['fathername'] = request('new_author_fathers_name');
        } 
        $author = $this->authorRepository->updateAuthor($id, $data);
        return redirect('/authors');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $data = [];
        if($request->ajax()) {
            [
                $data['fname'] = $request->fname,
                $data['lname'] = $request->lname,
                $data['fathername'] = $request->fathername,
            ];
        } else {
            if(!empty(request('author_fname')) && strlen(request('author_fname')) > 2){
                $data['fname'] = request('author_fname');
            } else {
                return 'This field is required or string is too short!';
            }
    
            if(!empty(request('author_lname'))){
                $data['lname'] = request('author_lname');
            } else {
                return 'This field is required!';
            }
    
            if(!empty(request('author_fathers_name'))){
                $data['fathername'] = request('author_fathers_name');
            }  else {
                $data['fathername'] = '';
            }
        }        
        $author = $this->authorRepository->addauthor($data);
        return redirect('/authors');
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
        $string = request('find_button');
        $authors = $this->authorRepository->findAuthor($string);
        $authData = $authors->toArray();
        return view('authors/show', ['authors' => $authData]);
    //    if ($request->ajax()) {
    //        $output = "";
    //        $authors = Author::where('fname','LIKE', '%'.$request->search.'%')
    //            ->orwhere('lname', 'LIKE', '%'. $request->search .'%')
    //            ->get();
    //    }

    //    if ($authors) {
    //        foreach($authors as $key => $author){
    //            $output .= '<li>'.$author['fname'].' '.$author['lname'].' '.$author['fathername']
    //                        .'<a class="edit-author">Edit author</a>'
    //                        .'<a href="deleteAuthor/'.$author['id'].'"  class="delete-author">Delete author</a>'
    //                    .'</li>';

    //        }
    //    }

    //    return Response($output);
    }
}
