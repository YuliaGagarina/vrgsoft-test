require('./bootstrap');
require('./jquery');

global.$ = global.jQuery = require('jquery');

$(document).ready(function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#btn-add-author').on('click', function(e){
        e.preventDefault();
        var addAuthorData = {}
        if($('author_fname').val().length > 2){
            addAuthorData = {
                fname = $('author_fname').val()
            };
        } else {
            return 'This field is required or string is too short!';
        }

        if($('author_lname').val().length > 0){
            addAuthorData = {
                lname = $('author_lname').val()
            };
        } else {
            return 'This field is required!';
        }

        if($('author_fathers_name').val().length > 0){
            addAuthorData = {
                fathername = $('author_fathers_name').val()
            };
        } else {
            addAuthorData = {
                fathername = ''
            };
        }
        console.log(addAuthorData)
        $.ajax({
            type: "post",
            url: "/addAuthor",
            data: addAuthorData,
            dataType: 'json',
            success: function (data) {
                console.log('Success');
                $('#modal-add-author').modal('hide');
            },
            error: function (data) {
                console.log('Error');
            }
        });        
    });

    // $('#addition-book-form').on('submit', function(e){
    //     e.preventDefault();
    //     var addBookData = {};
    //     $.ajax({
    //         type: "POST",
    //         url: "/addBook",
    //         data: addBookData,
    //         dataType: 'json',
    //         success: function (data) {
    //             console.log(data);
    //         },
    //         error: function (data) {
    //             console.log(data);
    //         }
    //     });

    //     $('#modal-add-book').modal('hide');
    // });
    // $('#edition-author-form').on('submit', function(e){
    //     e.preventDefault();
    //     var editAuthorData = {};
    //     let id = $this->data('id);
    //     $.ajax({
    //         type: "GET",
    //         url: "/editionAuthor/" + id,
    //         data: editAuthorData,
    //         dataType: 'json',
    //         success: function (data) {
    //             console.log(data);
    //         },
    //         error: function (data) {
    //             console.log(data);
    //         }
    //     });

    //     $('#modal-edit-author').modal('hide');
    // });
    // $('#edition-book-form').on('submit', function(e){
    //     e.preventDefault();
    //     var editBookData = {};
    //     let id = $this->data('id); 
    //     $.ajax({
    //         type: "GET",
    //         url: "/editionBook/" + id,
    //         data: editBookData,
    //         dataType: 'json',
    //         success: function (data) {
    //             console.log(data);
    //         },
    //         error: function (data) {
    //             console.log(data);
    //         }
    //     });

    //     $('#modal-edit-book').modal('hide');
    // });

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

    // $('.edit-author').on('click', function (e) {
    //     // e.preventDefault();
    //     $('.main').addClass('hidden-main');
    //     $('#modal-edit-author').show();
    // });

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

    if(!$('#modal-edit-book').length == 0)  {
        $('.main').addClass('hidden-main'); 
    }
    
    
    $('.close').on('click', function (e) {
        $('.main').removeClass('hidden-main');
        $('.edition').hide();
    });
})