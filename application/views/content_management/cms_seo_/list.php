<div class="box">
  <?php 
    $data['buttons'] = ['add', 'search']; // add, save, update
    $this->load->view("content_management/template/buttons", $data);
  ?>  
    <div class="box-body">
    <!-- LIST TABLE -->
    <table class="table table-bordered listdata">
      <thead>
        <tr>
        <th><input class ="selectall" type ="checkbox"></th>
        <th>URL</th>
        <th>Meta Title</th>
        <th>Meta Description</th>
        <th>Meta Keyword</th>
        <th>OG Title</th>
        <th>OG Description</th>
        <th>OG Image</th>
        <th>Edit</th>
        </tr>
      </thead>
      <tbody class="table_body">
        
      </tbody>
    </table>
    </div>
</div>

<script type="text/javascript">

  $('.box-header .btn-info').remove();
  $('.box-header .btn-warning').remove();

  var query="";
  $(document).ready(function(){

    get_list();
    get_pagination();
    $('.selectall').prop('checked', false);

 });

  $(document).on('click', '.glyphicon-search', function(){
    var keyword = $('.search-query').val();
     query = "( cms_seo.url like '%" + keyword + "%' OR cms_seo.meta_title like '%" + keyword + "%' OR cms_seo.meta_description like '%" + keyword + "%' OR cms_seo.meta_keywords like '%" + keyword + "%' OR cms_seo.og_title like '%" + keyword + "%' OR cms_seo.og_description like '%" + keyword + "%') AND status >= 0";
    get_list();
    get_pagination();
  });

  $(document).on('keypress', '#search_query', function(e) {                          
    if (e.keyCode == 13) {
        var keyword = $(this).val()
         query = "( cms_seo.url like '%" + keyword + "%' OR cms_seo.meta_title like '%" + keyword + "%' OR cms_seo.meta_description like '%" + keyword + "%' OR cms_seo.meta_keywords like '%" + keyword + "%' OR cms_seo.og_title like '%" + keyword + "%' OR cms_seo.og_description like '%" + keyword + "%') AND status >= 0";
        get_list();
        get_pagination();
    }
  });

var limit = 10;
var query = "status >= 0";
var offset = 1;

function get_list(){
   modal.loading(true);
    var url = "<?= base_url('content_management/global_controller');?>";
    var data = {
        event : "list", 
        select : "*", 
        query : query, 
        offset : offset, 
        limit : limit, 
        table : "cms_seo",
    }

    aJax.post(url,data,function(result){
      var obj = is_json(result); 

      var htm = '';
        $.each(obj, function(x,y){

              htm+="  <tr>";
              htm+="    <td><input class = 'select'  data-id = '"+y.id+"' type ='checkbox'></td>";
              htm+="    <td>"+y.url+"</td>";
              htm+="    <td>"+y.meta_title+"</td>";
              htm+="    <td>"+y.meta_description+"</td>";
              htm+="    <td>"+y.meta_keywords+"</td>";
              htm+="    <td>"+y.og_title+"</td>";
              htm+="    <td>"+y.og_description+"</td>";
              htm+="    <td>"+y.og_image+"</td>";
              htm+="    <td><a href='<?= base_url()."content_management/"?>seo/edit_seo/"+y.id+"' class='edit' data-status='"+y.status+"' id='"+y.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
              htm+="  </tr>";

         });

         $('.listdata tbody').html(htm);
          modal.loading(false);


    });
  }

  function get_pagination(){

      var url = "<?= base_url('content_management/global_controller');?>";
      var data = {
          event : "pagination", 
          select : "*", 
          query : "status >= 0", 
          offset : offset, 
          limit : limit, 
          table : "cms_seo",   
      }

        aJax.post(url,data,function(result){
            var obj = is_json(result);
            console.log(obj);
            modal.loading(false);
            pagination.generate(obj.total_page, '.list_pagination', get_list);
        });
      }

        pagination.onchange(function(){
          offset = $(this).val();
          get_list();
      })

  $(document).on('click', '#btn_add', function(e){
    location.href = ('<?= base_url()."content_management/"?>seo/add_seo');
  });

  $(document).on('click', '#btn_status', function(e){
        var status = $(this).attr("data-status");
        var id = "";

        if(status == 0){
            var modal_obj = '<?= $this->standard->confirm("confirm_unpublish"); ?>'; 
            var modal_alert = '<?= $this->standard->dialog("unpublished_success"); ?>';
        }
        if(status == 1){
            var modal_obj = '<?= $this->standard->confirm("confirm_publish"); ?>'; 
            var modal_alert = '<?= $this->standard->dialog("published_success"); ?>';
        }
        if(status == -2){
            var modal_obj = '<?= $this->standard->confirm("confirm_delete"); ?>'; 
            var modal_alert = '<?= $this->standard->dialog("delete_success"); ?>';
        }
        var result_message = "";
        modal.standard(modal_obj, function(result){
            if(result){
                $('.selectall').prop('checked', false);
                $('.select:checked').each(function(index) { 
                    id = $(this).attr('data-id');
                    var url = "<?= base_url("content_management/global_controller");?>";
                    var data = {
                        event : "update",
                        table : "cms_seo", 
                        field : "id", 
                        where : id, 
                        data  : {
                            status : status,
                            update_date : moment(new Date()).format('YYYY-MM-DD HH:mm:ss')
                        }, 
                    }

                    aJax.post(url,data,function(result){
                        var obj = is_json(result);
                        result_message = obj;
                        
                    });
                });

                modal.alert(modal_alert, function(){
                    get_data();
                    get_pagination();
                    $('.btn_status').hide();    
                });
            }

        })
    });

</script>