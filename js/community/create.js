$(document).ready(function() {
  // Get the textarea and character count element
  var textarea = $('#post-text');
  var charCount = $('.words');
  var maxLength = 200;

  // Set the initial character count
  charCount.text('Words: ' + maxLength);

  // Listen to the keyup event on the textarea
  textarea.on('keyup', function() {
    // Get the current value of the textarea
    var text = textarea.val();

    // Get the remaining character count
    var remainingCount = maxLength - text.length;

    // Update the character count element
    charCount.text('Words: ' + remainingCount);

    // Apply red color if character count exceeds the limit
    if (text.length > (maxLength-1)) {
      charCount.css('color', 'red');
      $('post-btn').prop('disabled', true);
    } else {
      charCount.css('color', 'black');
    }
    
    // Trim the text if it exceeds the limit
    if (text.length > (maxLength-1)) {
      textarea.val(text.slice(0, (maxLength-1)));
    }
  });
});