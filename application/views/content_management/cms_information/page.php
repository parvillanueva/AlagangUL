<div class="box">
    <?php
        $data['buttons'] = ['update']; // add, save, update
        $this->load->view("content_management/template/buttons", $data);
    ?> 
 	<div class="box-body">  
 		<div class="form-horizontal">
            <div class="form-group">
              	<label class="col-sm-2 control-label">CMS Title</label>
              	<div class="col-sm-5">
                	<input id="title" class="form-control" placeholder="Website Title">
              	</div>
            </div>
            <div class="form-group">
              	<label class="col-sm-2 control-label">Skin</label>
              	<div class="col-sm-5">
                	<select name="skin" class="form-control theme required"></select>
              	</div>
            </div>

            <?php if($this->session->userdata('sess_role') == 6 || $this->session->userdata('sess_role') == 7 ){?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Edit Header Label</label>
                <div class="col-sm-5">
                    <select name="edit_label" class="form-control edit-label required">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">AD Authentication</label>
                <div class="col-sm-5">
                    <select name="ad_authentication" class="form-control ad-authentication required">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
           <?php }?>
 	</div>
</div>
 
<script type="text/javascript">

	var url = "<?= base_url('content_management/global_controller');?>";

	$(document).ready(function(){
        get_data();
    });

    function get_data(){	
        var data = {
        	event : "list", // list, insert, update, delete
            select : "id, cms_title, cms_skin, cms_edit_label, ad_authentication",
            query : "id = 1", 
            table : "cms_preference", 
        }

        aJax.post(url,data,function(result){
        	var obj = is_json(result); 
        	$.each(obj, function(x,y){
        		$('#title').val(y.cms_title);
                load_skins(y.cms_skin);
                $('.edit-label').val(y.cms_edit_label);
                $('.ad-authentication').val(y.ad_authentication)
        	});
        });
    }

    function load_skins(current){
        aJax.post(
            "<?= base_url('content_management/file_manager/files');?>",
            { path: "./cms/css/skins" },
            function(data){

                var obj = is_json(data); 
                var html ='';
                for (var key in obj) {
                    if(obj[key].text != null){
                        parts = obj[key].text.split('.');
                        x = parts[0];
                        if(x == current){
                            html += '<option selected>' + x + '</option>'
                        } else {
                            html += '<option>' + x + '</option>'
                        }
                    }   
                }
                $('.theme').html(html);
            }
        )
    }

    $(document).on('click', '#btn_update', function(e){
    	modal.confirm("Are you sure you want to update this record?",function(result){
    		if(result){
                var url = "<?= base_url("content_management/global_controller");?>";
    			var data = {
    				event : "update", // list, insert, update, delete
			        table : "cms_preference", 
			        field : "id", 
			        where : 1,
			        data : 
			        	{
			        		cms_title : $('#title').val(),
			        		cms_skin : $('.theme').val(),
                            cms_edit_label : $('.edit-label').val(),
                            ad_authentication : $('.ad-authentication').val()
			        	}
			    }
                aJax.post(url,data,function(result){
                    modal.alert("Preference has been updated!",function(){
                        location.reload();  
                    });
                });
    		}
    	});
    });

	$(document).on('keypress', 'textarea', function(e){
	    if (e.which == 13) { 
	       e.preventDefault();
	    }
	});

</script>