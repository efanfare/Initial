function showItemDeleteConfirmation(itemId) {
    // Show the confirmation modal
    $('#exampleModalItemDelete').modal('show');

    // Update the delete button action with the scene ID
    $('#delete-item-button').attr('data-item-id', itemId);
}


function deleteItem() {
    var id = $('#delete-item-button').attr('data-item-id');
    jQuery.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: deleteItemUrl,

        data: {
            id: id
        },
        success: function (response) {
            $('#exampleModalItemDelete').modal('hide');
            showToast('success', response.message);
            $('#item_' + id).remove();

        },
        error: function (response) {
            $('#exampleModalItemDelete').modal('hide');
            var errorMessage = response.responseJSON.message;
            showToast('error', errorMessage);
        }
    });
}