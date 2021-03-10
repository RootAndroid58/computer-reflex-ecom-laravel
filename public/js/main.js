$('#filter_form').on('submit', function (e) {
    e.preventDefault()

    var form = $('#filter_form');
    var formGetURL = form.attr('action') + "?" + form.serialize();

    $('#RowDiv').load(formGetURL+' #RowDiv')
    var domain = window.location.hostname
    $.getScript('/js/main.js'); 
})


$('#CategorySelect').on('change', function () {
  $('#CategoryInput').val($(this).val())
})








$('#multi-item-carousel').carousel({
    interval: 10000
  })
  
  $('.carousel .carousel-item').each(function(){
      var minPerSlide = 4;
      var next = $(this).next();
      if (!next.length) {
      next = $(this).siblings(':first');
      }
      next.children(':first-child').clone().appendTo($(this));
      
      for (var i=0;i<minPerSlide;i++) {
          next=next.next();
          if (!next.length) {
              next = $(this).siblings(':first');
            }
          
          next.children(':first-child').clone().appendTo($(this));
        }
  });
  


