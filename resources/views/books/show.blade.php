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

    <title>The books catalog</title>

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
        @if(isset($books))
        <div class="content">
            <ol>
                @foreach($books as $book)
                <li>{{ $book['name'] }} | {{ $book['description'] }} | {{ $book['author'] }} | {{ $book['publication'] }}
                    <a class="edit-book">Edit book</a>
                    <a href="deleteBook/{{$book['id']}}" class="delete-book">Delete book</a>
                    {{ @if(!empty($book['image'])) }}
                        <img src="{{$book['image']}}" alt="{{ $book['name'] }}"/>
                </li>
                @endforeach
            </ol>
        </div>
        @endif
    </main> 
    <div class="modal-window">
        @include('modal-window-adding')
        @include('modal-window-editing')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
