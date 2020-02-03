<div class="box">
  <div class="box-body">   

    <div class="col-md-12 list-data tbl-content" id="list-data">
      <?php
        $data['table'] = ['site_shop_now' => 'site_'];
        $data['order'] = ['desc' => 'update_date'];
        $data['join'] = [];

        $data['checkbox'] = 1;
        $data['display_fields'] = [
                                    'url' => ['URL'],
                                    'img_banner'  => ['Banner', 150], 
                                    'status'     => ['Status'],
                                    'create_date' => ['Date Created'],
                                    'update_date' => ['Date Updated'],
                                  ];

        $data['search_keyword'] = ['img_banner', 'url', 'status'];
        $data['query'] = "status >= 0";
        $data['sortable'] = ['column'];
        $data['button'] = ['add', 'close', 'search'];
      ?>
      <?php $this->form_table->display_data($data); ?>
    </div>

 	</div>
 </div>

  <script>
    $(document).ready(function(){
      $('#btn_add').removeAttr('id');
    });
    $(document).on('click', '.btn_add', function(e) {
        e.preventDefault();
        if(shop_menu() > 1){
           modal.alert("Maximum Buy Now Button is 2",function(){ });
        }else{
            location.href = '<?=base_url("content_management/site_menu/shop_add");?>';
        }
       
    });

    $(document).on('click', '.edit', function(e) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      location.href = '<?=base_url("content_management/site_menu/shop_edit");?>/'+id;
    });

    $(document).on('click', '#btn_close', function() {
        location.href = '<?=base_url("content_management/site_menu/menu");?>';
    });


  function shop_menu(){
    var url = "<?= base_url('content_management/global_controller');?>";
    var data = {
        event : "list",
        select : "id,status",
        query : "status >= 0",
        table : "site_shop_now"
    }
    var count = 0;

    aJax.post(url,data,function(result){
        var obj = is_json(result);
        count = obj.length;
      });

      return count;
  }

  </script>