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
            <form action="/searchBook" method="get">
                <p>You can try to find book here</p>
                <input type="text" name="find_button" placeholder="Enter data" value="">
                <button type="submit" class="find-book">Find</button>
            </form>
            <a href="sortBooks" class="sort-book">Sort books</a>
            <a class="add-book">Add book</a>           
        </div>
        @if(isset($books))
        <div class="content">
                @foreach($books as $book)
                <div class="book-element">
                    <h2>{{ $book['name'] }}</h2>
                    <p>{{ $book['description'] }}</p>
                    <span class="author-span">{{ $book['author'] }}</span>
                    <span class="publication-span">Published {{ $book['publication'] }}</span>
                    <div class="book-btns">
                    <a href="editBook/{{$book['id']}}" class="edit-book">Edit book</a>
                    <a href="deleteBook/{{$book['id']}}" class="delete-book">Delete book</a>
                    </div>
                    <!-- Здесь не работает, потому что пути нет, только название. Отладить сохранение картинки -->
                    @if(!empty($book['image']))
                        <img src="/{{$book['image']}}" alt="{{ $book['name'] }}"/>
                    @endif
                </div>
                @endforeach
        </div>
        @endif
        
    </main> 
    
    <div class="modal-window">
        @if(isset($newBook))        
        <div class="edition" id="modal-edit-book">
            <button class="close">Close</button>            
            <form method="patch" id="edition-book-form" class="edition-form" action="/editionBook/{{$newBook['id']}}"  enctype="multipart/form-data" data-id="{{$newBook['id']}}">
            {{csrf_field()}}
                <input type="text" name="new_book_name" value="{{$newBook['name']}}">
                <input type="textarea" name="new_book_desc" value="{{$newBook['description']}}">
                <input type="file"  name="new_book_image" value="{{$newBook['image']}}">
                @if(isset($newAuthors))
                <label>Book author(s)</label>            
                <select name="authors[]" multiple="multiple">
                    @foreach($newAuthors as $aKey => $author)
                    <option value="{{$author['lname'] . ' ' . $author['fname']}}">{{ $author['lname'] . ' ' . $author['fname'] }}</option>
                    @endforeach
                </select>
                @endif 
                <input type="text" placeholder="Another Publication date" class="publication-date" name="new_book_date" value="{{$newBook['publication']}}">
                <button type="submit" class="btn-submit">Save editions</button>
            </form>
        </div>
        @endif 
        <div class="addition" id="modal-add-book">
            <button class="close">Close</button>
            <form class="addition-form" id="addition-book-form" action="/addBook" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <input type="text" placeholder="Book name" name="book_name" id="book_name" value="">
                <input type="textarea" placeholder="Book description" name="book_desc" id="book_desc" value="">
                <input type="file" placeholder="Book image" name="book_image" id="book_image" >                
                @if(isset($authors))
                <label>Book author(s)</label>            
                <select  name="authors[]" id="authors_id_select">
                <!-- Ниже написан первоначальный вариант. Пока что оставляю 
                одиночный выбор автора. Если получится разобраться - переделаю позже -->
                <!-- <select  multiple="multiple" name="authors" id="authors_id_select"> -->
                    @foreach($authors as $aKey => $author)
                    <option value="{{$author['lname'] . ' ' . $author['fname']}}" name="authors">{{ $author['lname'] . ' ' . $author['fname'] }}</option>
                    @endforeach
                </select>
                @endif 
                <input type="text" placeholder="Publication date" class="publication-date" name="book_date" id="book_date">
                <button type="submit" class="btn-submit" value="add" id="btn-add-id">Add book</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
