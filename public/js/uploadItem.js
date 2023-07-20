$('body').on('click', '#upload-items', function () {

    $(this).prop('disabled', true);
    var itemTitle = $("#item-upload-tile").val();
    var itemKeyword = $("#item-upload-tags").tagsinput('items');

    var fileInput = $('#file-upload-item');
    var file = fileInput.prop('files')[0]; // Get the selected file
    var fd = new FormData();
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    if (file) {
        // Create a FormData object

        // Append data 
        fd.append('item_image', file);
        fd.append('_token', csrfToken);
        fd.append('title', itemTitle);
        fd.append('itemKeyword', itemKeyword);
    }

    jQuery.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        url: itemStoreUrl,
        processData: false, // prevent jQuery from processing data
        contentType: false, // prevent jQuery from setting content type
        cache: false,
        data: fd,

        success: function (response) {
            // $('#upload-items').prop('disabled', false);
            showToast('success', response.message);
            
            $("#item-upload-tile").val('');
            $('#file-upload-item').val('');
            $("#item-upload-tags").val('');
            $("#item-upload-tags").tagsinput('removeAll');
            $('#item-input-fields').css("display", "none");
            document.getElementById('file-image-item').classList.add("hidden");
            // document.getElementById('notimage-item').classList.remove("hidden");
            document.getElementById('start-item').classList.remove("hidden");
            document.getElementById('response-item').classList.add("hidden");
            $("#uploaded-item-area").find('.uploaded-flex').find('p').html('');
            $("#uploaded-item-area").find('.uplaoded-background').find('.image-view-text').removeClass('d-none');
            $("#uploaded-item-area").find('.uplaoded-background').find('.image-view-text').addClass('d-flex');
            $("#uploaded-item-area").find('.uploaded-flex').prepend(response.html);
            document.querySelector('.remove-upload-file-item').innerHTML = '';

        },
        error: function (response) {
            // If error, show the error toast with validation errors
            var errors = response.responseJSON.errors;
            var errorMessage = response.responseJSON.message;
            $.each(errors, function (key, value) {
                errorMessage += value + '<br>';
            });
            showToast('error', errorMessage);
            $('#upload-items').prop('disabled', false);
        }
    });
});
// Function to show Bootstrap toast
function showToast(type, message) {
    $('.toast-container').html('');
    var toast = $('<div aria-live="polite" aria-atomic="true"  class="d-flex justify-content-center align-items-center" style="z-index: 5; right: 0; bottom: 0;">' +
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