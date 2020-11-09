<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 07.11.2020
 * Time: 11:17
 */

namespace App\Repository;

interface BookRepositoryInterface
{

    public function viewAllBooks();
    public function findBook (str $author);
    public function sortBooks();
    public function addBook(array  $data);
    public function updateBook($id, array  $data);
    public function deleteBook($id);
}