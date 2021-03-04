@extends('books.show')

@section('modal-window-adding')

<div class="addition" id="modal-add-book">
        <button class="close">Close</button>
        <form class="addition-form" action="" method="post">
        <input type="text" placeholder="Book name" name="book_name">
            <input type="textarea" placeholder="Book description" name="book_desc">
            <input type="file" placeholder="Book image" name="book_image">
            {{ @if(isset($authData))}}
            <label>Book author(s)</label>            
            <select>
                @foreach($authData as $author)
                <option>{{ $author['lname'] }}</option>
            </select>
            {{ @endif }}
            <input type="text" placeholder="Publication date" class="publication-date" name="book_date">
            <button type="submit" class="btn-submit">Add book</button>
        </form>
    </div>
@endsection