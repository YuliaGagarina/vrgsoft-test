@extends('books.show')

@section('modal-window-editing')

    <div class="edition" id="modal-edit-book">
        <button class="close">Close</button>
        <form class="edition-form">
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
            <button type="submit" class="btn-submit">Save editions</button>
        </form>
    </div>

@endsection

