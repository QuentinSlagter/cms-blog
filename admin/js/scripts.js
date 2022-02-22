$(document).ready(function() {
  $('#summernote').summernote({
    height: 200
  });
});

// Selecting All posts at once
$(document).ready(function() {
  $('#selectAllBoxes').click(function(event) {
    if(this.checked) {
      $('.checkBoxes').each(function() {
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function() {
        this.checked = false;
      });
    }
  });
});