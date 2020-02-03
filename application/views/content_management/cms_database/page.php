<div class="box">
  <?php
    $data['buttons'] = ['add', 'save']; // add, save, update
    $this->load->view("content_management/template/buttons", $data);
  ?> 
 	<div class="box-body">  
 		<div class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">Table Name</label>
        <div class="col-sm-5">
          <div class="input-group"> 
            <span class="input-group-addon">site_</span>
            <input id="table_name" class="form-control reqq" placeholder="Table Name">
          </div>
        </div>
    </div>
 	</div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="width: 350px;">Field Name</th>
        <th style="width: 350px;">Type</th>
        <th style="width: 150px;">Length</th>
        <th style="width: 150px;" colspan="2">Allow Null</th>
      </tr>
    </thead>
    <tbody class="table_body">
      <tr>
        <td><input class="form-control" type="text" readonly id="field" name="field[]" value="id"/></td>
        <td><input class="form-control" type="text" readonly id="type" name="type[]" value="INT"/></td>
        <td><input class="form-control" type="text" readonly id="length" name="length[]" value="11"/></td>
        <td><input class="form-control" type="text" readonly id="null" name="null[]" value="FALSE"/></td>
        <td style="width: 50px;"></td>
      </tr>
      <tr>
        <td><input class="form-control" type="text" readonly id="field" name="field[]" value="create_date"/></td>
        <td><input class="form-control" type="text" readonly id="type" name="type[]" value="DATETIME"/></td>
        <td><input class="form-control" type="text" readonly id="length" name="length[]" value=""/></td>
        <td><input class="form-control" type="text" readonly id="null" name="null[]" value="TRUE"/></td>
        <td style="width: 50px;"></td>
      </tr>
      <tr>
        <td><input class="form-control" type="text" readonly id="field" name="field[]" value="update_date"/></td>
        <td><input class="form-control" type="text" readonly id="type" name="type[]" value="DATETIME"/></td>
        <td><input class="form-control" type="text" readonly id="length" name="length[]" value=""/></td>
        <td><input class="form-control" type="text" readonly id="null" name="null[]" value="TRUE"/></td>
        <td style="width: 50px;"></td>
      </tr>
      <tr>
        <td><input class="form-control" type="text" readonly id="field" name="field[]" value="user"/></td>
        <td><input class="form-control" type="text" readonly id="type" name="type[]" value="INT"/></td>
        <td><input class="form-control" type="text" readonly id="length" name="length[]" value="11"/></td>
        <td><input class="form-control" type="text" readonly id="null" name="null[]" value="TRUE"/></td>
        <td style="width: 50px;"></td>
      </tr>
      <tr>
        <td><input class="form-control" type="text" readonly id="field" name="field[]" value="status"/></td>
        <td><input class="form-control" type="text" readonly id="type" name="type[]" value="INT"/></td>
        <td><input class="form-control" type="text" readonly id="length" name="length[]" value="6"/></td>
        <td><input class="form-control" type="text" readonly id="null" name="null[]" value="TRUE"/></td>
        <td style="width: 50px;"></td>
      </tr>
    </tbody>
  </table>
</div>

<div id="add_field" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Field</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
          <div class="form-group">
              <label class="col-sm-2 control-label">Field Name</label>
              <div class="col-sm-10">
                <input id="insert_name" class="form-control req" placeholder="Field Name">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Type</label>
              <div class="col-sm-10">
                <select class="form-control" id="insert_type">
                  <option>CHAR</option>
                  <option>VARCHAR</option>
                  <option>TEXT</option>
                  <option>BLOB</option>
                  <option>INT</option>
                  <option>BIGINT</option>
                  <option>FLOAT</option>
                  <option>DOUBLE</option>
                  <option>DECIMAL</option>
                  <option>DATE</option>
                  <option>DATETIME</option>
                  <option>TIMESTAMP</option>
                </select>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Length</label>
              <div class="col-sm-10">
                <input type="number" id="insert_length" class="form-control" placeholder="Length">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Allow Null</label>
              <div class="col-sm-10">
                <select class="form-control" id="insert_null">
                  <option>TRUE</option>
                  <option>FALSE</option>
                </select>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="table_add" class="btn btn-primary table_add">Insert</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">

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
          var row_current = 0
          $('.table_body  > tr').each(function() {
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
            var url = "<?= base_url('content_management/preference/create_table');?>";
           /* var data = {
              "fields" : $('.table_body :input').serialize(), 
              "table_name" : "site_" + $("#table_name").val(), 
            }*/
            var serialize_data = $('.table_body :input').serialize();
            var table_name = "site_" + $("#table_name").val();

            aJax.post(url,serialize_data+'&table_name='+table_name+'&rowCount='+row_count,function(result){
              modal.alert("Database Table Saved",function(){location.reload(); })
            });
          }
        }
      });
      
    }
  });

</script>