$('#filter_form').on('submit', function (e) {
    e.preventDefault()

    var form = $('#filter_form');
    var formGetURL = form.attr('action') + "?" + form.serialize();

    $('#RowDiv').load(formGetURL+' #RowDiv')

    $.getScript('/js/main.js'); 
})


$('#CategorySelect').on('change', function () {
  $('#CategoryInput').val($(this).val())
})











$('.ReviewModalToggleBtn').on('click', function () {
    if ($('#ProductReviewForm').hasClass('d-none')) {
      $('#ProductReviewForm').removeClass('d-none')
    } else {
      $('#ProductReviewForm').addClass('d-none')
    }
})

var destroyed = false;
var starratingPrebuilt = new StarRating('.star-rating-prebuilt', {
    prebuilt: true,
    maxStars: 5,
});
var starrating = new StarRating('.star-rating', {
    stars: function (el, item, index) {
        el.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><rect class="gl-star-full" width="19" height="19" x="2.5" y="2.5"/><polygon fill="#FFF" points="12 5.375 13.646 10.417 19 10.417 14.665 13.556 16.313 18.625 11.995 15.476 7.688 18.583 9.333 13.542 5 10.417 10.354 10.417"/></svg>';
    },
});
var starratingOld = new StarRating('.star-rating-old');





$('#ProductReviewForm').on('submit', function (e) {
    e.preventDefault()
    var _token      = $('#ProductReviewForm').find('input[name="_token"]').val()
    var product_id  = $('#ProductReviewForm').find('input[name="product_id"]').val()
    var rating      = $('#ProductReviewForm').find('select[name="rating"]').val()
    var title       = $('#ProductReviewForm').find('input[name="title"]').val()
    var message     = $('#ProductReviewForm').find('textarea[name="message"]').val()
    var action     = $('#ProductReviewForm').find('input[name="action"]').val()

    $.ajax({
      url: action,
      method: 'POST',
      data: {
          '_token' : _token,
          'product_id' : product_id,
          'rating' : rating,
          'title' : title,
          'message' : message,
      },
      async: false,
      success: function (data) {

          if (data.status == 200) {
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl(data.message, {
                type: "success",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })  
              
            $('#RatingAreaDIV').load(window.location.href+" #RatingAreaDIV", function () {
              $.getScript('/js/main.js'); 
            })

          }
          if (data.status == 210) {
            $(".bootstrap-growl").remove();
            $.bootstrapGrowl(data.message, {
                type: "success",
                offset: {from:"bottom", amount: 100},
                align: 'center',
                allow_dismis: true,
                stack_spacing: 10,
            })
            fetchReviews('new')
            $('#RatingAreaDIV').load(window.location.href+" #RatingAreaDIV", function () {
              $.getScript('/js/main.js'); 
            })
             
          }
      }
  })

})






// Show Reviews on dedicated reviews page

function fetchReviews(type) {

  if (type == 'new') {
    $('#reviewsDivLoader').removeClass('d-none')
    $('.reviewItem').remove()
  }



  var _token              = $('input[name="_token"]').val()
  var reviews_form_action = $('#reviews_form_action').val()
  var product_id          = $('#product_id').val()
  var review_search       = $('#review_search').val()
  var sort_by             = $('#sort_by').val()
  var skip_count          = $('.reviewCount').length
  var domain              = $('#domain').val()

  $.ajax({
    url: reviews_form_action,
    method: 'POST',
    data: {
        '_token'        : _token,
        'product_id'    : product_id,
        'review_search' : review_search,
        'sort_by'       : sort_by,
        'skip_count'    : skip_count,
    },
    async: false,
    success: function (data) {
      if (data.status == 200) {
        $('#reviewsDivLoader').addClass('d-none')

        if (data.reviewsCount == 0) {
          if (type == 'new') {
            $('#ShowReviewsArea').append(
              `
              <div class="reviewItem">
                <div class="w-100 prod-back-div mt-4" style="height: 146px; background-image: url('${domain}/img/svg/notify.svg');"></div>
                <div class="mt-3" style="text-align: center;">
                    <span style="font-size: 18px;">No Review Found</span>
                </div>
              </div>
              `)
          }
  
        } 
        else {
          data.reviews.forEach(review => {
            $('#ShowReviewsArea').append(
              `
            <div class="reviewItem reviewCount" style="border: 1px solid #dddddd; border-radius: 2px; border-left: 0; border-right: 0;">
              <div class="wishlist-basic-padding" >
                  <div class="row">
                      <button type="button" class="btn btn-dark btn-sm">
                          
                          ${review.stars} <span><svg class="svg-inline--fa fa-star fa-w-18" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"></path></svg><!-- <i class="fa fa-star" aria-hidden="true"></i> Font Awesome fontawesome.com --></span>
                      </button>
                      <span style="padding-left: 12px; padding-top: 3px; font-size: 14px; color: #212121; font-weight: 500;">${review.title}</span>
                  </div>
                  <div class="row">
                      <span style="margin: 12px 0;">
                      `+review.message+`
                      </span>
                  </div>
    
                  <div class="row">
                      <span style="margin: 12px 0;">
                          `+review.user.name+` <img width="14" src="http://localhost:8000/img/svg/verified-tick.svg" alt=""> (Buyer), 0 days ago
                      </span>
                  </div>
              </div>
            </div>
              `
            )
        });


        }
      }
    }
})

}
















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
  


