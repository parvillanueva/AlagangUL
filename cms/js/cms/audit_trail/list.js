AJAX.config.base_url(base_url);

var limit = 10;
var offset = 1;

$(document).ready(function(){
    get_data();
	//$(".table").addSortWidget();
    $("#form_search").removeClass( "pull-right" );
	record_number();
});

$(document).on('cut copy paste input', '.start-date, .end-date', function(e) {
    e.preventDefault();
});

function get_data(keyword, filter=false){

    $('.num-record').empty();
    modal.loading(true); //show loading

    AJAX.select.table("cms_audit_trail");
    AJAX.select.select("cms_audit_trail.new_data as data, cms_audit_trail.id as id, cms_audit_trail.url as Url, cms_users.name as Name, cms_audit_trail.action as Action, cms_audit_trail.create_date as Date");
    AJAX.select.offset(offset);
    AJAX.select.limit(limit);
    AJAX.select.order.desc("cms_audit_trail.create_date");
    AJAX.select.join.left("cms_users", "cms_users.id", "cms_audit_trail.user_id");
		//if(froms && to){
            //AJAX.select.where.greater_equal("DATE(cms_audit_trail.create_date)", from);
            //AJAX.select.where.less_equal("DATE(cms_audit_trail.create_date)", to);
			//AJAX.select.query("cms_audit_trail.create_date BETWEEN '"+froms+" 00:00' AND '"+to+" 23:59'");
       // }
		var session_data = session_filter();
		var search_query = '';
		var session_include = ' AND '+session_data;
		if(session_data == ''){
			session_include = '';
		}
		var filter_query = session_data;
	    var search = $('#search_query').val();
		var search_trim = $.trim(search);
		var search_val = '';
		if(search_trim != ''){
			search_query = "(cms_audit_trail.url like '%"+$.trim(search_trim)+"%' OR cms_users.name like '%"+$.trim(search_trim)+"%' OR cms_audit_trail.action like '%"+$.trim(search_trim)+"%')";
		}
		
		var start_date = $('.start-date').val();
		var sd_trim = $.trim(start_date);
		var end_date = $('.end-date').val();
		var ed_trim = $.trim(end_date);
		if(sd_trim != '' && ed_trim != ''){
			filter_query = "cms_audit_trail.create_date BETWEEN '"+sd_trim+" 00:00' AND '"+ed_trim+" 23:59'";
		}
		
        
		if(keyword){
			if(sd_trim != '' && ed_trim != ''){				
				AJAX.select.query(filter_query+' AND ' + search_query + session_include);
			} else{
				AJAX.select.query(search_query + session_include);
			}
        }
		
		if(filter ==true){
			if(search_trim != ''){
				if(sd_trim != '' && ed_trim != ''){			
					AJAX.select.query(filter_query+' AND '+search_query + session_include);
				} else{

					AJAX.select.query(search_query+session_include);
				}
			} else{
				AJAX.select.query(filter_query + session_include);
			}
		} else{
			if(keyword){
				if(sd_trim != '' && ed_trim != ''){				
					AJAX.select.query(filter_query+' AND ' + search_query + session_include);
				} else{
					AJAX.select.query(search_query + session_include);
				}
			} else{
				AJAX.select.query(filter_query);
			}
		}
		
		
      

    AJAX.select.exec(function(result){
        var obj = result; //check if result is valid JSON format, Format to JSON if not
        var html ='';
        if(obj.length > 0){
            $.each(obj, function(x,y){
                html += '<tr>';
                var page = y.Url.split("/");
                var bread = '<ul class="breadcrumb">';
                var uri = content_management;

                var count = 0;
                $.each(page, function(x,y){
                    count ++;
                    if(count < 3){
                        if(count == 1){
                            bread += '<li>'+y+'</li>';
                        } else {
                            bread += '<li>'+y+'</li>';
                        }
                    }
                });

                bread += '</ul>';
                html += '   <td>'+bread+'</td>';
                html += '   <td>'+y.Name+'</td>';
                html += '   <td>'+y.Action+'</td>';
                html += '   <td>'+moment(y.Date).format('LLL')+'</td>';
                if(y.data != ""){
                    html += '   <td style="width: 50px;"><a class="view_history" href="#" data-id="'+y.id+'"><i class="fa fa-eye"></i></a></td>';
                } else {
                    html += '   <td style="width: 50px;"></td>';
                }
                
                html += '</tr>';
            });
        }else{
                html = '<tr><td colspan=12 style="text-align: center;"><b>No records to show!</b></td></tr>';
            }   
        $('.table_body').html(html);
        modal.loading(false); //hide loading
    }, function(obj){
		$('.total-record').html('of '+obj.total_record);
        pagination.generate(obj.total_page, ".list_pagination", limit, 'table_body', 4);
       });

        
}

