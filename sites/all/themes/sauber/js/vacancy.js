(function ($) {
  Drupal.behaviors.vacancy = {
    attach: function (context, settings) {
      $('.view-vacancy .views-field-title').click(function(){
      	  scrollTo = $('.view-id-vacancy').offset().top - 200;
          var timer = 300;
	      var body = $(this).next('.views-field-body');
	      if(body.is(":visible")){
	      	body.slideUp(timer);
	      	$('.view-vacancy .views-field-title').removeClass('open');
	      }
	      else{
	      	$('.view-vacancy .views-field-body').slideUp(timer);
	      	body.slideDown(timer);
	      	$('.view-vacancy .views-field-title').removeClass('open');
	      	$(this).addClass('open');	      	
      	    $('html, body').animate({	      	    	
		        scrollTop: scrollTo,
		    }, timer);
	      }
      });
    }
  };
}(jQuery));