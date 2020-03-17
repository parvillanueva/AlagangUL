$(document).on('change', '#filter_limit', function(result){
	var value_set = $(this).val();
	$('.filter_limit').val(value_set).change();
});

$(document).on('click','#reset',function(){
	location.reload();
});