var modal = '';
modal += '<div class="modal fade" id="bootstrapShowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
modal += '  <div class="modal-dialog" role="document">';
modal += '      <div class="modal-content">';
modal += '          <div class="modal-body" id="confirmmessage"></div>';
modal += '          <div class="modal-footer">';
modal += '              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>';
modal += '              <button type="button" class="btn btn-primary" id="bootstrapShowModalConfirm">Yes</button>';
modal += '          </div>';
modal += '      </div>';
modal += '  </div>';
modal += '</div>';
modal += '<div class="modal fade" id="bootstrapShowModalLoading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
modal += '  <div class="modal-dialog" role="document">';
modal += '      <div class="modal-content">';
modal += '          <div class="modal-body">Loading...</div>';
modal += '      </div>';
modal += '  </div>';
modal += '</div>';

modal += '<div class="modal fade" id="bootstrapShowModalAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
modal += '  <div class="modal-dialog" role="document">';
modal += '      <div class="modal-content">';
modal += '          <div class="modal-body"  id="alert_message"></div><br>';
modal += '          <div class="modal-footer">';
modal += '              <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>';
// modal += '              <button type="button" class="btn btn-primary" id="bootstrapShowModalConfirm">Yes</button>'
modal += '          </div>';
modal += '      </div>';
modal += '  </div>';
modal += '</div>';
$(".au-wrapper").append(modal);

$("head").append("<style>.modal-backdrop {  background-color: rgb(0,0,0,.50) !important ; }</style>");


var BM = {
    confirm : function(message, cb){
        $('#confirmmessage').text(message);
        $("#bootstrapShowModal").modal("toggle");
        $("#bootstrapShowModalConfirm").on('click', function(){
            $("#bootstrapShowModal").modal("hide");
            cb(true);
        });
    },
    loading : function(show){
        if(show){
            $("#bootstrapShowModalLoading").modal("toggle");
        } else {
            $("#bootstrapShowModalLoading").modal("hide");
        }
    },
    show : function(modal){
        $(modal).modal("toggle");
    },
    hide : function(modal){
        $(modal).modal("hide");
    },
    alert : function(message,type){
        if(type == 'html'){
            $('#alert_message').html(message);
        }
        else {
            $('#alert_message').text(message);
        }

        $("#bootstrapShowModalAlert").modal("toggle");
    }
}
