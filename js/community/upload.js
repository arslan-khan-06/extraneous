$(document).ready(function () {
  $image_crop = $('#image_demo').croppie({
    enableExif: true,
    viewport: {
      width: 200,
      height: 200,
      type: 'circle'
    },
    boundary: {
      width: 300,
      height: 300
    }
  });



  $('#upload_image').on('change', function () {
    var fileName = $(this).val();
    var ext = fileName.split('.').pop().toLowerCase();

    if (ext !== 'jpg' && ext !== 'png' && ext !== 'jpeg') {
      alert('Please select a valid JPG or PNG image.');
    } else {
      var reader = new FileReader();
      reader.onload = function (event) {
        $image_crop.croppie('bind', {
          url: event.target.result
        });
      }
      reader.readAsDataURL(this.files[0]);
      $('#uploadimage').show();
    }
  });

  $('.crop_image').click(function (event) {
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function (image) {
      $.ajax({
        url: '../modules/server-2/upload-image.php', // Replace with the URL of your server-side script
        method: 'POST',
        data: { image: image },
        success: function (response) {
          window.location.href = "../community/profile";
        },
        error: function (xhr, status, error) {
          alert('Something went wrong!');
        }
      });
    });
  });
});

