<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 07.11.2020
 * Time: 10:30
 */ ?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Authors</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

    </head>
    <body>
        <main class="main">
            <h2>Hello on authors page!</h2>
            <h4>Our authors</h4>
            <div class="option-container">
                <form action="/search" method="get">
                    <input type="text" name="find-button" placeholder="Enter data"  id="searchAuthor">
                    <input type="submit" value="Find">
                    <div id="result">
                        {{--@include('results')--}}
                    </div>
                </form>

                <a href="/sortAuthors" class="sort-author">Sort authors</a>
                <a class="add-author">Add author</a>
            </div>
            <div class="content">
                <ol>

                    @foreach($authors as $author)
                    <li>{{$author['fname']}} {{$author['lname']}} {{$author['fathername']}}
                        <a class="edit-author">Edit author</a>
                        <a href="deleteAuthor/{{$author['id']}}"  class="delete-author">Delete author</a>
                    </li>
                    @endforeach
                </ol>
            </div>
        </main>
        
        <div class="modal-window">
<<<<<<< HEAD
            <div class="addition" id="modal-add-author">
                <button class="close">Close</button>
                <form action="" class="addition-form" method="post">
                    <input type="text" placeholder="Author first name">
                    <input type="text" placeholder="Author second name">
                    <input type="text" placeholder="Author's father name">
                    <button type="submit" class="btn-submit">Add author</button>
                </form>
            </div>
            <div class="edition" id="modal-edit-author">
                <button class="close">Close</button>
                <form class="edition-form" method="post">
                    <input type="text" placeholder="Author first name" name="author_fname">
                    <input type="text" placeholder="Author second name" name="author_sname">
                    <input type="text" placeholder="Author's father name" name="author_fathers_name">
                    <button type="submit" class="btn-submit">Save editions</button>
                </form>
            </div>
=======
            @include('modal-window-adding')
            @include('modal-window-editing')
>>>>>>> 10c852ad7f79b891ab9019580efd190ac38ee934
        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>