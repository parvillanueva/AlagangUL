<!-- Shop Now  Start -->
<div class="modal fade" id="shop_now_modal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal_custom_size">
        <div class="modal-content">              
            <!--Header-->
            <div class="shop_now_modal_header modal-header">
              <p class="modal_title">
                <strong>Shop Now</strong>
              </p>
              <div class="modal_close_div">
                  <button id="modal_close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                  </button>
             </div>
            </div>
            <!--Body-->
            <div class="modal-body shop_now_modal_body">
                <div class="row">
                    <div class="shop-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $(document).on('click', '.buy-now-menu', function() {
          get_data();
        });


    function get_data(){
        var url = "<?= base_url('content_management/global_controller');?>";
        var data = {
            event: "list",
            select: "id,url,img_banner,status",
            query: "status > 0",
            table: "site_shop_now"
        }

        aJax.post(url,data,function(result){
            var obj = is_json(result);
            if(obj.length > 1){
               $('#shop_now_modal').modal('show');
            }else{
                window.open(obj[0].url);
            }
        });
    }

        $.get("<?= base_url("shop_now"); ?>", function(data) {
            var html = "";
            if (data.length > 0) {
                $.each(data, function(x,y) {
                    var host_url = y.url;
                    var hostname = host_url.replace('http://','').replace('https://','').replace('www.', '').replace('.com.ph', '').replace('.com', '').replace('.ph', '');
                    html += "<div class='col-md-6 col-sm-6 col-xs-6'>";
                    html += "   <a href='"+y.url+"' class='shop_url' id='"+hostname+"_url' target='_blank'>";
                    html += "       <img src='<?=base_url()?>"+y.img_banner+"' class='shop_image'/>";
                    html += "   </a>";
                    html += "</div>";
                });
            } else {
                $('#shop_now_modal').modal('hide');
            }

            $(".shop-container").html(html);
        });
    });





</script>

<style type="text/css">
    #shop_now{
        cursor: pointer;
    }
    .shop_now_modal_header {
        position: relative;
        padding: 5px 10px;
        border-bottom: 0px;
        display: table;
        width: 100%;
    }
    .shop_now_modal_body{
        padding: 20px;
    }
    .modal_title {
        margin: auto;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 600;
        display: table-cell;
        vertical-align: middle;
    }

    .modal_close_div {
        display: inline-block;
        float: right;
        position: relative;
        top: -20px;
        right: -18px;
    }


    .shop_image{
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

      #modal_close {
        background: #fff;
        border: 2px solid #000;
        border-radius: 50%;
    }

    #modal_close span {
        color: #000;
        font-weight: 800;
        font-size:16px;
    }

    #modal_close:active{
        transform:translateY(4px);
        color:#000;
    }

    #modal_close:hover{
        color:#000;
    }



    .modal_custom_size {
        max-width: 450px;
        min-width: 450px;
    }


    @media only screen and (max-width: 768px) {
        .modal_close_div {
            top: -15px;
            right: -17px;
        }
        .modal_custom_size {
            max-width: none;
            min-width: auto;
        }
    }


</style>
<!--Shop Now End 