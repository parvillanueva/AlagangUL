var input_id = {input_id};
var input_class = {input_class};
var input_maxlength = {input_maxlength};
var input_note = {input_note};
var required_field = {required_field};
var input_label = {input_data};
var input_count = {input_countx};
var text_label = {input_label};
var text_placeholder = {input_placeholder};

for(var i = 0;  i < input_count; i++) {
   
    $('.'+input_label[i]+'_input').attr('placeholder', text_placeholder[i]);
    $('.'+input_label[i]+'_input').attr('id', input_id[i]);
    $('.'+input_label[i]+'_input').addClass(input_class[i]);
    $('.'+input_label[i]+'_input').attr('maxlength', input_maxlength[i]);
    
    if (input_note[i] == "" && input_maxlength[i] == "") {
        note_data = "";
    } else {
        if (input_note[i] == "") {
            $('.standard-note').remove();
            note_data = 'Maximum character count is ' + input_maxlength[i]+ '.'; 
        } else if (input_maxlength[i] == "") {
            $('.standard-max').remove();
            note_data = '<b>Note: </b>' + input_note[i] + '.'; 
        } else {
            $('.standard-note').remove();
            $('.standard-max').remove();
           note_data = '<b>Note: </b>' + input_note[i] + '<br/>' + ' Maximum character count is ' + input_maxlength[i]+ '.';
        }
    }

   $('<small>'+note_data+'</small>').insertAfter('.'+input_class[i]);
   $('.sm-maxlength').hide();

    if (required_field[i] === "1") {
        $('.'+input_label[i]+'_input').addClass('required_input');
        $('.'+input_label[i]+'_label').html(text_label[i]+'<span style="color:red;">*</span>:');
    } else if (required_field[i] === "0") {
        $('.'+input_label[i]+'_input').removeClass('required_input');
        $('.'+input_label[i]+'_label').html(text_label[i]+':');
    }
}