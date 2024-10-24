$(document).ready(function () {
  var link = document.getElementById('down');

  link.click();
});

$('.back').click(()=>{
  window.location.href = 'chats';
})

function autoExpand(textarea) {
  textarea.style.height = '20px'; // Reset the height to the minimum value

  const scrollHeight = textarea.scrollHeight; // Calculate the scroll height

  if (scrollHeight > 20 && scrollHeight <= 70) {
    textarea.style.height = scrollHeight + 'px'; // Set the height within the desired range
  }

  if (scrollHeight > 70) {
    textarea.style.height = '70px'; // Set the height to the maximum value
  }
}

const sendButton = document.getElementById('sendButton');
const messageInput = document.getElementById('messageInput');

sendButton.addEventListener('click', function (e) {
  e.preventDefault(); // Prevent the form from submitting

  // Clear the text area and reset its height
  messageInput.value = '';
  messageInput.style.height = '20px';
});


$('.feed-action-i').click(function () {
  $(".f-more-box").css('display', 'flex');
  $('.overlay-f').css('display', 'flex');
  $('body').css('overflow-y', 'hidden');
});

$('.overlay-f').click(() => {
  $('.f-more-box').css('display', 'none');
  $('.overlay-f').css('display', 'none');
  $('body').css('overflow-y', 'scroll');
})