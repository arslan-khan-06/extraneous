$('.add-plus').click(()=>{
    window.location.href = "../community/upload";
})

$('.txt-1').click(()=>{
    window.location.href = "../community/upload";
})

$(document).ready(function() {
    var textarea = $('.bio-txt');
    var charCount = $('.words');
    var maxLength = 100;
  
    charCount.text(maxLength);
  
    textarea.on('keyup', function() {
      var text = textarea.val();
  
      var remainingCount = maxLength - text.length;

      charCount.text(remainingCount);
      if (text.length > (maxLength-1)) {
        charCount.css('color', 'red');
      } else {
        charCount.css('color', 'black');
      }
    
      if (text.length > (maxLength)) {
        textarea.val(text.slice(0, (maxLength-1)));
      }
    });
  });