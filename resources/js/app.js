require('./bootstrap');

$('.show-menu').click(function() {
    $('.dashboard').addClass('mobile-menu');
});

$('.close-menu').click(function() {
    $('.dashboard').removeClass('mobile-menu');
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
