@extends('authors.show')

@section('modal-window')

<div class="edition" id="modal-edit-author">
    <button class="close">Close</button>
    <form class="edition-form" method="post">
        <input type="text" placeholder="Author first name" name="author_fname">
        <input type="text" placeholder="Author second name" name="author_sname">
        <input type="text" placeholder="Author's father name" name="author_fathers_name">
        <button type="submit" class="btn-submit">Save editions</button>
    </form>
</div>