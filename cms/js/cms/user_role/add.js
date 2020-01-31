AJAX.config.base_url(base_url);

var counter = 0;

$(document).ready(function(){
    $('#status [value="1"]').prop('selected', true);
    get_data();
});

function get_data(){

    if(role == 7){
        AJAX.select.where.equal("menu_level", "1");
        AJAX.select.where.equal("menu_status", "1");
    }else{
        AJAX.select.where.equal("menu_level", "1");
        AJAX.select.where.equal("menu_status", "1");
        AJAX.select.where.not("id", 8);
        AJAX.select.where.not("id", 6);
    } 

    AJAX.select.table("cms_menu");
    AJAX.select.select("id,menu_name,menu_type,menu_parent_id,menu_level,menu_status,menu_orders");
    AJAX.select.order.asc("menu_orders");

    AJAX.select.exec(function(result){
        var obj = result;
        var htm = '';
   
        if(obj.length > 0){  
            $.each(obj,function(x,y){
                htm += "<ul class='parent_menu'>";
                    if(y.menu_level == 1){
                        htm += "<li class='main_menu_"+y.id+"'>";
                        htm += "<div class='menu_title'><input type='hidden' class='menu_id_"+counter+"' data-id="+y.id+"><span>"+y.menu_name+"</span></div>"; 
                        htm += "<div class='menu_chkbx'><input class='chckbx_menu  read_"+counter+" chckbx_menu_read parent_chckbox_read_"+y.id+"' type = 'checkbox'  name='menu_role_read' data-id="+y.id+" value='0' onchange='chckbox_parent_menu("+y.id+")'></div>";
                        htm += "<div class='menu_chkbx'><input class='chckbx_menu write_"+counter+" chckbx_menu_write parent_chckbox_write_"+y.id+"' name='menu_role_write' type = 'checkbox' data-id="+y.id+" value='0' onchange='chckbox_parent_menu("+y.id+")'></div>";
                        htm += "<div class='menu_chkbx'><input class='chckbx_menu delete_"+counter+" chckbx_menu_delete parent_chckbox_delete_"+y.id+"' name='menu_role_delete' type = 'checkbox' data-id="+y.id+" value='0' onchange='chckbox_parent_menu("+y.id+")'></div>";
                        htm += "</li>";
                        get_sub_menu(y.id);
                    }
                htm += "</ul>";
                counter++;
            });
        }else{
            htm += '    <ul>';
            htm += '        <li style="text-align: center;">No Results Found.</li>';
            htm += '    </ul>';
        }
        $('.module_body_container').html(htm);
    });
}


function get_sub_menu(id){

    if(role == 7){
        AJAX.select.where.equal("menu_parent_id", id);
        AJAX.select.where.equal("menu_level", "2");
        AJAX.select.where.equal("menu_status", "1");

    }else{
       AJAX.select.where.equal("menu_parent_id", id);
        AJAX.select.where.equal("menu_status", "1");
        AJAX.select.where.not("id", "14");
        AJAX.select.where.not("id", "15");
        AJAX.select.where.not("id", "22");
    } 

    AJAX.select.table("cms_menu");
    AJAX.select.select("id,menu_name,menu_type,menu_parent_id,menu_level,menu_status,menu_orders");
    AJAX.select.order.asc("menu_orders");
    AJAX.select.exec(function(result){
        var obj = result;
        var htm = '';
        if(obj.length > 0){
            $.each(obj,function(a,b){
                htm += "<ul class='child_menu'>";
                    if(b.menu_level == 2){
                        htm += "<li class='sub_menu_"+b.id+"'>";
                        htm += "<div class='sub_menu_title'><input type='hidden' class='menu_id_"+counter+"' data-id="+b.id+"><span>"+b.menu_name+"</span></div>";
                        htm += "<div class='sub_menu_chkbx'><input class='chckbx_menu read_"+counter+" chckbx_menu_read sub_checker_read_"+id+" sub_chckbox_read_"+counter+"' name='menu_role_read' type = 'checkbox' data-id="+b.id+" value='0' onchange='chckbox_sub_menu("+counter+","+id+")'></div>";
                        htm += "<div class='sub_menu_chkbx'><input class='chckbx_menu write_"+counter+" chckbx_menu_write sub_checker_write_"+id+" sub_chckbox_write_"+counter+"' name='menu_role_write' type = 'checkbox' data-id="+b.id+" value='0' onchange='chckbox_sub_menu("+counter+","+id+")'></div>";
                        htm += "<div class='sub_menu_chkbx'><input class='chckbx_menu delete_"+counter+" chckbx_menu_delete sub_checker_delete_"+id+" sub_chckbox_delete_"+counter+"' name='menu_role_delete' type = 'checkbox' data-id="+b.id+" value='0' onchange='chckbox_sub_menu("+counter+","+id+")'></div>";
                        htm += "</li>";
                    }
                htm += "</ul>";
                counter++; 
            });
            $(htm).insertAfter($('.main_menu_'+id+''));
        }
    });
}

