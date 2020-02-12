function progressBar($id, $percentage){
	$($id).css("width", $percentage + '%');
}

$("#btnTestimonial").click(function(event) {
    var form = $("#testimonial")

    if (form[0].checkValidity() === false) {
        event.preventDefault()
        event.stopPropagation()
    }
    form.addClass('was-validated');
});

$("#btnPicture").click(function(event) {
    var form = $("#uploadpicture")

    if (form[0].checkValidity() === false) {
        event.preventDefault()
        event.stopPropagation()
    }
    form.addClass('was-validated');
});