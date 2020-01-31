
var crud_result = null;
var crud_result_all = null;
var crud_limit = 10
var crud_head = null;
var crud_offset = null;
var crud_max = 0;
var crud_values = null;

//return if json
function Json(str) {
    try {
        return JSON.parse($.trim(str));
    } catch (e) {
        return $.trim(str)
    }
} 

var CRUD_Table = function() {
  this.url = '';
  this.data = '';
  this.header = '';
  this.element = '';
  this.default_values = '';
  this.limit = 10;

  this.result = "";
};

CRUD_Table.prototype.set_url = function(data) {
	this.url = data;
}


CRUD_Table.prototype.set_data = function(data) {
  	
  	data['query'] = "status > 0";
  	this.data = data;
};


CRUD_Table.prototype.set_header = function(data) {
  	this.header = data;
};

CRUD_Table.prototype.set_values = function(data) {
  	crud_values = data;
};


CRUD_Table.prototype.init = function(element = null) {
	modal.loading(true);
	var head = this.header;
	crud_head = this.header;
	var limit = this.limit;
	if(element != null){
		this.element = element;
	}
	var header_count = 2;
	$.each(head, function(x,y){
    	header_count ++;
    });
    var obj = null;
	$.ajax({
      	async: false,
      	cache: false,
      	type: 'POST',
      	url:this.url,
      	data:this.data,
      	success: function(result){
      		obj = Json(result);
      		crud_result_all	 = obj;
      		crud_result	 = obj;
      		crud_max = obj.length;
      		var html = '';
			html += '<table class= "table listdata table-striped">';
		    html += '	<thead>';

		    //search
		    html += '		<tr style="background: #fff;">';
		    html += '			<th colspan=' + header_count + '>';
		    html += '				<div class="input-group pull-right">';
	    	html += '  					<input type="text" id="crud_search_keyword" class="form-control" placeholder="Search for...">';
	    	html += '  					<span class="input-group-btn">';
	    	html += '    					<button class="btn btn-default" type="button" id="crud_search_go">Search</button>';
	    	html += '    					<button class="btn btn-warning" type="button" id="crud_reset_go">Reset</button>';
	    	html += '  					</span>';
	    	html += '				</div>';
		    html += '				<div class="">';
	    	html += '    				<button class="btn btn-info crud_status" type="button" data-status=1 style="display: none;"><span class="fa fa-check"></span> Publish</button>';
	    	html += '    				<button class="btn btn-warning crud_status" type="button" data-status=0 style="display: none;"><span class="fa fa-ban"></span> Unpublish</button>';
	    	html += '    				<button class="btn btn-danger crud_status" type="button" data-status=-2 style="display: none;"><span class="fa fa-trash"></span> Trash</button>';
	    	html += '				</div>';
		    html += '			</th>';
		    html += '       </tr>  ';

		    //header
		    html += '		<tr>';
		    html += '			<th><input id="crud_select_all" type ="checkbox"></th>';
		    $.each(head, function(x,y){
		    	html += '       <th>' + y.toUpperCase() + '</th>';
		    });
		     html += '			<th style="width:50px; text-align: right;">ACTION</th>';
		    html += '       </tr>  ';
		    html += '	</thead>';

		    //body
		    html += '	<tbody class="crud_table_body">';
		    
		    html +=	'	</tbody>';

		    //pagination
		    html += '	<thead>';
		    html += '		<tr>';
		    html += '			<th colspan=' + header_count + '>';
		    html += '			<span class="pull-right">';
		    html += '					<a style="background: #fff; color : #222d32;" class="btn btn-default" id="crud_frst_button" href="#"><span class="fa fa-angle-double-left"></span></a>';
		    html += '					<a style="background: #fff; color : #222d32;" class="btn btn-default" id="crud_prev_button" href="#"><span class="fa fa-angle-left"></span></a>';
		    html += '					<a style="background: #fff; color : #222d32;" class="btn btn-default" id="crud_nxt_button" href="#"><span class="fa fa-angle-right"></span></a>';
		    html += '					<a style="background: #fff; color : #222d32;" class="btn btn-default" id="crud_last_button" href="#"><span class="fa fa-angle-double-right"></span></a>';
		    html += '			</span>';
		    html += '			<select class="form-control" style="color: #000; max-width: 80px;" id="crud_limit">';
		    html += '				<option value=10>10</option>';
		    html += '				<option value=15>15</option>';
		    html += '				<option value=20>20</option>';
		    html += '				<option value=30>30</option>';
		    html += '				<option value=40>40</option>';
		    html += '				<option value=50>50</option>';
		    html += '			</select>';
		    html += '			</th>';
		    html += '       </tr>  ';
		    html += '	</thead>';
		  	html += '	</table>';

		  	$(element).html(html);

		  	table_body(obj);

      	}
    });

    this.result = obj;
};

