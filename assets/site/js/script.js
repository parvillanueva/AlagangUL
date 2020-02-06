$(document).ready(function() {
	responsive();
});

$(window).resize(function(){
	responsive();
});

function responsive(){
	//minimum height for hero banner
	var maxHeight = -1;
	$('.au-hero-container .carousel-item').each(function() {
	    if ($(this).outerHeight(true) > maxHeight) {
	        maxHeight = $(this).outerHeight(true) + 64;
	    }
	});
	$('.au-hero-bg').css("min-height", maxHeight);

	var headerheight = $('header').height();
	var footerheight = $('footer').height();

	//full height hero banner
	$(".au-hero-bg").css("height", "calc(100vh - "+ headerheight +"px)");

}