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
    public function viewAllAuthors()
    {
        $authors = Author::paginate(15);
        return $authors;
    }
    public function findAuthor (str $request)
    {
    }

    public function sortAuthors()
    {
        $authors = Author::orderBy('fname', 'asc')->get();
        return $authors;
    }
    public function addAuthor(array  $data)
    {
        $this->model->fill($data)->save();
        return $this->model->id;
    }
    public function updateAuthor($id, array  $data)
    {
        $author = Author::findOrFail($id);
        $author->update($data);
        return $author;
    }
    public function deleteAuthor($id){
        $author = Author::findOrFail($id);
        $author->delete($author->all());
        return $author;
    }
}