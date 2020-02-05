$(document).ready( function() {

	$(".php-file-tree").find("UL").hide();

	$(".pft-directory A").click( function() {
		$(this).parent().find("UL:first").slideToggle("medium");
		if( $(this).parent().attr('className') == "pft-directory" ) return false;
	});

});
