$(document).ready(function () {

    var typingTimer;
    var doneTypingInterval = 500;


    $('#search-item').on('submit', function (event) {
        event.preventDefault();
        var $input = $(this);
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            var searchTerm = $input.val();
            searchItems(searchTerm);
        }, doneTypingInterval);
    });

    // $('#search-item').on('keyup', function (event) {
    //     var $input = $(this);
    //     clearTimeout(typingTimer);
    //     if (event.keyCode === 13) {

    //         typingTimer = setTimeout(function () {
    //             var searchTerm = $input.val();
    //             showLoader();
    //             searchItems(searchTerm);
    //         }, doneTypingInterval);

    //     }
    // });

    $('#search-item').on('input keyup', function () {
        var $input = $(this);
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function () {
            var searchTerm = $input.val();
            showLoader();
            searchItems(searchTerm);
        }, doneTypingInterval);
    });

    $('#search-item').on('keypress', function (event) {
        clearTimeout(typingTimer);
        var $input = $(this);

        typingTimer = setTimeout(function () {
            var searchTerm = $input.val();
            // if ($('#search-item').val().length > 2) {
            showLoader();
            searchItems(searchTerm);
            // }
        }, doneTypingInterval);
    });

    $('#search-item-search').on('click', function (event) {
        var $input = $(this);
        clearTimeout(typingTimer);
        typingTimer = setTimeout(function () {
            var searchTerm = $('#search-item').val();
            showLoader();
            searchItems(searchTerm);
        }, doneTypingInterval);
    });
    $('#search-item').on("search", function () {
        var $input = $(this);
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function () {
            var searchTerm = $input.val();
            showLoader();
            searchItems(searchTerm);
        }, doneTypingInterval);
    });
});

function showLoader() {
    $("#uploaded-item-area").find('.uploaded-flex').html('');
    $('#loader').removeClass('d-none');
}

function hideLoader() {
    $('#loader').addClass('d-none');
}

function searchItems(searchTerm) {


    $.ajax({
        url: searchItemUrl,
        method: 'GET',
        data: {
            search: searchTerm,
            sceneId: sceneId
        },
        dataType: 'json',
        success: function (response) {
            hideLoader();
            $("#uploaded-item-area").find('.uploaded-flex').html('');
            $("#uploaded-item-area").find('.uploaded-flex').prepend(response.html);
            $("#photo-bank-area").find(".empty-box").html('');
            $("#photo-bank-area").find(".empty-box").prepend(response.photoBankHtml);

        },
        error: function (xhr, status, error) {
            hideLoader();
            // Handle errors as needed
        }
    });
}
