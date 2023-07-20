$('body').on('click', '#upload-background', function () {

    $(this).prop('disabled', true);
    var backgroundTitle = $("#background-upload-tile").val();
    var fileInput = $('#file-upload');
    var file = fileInput.prop('files')[0]; // Get the selected file
    var fd = new FormData();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (file) {
        // Create a FormData object

        // Append data 
        fd.append('background_image', file);
        fd.append('_token', csrfToken);
        fd.append('title', backgroundTitle);

    }

    jQuery.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        url: backgroundStoreUrl,
        processData: false, // prevent jQuery from processing data
        contentType: false, // prevent jQuery from setting content type
        cache: false,
        data: fd,

        success: function (response) {
            showToast('success', response.message);

            $("#background-upload-tile").val('');
            $('#file-upload').val('');
            $('#background-input-fields').css("display", "none");
            document.getElementById('file-image').classList.add("hidden");
            // document.getElementById('notimage').classList.remove("hidden");
            document.getElementById('start').classList.remove("hidden");
            document.getElementById('response').classList.add("hidden");
            $("#uploaded-background-area").find('.uploaded-flex').find('p').html('');
            $("#uploaded-background-area").find('.uplaoded-background').find('.image-view-text').removeClass('d-none');
            $("#uploaded-background-area").find('.uplaoded-background').find('.image-view-text').addClass('d-flex');
            $("#uploaded-background-area").find('.bg-container.uploaded-flex.user-background').prepend(response.html);
            document.querySelector('.remove-upload-file-background').innerHTML = '';

        },
        error: function (response) {
            // If error, show the error toast with validation errors
            var errors = response.responseJSON.errors;
            var errorMessage = response.responseJSON.message;
            $.each(errors, function (key, value) {
                errorMessage += value + '<br>';
            });
            showToast('error', errorMessage);
            $('#upload-background').prop('disabled', false);
        }
    });
});
// Function to show Bootstrap toast
function showToast(type, message) {
    $('.toast-container').html('');
    var toast = $('<div aria-live="polite" aria-atomic="true"  class="d-flex justify-content-center aligns-center" style="z-index: 5; right: 0; bottom: 0;">' +
        '<div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="6000">' +
        '<div class="toast-header">' +
        '<strong class="mr-auto">' + type.toUpperCase() + '</strong>' +
        '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
        '</div>' +
        '<div class="toast-body">' +
        message +
        '</div>' +
        '</div>');

    toast.addClass('toast-' + type); // Add appropriate Bootstrap class for toast type

    // Show the toast with animation
    $('.toast-container').append(toast);
    $('.toast').toast('show');
    // toast.toast({ animation: true });
    // toast.toast('show');
}