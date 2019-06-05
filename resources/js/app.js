require('./bootstrap');

// RWD menu
$('.show-menu').click(function() {
    $('.dashboard').addClass('mobile-menu');
});

$('.close-menu').click(function() {
    $('.dashboard').removeClass('mobile-menu');
});

// Handle message close button event
$('.message .close.icon').click(function() {
    $(this)
        .parent()
        .remove();
});

// Handle selectable resource tables
$('.resource .selectable.table tbody tr').click(function() {
    $(this)
        .find('td:first-child input[type="radio"]')[0]
        .click();
});

$('.resource .selectable.table td:first-child input[type="radio"]')
    .prop('checked', false)
    .change(function() {
        $(this)
            .closest('tbody')
            .find('tr')
            .removeClass('active');

        $(this)
            .closest('tr')
            .addClass('active');

        $(this)
            .closest('.resource')
            .find('.controls button.disabled')
            .removeClass('disabled');
    });

// Handle resource delete button click
$('.delete-resource').click(function() {
    const { name, deleteRoute } = $(this)
        .closest('.resource')
        .find('tr.active')
        .data();

    const $modal = $('.delete-modal');

    $modal.find('.content > strong').text(name);
    $modal
        .modal({
            onApprove: function() {
                $('.delete-modal form')
                    .attr('action', deleteRoute)
                    .submit();
            }
        })
        .modal('show');
});

// Handle resource edit button click
$('.edit-resource').click(function() {
    const route = $(this)
        .closest('.resource')
        .find('tr.active')
        .data('edit-route');
    document.location = route;
});

// Handle new resource form
$('.resource .controls button.new-resource').click(function() {
    const $modal = $('.new-resource-modal');

    $modal
        .modal({
            onApprove: function() {
                $modal.find('form').submit();
            }
        })
        .modal('show');
});

// Add CSRF token to every ajax request
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
