$(document).on('change', '#filter_limit', function(result){
	var value_set = $(this).val();
	$('.filter_limit').val(value_set).change();
});

$(document).on('click','#reset',function(){
	location.reload();
});

function pagination(total, filter){
	$('.pagination').twbsPagination('destroy');
	var grand_total = parseInt(Math.ceil(total/filter));
	var visible = (grand_total < 3) ? grand_total : 3;
	$('.pagination').twbsPagination({
		totalPages: grand_total,
		visiblePages: visible,
		onPageClick: function (event, page) {
			var filter_set = (page - 1) * filter;
			if(filter_set == 0){
				get_data_filter_pagination();
			}
			if(filter_set>0){
				filter_pagination(filter_set, total);
			} 
		}
	}).on('page', function (event, page) {
		//console.info(page + ' (from event listening)');
	});
}