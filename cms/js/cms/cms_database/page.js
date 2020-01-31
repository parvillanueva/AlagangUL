$(document).on('click', '#btn_add', function(e){
    $("#add_field").modal("show");
});

$(document).on('click', '#table_add', function(e){
    if(validate.required('.req') == 0){
        var html = '';
        html +='<tr>';
        html +='  <td><input class="form-control" type="text" readonly id="field" name="field[]" value="'+$('#insert_name').val()+'"/></td>';
        html +='  <td><input class="form-control" type="text" readonly id="type" name="type[]" value="'+$('#insert_type').val()+'"/></td>';
        html +='  <td><input class="form-control" type="text" readonly id="length" name="length[]" value="'+$('#insert_length').val()+'"/></td>';
        html +='  <td><input class="form-control" type="text" readonly id="null" name="null[]" value="'+$('#insert_null').val()+'"/></td>';
        html +='  <td style="width: 50px;"><a class="btn btn-danger btn-remove-field" href="#"><span class="fa fa-times"></span></a></td>';
        html +='</tr>';
        $(".table_body").append(html);
        $('#insert_name').val("");
        $('#insert_length').val("");
        $("#add_field").modal("hide");
    }
});

$(document).on('click', '.btn-remove-field', function(e){
    var element = $(this);
    modal.confirm("Are you sure you want to remove this field?",function(result){
        if(result){
            element.parents('tr').remove();
        }
    });
});

$(document).on('click', '#btn_save', function(e){
    if(validate.required('.reqq') == 0){
        modal.confirm("Are you sure you want to save this table?",function(result){
            if(result){
                var rwos = {};
                var row_count = $('.table_body  > tr').length;
                var row_current = 0;

                $('.table_body  > tr').each(function(){
                    row_current ++;
                    var field_name = $(this).find("#field").val();
                    var field_type = $(this).find("#type").val();
                    var field_length = $(this).find("#length").val();
                    var field_null = $(this).find("#null").val();
                    var obj = {};
                    obj['type'] =  field_type;
                    obj['constraint'] = field_length;
                    //obj['null'] = field_null;
                    if(field_name == "id"){
                        obj['unsigned'] = 1;
                        obj['auto_increment'] = 1;
                    }
                    rwos[field_name] = obj;
                });

                if(row_current == row_count){
                    var url = content_management + "/preference/create_table";
                    /* var data = {
                      "fields" : $('.table_body :input').serialize(), 
                      "table_name" : "site_" + $("#table_name").val(), 
                    }*/
                    var serialize_data = $('.table_body :input').serialize();
                    var table_name = "site_" + $("#table_name").val();

                    aJax.post(url,serialize_data+'&table_name='+table_name+'&rowCount='+row_count,function(result){
                        modal.alert("Database Table Saved", function(){
                            location.reload();
                        });
                    });
                }
            }
        }); 
    }
});