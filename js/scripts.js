(function ($) {
	"use strict";
	$(document).ready(function () {
		$('.products-home').slick({
			dots: true,
			infinite: false,
			speed: 300,
			arrows: false,
			slidesToShow: 4,
			slidesToScroll: 4,
			autoplay: true,
			autoplaySpeed: 2000,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						dots: true
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
						dots: true
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						dots: true
					}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
		});
	});
	var masonryUpdate = function () {
		setTimeout(function () {
			$('#notas').masonry();
		}, 500);
	}
	$(window).load(function () {

		$('.notas').masonry({
			// options
			itemSelector: '.grid-item',
			gutter: 10,
			percentPosition: true,
			originTop: true,
			resize: true
		});
		masonryUpdate();
	});

	$(window).load(function () {

		$("div.grid-item").hide();
		$("div.grid-item").slice(0, 10).show();
		$("#coso").on('click', function (e) {
			e.preventDefault();
			$("div.grid-item:hidden").slice(0, 10).slideDown();
			if ($("div.grid-item:hidden").length == 0) {
				$("#coso").fadeOut('slow');
			}
			masonryUpdate();
			$('html,body').animate({
				scrollTop: $(this).offset().top
			}, 1500);
		});
	});

	$(window).load(function () {
		$('a.tag-cloud-link').attr('href', '#');

		var categories = {};
		$(".wp-tag-cloud li a.tag-cloud-link").each(function () {
			var tag = $(this).text();
			$(this).attr('data-tag', tag);
		});
	});
	//twitter
	$(document).ready(function () {
		var tweets = $(".tweet");
		$(tweets).each(function (t, tweet) {
			var id = $(this).attr('id');
			twttr.widgets.createTweet(
				id, tweet,
				{
					conversation: 'none',    // or all
					cards: 'hidden',  // or visible 
					linkColor: '#cc0000', // default is blue
					theme: 'light'    // or dark
				});
		});
	});

}(jQuery));

