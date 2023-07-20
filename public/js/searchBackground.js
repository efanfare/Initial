$(document).ready(function () {

    var typingTimer;
    var doneTypingInterval = 500;


    $('#search-background').on('submit', function (event) {
        event.preventDefault();
        var $input = $(this);
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            var searchTerm = $input.val();
            searchBackgrounds(searchTerm);
        }, doneTypingInterval);
    });

    $('#search-background').on('input keyup', function (event) {
        var $input = $(this);
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            var searchTerm = $input.val();
            showLoader();
            searchBackgrounds(searchTerm);
        }, doneTypingInterval);

    });

    $('#search-background').on('keypress', function (event) {
        clearTimeout(typingTimer);
        var $input = $(this);

        typingTimer = setTimeout(function () {
            var searchTerm = $input.val();
            // if ($('#search-background').val().length > 2) {
            showLoader();
            searchBackgrounds(searchTerm);
            // }
        }, doneTypingInterval);
    });

    $('#search-background-search').on('click', function (event) {
        var $input = $(this);
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            var searchTerm = $('#search-background').val();
            showLoader();
            searchBackgrounds(searchTerm);
        }, doneTypingInterval);
    });
    $('#search-background').on("search", function () {
        var $input = $(this);
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function () {
            var searchTerm = $input.val();
            showLoader();
            searchBackgrounds(searchTerm);
        }, doneTypingInterval);
    });
});

function showLoader() {
    $("#uploaded-background-area").find('.uploaded-flex.user-background').html('');
    $("#uploaded-background-area").find('.uploaded-flex.system-background').html('');
    $('#loader-background').removeClass('d-none');
}

function hideLoader() {
    $('#loader-background').addClass('d-none');
}

function searchBackgrounds(searchTerm) {
    $.ajax({
        url: searchBackgroundUrl,
        method: 'GET',
        data: {
            search: searchTerm,
            backgroundId: $("#background-id").val(),
        },
        dataType: 'json',
        success: function (response) {
            hideLoader();
            $("#uploaded-background-area").find('.uploaded-flex.user-background').html('');
            $("#uploaded-background-area").find('.uploaded-flex.user-background').prepend(response.html);

            $("#uploaded-background-area").find('.uploaded-flex.system-background').html('');
            $("#uploaded-background-area").find('.uploaded-flex.system-background').prepend(response.systemhtml);
        },
        error: function (xhr, status, error) {
            hideLoader();
            // Handle errors as needed
        }
    });
}
