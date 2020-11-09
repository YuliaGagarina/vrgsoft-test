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

    <title>Books</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">

</head>
<body>
    <main class="main">
        <h2>Hello on books page!</h2>
        <h4>Books list</h4>
        <div class="option-container">
            <form>
                <p>You can try to find book here</p>
                <input type="text" name="find-button" placeholder="Enter data">
                <input type="submit" value="Find">
            </form>
            <a href="/sortBooks" class="sort-book">Sort books</a>
            <a class="add-book">Add book</a>

        </div>
        <div class="content">
            <ol>
                @foreach($books as $book)
                <li>{{ $book['name'] }} | {{ $book['description'] }} | {{ $book['author'] }} |{{ $book['publication'] }}
                    <a class="edit-book">Edit book</a>
                    <a href="deleteBook/{{$book['id']}}" class="delete-book">Delete book</a>
                    {{--@if(!empty($book['image']))--}}
                        {{--<img src="{{$book['image']}}" alt=""/>--}}
                    {{--@endif--}}
                </li>
                @endforeach
            </ol>
        </div>
    </main>

    <div class="addition" id="modal-add-book">
        <button class="close">Close</button>
        <form class="addition-form">
            <input type="text" placeholder="Book name">
            <input type="textarea" placeholder="Book description">
            <input type="file" placeholder="Book image">
            <p>Book author(s)</p>
            <select>
                <option>hi</option>
            </select>
            <input type="text" placeholder="Publication date" class="publication-date">
            <input type="submit" value="Add book">
        </form>
    </div>
    <div class="edition" id="modal-edit-book">
        <button class="close">Close</button>
        <form class="edition-form">
            <input type="text" placeholder="Book name">
            <input type="textarea" placeholder="Book description">
            <input type="file" placeholder="Book image">
            <p>Book author(s)</p>
            <select>
                <option>hi</option>
            </select>
            <input type="text" placeholder="Publication date">
            <input type="submit" value="Save editions">
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
