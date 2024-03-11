
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const imageCheckBoxes = $('.imagecheck-input');
    let imagesIds = [];
    const checkedImages = [];
    const deleteButton = $('#deleteImagesButton');

    imageCheckBoxes.change(function (e) {
        const checkboxValue = e.target.value;

        if ($(this).is(':checked')) {
            imagesIds.push(checkboxValue);
            if (imagesIds.length !== 0) {
                deleteButton.show();
            }
            const image = $(this).siblings('.imagecheck-figure').attr('data-image');
            checkedImages.push(image);
        } else {
            const indexToRemove = imagesIds.indexOf(checkboxValue);
            if (indexToRemove !== -1) {
                imagesIds.splice(indexToRemove, 1);
            }

            const image = $(this).siblings('.imagecheck-figure').attr('data-image');
            const indexToRemoveChecked = checkedImages.indexOf(image);
            if (indexToRemoveChecked !== -1) {
                checkedImages.splice(indexToRemoveChecked, 1);
            }

            // Check if there are no more checked images
            if (checkedImages.length === 0) {
                deleteButton.hide();
            }
        }
    });

    deleteButton.hide();

    deleteButton.click(() => {
        $.ajax({
            url: '/admin/products/delete/images',
            method: 'post',
            data: { 'imagesId': imagesIds },
            success: (response) => {
                checkedImages.forEach(image => {
                    $(`.imagecheck-figure[data-image="${image}"]`).hide();
                    deleteButton.hide();
                    imagesIds = [];
                });
                if (checkedImages.length === 0) {
                    deleteButton.hide();
                }
            },
            error : function(error){
                console.log(error);
            }
        });
    });

    markAsAllRead = () => {
        $.ajax({
            url : "/admin/notifications/mark-as-all-read",
            method : 'post',
            success : (response) => {
                $('#notification').removeClass('beep')
            },
            error : (error) => {
                console.log(error);
            }
        })
    }

    $('#markAsAllRead').click(function(){
        markAsAllRead()
    })
});

