<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 07.11.2020
 * Time: 15:18
 */

namespace App\Repository;


interface AuthorRepositoryInterface
{
    public function viewAllAuthors();
    public function findAuthor(str $author);
    public function sortAuthors();
    public function addAuthor(array  $data);
    public function updateAuthor($id, array  $data);
    public function deleteAuthor($id);
}