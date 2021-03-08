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
                <form action="/searchAuthor" method="get">
                    <p>You can try to find author here</p>
                    <input type="text" name="find_button" placeholder="Enter data"  id="searchAuthor">
                    <button type="submit">Find</button>
                </form>
                <a href="sortAuthors" class="sort-author">Sort authors</a>
                <a class="add-author">Add author</a>
            </div>
            <div class="content">
                @if(isset($books))
                <ol>
                    @foreach($authors as $author)
                    <li>
                        <h4>{{$author['fname']}} {{$author['lname']}} {{$author['fathername']}}</h4>
                        <a href="editAuthor/{{$author['id']}}" class="edit-author">Edit author</a>
                        <a href="deleteAuthor/{{$author['id']}}"  class="delete-author">Delete author</a>
                    </li>
                    @endforeach
                </ol>
                @endif
            </div>
        </main>
        
        <div class="modal-window">
            <div class="addition" id="modal-add-author">
                <button class="close">Close</button>
                <form action="/addAuthor" id="addition-author-form" class="addition-form" method="post">
                    {{csrf_field()}}
                    <input type="text" placeholder="Author first name" name="author_fname">
                    <input type="text" placeholder="Author second name" name="author_lname">
                    <input type="text" placeholder="Author's father name" name="author_fathers_name">
                    <button type="submit" id="btn-add-author" class="btn-submit">Add author</button>
                </form>
            </div>
            @if(isset($newAuthor))
            <div class="edition" id="modal-edit-author">
                <button class="close">Close</button>
                <form action="/editionAuthor/{{$newAuthor['id']}}" id="edition-author-form" class="edition-form" method="patch" data-id="{{$newAuthor['id']}}">
                    {{csrf_field()}}
                    <input type="text" value="{{$newAuthor['fname']}}" name="new_author_fname">
                    <input type="text" value="{{$newAuthor['lname']}}" name="new_author_sname">
                    <input type="text" value="{{$newAuthor['fathername']}}" name="new_author_fathers_name">
                    <button type="submit" class="btn-submit">Save editions</button>
                </form>
            </div>
            @endif
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>