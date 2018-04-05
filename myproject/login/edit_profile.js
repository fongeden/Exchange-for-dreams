$('.user_pro_pic').on('click', function() {
    $('#profile-image-upload').click().change(function(){
    readURL(this);
  });
});

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}