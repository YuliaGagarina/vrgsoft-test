global.$ = global.jQuery = require('jquery');

$(document).ready(function(e) {
    

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
})