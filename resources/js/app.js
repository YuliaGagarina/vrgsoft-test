require('./bootstrap');
require('./jquery');

global.$ = global.jQuery = require('jquery');

$(document).ready(function(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $('#addition-book-form').submit(function(e) {
    //     var $form = $(this);
    //     $.ajax({
    //       type: $form.attr('method'),
    //       url: $form.attr('action'),
    //       data: $form.serialize()
    //     }).done(function() {
    //       console.log('success');
    //     }).fail(function() {
    //       console.log('fail');
    //     });
    //     //отмена действия по умолчанию для кнопки submit
    //     e.preventDefault(); 
    //     $('#modal-add-book').modal('hide');
    // });

    // $('#addition-book-form').submit(function(e) {
    //     var $form = $(this);
    //     $.ajax({
    //       type: $form.attr('method'),
    //       url: $form.attr('action'),
    //       data: $form.serialize()
    //     }).done(function() {
    //       console.log('success');
    //     }).fail(function() {
    //       console.log('fail');
    //     });
    //     //отмена действия по умолчанию для кнопки submit
    //     e.preventDefault(); 
    //     $('#modal-add-book').modal('hide');
    // });

    // $('#edition-author-form').submit(function(e) {
    //     var $form = $(this);
    //     $.ajax({
    //       type: $form.attr('method'),
    //       url: $form.attr('action'),
    //       data: $form.serialize()
    //     }).done(function() {
    //       console.log('success');
    //     }).fail(function() {
    //       console.log('fail');
    //     });
    //     //отмена действия по умолчанию для кнопки submit
    //     e.preventDefault(); 
    //     $('#modal-edit-author').modal('hide');
    //   });

    // $('#edition-book-form').submit(function(e) {
    //     var $form = $(this);
    //     $.ajax({
    //       type: $form.attr('method'),
    //       url: $form.attr('action'),
    //       data: $form.serialize()
    //     }).done(function() {
    //       console.log('success');
    //     }).fail(function() {
    //       console.log('fail');
    //     });
    //     //отмена действия по умолчанию для кнопки submit
    //     e.preventDefault(); 
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