function session_filter(){
	var session_output = '';
	switch(session_user_id){
		case '1':
			session_output = '';
		break;
		default:
			session_output = 'user_id='+session_user_id;
	}
	return session_output;
}


function record_number() {
	setInterval(function(){
		var tbody = $('.table_body tr');
		var texts = tbody.text();
		if(texts == "No records to show!"){
			$('.num-record').html('0');
		}else{	
		$('.num-record').html(tbody.length);
		}
	}, 10);
}

$(document).on('click', '.view_history', function(e){
    e.preventDefault();
    modal.loading(true);
    var html = "";
    var html2 = "";
    var data_id = $(this).attr("data-id");

    AJAX.select.table("cms_audit_trail");
    AJAX.select.select("cms_audit_trail.new_data as new_data,cms_audit_trail.old_data as old_data");
    AJAX.select.where.equal("id", data_id);

    AJAX.select.exec(function(result){
        var obj = result; //check if result is valid JSON format, Format to JSON if not
        var obj2 = is_json(obj[0].new_data); //check if result is valid JSON format, Format to JSON if not
        var json = is_json(obj[0].old_data);
        var json2 = Object.keys(is_json(obj[0].new_data));
        var obj3 = is_json(obj[0].old_data);
        var obj = result; //check if result is valid JSON format, Format to JSON if not
        var obj2 = is_json(obj[0].new_data); //check if result is valid JSON format, Format to JSON if not
        var json = Object.keys(is_json(obj[0].old_data));
        var json2 = Object.keys(is_json(obj[0].new_data));
        var obj3 = is_json(obj[0].old_data);
        //new data
        html += '<table class="col-md-6 table table-bordered" style="margin-top: 20px;">';
        html += '<tbody>';
        html += '<tr id="header">';
        html += '<td style="width: 100px; background-color: #222d32; color: #fff; text-align:center;">Field</td>';
        html += '<td style="width: 370px; background-color: #222d32; color: #fff; text-align:center;">Old Data</td>';
        html += '<td style="width: 370px; background-color: #222d32; color: #fff; text-align:center;">New Data</td>';
        html += '</tr>';
        
        if(obj3[0]){
            $.each(obj3[0], function(x,y){
                html += '<tr>';
                html += '<td style="width: 100px; background-color: #222d32; color: #fff; text-align:center;">' + x + '</td>';
                html += '<td style="width: 370px;">' + y + '</td>';
                if(json2.indexOf(x) > -1){
                    if(obj2[x] != y){
                        html += '<td style="background-color: #c7cdfa;">'+ obj2[x] +'</td>';
                    } else {
                        html += '<td>'+ obj2[x] +'</td>';     
                    }
                    
                } else {
                    html += '<td>'+y+'</td>';
                }
                html += '</tr>';
            });
        }else{
            var json_new_data = is_json(obj[0].new_data);
            $.each(json_new_data, function(x,y){
                html += '<tr>';
                html += '<td style="width: 100px; background-color: #222d32; color: #fff; text-align:center;">' + x + '</td>';
                html += '<td style="width: 370px; background-color: #fbe7eb;">No Data</td>';
                html += '<td style="width: 370px; background-color: #c7cdfa;">' + y + '</td>';
                html += '</tr>';
            });
        }
        
        modal.loading(false);
        modal.show('<div style="overflow-y: scroll; max-height: 500px;">' + html + '</div>',"large",function(){});
    });
});

$(document).on('click', '#btn_filter', function(){
    var froms = $('.start-date').val();
    var to = $('.end-date').val();
    var keyword = $('.search-query').val();
    $('.start-date').css('border-color','#ccc');
    $('.end-date').css('border-color','#ccc');

    if(froms == ''){
        $('.start-date').css('border-color','red');
    }else if(to == ''){
        $('.end-date').css('border-color','red');
    }else if(keyword == ''){
		keyword = '';
    }

    get_data(keyword, true);
});

$(document).on('click', '#btn_reset', function(){
    $('.start-date').val('');
    $('.end-date').val('');
    $('.search-query').val('');
    AJAX.select.where.not("user_id", 0);
    get_data();
});