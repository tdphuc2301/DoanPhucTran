$(document).ready(function() {

    var readURL = function(input, image_type = 'image') {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.profile-pic[image-type='+image_type+']').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function() {
        $(this).closest('.form-group').find('.remove-image').css('display','inline-block');
        var image_type = $(this).attr('image-type') ? $(this).attr('image-type') : 'image' ;
        readURL(this,image_type);
    });

    $(".upload-button").on('click', function() {
        var image_type = $(this).attr('image-type') ? $(this).attr('image-type') : 'image' ;
        $('.file-upload[image-type='+image_type+']').click();
    });
});
