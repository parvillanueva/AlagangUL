$(function(){
	setBodyMargin();
	
	
});

$(window).bind('resize', function(){		
		setBodyMargin();
	});
function setBodyMargin(){
		var footerHeight = $('.footer').height(); 
		//alert('footer:'+footerHeight);
		$("body").css('margin-bottom', footerHeight);
}


