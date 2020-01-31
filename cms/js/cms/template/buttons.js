$('.status_action').hide();

$(document).on('click', '#btn_close', function(){   
    window.location.href = implode_urls;
});

$(function() {
	$('[data-toggle="tooltip"]').tooltip();   
});


/*$('.start-date').datepicker({ 
	dateFormat: 'yy-mm-dd', 
	changeMonth: true,
	changeYear: true,
	onSelect: function(str){ 
	  	$(".end-date").datepicker("destroy"); 
	  	$(".end-date").val(str); 
	  	$(".end-date").datepicker({ 
		    dateFormat: 'yy-mm-dd', 
		    changeMonth: true,
		    changeYear: true,
		    minDate: new Date(str) 
	  	}); 
    }
});*/

//=== Material Date Picker ===//
//=== Options availables ===//
//{date: true, time: true, format: 'YYYY-MM-DD', minDate: null, maxDate: null, currentDate: null, lang: 'en', weekStart: 0, disabledDays: [], shortTime: true, clearButton: false, nowButton: false, cancelText: 'Cancel', okText: 'OK', clearText: 'Clear', nowText: 'Now', switchOnClick: false, triggerEvent: 'focus', monthPicker: false, year:true}


$('.start-date').materialDatePicker({
	time : false,
	weekStart : 0
}).on('change', function(e, date){
	$('.end-date').val($('.start-date').val()).prop('disabled', false);
	$('.end-date').materialDatePicker({
		time : false,
		weekStart : 0
	});
	$('.end-date').materialDatePicker('setMinDate', date);
});


$(document).on('cut copy paste input', '.start-date, .end-date', function(e) {
    e.preventDefault();
});

$(document).on('click', '#btn_reset', function(){
	$('.start-date').val('');
	$('.end-date').val('').prop('disabled', true);
	$('#search_query').val('');
});