//Set Value of checkbox
$(document).on('change', '.chckbx_menu', function(){
    if(this.checked==true){ 
        $(this).val(1);
    }else{
        $(this).val(0);
    }

    //Select all Read
    var read_checkbox_count = $('input[name="menu_role_read"]').length;
    var read_checked_checkboxes_count = $('input[name="menu_role_read"]:checked').length;
    if(read_checkbox_count == read_checked_checkboxes_count){
        $(".select_all_read").prop("checked", true);
    }else{
        $(".select_all_read").prop("checked", false);
    }

    //Select all Write
    var write_checkbox_count = $('input[name="menu_role_write"]').length;
    var write_checked_checkboxes_count = $('input[name="menu_role_write"]:checked').length;
    if(write_checkbox_count == write_checked_checkboxes_count){
        $(".select_all_write").prop("checked", true);
    }else{
        $(".select_all_write").prop("checked", false);
        $('.select_all_read').attr('disabled',false);
    }

    //Select all Delete
    var delete_checkbox_count = $('input[name="menu_role_delete"]').length;
    var delete_checked_checkboxes_count = $('input[name="menu_role_delete"]:checked').length;
    if(delete_checkbox_count == delete_checked_checkboxes_count){
        $(".select_all_delete").prop("checked", true);
    }else{
        $(".select_all_delete").prop("checked", false);
        $('.select_all_read').attr('disabled',false);
    }   

});


function chckbox_sub_menu(count_id,id){
    //check parent menu read column
    if($('input.sub_chckbox_read_'+count_id+'').is(':checked')){
        $('.parent_chckbox_read_'+id+'').prop("checked", true).val(1);
    }

    //check parent menu read column if write and delete is checked
    if (($('input.sub_chckbox_write_'+count_id+'').is(':checked'))) {
        $('.sub_chckbox_read_'+count_id+'').prop("checked", true).attr('disabled',true).val(1);
        $('.parent_chckbox_read_'+id+'').prop("checked", true).attr('disabled',true).val(1);
        $('.parent_chckbox_write_'+id+'').prop("checked", true).val(1);
    }else{
        $('.sub_chckbox_read_'+count_id+'').attr('disabled',false);
        $('.parent_chckbox_read_'+id+'').attr('disabled',false);
    }

    //check parent menu read column if write and delete is checked
    if(($('input.sub_chckbox_delete_'+count_id+'').is(':checked'))){
        $('.sub_chckbox_read_'+count_id+'').prop("checked", true).attr('disabled',true).val(1);
        $('.parent_chckbox_read_'+id+'').prop("checked", true).attr('disabled',true).val(1);
        $('.parent_chckbox_delete_'+id+'').prop("checked", true).val(1);
    }else{
        $('.sub_chckbox_read_'+count_id+'').attr('disabled',false);
        $('.parent_chckbox_read_'+id+'').attr('disabled',false);
    }

    /// Unchecked parent menu  if all sub menu value is 0 
    if(($('.sub_checker_read_'+id+':checked').length) == 0){
        $('.parent_chckbox_read_'+id+'').prop("checked", false).val(0);
    }

    /// Unchecked parent menu  if all sub menu value is 0 
    if(($('.sub_checker_write_'+id+':checked').length) == 0){
        $('.parent_chckbox_write_'+id+'').prop("checked", false).val(0);
    }
  
    if(($('.sub_checker_delete_'+id+':checked').length) == 0){
        $('.parent_chckbox_delete_'+id+'').prop("checked", false).val(0);
    }
}



