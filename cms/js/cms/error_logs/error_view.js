$(document).ready(function(){
	get_data();
    $('.date-header').text(moment(date_id).format('LL'));
});

function get_data(){
    var url = content_management + '/error_logs/error_data';
	var data = { date_id: segment_4 };

    modal.loading(true);
	aJax.post(url, data, function(result){
		var obj = is_json(result);
        var html = "";
        var counter = 0;
        if(obj.length > 0){
        	counter = obj.length;
            $.each(obj, function(x,y){
                html += "<tr>";
                    html += "<td>"+counter+"</td>";
                    html += "<td>"+y.level+"</td>";
                    html += "<td>"+y.message+"</td>";
                    html += "<td>"+moment(y.date).format('LTS')+"</td>";
                html += "</tr>";
                counter--;
            });
        }else{
            html = "<tr><td colspan=3 style='text-align: center;'>No records to show.</td></tr>";
        }

        $('.table_body').html(html);
	});
    modal.loading(false);
}

$(document).on('click', '#btn_fetch', function(){
    get_data();
});

$(document).on('click', '#btn_close', function(){
    location.href = content_management + '/error_logs';
});