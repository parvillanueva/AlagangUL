<body>
  <div class="box">
      <?php
        $data['buttons'] = ['add','search'];
        $this->load->view("content_management/template/buttons",$data);
      ?>

    <div class="box-body">
    <div class="col-md-12 list-data">
        <table class= "table listdata table-striped sorted_table">
            <thead>
                <tr id="sortable">
                    <th style="width: 10px;"></th>
                    <th><input class ="selectall" type ="checkbox"></th>
                    {th_data}
                    <th class="th-setter">Update Date</th>
                    <th class="th-setter">Status</th>
                    <th>Edit</th>
                </tr>  
            </thead>
            <tbody></tbody>
        </table>
      <div class="list_pagination"></div>
    </div>
   </div>
  </div>
</body>

<script type="text/javascript">
  
  AJAX.config.base_url("<?=base_url();?>"); 

  $(document).ready(function(){
    
    $(document).on('keypress', '#search_query', function(e) {
      query = "";                          
      if (e.keyCode == 13) {
          var keyword = $(this).val();
          get_list(keyword);
      }
    });

    get_list();
   // get_pagination();
    $('.selectall').prop('checked', false);

    var sorttable = $('tbody').sortable();
    $('tbody').bind('sortupdate', function(event, ui) {
      var order = 0;

          $('.order').each(function() {  
              order ++;
              $(this).attr("data-order",order);
          });

      save_sort();
   });      
 });

//add user
$(document).on('click', '#btn_add', function(e){
   location.href = ('<?= base_url()."content_management/"?>{page}/add');
});

 var limit = 10;
 var offset = 1;

function get_list(keyword){
    modal.loading(true);
    var search_arr = {input_data};

    AJAX.select.table("{table_name}");
    AJAX.select.select({input_custom_table_field});
    AJAX.select.where.greater_equal("status", 0);
    AJAX.select.offset(offset);
    AJAX.select.limit(limit);
    AJAX.select.order.asc("orders");

    if(keyword)
    {
      for (var i = 0; i < search_arr.length; i++) {
        if (i != search_arr.length - 1) {
          AJAX.select.where.like(search_arr[0], keyword);
          AJAX.select.where.or.like(search_arr[i+1], keyword);
        } 
      }
    }
    // ajax get post
    AJAX.select.exec(function(result){
        var obj = result;
        var htm = "";
        var status_action = null;
        
        if (obj.length > 0) {
          $.each(obj, function(x,y){
           
            htm += "<tr>";
            htm += "<td class='hide'><p class='order' data-order='' data-id="+y.id+"></p></td>";
            htm += "<td style='background:#c3c3c3;'><span style='color: #fff;' class='move-menu glyphicon glyphicon-th'></span></td>"; 
            htm +=   "<td><input class='select' data-status='"+y.status+"' data-id='"+y.id+"' type='checkbox'></td>";

            $("table th.th-setter").each(function(){
              var data = [$(this).text().toLowerCase()];
              var new_data =  data.map(replace_in_array);
              
              if (y['status'] == 1) {
                  y['status'] = 'Active';
                  status_action = 1;
              } else if (y['status'] == 0) {
                  y['status'] = 'Inactive';
                  status_action = 0;
              }

              htm += "<td data-status='"+status_action+"'>"+y[new_data]+"</td>";
            });

            htm +=   "<td><a href='<?= base_url()."content_management/"?>{module}/update/"+y.id+"' class='edit' data-status='"+y.status+"' id='"+y.id+"' title='edit'><span class='glyphicon glyphicon-pencil'></span></td>";
            htm += "</tr>";
          });
        } else {
          htm = "<td colspan='10'>No data found.</td>";
        }

        $('.listdata tbody').html(htm);
        modal.loading(false);
    }, function(obj){
        pagination.generate(obj.total_page, '.list_pagination', get_list);
    });
  }

pagination.onchange(function(){
      offset = $(this).val();
      get_list();
});

function save_sort() {
  $('.order').each(function() {       
    var orders = $(this).attr("data-order");

    AJAX.update.table("{table_name}");
    AJAX.update.where("id", $(this).attr("data-id"));
    AJAX.update.params(orders, orders);

    AJAX.update.exec(function(result){});
  });

}

$(document).on('click','.btn_status',function(e){
  var status = $(this).attr("data-status");
  var id = "";

  modal.confirm("Are you sure you want to Update this record?",function(result){
      if(result){
          $('.selectall').prop('checked', false);
          $('.select:checked').each(function(index) { 
              id = $(this).attr('data-id');

              AJAX.update.table("{table_name}");
              AJAX.update.where("id", id);
              AJAX.update.params("status", status);
              AJAX.update.params("update_date", moment(new Date()).format('YYYY-MM-DD HH:mm:ss'));

              AJAX.update.exec(function(result){
                var obj = result;
                if (obj.length > 0) {
                  get_list();
                  $('.status_action').hide();
                } else {
                  console.log(obj);
                }
              });
          });
      }

   })
});

//replace all space in array
var replace_in_array = function(str){
  return str.replace(/\s+/g, "_")
}

</script>
