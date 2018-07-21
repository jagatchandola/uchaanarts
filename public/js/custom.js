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
});

	