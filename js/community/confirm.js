let feed_id = null;

$('.toggle-cnfrm-del').click(function () {
    $('.cnfrm-container').css('display', 'flex');
    $('.f-more-box').css('display', 'none');
    $('.overlay-f').css('display', 'none');

    feed_id = $(this).closest('.feed-box').find('.req_post').val();
});

$('.toggle-cnfrm-rep').click(function () {
    $('.cnfrm-container').css('display', 'flex');
    $('.rep-true').css('display', 'flex');
    $('.cnfrm-true').css('display', 'none');
    $('.del-true-box').css('display', 'none');

    $('.f-more-box').css('display', 'none');
    $('.overlay-f').css('display', 'none');

    feed_id = $(this).closest('.feed-box').find('.req_post').val();
})

$('.cnfrm-cancel').click(function () {
    $('.cnfrm-container').css('display', 'none');
    $('body').css('overflow-y', 'scroll');
})

$('.cnfrm-delete').click(function () {
    $('.del-text').css('display', 'none');
    $('.loader').css('display', 'block');
    $('.cnfrm-delete').prop('disabled', true);
    $.ajax({
        type: "GET",
        url: "../modules/server-3/confirm-delete.php",
        data: {
            feed_id: feed_id,
        },
        success: function (response) {
            $('.cnfrm-true').css('display', 'none');
            $('.del-true-box').css('display', 'flex');
        },
        error: function (xhr, status, error) {
            alert("Something went wrong");
        }
    });
})

$('.dismiss-btn').click(function () {
    location.reload();
})


$('.cnfrm-rep').click(function () {
    $('.del-text-2').css('display', 'none');
    $('.loader-2').css('display', 'block');
    $('.cnfrm-rep').prop('disabled', true);

    let message = $(this).closest('.rep-true').find('.rep-msg').val();
    $.ajax({
        type: "GET",
        url: "../modules/server-3/confirm-report.php",
        data: {
            feed_id: feed_id,
            message: message
        },
        success: function (response) {
            if (response == "empty") {
                $('.rep-msg').css('border', '1px solid red');
                $('.rep-msg').css('border-radius', '2px');

                $('.del-text-2').css('display', 'block');
                $('.loader-2').css('display', 'none');
                $('.cnfrm-rep').prop('disabled', false);
            } else {
                $('.rep-true').css('display', 'none');
                $('.rep-true-box').css('display', 'flex');
            }
        },
        error: function (xhr, status, error) {
            alert("Something went wrong");
        }
    });
})

$('.rep-msg').click(function () {
    $('.rep-msg').css('border', '1px solid grey');
    $('.rep-msg').css('border-radius', '2px');
})