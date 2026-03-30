(function ($) {
  jQuery(document).ready(function(){

	var windowsize = $(window).width();
	if (windowsize > 1190) {
	    fixed_header();
	}
	else{
		$('#main-menu').hide();
	}

    $("#open-menu").click(function(){
    	if(!$(this).hasClass("openned-menu")){
	    	$("aside").fadeIn("slow");
	    	$(this).addClass("openned-menu");
	    	//$("aside").height($(document).height() - $('header').height());
	    	$('article').fadeOut("slow");
	    	$('footer').fadeOut("slow");
	    	return false;
    	}
    	else{
	    	$("aside").fadeOut("slow");
	    	$(this).removeClass("openned-menu");
	    	$('article').fadeIn("slow");
	    	$('footer').fadeIn("slow");
	    	return false;
    	}
    });

	jQuery(document).click(function(event){

		article = $(event.target).closest("article").length;
		header = $(event.target).closest("header").length;
		footer = $(event.target).closest("footer").length;		
		if($(window).width() < 1190){
			if(article || header || footer){
				jQuery("aside").fadeOut("slow");
				$("#open-menu").removeClass("openned-menu");
	    		$('article').fadeIn("slow");
	    		$('footer').fadeIn("slow");
	    		console.log('tut2');
				event.stopPropagation();
			}
			else{
				return;
			}
		}
	});

	

	$(window).resize(function() {
	  windowsize = $(window).width();
	  if (windowsize > 1190) {
	  	fixed_header();
	    //jQuery("aside").fadeIn("slow");
	  }
	  else{
	  	$('#main-menu').hide();
	  	//articlewidth = $('article').width();
	  	//$('header').css('width', articlewidth);
	  	//jQuery("aside").fadeOut("slow");
	  	//$("#open-menu").removeClass("openned-menu");
	  }
	});


	  function fixed_header(){
		var win_width = $(window).width();
	    var center_width = $('aside').width() + $('article').width();
	    right = (win_width - center_width) / 2;
	    //console.log(right);
	    $('.region-header').css('right', right);
	    $('.region-header').show();
	    $('#main-menu > ul').css('right', right);
	    $('#main-menu > ul').show();  	
	  }

	  /*$('a').click(function(){
	  	var hash = $(this).attr('hash');
	  	if(hash !== undefined && hash != ''){
	  		$(document).scrollTop( $(hash).offset().top - 150);
	  		return false;
	  	}
	  });*/

	$("#block-menu-menu-devices-and-mats .content, #block-menu-menu-products .content").each(function () {
		let block = $(this);
		// expanded active-trail		
		$(".menu li", block).each(function() {
			let li = $(this); //console.log(li);
			if ($(li).hasClass('active-trail') && $(li).hasClass('expanded')) {
				$(this).addClass('opened');
			}
		});
		
		$(".menu li", block).click(function (event) {
		 	$(this).toggleClass('opened');
		 	event.stopPropagation();
		});		
	});

	$("article .block-block .content, article .video-container, article .node > .content > .field-name-field-video .media-youtube-video").each(function() {
		let content = $(this);
		$('iframe', content).each(function () {
			var iframe = $(this);
			let title = '';
			let collect_title = $(".field-name-field-video-title .field-item", content).text();
			if (collect_title !== '') {
				title = collect_title;
			} else {
				title = $(iframe).attr('title');
			}
			
			$(content).addClass('video-content');
			if (title !== undefined) {
				$(content).append('<div class="video-hover"><div class="video-play"></div><p>'+title+'</p></div>');
			} else {
				$(content).append('<div class="video-hover"><div class="video-play"></div></div>');
			}
			$('.video-play', content).click(function () {
				$('.video-hover', content).animate({opacity: "hide"}, 1500, 'linear', function() {
					let src = $(iframe).attr('src');
					if (src.search(/\?/) > 0) {
						$(iframe).attr('src', src+'&autoplay=1');
					} else {
						$(iframe).attr('src', src+'?autoplay=1');
					}
					
				});
			});
		});
		
	});

	$("article .field-name-field-video-collection").each(function() {
		let content = $(this);
		$('.entity-field-collection-item', content).each(function () {
			let item = $(this);
			var iframe = $('iframe', item);
			let title = '';
			let collect_title = $(".field-name-field-video-title .field-item", item).text();
			if (collect_title !== '') {
				title = collect_title;
			} /*else {
				title = $(iframe).attr('title');
			}*/
			
			$(item).addClass('video-content');
			if (title != '') {
				$(item).append('<div class="video-hover"><div class="video-play"></div><p>'+title+'</p></div>');
			} else {
				$(item).append('<div class="video-hover"><div class="video-play"></div></div>');
			}
			$('.video-play', item).click(function () {
				$('.video-hover', item).animate({opacity: "hide"}, 1500, 'linear', function() {
					let src = $(iframe).attr('src');
					if (src.search(/\?/) > 0) {
						$(iframe).attr('src', src+'&autoplay=1');
					} else {
						$(iframe).attr('src', src+'?autoplay=1');
					}
					
				});
			});
		});
		
	});

	$(".info-block").each(function() {
		let $block = $(this);
		$(".info-tabs span", $block).click(function () {
			let $label = $(this);
			let $id = $($label).attr("infoblock");
			if ($($label).hasClass('active')) {
				$(".info-data", $block).slideUp();
				$($label).removeClass('active');
			} else {
				$(".info-tabs span", $block).removeClass('active');
				$($label).addClass('active');
				$(".info-data", $block).slideUp(function () {
					$(".info-data-"+$id, $block).slideDown();
				})
			}
		})
	});
	//console.log('loaded');
	//$("#views-slideshow-bxslider-1").addClass('loaded');

	setTimeout(showSliders, 5000);

	function showSliders() {
		$("#views-slideshow-bxslider-1").addClass('loaded');
	}

	$('.view-sertificate .view-content').addClass('owl-carousel').owlCarousel({
    //rtl:true,
    loop:true,
    margin:30,
    nav:true,
    //slideBy:1,
    dotsEach:true,
    items:3,
    responsive:{
    		768: {
    			items: 3
    		},
    		640: {
    			items: 3
    		},
        560:{
            items:2
        },
        480:{
            items:2
        },
        320:{
            items:2,
            center:true,
        },
        240:{
            items:2,
            center:true,
        }
    }
    //autoWidth:true,
    //items:3,
    // responsive:{
    //   0:{
    //       items:1
    //   },
    //   600:{
    //       items:2
    //   },
    //   1000:{
    //       items:3
    //   }
    // }
	});

  });
   
  Drupal.behaviors.faqAccordion = {
    attach: function (context, settings) {
      // Используем делегирование событий для .faq-question
      // Это гарантирует работу даже после AJAX-загрузок
      $('.faq-question', context).once('faq-accordion-behavior').on('click', function() {
        var $this = $(this);
        var $answer = $this.next('.faq-answer'); // Соседний .faq-answer
        var $allAnswers = $('.faq-answer'); // Все .faq-answer
        var $allQuestions = $('.faq-question'); // Все .faq-question

        // Закрываем все открытые ответы
        $allAnswers.slideUp();
        $allQuestions.removeClass('active'); // Убираем активный класс

        // Открываем/закрываем текущий
        if ($answer.is(':visible')) {
          $answer.slideUp();
          $this.removeClass('active');
        } else {
          $answer.slideDown();
          $this.addClass('active');
        }
      });
    }
  };

})(jQuery);


