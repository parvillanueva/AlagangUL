$(document).on("click", ".btn_insert", function(e){

	//get source
	var data_id = $(this).attr("identifier");
	//path of file 
	var path = $('#file_url').val();
	var ext =  path.split('.').pop();
	switch(ext.toLowerCase()) {
        case 'jpg':
        case 'png':
        case 'jpeg':
        case 'gif':
           var preview = '<img class="img_banner_preview" id="img_ban_'+data_id+'" src="'+base_url+path+'" style="max-width:200px" /><br>';
        break;  
        case 'pdf':
           var preview = '<iframe class="img_banner_preview" id="img_ban_'+data_id+'" src="'+base_url+path+'" style="width:100%; height: 300px;"></iframe>';
        break;                         // the alert ended with pdf instead of gif.
        case 'mp4':
            var preview = '<video class="img_banner_preview" style="width : 100%" controls>';
            preview += '<source src="'+base_url+path+'" type="video/mp4">';
            preview += 'Your browser does not support HTML5 video.';
            preview += '</video>';
        break;
        default:
			var preview = '<span class="img_banner_preview"></span>';

    }

	$('.'+data_id).next('.img_banner_preview').remove();
	$('#'+data_id).val(path);
	$(preview).insertAfter('.'+data_id);
	//close modal
	$(".modal").modal("hide");
    $('.bootbox').modal('hide');
    $('#ckeditor_filemanager_modal').modal('hide');
	$("#img_delete_button").html("<div class='col-sm-6'><a href='#' id='btn_delete_image' id-identifier='"+data_id+"' class='btn_delete btn-sm btn btn-default cms-btn' style='width: 110px; margin-top: 5px;'><span class='fa fa-trash'></span> Remove Preview </a> </div>");

});

$(document).on("click", "btn_delete_image", function(){
	var data_identify = $(this).attr('id-identifier');
	$("#img_ban_"+data_identify+"").remove();
	$(this).hide();
});