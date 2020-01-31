$(document).on('click', '#btn_connect_table', function(e){
	var url = content_management + '/preference/get_table_fields';
	var data = { table : $('#sql_table').val() }
	aJax.post(url,data,function(data){
		var obj = is_json(data);
		var required = ["id", "update_date", "create_date","status","user"];
		var html = '';
		for (i = 0; i < obj.length; ++i) {
			var found = (required.indexOf(obj[i]) > -1);
			if(!(found)){	
			    html += '	<tr>';
				html += '		<td data-class="field"><input readonly class="data-value form-control" value=' + obj[i] + '><a href="#" class="text-danger do-not-include">do not include (x)</a></td>';
				html += '		<td data-class="label">';
				html += '			<input class="form-control data-value ">';
				html += '		</td>';
				html += '		<td data-class="input">';
				html += '			<select class="data-value form-control">';
				html += '				<option value="text">Textbox - Text</option>';
				html += '				<option value="number">Textbox - Number</option>';
				html += '				<option value="password">Textbox - Password</option>';
				html += '				<option value="email">Textbox - Email</option>';
				html += '				<option value="textarea">Textarea</option>';
				html += '				<option value="date">Date Picker</option>';
				html += '				<option value="ckeditor">CKEditor</option>';
				html += '			</select>';
				html += '		</td>';
				html += '		<td data-class="list">';
				html += '			<label><input checked class="data-value select-display" type="checkbox" value="1"></label>';
				html += '		</td>';
				html += '		<td data-class="create">';
				html += '			<label><input checked class="data-value select-display" type="checkbox" value="1"></label>';
				html += '		</td>';
				html += '		<td data-class="update">';
				html += '			<label><input checked class="data-value select-display" type="checkbox" value="1"></label>';
				html += '		</td>';
				html += '		<td data-class="required">';
				html += '			<label><input checked class="data-value select-display" type="checkbox" value="1"></label>';
				html += '		</td>';
				html += '	</tr>';
			}
		}

		var count_required = 0;
		for (i = 0; i < obj.length; ++i) {
			var found = (required.indexOf(obj[i]) > -1);
			if(found){
				count_required++;
			}
		}

		if(count_required == 5){
			$(".crud_table").html(html);
		} else {
			$(".crud_table").html("<tr><td colspan=7 style='text-align: center;'>id(int), create_date(datetime), update_date(datetime), status(int) and user(int) field is required</td></tr>");
		}
	})
});

$(document).on('click', '.do-not-include', function(e){
	e.preventDefault();
	$(this).closest('tr').remove();
});