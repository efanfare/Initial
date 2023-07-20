function showBackgroundDeleteConfirmation(backgroundId, element) {
    // Show the confirmation modal
    $('#exampleModalBackgroundDelete').modal('show');

    // Update the delete button action with the scene ID
    $('#delete-background-button').attr('data-background-id', backgroundId);
    $('#delete-background-button').data('clicked-element', element);
}

function deleteBackground() {
    var id = $('#delete-background-button').attr('data-background-id');
    var element = $('#delete-background-button').data('clicked-element');
    jQuery.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: deleteBackgroundUrl,

        data: {
            id: id
        },
        success: function (response) {
            $('#exampleModalBackgroundDelete').modal('hide');
            showToast('success', response.message);
            $(element).closest('.container-item').remove();


        },
        error: function (response) {
            $('#exampleModalBackgroundDelete').modal('hide');
            var errorMessage = response.responseJSON.message;
            showToast('error', errorMessage);
        }
    });
}