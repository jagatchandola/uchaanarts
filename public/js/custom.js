$('.first-owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
	lazyLoad: true,
	singleItem: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
	
})

$('.second-owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
	lazyLoad: true,
	singleItem: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:2
        }
    }
	
})

$('.third-owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
	lazyLoad: true,
	singleItem: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
	
})
$('.fourth-owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
	lazyLoad: true,
	singleItem: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:2
        }
    }
	
})
$('.fifth-owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
	lazyLoad: true,
	singleItem: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
	
})

$(".moreBox").slice(0, 1).show();
    if ($(".blogBox:hidden").length != 0) {
      $("#loadMore").show();
    }   
    $("#loadMore").on('click', function (e) {
      e.preventDefault();
      $(".moreBox:hidden").slice(0, 4).slideDown();
      if ($(".moreBox:hidden").length == 0) {
        $("#loadMore").fadeOut('slow');
      }
    });
	
//FIlter for desktop//
 var $btns = $('.list').click(function() {
  if (this.id == 'all') {
    $('#parent > div.box').fadeIn(450);
  } else {
    var $el = $('.' + this.id).fadeIn(450);
    $('#parent > div.box').not($el).hide();
  }
  $btns.removeClass('active');
  $(this).addClass('active');
})
 
 
//filter for mobile //
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
			
            if ($(window).width() < 838) {
			   
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
				
            } else{
                $(".box").show();
            }
        });
    }).change();

    $('#news-letter').on('click', function(){
        $('#news-letter-msg-box').html('');
        var email = $('#news-letter-email').val().trim();
        if(email != ''){

                $.ajax({
                    type: "POST",
                    url: '/news-letter',
                    data: {email: email, '_token': $('meta[name=csrf-token]').attr('content')},
                    success: function( response ) {
                        var _html = '';
                        if(response == 1){
                            _html = '<div class="alert-success" style="font-size:12px;"><strong>Success!</strong> Thanks for subscription.</div>'
                        }else if(response == 0){
                            _html = '<div class="alert-danger" style="font-size:12px;"><strong>Danger!</strong> Email is already exist.</div>';
                        } else{
                            _html = '<div class="alert-danger" style="font-size:12px;"><strong>Danger!</strong> Email is Required.</div>';
                        }
                        $('#news-letter-msg-box').html(_html);
                    }
                });
            
        } else {
            $('#news-letter-msg-box').html('<div class="alert-danger" style="font-size:12px;"><strong>Danger!</strong> Email id is Required.</div>');
        }
    });

    $(".add-to-cart").on('click', function(){
        let id = $(this).attr('data-id');
        addToCart(id, 'cart')
        
    })

    $(".add-to-wishlist").on('click', function(){
        let id = $(this).attr('data-id');
        addToCart(id, 'wishlist')
        
    })

    
});

function addToCart(id, type){
    $.ajax({
      url: '/add-to-cart',
      type: 'POST',
      data: {id: id, type: type, _token: $('meta[name="csrf-token"]').attr('content')},
      success: function(data) {
        //called when successful
        if(data != 0){
            if(type == 'cart'){

            } else {

            }
        } else {

        }
      },
      error: function(e) {
        //called when there is an error
        //console.log(e.message);
      }
    });
}
