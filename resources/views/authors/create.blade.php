@extends('authors.show')

@section('modal-window-adding')


<div class="addition" id="modal-add-author">
    <button class="close">Close</button>
    <form action="" class="addition-form" method="post">
        <input type="text" placeholder="Author first name">
        <input type="text" placeholder="Author second name">
        <input type="text" placeholder="Author's father name">
        <button type="submit" class="btn-submit">Add author</button>
    </form>
</div>

@endsection