require('./bootstrap');
require('./jquery');

global.$ = global.jQuery = require('jquery');

$(document).ready(function(e) {

    $('btn-add-id').on('click', function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = {
            name: $('#title').val(),
            description: $('#description').val(),
            image: $('#book_image').val(),
            authors: $('#authors_id_select').val(),
            date: $('book_date').val()
        };
        var state = jQuery('#btn-add-id').val();
        var type = "POST";
        var book_id = jQuery('#book_id').val();
        var ajaxurl = '/addBook';
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
                // if (state == "add") {
                //     jQuery('#todo-list').append(todo);
                // } else {
                //     jQuery("#todo" + todo_id).replaceWith(todo);
                // }
                // jQuery('#myForm').trigger("reset");
                // jQuery('#formModal').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $("#searchAuthor").on('keyup', function(){
        $search = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to("search") }}',
            data: {'search': $search},
            success: function(data){
                console.log(data);
            }
        });
    });

    $('.add-author').on('click', function (e) {
        e.preventDefault();
        $('.main').addClass('hidden-main');
        $('#modal-add-author').show();
    });
    $('.close').on('click', function (e) {
        e.preventDefault();
        $('.main').removeClass('hidden-main');
        $('.addition').hide();
    });

    $('.edit-author').on('click', function (e) {
        e.preventDefault();
        $('.main').addClass('hidden-main');
        $('#modal-edit-author').show();
    });

    $('.close').on('click', function (e) {
        e.preventDefault();
        $('.main').removeClass('hidden-main');
        $('.edition').hide();
    });

    $('.add-book').on('click', function (e) {
        e.preventDefault();
        $('.main').addClass('hidden-main');
        $('#modal-add-book').show();
    });
    $('.close').on('click', function (e) {
        e.preventDefault();
        $('.main').removeClass('hidden-main');
        $('.addition').hide();
    });

    $('.edit-book').on('click', function (e) {
        e.preventDefault();
        $('.main').addClass('hidden-main');
        $('#modal-edit-book').show();
    });

    $('.close').on('click', function (e) {
        e.preventDefault();
        $('.main').removeClass('hidden-main');
        $('.edition').hide();
    });
})