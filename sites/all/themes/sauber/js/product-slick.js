(function ($) {
  jQuery(document).ready(function () {
  	$('.first-images').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  arrows: false,
		  fade: true,
		  asNavFor: '.second-images'
		});
		$('.second-images').slick({
		  slidesToShow: 4,
		  slidesToScroll: 1,
		  asNavFor: '.first-images',
		  arrows: false,
		  dots: false,
		  focusOnSelect: true
		});
  });
}(jQuery));