function table_body(obj = null)
{
	if(obj != null){
		crud_result = obj;
	}

	var no_result_span = 0;
	$.each(crud_head, function(x,y){
		no_result_span++;
	});

	if(crud_result.length > 0){
		var data = crud_result.slice(crud_offset, crud_offset + crud_limit);
		var html = '';
		$.each(data, function(x,y){
	    	html += '		<tr>';
	    	html += '			<td><input class="crud_select" data-id='+y.id+' type="checkbox"></td>';
	    	$.each(crud_head, function(a,b){
	    		var value_return = "";
	    		switch(a.toLowerCase()) {
				    case "status":
				        $.each(crud_values[a][0], function(k,l){
    						if(l == y[a]){
    							value_return = k;
    						}
    					});
				        break;
				    case "update_date":
				        value_return = moment(y[a]).format(crud_values[a]);
				        break;
				    case "create_date":
				        value_return = moment(y[a]).format(crud_values[a]);
				        break;
				    default:
				    	if(crud_values[a]){
				    		value_return = "<img src='" + crud_values[a][0]['base_url'] + y[a] + "' style='width:" + crud_values[a][0]['width'] + "px;' />";
				    	} else {
				    		value_return = y[a];
				    	}
				        
				}
	    		html += '       <td>' + value_return + '</td>';
	    	});
	    	html += '			<td style="width:50px; text-align: right;"><a class="btn btn-default" data-id=' + y.id + ' href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>';
	    	html += '		</tr>';
	    });
	} else {
    	html += '		<tr>';
    	html += '			<td colspan='+(no_result_span + 2)+' style="text-align:center;">No Record Found!</td>';
    	html += '		</tr>';
	}
	
    $(".crud_table_body").html(html);
    modal.loading(false);
}

function trimString(s) {
  var l=0, r=s.length -1;
  while(l < s.length && s[l] == ' ') l++;
  while(r > l && s[r] == ' ') r-=1;
  return s.substring(l, r+1);
}

function compareObjects(o1, o2) {
  var k = '';
  for(k in o1) if(o1[k] != o2[k]) return false;
  for(k in o2) if(o1[k] != o2[k]) return false;
  return true;
}

function itemExists(haystack, needle) {
  for(var i=0; i<haystack.length; i++) if(compareObjects(haystack[i], needle)) return true;
  return false;
}

function getObjects(objects, keyword) {
    var results = [];
    var found = 0;
    toSearch = trimString(keyword); // trim it
	for(var i=0; i<objects.length; i++) {
		for(var key in objects[i]) {
  			if(objects[i][key].toLowerCase().indexOf(toSearch)!=-1) {
  				found ++ ;
	    		if(!itemExists(results, objects[i])) results.push(objects[i]);
	  		}
		}
    }
    return results;
}


$(document).on('click', '#crud_search_go', function(){
	var keyword = $("#crud_search_keyword").val();
	crud_result	 = crud_result_all;
	var result = getObjects(crud_result, keyword);
	crud_result = result;
	crud_offset = 0;
	table_body();
});

$(document).on('click', '#crud_reset_go', function(){
	crud_result = crud_result_all;
	crud_offset = 0;
	table_body();
});


$(document).on('change', '#crud_limit', function(){
	crud_limit = $(this).val();
	crud_offset = 0;
	table_body();
});

$(document).on('click', '#crud_nxt_button', function(e){
	e.preventDefault();
	if(crud_max < crud_limit){
		crud_offset = 0;
		table_body();
	} else {
		var maxx = (Math.ceil(crud_max / crud_limit) - 2) + crud_limit;
		if(maxx != crud_offset){
			crud_offset = crud_offset + crud_limit;
			table_body();
		}
	}
});

$(document).on('click', '#crud_prev_button', function(e){
	e.preventDefault();
	if(crud_offset > 0){
		crud_offset = crud_offset - crud_limit;
		table_body();
	}
});

$(document).on('click', '#crud_frst_button', function(e){
	e.preventDefault();
	crud_offset = 0;
	table_body();
});
$(document).on('click', '#crud_last_button', function(e){
	e.preventDefault();
	if(crud_max < crud_limit){
		crud_offset = 0;
	} else {
		crud_offset = (Math.ceil(crud_max / crud_limit) - 2) + crud_limit;
	}
	table_body();
});

$(document).on('change', '#crud_select_all', function(){
  	var del = 0;
    if(this.checked) { 
    	$('.crud_select').each(function() { 
        	this.checked = true;     
        	$(".crud_status").show();     
    	});
    } else {
    	$('.crud_select').each(function() { 
      		this.checked = false;    
      		$(".crud_status").hide();             
    	});         
  	}
});

$(document).on('change', '.crud_select', function(){
    var x = 0;
    var rec_display_count = $('.crud_select').length
    $('.crud_select').each(function() {  
     	var ischecked =  $(this).is(":checked");
        if (this.checked==true) { x++; } 

        if(x > 0){
        	//display status button
        	$(".crud_status").show();
        } else {
        	//hide status button
        	$(".crud_status").hide();
        }

        if(x < rec_display_count){
        	$("#crud_select_all").attr('checked', false);
        } else {
        	$("#crud_select_all").attr('checked', true);
        }
    });
});
