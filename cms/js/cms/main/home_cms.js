AJAX.config.base_url(base_url);

var uri = "";
var days = 7;

$(document).ready(function(){
    // $('#breadcrumb').remove();
    // get_urls();
    // get_analytics();

    // $('.collapse').collapse()

    // $('.site_menu_count').text(site_menu_count);
    // $('.cms_menu_count').text(cms_menu_count);
    // $('.installed_packages_count').text(installed_packages_count);
    // $('.audit_trail_count').text(audit_trail_count);
    // $('.users_count').text(users_count);
    // $('.file_count').text(file_count);
    // $('.version_id').text($('#version_patch h2 > b').text());
});

$(document).on('change', '.chart_limit', function(e){
    days = $(this).val();
    // get_analytics();
});

$(document).on('change', '.chart_filter', function(e){
    uri = $(this).val();
    // get_analytics();
});

//get report analytics
// function get_analytics(){
//     var url = global_controller + "/get_analytics" //URL OF CONTROLLER
//     var data = {
//         url : uri,
//         days : days,
//     }

//     aJax.post(url,data,function(result){
//         var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not

//         var line = new Morris.Line({
//             element: 'line-chart',
//             resize: true,
//             data: obj,
//             xkey: 'date',
//             xLabelFormat: function(date) {
//               return moment(date).format("L");
//             },
//             xLabels:'day',
//             ykeys: ['global','unique','daily'],
//             lineColors: ['#3c8dbc','#41b36a','#ffa500'],
//             hideHover: 'auto'
//         });
//     });
// }

//get all urls
function get_urls(){

    AJAX.select.table("site_analytics");
    AJAX.select.select("url");
    AJAX.select.group("url");

    AJAX.select.exec(function(result){
        var obj = result; //check if result is valid JSON format, Format to JSON if not
        var html = '<option value="">Show All</option>';

        $.each(obj, function(x,y){
            html += '<option value="'+y.url+'">'+y.url+'</option>';
        });
        $('.chart_filter').html(html);
    });

}


$('.dashboard-date').text(moment(new Date()).format("LL"));

function real_time_clock(){
    var date = moment(new Date()).format("hh:mm:ss A");
    $('.dashboard-time').text(date);
}

var time = setInterval(real_time_clock,1000);

$('.collapse_btn').on('click', function(){
    if ($(this).html() == "Hide Panels"){
        $(this).html('Show Panels');
    }else{
        $(this).html('Hide Panels');
    }
});

$('.close-panel').on('click', function() {
    $(this).parent().parent().remove();
});