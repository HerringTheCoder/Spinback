require('./bootstrap');

$('.show-menu').click(function() {
    $('.dashboard').addClass('mobile-menu');
});

$('.close-menu').click(function() {
    $('.dashboard').removeClass('mobile-menu');
});

$('.message .close.icon').click(function() {
    $(this)
        .parent()
        .remove();
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
