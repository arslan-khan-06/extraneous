$('.feed-action-i').click(function () {
    $(this).closest(".feed-box").find(".f-more-box").css('display', 'flex');
    $('.overlay-f').css('display', 'flex');
    $('body').css('overflow-y', 'hidden');
});

$('.overlay-f').click(() => {
    $('.f-more-box').css('display', 'none');
    $('.overlay-f').css('display', 'none');
    $('body').css('overflow-y', 'scroll');
})


$(document).ready(function() {
    $('.likes').click(function(event) {
        event.preventDefault();

        var heartF = $(this).find('.react-f-img');
        var heartT = $(this).find('.react-f-img2');
        var count = $(this).find('.feed-like');

        var user_id = $(this).closest('form.finder').find('input.user_id').val();
        var post_id = $(this).closest('form.finder').find('input.post_id').val();

        var action = heartF.css('display') === 'block' ? 'like' : 'dislike';

        $.ajax({
            type: 'GET',
            url: '../modules/server-3/feed-react.php',
            data: {
                action: action,
                user_id: user_id,
                post_id: post_id,
            },
            success: function(response) {
                
            },
            error: function(xhr, status, error) {
                
            }
        });

        if (heartF.css('display') === 'block') {
            heartF.css('display', 'none');
            heartT.css('display', 'block');
            count.text(parseInt(count.text()) + 1);
        } else {
            heartF.css('display', 'block');
            heartT.css('display', 'none');
            count.text(parseInt(count.text()) - 1);
        }
    });
});


$(document).ready(function() {
    $('.feed-data').click(function() {
        // var req_post = $(this).find('input.req_post').val();
        $(this).find('.feed-form').submit();
    });
});
