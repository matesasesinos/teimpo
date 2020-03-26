(function ($) {
	"use strict";
	//masorny
	function resizeGridItem(item){
		var grid = $(".notas")[0];
		var rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
		var rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
		var rowSpan = Math.ceil((item.querySelector('.content').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
		item.style.gridRowEnd = "span "+rowSpan;
	}

	function resizeAllGridItems(){
		var x;
		var allItems = $(".grid-item");
		for(x=0;x<allItems.length;x++){
		resizeGridItem(allItems[x]);
		}
	}
	
	function resizeInstance(instance){
		var item = instance.elements[0];
		resizeGridItem(item);
	}

	$(document).ready(function(){
		resizeAllGridItems();
	});
	$(document).on('resize', resizeAllGridItems);
	$(document).ready(function(){
		var x;
		var allItems = $(".grid-item");
		for(x=0;x<allItems.length;x++){
			imagesLoaded( allItems[x], resizeInstance);
		}
	});
	//cargo tweets
	$(window).load(function(){	
		setTimeout(function(){
			feedTweets();
		}, 500);
	});
	//cargamos la nube
	$(window).load(function () {
		$('a.tag-cloud-link').attr('href', '#');

		var categories = {};
		$(".wp-tag-cloud li a.tag-cloud-link").each(function () {
			var tag = $(this).text();
			$(this).attr('data-tag', tag);
		});
	});
	//boton de mas
	$(document).ready(function () {

		$("div.grid-item").hide();
		$("div.grid-item").slice(0, 10).show();
		$("#coso").on('click', function (e) {
			e.preventDefault();
			
			$("div.grid-item:hidden").slice(0, 10).slideDown();
			if ($("div.grid-item:hidden").length == 0) {
				$("#coso").fadeOut('slow');
			}
			$('html,body').animate({
				scrollTop: $(this).offset().top
				
			}, 1500);
			feedTweets();
		});
	});
	//links tag cloud
	function filter(e) {
		var regex = new RegExp('\\b' + e + '\\b');
		//console.log('test', regex);
		$('.nota-feed').hide().filter(function () {
			//console.log($(this).data('filter'), regex.test($(this).data('filter')))
			return regex.test($(this).data('filter'));
		}).show();
		
	}
	$(document).ready(function () {
		$('a.tag-cloud-link').click(function (e) {
			var selectSize = $(this).text();
			filter(selectSize);
			e.preventDefault();
			feedTweets();
		});
		
		$('a.tag-term').click(function (e) {
			var selectSize = $(this).text();
			filter(selectSize);
			e.preventDefault();
			feedTweets();
		});

	});
	//twitter
	function feedTweets() {
		var tweets = $(".tweet");
		$(tweets).each(function (t, tweet) {
			var id = $(this).attr('id');
			twttr.widgets.createTweet(
				id, tweet,
				{
					conversation: 'none', 
					cards: 'visible',  
					linkColor: '#cc0000', 
					theme: 'light', 
					lang: 'es'
				}).then(function(tweet){
					resizeAllGridItems();
				});
		});
	}
		
	
}(jQuery));