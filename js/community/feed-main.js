$(document).ready(function () {
    var replyParagraph = $('<p>', {
        class: 'rep-all reply',
        text: 'Reply'
    });

    replyParagraph.insertBefore('.cm-rep .view-replies');
});


$(document).ready(function () {
    $('.back-btn').click(function () {
        window.history.back();
    });
});

$(".feed-action-i").click(function () {
    $(".f-more-box").css("display", "flex");
    $(".overlay-f").css("display", "flex");
    $("body").css("overflow-y", "hidden");
});

$(".overlay-f").click(() => {
    $(".f-more-box").css("display", "none");
    $(".overlay-f").css("display", "none");
    $("body").css("overflow-y", "scroll");
})

$(document).ready(function () {
    let val1 = $(".val-1").text();
    let val2 = $(".post_id").val();
    $(".cmnt-alias").text("@" + val1);
    $(".alias-inp").val(val1);
    $(".reply-to").val(val2);
    $(".status").val("main");
});

$(document).ready(function () {
    $(".likes").click(function (event) {
        event.preventDefault();

        var heartF = $(this).find(".react-f-img");
        var heartT = $(this).find(".react-f-img2");
        var count = $(this).find(".feed-like");
        var user_id = $(this).closest("form.finder").find("input.user_id").val();
        var post_id = $(this).closest("form.finder").find("input.post_id").val();

        var action = heartF.css("display") === "block" ? "like" : "dislike";

        $.ajax({
            type: "GET",
            url: "../modules/server-3/feed-react.php",
            data: {
                action: action,
                user_id: user_id,
                post_id: post_id,
            },
            success: function (response) {

            },
            error: function (xhr, status, error) {

            }
        });

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
    $(".cmt-react").click(function () {
        var heartF = $(this).find(".heart-f");
        var heartT = $(this).find(".heart-t");
        var count = $(this).find(".cl-counts");

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
    $(".reply").click(function () {
        $(".sf-2").css("display", "none");
        $(".sf-1").css("display", "flex");
        let attr_1 = $(this).closest(".cmt-dat").find(".dat-un").text();
        $(".cM-1").removeAttr("disabled");
        $(".cM-1").get(0).focus();
        $(".alias-inp").val(attr_1);
        $(".cmnt-alias").text("@" + attr_1);
        $(".status").val("reply");
        $('.fork').val("thread");
        let th_val = $(this).closest(".cmt-dat").find(".cmt-id").val();
        let user_id = $(this).closest(".cmt-dat").find(".cmt_username").val();
        $(".thread-to").val(th_val);
        $(".replying-to").val(user_id);
    });
});

$(document).ready(function () {
    $(".cmt-btn").click(function (event) {
        event.preventDefault();
        let cmt_alias = $(".alias-inp").val();
        let cmt_status = $(".status").val();
        let reply_to = $(".reply-to").val();
        let comment = $(".cmnt-main").val();
        let cmt_to = $(".reply-to").val();
        let thread_to = $(".thread-to").val();
        let replying_to = $(".replying-to").val();
        let fork = $(".fork").val();
        $.ajax({
            method: "GET",
            url: "../modules/server-3/cmt-to.php",
            data: {
                cmt_to: cmt_to,
                cmt_alias: cmt_alias,
                reply_to: reply_to,
                replying_to: replying_to,
                thread_to: thread_to,
                cmt_status: cmt_status,
                comment: comment,
                fork: fork,
            },
            success: function (response) {
                location.reload();
            },

            error: function (xhr, status, error) {
                alert(error);
            }
        })
    });
});

$(document).ready(function () {
    $(".view-replies").click(function (event) {
        event.preventDefault();
        let $this = $(this);
        let vr_id = $this.closest(".cmt-dat").find(".cmt-id").val();

        if ($this.text() === "View all replies") {
            $this.text("Loading...");

            $.ajax({
                method: "GET",
                url: "../modules/server-3/view-replies.php",
                data: {
                    vr_id: vr_id,
                },
                success: function (response) {
                    $this.text("Hide replies");
                    $this.closest(".cmn-major").find(".more-reps").html(response);

                    var replyParagraph = $('<p>', {
                        class: 'rep-all reply2',
                        text: 'Reply'
                    });
            
                    // Append the 'Reply' paragraph to the '.cm-rep' div
                    $this.closest(".cmn-major").find('.cm-ret-reps').append(replyParagraph);


                    $(".reply2").click(function () {
                        $(".sf-2").css("display", "none");
                        $(".sf-1").css("display", "flex");
                        let attr_1 = $(this).closest(".cmt-dat").find(".dat-un").text();
                        $(".cM-1").removeAttr("disabled");
                        $(".cM-1").get(0).focus();
                        $(".alias-inp").val(attr_1);
                        $(".cmnt-alias").text("@" + attr_1);
                        $(".status").val("reply");
                        $('.fork').val("thread");
                        let th_val = $(this).closest(".cmt-dat").find(".thread-id").val();
                        let user_id = $(this).closest(".cmt-dat").find(".cmt_username").val();
                        $(".thread-to").val(th_val);
                        $(".replying-to").val(user_id);
                    });



                    $(".cmt-react").click(function () {
                        var heartF = $(this).find(".heart-f");
                        var heartT = $(this).find(".heart-t");
                        var count = $(this).find(".cl-counts");
                
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


                },
                error: function (xhr, status, error) {
                    $this.text("View all replies");
                }
            });
        } else if ($this.text() === "Hide replies") {
            $this.text("View all replies");
            $this.closest(".cmn-major").find(".more-cmnt").html("");
        }
    });
});

$(document).ready(function () {
    $(".cmt-react").click(function (event) {
        event.preventDefault();
        var cmtF = $(this).find(".heart-f");
        var cmtT = $(this).find(".heart-t");
        var count = $(this).find(".cl-counts");
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



