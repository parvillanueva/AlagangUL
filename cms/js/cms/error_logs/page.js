$(document).ready(function(){
    modal.loading(true);
    get_data();
    modal.loading(false);

    if(no_log){
        modal.alert(no_log);
    }
});

function get_data(){
    modal.loading(true);
    aJax.get(content_management+'/error_logs/get_error_log_files', function(result){
        var obj = is_json(result);
        var html = "";

        if(obj.length > 0){
            $.each(obj, function(x,y){
                html += "<tr>";
                    html += "<td>"+y.filename+"</td>";
                    html += "<td>"+y.date+"</td>";
                    html += "<td>"+y.lines+"</td>";
                    html += "<td><a href='"+content_management+"/error_logs/log/"+y.date_id+"' class='edit'><span class='fa fa-eye'></span></td>";
                html += "</tr>";
            });
        }else{
            html = "<tr><td colspan=3 style='text-align: center;'>No records to show.</td></tr>";
        }

        $('.table_body').html(html);
    });
    modal.loading(false);
}