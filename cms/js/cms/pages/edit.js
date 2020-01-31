AJAX.config.base_url(base_url);

var site = segment_4;
var package = "";
//Get list of * active roles
$(document).ready(function(){
	get_data();
});

function get_data(){

	AJAX.select.table("pckg_tables");
	AJAX.select.select("package, site_menu");
	AJAX.select.group("package");

	AJAX.select.exec(function(result){
		var obj = result;

		var packages = '';

		$.each(obj, function(x, y){
			packages += '<input type="radio" name="package" value = "'+y.package+'" class="package_opt" ';
			if(site == y.site_menu){
				packages += 'checked="checked" >'+y.package + '<br>';
				load_fields(y.package);
			}else{
				packages +=  '>'+y.package + '<br>';
			}
		});

		$('#packages').append(packages);

		modal.loading(false);
	});
}

$(document).on('click', '#btn_update', function(){
    update_data(package);
});

$(document).on('click', '.package_opt', function(){
	package = $(this).val();
	load_fields(package);
});

function load_fields(package){
	$('#fields').empty();

	AJAX.select.table("pckg_tables");
	AJAX.select.select("fields,id,display");
	AJAX.select.where.equal("package", package);

	AJAX.select.exec(function(result){
		var obj = result;
		
		var fields = '<table class="table table-bordered sorted_table">';
			fields += '<thead> <tr> <th> Fields </th><th> Status </th> </tr> </thead> <tbody class="table_body">';
		$.each(obj, function(x, y){

        	checked = (y.display==1)?"checked":"";
			fields += '<tr>';
        	fields += ' <td>' +y.fields+ '</td><td class="text-center"><input type="checkbox" value="'+y.id+'" class="field_status"  '+checked+'></td> <tr>';
		});

		fields += '</tbody>';
		$('#fields').append(fields);

		modal.loading(false);
	});
}

//Update Status
$(document).on('click', '.field_status', function(){
	status = ($(this).prop("checked")==true)?1:0;

	AJAX.update.table("pckg_tables");
	AJAX.update.where("id", $(this).val());
	AJAX.update.params("display", status);

	AJAX.update.exec(function(result){
   		var obj = result;
	});
});

//Update record
function update_data(param){

	modal.standard(confirm_update, function(result){
		if(result){
			var url = global_controller;
	   		var data = {
				event: "package",
		        table : "pckg_tables",
		        field : "package",
		        where : "'" + param + "'",
		        data : {
		        	site_menu : site
		       }
	    	}
		   	aJax.post_async(url,data,function(result){
		   		var obj = is_json(result);

		   		aJax.get(content_management+'/pages/write_template?param='+param+'&site='+site);

			    modal.alert(update_success, function(){
	            	location.href = content_management + '/pages';
	            });
			});
	 	}
	});
}