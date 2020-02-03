<div class="box audit_trail_div">
    <?php   
        $data['buttons'] = ['search','date_range']; // add, save, update
        $this->load->view("content_management/template/buttons", $data);
    ?>  

    <div class="box-body">
        <div class="col-md-12 list-data tbl-content" id="list-data">
             <table class= "table listdata table-striped">
               <thead>
                  <tr>
                        <th>Page</th>
                        <th>User</th>
                        <th>Action</th>

                        <th colspan="2">Date &amp; Time</th>
                    </tr>  
                 </thead>
                <tbody class="table_body">
                    
                </tbody>

             </table>
        </div>
        <!-- PAGINATION -->
        <div class="list_pagination"></div>
    </div>

</div>

<style type="text/css">
    #header { position: fixed; top: 0; background: #fff;}
    body .breadcrumb {        
        border: none;
    }
    #form_search {
        width: 20%;
        display: inline-block;
    }
    .audit_trail_div .form-group.has-feedback {
        margin: 0;
    }

</style>

<script type="text/javascript">
    var query = "";
    var limit = 10;

    $(document).ready(function(){
        get_data();
        get_pagination();
        $("#form_search").removeClass( "pull-right" );

        $(document).on('cut copy paste input', '.start-date, .end-date', function(e) {
            e.preventDefault();
        });

    });

    function get_data()
    {
        modal.loading(true); //show loading
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "list", // list, insert, update, delete
            select : "cms_audit_trail.new_data as data, cms_audit_trail.id as id, cms_audit_trail.url as Url, cms_users.name as Name, cms_audit_trail.action as Action, cms_audit_trail.create_date as Date", //select
            query : query, //query
            offset : offset, // offset or start
            limit : limit, // limit
            table : "cms_audit_trail", // table
            order : {
                field : "cms_audit_trail.create_date", //field to order
                order : "desc" //asc or desc
            },
            join : [
                {
                    table : "cms_users", //table
                    query : "cms_users.id = cms_audit_trail.user_id", //join query
                    type : "LEFT" //type of join
                }
            ]
        }

        //get list
        aJax.post(url,data,function(result){
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            var html ='';
            console.log(obj);

            $.each(obj, function(x,y){
                html += '<tr>';
                var page = y.Url.split("/");
                var bread = '<ul class="breadcrumb">';
                var uri = "<?= base_url('content_management');?>/";
                var lnk;
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

                if(y.data != ""){
                    lnk = '<a class="view_history black" href="#" data-id="'+y.id+'">';
                }else{
                    lnk = '';
                }

                bread += '</ul>';
                
                html += '   <td>'+lnk+bread+'</td>';
                html += '   <td>'+lnk+y.Name+'</td>';
                html += '   <td>'+lnk+y.Action+'</td>';
                html += '   <td>'+lnk+moment(y.Date).format('LLL')+'</td>';
                if(y.data != ""){
                    html += '   <td style="width: 50px;"><a class="view_history" href="#" data-id="'+y.id+'"><i class="fa fa-eye"></i></a></td>';
                } else {
                    html += '   <td style="width: 50px;"></td>';
                }
                
                html += '</tr>';
            })

            $('.table_body').html(html);
            modal.loading(false); //hide loading
        });
    }

    function get_pagination()
    {
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "pagination", // list, insert, update, delete
            select : "cms_audit_trail.new_data as data, cms_audit_trail.id as id, cms_audit_trail.url as Url, cms_users.name as Name, cms_audit_trail.action as Action, cms_audit_trail.create_date as Date", //select
            query : query, //query
            offset : offset, // offset or start
            limit : limit, // limit
            table : "cms_audit_trail", // table
            order : {
                field : "cms_audit_trail.create_date", //field to order
                order : "desc" //asc or desc
            },
            join : [
                {
                    table : "cms_users", //table
                    query : "cms_users.id = cms_audit_trail.user_id", //join query
                    type : "LEFT" //type of join
                }
            ]
        }

        //get list
        aJax.post(url,data,function(result){
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            console.log(obj);
            modal.loading(false);
            pagination.generate(obj.total_page, '.list_pagination', get_data);
        });
    }

    pagination.onchange(function(){
        offset = $(this).val();
        get_data();
    })

    $(document).on('keypress', '#search_query', function(e) {                          
        if (e.keyCode == 13) {
            var keyword = $(this).val()
            query = "cms_audit_trail.url like '%" + keyword + "%' OR cms_users.name like '%" + keyword + "%' OR cms_audit_trail.action like '%" + keyword + "%' OR old_data like '%" + keyword + "%' OR new_data like '%" + keyword + "%'";
            get_data();
            get_pagination();
        }
    });

    $(document).on('click', '.view_history', function(e){
        e.preventDefault();
        modal.loading(true);
        var html = "";
        var html2 = "";
        var data_id = $(this).attr("data-id");
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event : "list", // list, insert, update, delete
            select : "cms_audit_trail.new_data as new_data,cms_audit_trail.old_data as old_data", //select
            query : "id = " + data_id,
            table : "cms_audit_trail"
        }
        aJax.post(url,data,function(result){
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            var obj2 = is_json(obj[0].new_data); //check if result is valid JSON format, Format to JSON if not
            var json = is_json(obj[0].old_data);
            var json2 = Object.keys(is_json(obj[0].new_data));
            var obj3 = is_json(obj[0].old_data);
            var obj = is_json(result); //check if result is valid JSON format, Format to JSON if not
            var obj2 = is_json(obj[0].new_data); //check if result is valid JSON format, Format to JSON if not
            var json = Object.keys(is_json(obj[0].old_data));
            var json2 = Object.keys(is_json(obj[0].new_data));
            var obj3 = is_json(obj[0].old_data);
            console.log(obj2);
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
            } else {
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
        var from = $('.start-date').val();
        var to = $('.end-date').val();
        var keyword = $('.search-query').val();
        $('.start-date').css('border-color','#ccc');
        $('.end-date').css('border-color','#ccc');

        if(from == ''){
          $('.start-date').css('border-color','red');
        }else if(to == ''){
          $('.end-date').css('border-color','red');
        }else if(!keyword == ''){
            query = "cms_audit_trail.url like '%" + keyword + "%' OR cms_users.name like '%" + keyword + "%' OR cms_audit_trail.action like '%" + keyword + "%' OR old_data like '%" + keyword + "%' OR new_data like '%" + keyword + "%'";
              if(from != '' && to != ''){
              query = "DATE(cms_audit_trail.create_date) BETWEEN '" + from + "' AND '" + to + "'";
             }
        }else{
          query = "DATE(cms_audit_trail.create_date) BETWEEN '" + from + "' AND '" + to + "'";
        }

        get_data();
        get_pagination();
    });

   $(document).on('click', '#btn_reset', function(){
        $('.start-date').val('');
        $('.end-date').val('');
        $('.search-query').val('');
        query = "user_id != 0";
        get_data();
        get_pagination();
    });

</script>