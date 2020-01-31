//return if json
function is_json(str) {
    try {
        return JSON.parse($.trim(str));
    } catch (e) {
        return $.trim(str)
    }
} 

//element action
var element = {
	click : function(element, cb){
		$(document).on('click', element, cb);
	},
	change : function(element, cb){
		$(document).on('change', element, cb);
	},
	html : function(element, value){
		$(element).html(value);
	},
	append : function(element, value){
		$(element).append(value);
	},
	show : function(element){
		$(element).show();
	},
	hide : function(element){
		$(element).hide();
	},
	remove : function(element){
		$(element).remove();
	}
}

//ajax
var aJax = {
  	post : function(url,data,cb){
	    $.ajax({
	      async: false,
	      cache: false,
	      type: 'POST',
	      url:url,
	      data:data,
	      success: cb
	    });
	},
	get : function(url,cb){
    	$.ajax({
      		type: 'GET',
      		url:url,
      		success: cb
    	});
  	}
}

//validation
var validate = {
	email_address : function(email){
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(email);
	},
	required: function(element){
		var counter = 0;
	    $(element).each(function(){
	    	if($(this).val() != null){
	    		var input = $(this).val().trim();
	          	if (input.length == 0) {
	          		$(this).css('border-color','red');
	          		$(this).next().html("This field is requred.");
	            	$(this).next().show();
	            	counter++;
	          	}else{
	            	if(input == 0 || input == "0"){
	                	$(this).css('border-color','red');
	               	 	$(this).next().html("Invalid Input.");
	                	$(this).next().show();
	                	counter++;
	            	} else {
	              		$(this).css('border-color','#ccc');
	              		$(this).next().hide();
	            	}        	
	          	}
	    	} else {
	    		$(this).css('border-color','red');
	    		$(this).next().html("This field is requred.");
	            $(this).next().show();
	    	}
	          
	      });
	    return counter;
	}
}

//modals
var modal = {
	confirm : function(message,cb){
		bootbox.confirm({
		   	message: message,
		   	buttons: {
			   	confirm: {
				   label: 'Yes',
				   className: 'btn-primary'
			   	},
			   	cancel: {
				   label: 'No',
				   className: 'btn-default'
			   	}
		   	},
		   	callback: cb
		});
	},
	alert : function(message, cb){
		bootbox.alert({
		    message: message,
		    callback: cb
		});
	},
	show : function(message, size, cb){
		bootbox.alert({
		    message: message,
		    size: size,
		    callback: cb
		});
	},
	input : function(message,type, cb){
		bootbox.prompt({
		    title: message,
		    inputType: type,
		    callback: cb
		});
	},
	custom : function(modal, action){
		$(modal).modal(action);
	},
	loading : function(isloading){
		if(isloading){
			bootbox.dialog({ message: '<div><h4><strong>Loading...</strong></h4><div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div></div>', closeButton: false });
		} else {
			$('.bootbox').modal('hide');
		}
	},
	image_view : function(src){
		var body = "<img src='"+src+"' style='width: 100%;' />"
		bootbox.alert({
		    message: body
		});
	},
	video_view : function(src){
		var body = '<video style="width: 100%;"  controls>';
		body += '	<source src="'+src+'" type="video/mp4">';
		body += '</video>';
		bootbox.alert({
		    message: body
		});
	}
}


function check_unique(element)
{
	var values = {};
	var countUnique = 0;
	var checks = $(element);
	checks.removeClass("error");

	checks.each(function(i, elem)
	{
	  if(elem.value in values) {
	    $(elem).css('border-color','red');
	    $(elem).next().html("Please enter a Unique Value.");
	    $(elem).next().show();
	    $(values[elem.value]).css('border-color','red');
	    $(values[elem.value]).next().html("Please enter a Unique Value.");
	    $(values[elem.value]).next().show();
	  } else {
	    values[elem.value] = elem;
	    ++countUnique;
	  }
	});

	if(countUnique == checks.size()) {
	  return 0;
	} else {
	  return 1;
	}
}

var pagination = {
	generate : function(total_page, element){
		  var htm = '<div class="clearfix"></div>';
		  htm += '<br><center><div class="btn-group">';
		  htm += '  <button type="button" class="btn btn-default first-page">First</button>';
		  htm += '  <button type="button" class="btn btn-default prev-page">Prev</button>';
		  htm += '  <div class="btn-group dropup">';
		  htm += '    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">';
		  htm += '      <span class="pager_no">Page 1</span>';
		  htm += '      <span class="glyphicon glyphicon-menu-down"></span>';
		  htm += '    </button>';
		  htm += '    <ul class="dropdown-menu" style="max-height: 200px; overflow: auto"">';
		  for(var x =1; x<=total_page; x++){
		    var pgno = x;
		    htm += '    <li><a style="margin-left: 0px;" class="pg_no" href="#" data-value='+pgno+'>Page '+pgno+'</a></li>';
		  }
		  htm += '    </ul>';
		  htm += '  </div>';
		  htm += '  <button type="button" class="btn btn-default next-page">Next</button>';
		  htm += '  <button type="button" class="btn btn-default last-page">Last</button>';
		  htm += '</div></center>';

		  htm += '<select class="form-control pager_number input-sm hidden" style="width: 70px;">';
		  for(var x =1; x<=total_page; x++){
		    var pgno = x;
		    htm += "<option value='" + pgno + "'>" + pgno + "</option>";
		  }
		  htm += '</select>';
		  $(element).html(htm);

		  // console.log(total_page);
		  // if(total_page < 2){
		  //   $(element).hide();
		  // } else {
		  //   $(element).show();
		  // }
	},
	onchange : function(cb){
		$(document).on('change','.pager_number', cb);
	}
}
var offset = 1;
$(document).on('change','.pager_number', function() {
	var page_number = parseInt($(this).val());
	offset = page_number
	$('.pager_no').html("Page " + numeral(page_number).format('0,0'));
});

$(document).on('click','.first-page', function() {
	var page_number = parseInt($('.page_number').val());
	if(page_number!=first()){
		offset = first();
		$('.pager_number').val($('.pager_number option:first').val()).change();;
		$('.pager_no').html("Page " + numeral(first()).format('0,0'));
	}
});


$(document).on('click','.prev-page', function() {
	var page_number = parseInt($('.pager_number').val());
	var prev = page_number -1;
	if(page_number!=first()){
		offset = prev;
		$('.pager_number').val(prev).change();;
		$('.pager_no').html("Page " + numeral(prev).format('0,0'));
	}
});


$(document).on('click','.next-page', function() {
	var page_number = parseInt($('.pager_number').val());
	var next = page_number +1;
	if(page_number!=last()){
		offset = next;
		$('.pager_number').val(next).change();;
		$('.pager_no').html("Page " + numeral(next).format('0,0') );
	}
});


$(document).on('click','.last-page', function() {
	var page_number = parseInt($('.page-number').val());
	if(page_number!=last()){
		offset = last();
		$('.pager_number').val($('.pager_number option:last').val()).change();
		$('.pager_no').html("Page " + numeral(last()).format('0,0'));
	}
});

function first(){
	return parseInt($('.pager_number option:first').val());
}

function last(){
	return parseInt($('.pager_number option:last').val());
}

$(document).on('click', '.pg_no', function(e){
    e.preventDefault();
    var page_no = $(this).attr("data-value");
    $('.pager_number').val(page_no).change()
});