function chckbox_parent_menu(id){
    if(($('input.parent_chckbox_read_'+id+'').is(':checked'))){
        $('.sub_checker_read_'+id+'').prop("checked", true).val(1);
    }else{
        $('.sub_checker_read_'+id+'').prop("checked", false).val(0);
    }

    //check  read column if write  is checked
    if(($('input.parent_chckbox_write_'+id+'').is(':checked'))){
        $('.sub_checker_write_'+id+'').prop("checked", true).val(1);
        $('.parent_chckbox_read_'+id+'').prop("checked", true).val(1);
        $('.sub_checker_read_'+id+'').prop("checked", true).attr('disabled',true).val(1);    
    }else{
        $('.sub_checker_write_'+id+'').prop("checked", false).val(0);
        $('.parent_chckbox_read_'+id+'').attr('disabled',false);
        $('.sub_checker_read_'+id+'').attr('disabled',false);
    }

    if(($('input.parent_chckbox_delete_'+id+'').is(':checked'))){
        $('.sub_checker_delete_'+id+'').prop("checked", true).val(1);
        $('.parent_chckbox_read_'+id+'').prop("checked", true).val(1);
        $('.sub_checker_read_'+id+'').prop("checked", true).attr('disabled',true).val(1);    
    }else{
        $('.sub_checker_delete_'+id+'').prop("checked", false).val(0);
        $('.parent_chckbox_read_'+id+'').attr('disabled',false);
        $('.sub_checker_read_'+id+'').attr('disabled',false);
    }
}

//Select all function for Read
$(document).on('change', '.select_all_read', function(){
    if(this.checked) { 
        $('.chckbx_menu_read').each(function() { 
            this.checked = true; 
            this.value = 1;      
        });
    }else{
        $('.chckbx_menu_read').each(function() { 
            this.checked = false; 
            this.value = 0;                
        });      
    }
});

//Select all function for write
$(document).on('change', '.select_all_write', function(){
    if(this.checked){ 
        $('.chckbx_menu_write').each(function(){ 
            this.checked = true; 
            this.value = 1; 
            $('.chckbx_menu_read').each(function(){ 
                this.checked = true; 
                this.value = 1;     
            });
            $('.select_all_read').prop("checked", true);  
            $('.select_all_read').attr('disabled',true);
            $('.chckbx_menu_read').attr('disabled',true);  
        });
    }else{
        $('.chckbx_menu_write').each(function(){ 
            this.checked = false; 
            this.value = 0;                
        });   
        $('.select_all_read').attr('disabled',false);
        $('.chckbx_menu_read').attr('disabled',false);      
    }
});

//Select all function for delete
$(document).on('change', '.select_all_delete', function(){
    if(this.checked){ 
        $('.chckbx_menu_delete').each(function(){ 
            this.checked = true; 
            this.value = 1; 
            $('.chckbx_menu_read').each(function(){ 
                this.checked = true; 
                this.value = 1;     
            });
            $('.select_all_read').prop("checked", true);  
            $('.select_all_read').attr('disabled',true);
            $('.chckbx_menu_read').attr('disabled',true);  
        });
    }else{
        $('.chckbx_menu_delete').each(function(){ 
            this.checked = false; 
            this.value = 0;                
        });    
        $('.select_all_read').attr('disabled',false);
        $('.chckbx_menu_read').attr('disabled',false);      
    }
});

function save_role_module(role_id){
    for(var i = 0; i < counter; i++){

        AJAX.insert.table("cms_menu_roles");
        AJAX.insert.params("role_id", role_id);
        AJAX.insert.params("menu_id", $('.menu_id_'+i+'').attr('data-id'));
        AJAX.insert.params("menu_role_read", $('.read_'+i+'').val());
        AJAX.insert.params("menu_role_write", $('.write_'+i+'').val());
        AJAX.insert.params("menu_role_delete", $('.delete_'+i+'').val());
        AJAX.insert.params("menu_role_updated_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));
        AJAX.insert.params("menu_role_created_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

        AJAX.insert.exec(function(result){
        //aJax.post(url ,data ,function(result){
            modal.loading(false);
            modal.alert(add_success, function(){
                location.href = implode_urls;
            });
        });
    }
    
}


$(document).on('click', '#btn_save', function(){  

    var name = $('#name').val();
    var name_escaped = encode_Html(name);

    if(validate.standard(id_inputs)){
        var modal_obj = confirm_add; 
        modal.standard(modal_obj, function(result){
            if(result){
                modal.loading(true);
                var url = content_management + "/user_role/save_role"; 
                var data = {
                    table : "cms_user_roles", 
                    data : {
                        name : name_escaped,
                        status : $('#status').val(),
                        create_date :  moment(new Date()).format('YYYY-MM-DD HH:mm:ss'),
                        update_date :  moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                    }  
                }

                aJax.post(url,data,function(result){ 
                    var obj = is_json(result);          
                    save_role_module(obj);
                    $('.btn-primary').attr("disabled", true);
                });
            }
        });
    }
}); 