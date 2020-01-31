window.onload = function(){
	var tableCont = document.querySelector('.tbl-content');
	
	function scrollHandle (e){
		var scrollTop = this.scrollTop;
		this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';
	}

	if(tableCont){
		tableCont.addEventListener('scroll', scrollHandle);
	}
}


/*** checking internet and database connection ***/

/*var click_return = true;
$(document).on('click','a',function(event){
	checkConnections();
	return click_return;
});

$(document).on('click','button',function(event){
    checkConnections();
	return click_return;
});

function checkConnections(callback){
	$("#loading_div_standard").show();
	$.ajax(
		{
			url: "<?= base_url();?>", 
			async: false,
			success: function(data, textStatus, jqXHR){
				$("#loading_div_standard").hide();
        		click_return = true;
    		},
    		error: function(XMLHttpRequest, textStatus, errorThrown) {
				$("#loading_div_standard").hide();
		        if (XMLHttpRequest.readyState == 4) {
		            // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
		            modal.alert('<h4><center><i class="fa fa-database fa-2x"></i><br><br>Something went wrong and we couldnt complete your request.</center></h4>');
		            click_return = false;
		        }
		        else if (XMLHttpRequest.readyState == 0) {
		            // Network error (i.e. connection refused, access denied due to CORS, etc.)
		            modal.alert('<h4><center><i class="fa fa-wifi fa-2x"></i><br><br>Cannot connect, Please check your internet connection.</center></h4>');
		            click_return = false;
		        } else {
		        	return false;
		        }
		    }
		}
	);
};*/
