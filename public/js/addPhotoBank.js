function addPhotoBank(id) {
    jQuery.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: addPhotoBankUrl,

        data: {
            id: id,
            sceneId: sceneId
        },
        success: function (response) {
            showToastAddPhotoBank('success', response.message);
            $("#photo-bank-area").find(".empty-box").prepend(response.html);
            $("#photo-bank-area").find(".empty-box").find('p').html('');
        },
        error: function (response) {
            var errorMessage = response.responseJSON.message;
            showToastAddPhotoBank('error', errorMessage);
        }
    });
}

// Function to show Bootstrap toast
function showToastAddPhotoBank(type, message) {
    $('.toast-container').html('');
    var toast = $('<div aria-live="polite" aria-atomic="true"  class="d-flex justify-content-center align-items-center" style="z-index: 5; right: 0; bottom: 0;">' +
        '<div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="6000">' +
        '<div class="toast-header">' +
        '<strong class="mr-auto"></strong>' +
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