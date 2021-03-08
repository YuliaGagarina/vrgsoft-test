<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 07.11.2020
 * Time: 15:18
 */

namespace App\Repository;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface
{

    public function updateAuthor($id, array  $data)
    {
        $author = Author::findOrFail($id);
        $author->update($data);
        return $author;
    }

    public function editAuthor($id)
    {
        $author = Author::findOrFail($id);
        return $author;
    }

    public function viewAllAuthors()
    {
        $authors = Author::paginate(15);
        return $authors;
    }

    public function findAuthor ($request)
    {
        $authors = Author::where('fname', 'like', '%' . $request . '%')
                    ->orWhere('lname', 'like', '%' . $request . '%')
                    ->orWhere('fathername', 'like', '%' . $request . '%')
                    ->get();
        return $authors;
    }

    public function sortAuthors()
    {
        $authors = Author::orderBy('fname', 'asc')->get();
        return $authors;
    }

    public function addAuthor(array  $data)
    {
        DB::insert('insert into authors (fname, lname, fathername) values (?, ?, ?)', 
        [
            $data['fname'],
            $data['lname'],
            $data['fathername'],
        ]);
    }    

    public function deleteAuthor($id){
        $author = Author::findOrFail($id);
        $author->delete($author->all());
        return $author;
    }
}