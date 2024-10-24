$(window).on('load', function() {
    $('body').css('display', 'flex');
});


$('#home').click(() => {
    window.location.href = "home";
});

$('#posts').click(() => {
    window.location.href = "feed";
});

$('#create').click(() => {
    window.location.href = "create";
});

$('#chat').click(() => {
    window.location.href = "chats";
});

$('#profile').click(() => {
    window.location.href = "profile";
});

$('#notifications').click(() => {
    window.location.href = "notifications";
});

$('#search').click(() => {
    window.location.href = "search";
});
