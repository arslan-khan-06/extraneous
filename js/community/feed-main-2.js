$(document).ready(function () {
    $(".cr2").click(function () {
        var heartF = $(this).find(".h2f");
        var heartT = $(this).find(".h2t");
        var count = $(this).find(".cc2");

        if (heartF.css("display") === "block") {
            heartF.css("display", "none");
            heartT.css("display", "block");
            count.text(parseInt(count.text()) + 1);
        } else {
            heartF.css("display", "block");
            heartT.css("display", "none");
            count.text(parseInt(count.text()) - 1);
        }
    });
});



$(document).ready(function () {
    $(".cr2").click(function (event) {
        event.preventDefault();
        var cmtF = $(this).find(".h2f");
        var cmtT = $(this).find(".h2t");
        var count = $(this).find(".cc2");
        var cmt_id = $(this).siblings("form.cmt-dat").find("input.cmt-id").val();

        // var post_id = $(this).closest("form.finder").find("input.post_id").val();

        var action = cmtT.css("display") === "block" ? "like" : "dislike";

        $.ajax({
            type: "GET",
            url: "../modules/server-3/cmt-likes.php",
            data: {
                action: action,
                cmt_id: cmt_id,
                // post_id: post_id,
            },
            success: function (response) {
                
            },
            error: function (xhr, status, error) {
                
            }
        });

       
    });
});



