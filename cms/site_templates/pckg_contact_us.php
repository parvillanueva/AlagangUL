<?php
    $dir = dirname(__FILE__);
    $this->minify->css($dir . "/asset/style.css", "Style"); //STYLE CSS FILE GOES HERE
    $this->minify->css($dir . "/asset/responsive.css", "Responsive"); // RESPONSIVE CSS FILE GOES HERE
    $this->minify->js($dir . "/asset/function.js", "Javascript"); //JAVASCRIPT/JQUERY FUNCTIONS GOES HERE
?>

<!--- YOUR HTML CODE HERE --->

<div class="main-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="row no-gutters">
                <div class="contact-container">
                <div class="text-left">
                    <h1>Contact Us</h1>
                </div>
                    <div class="row contact-main">
                        <div class="col-sm-4">
                            <img src="<?= base_url() ?>assets/img/Unilab-Logo-Corporate.jpg" alt="Unilab" width="100" height="100" class="img-responsive" style="margin: 0px auto; margin-bottom: 20px;">
                            <p>How can we help you?</p>
                            <p>You may call the Unilab Consumer Care Center at <b>(632) 864-5221</b>.</p>
                            <a href="tel:864-5221" class="btn btn-primary call-us-now">Call us now</a>
                            <p>We are available from Monday to Saturday, 8:00am – 5:00pm</p>
                            <p>You may also send us an email at <a href="mailto:info@unilab.com.ph">info@unilab.com.ph</a>.</p>
                            <p>You may also submit a report by clicking this link: <a href="https://www.unilab.com.ph/report-an-adverse-event/" target="_blank">Report an Adverse Event</a>.</p>
                            <a href="https://www.facebook.com/Unilab" target="_blank">
                            <button class="btn btn-primary message-us-fb"><i class="fa fa-facebook"></i> <span class="style-normal">&nbsp;|</span> Message Us on FB</button></a>
                        </div>
                        <div class="col-sm-8">
                            <div class="row no-gutters contact-form">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control firstname required" placeholder="First Name" id="firstname">
                                        <small>First</small><br>
                                        <span id="firstname_err" class="error-msg"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control middlename required" placeholder="Middle Name" id="middlename">
                                        <small>Middle</small><br>
                                        <span id="middlename_err" class="error-msg"></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control lastname required" placeholder="Last Name" id="lastname">
                                        <small>Last</small><br>
                                        <span id="lastname_err" class="error-msg"></span>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control email required" placeholder="Email Address" id="email">
                                        <span id="email_err" class="error-msg"></span>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control mobile required" placeholder="Mobile Number" id="mobile">
                                        <span id="mobile_err" class="error-msg"></span>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <select class="form-control inquiry required" id="inquiry">
                                            <option value="">Select Inquiry</option>
                                            <option value="Product Related">Product Related</option>
                                            <option value="Product Safety">Product Safety</option>
                                            <option value="Business Development">Business Development</option>
                                            <option value="Sponsorship / Medical Mission">Sponsorship / Medical Mission</option>
                                            <option value="Careers / OJT">Careers / OJT</option>
                                            <option value="Distribution / Trade Partner">Distribution / Trade Partner</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <span id="inquiry_err" class="error-msg"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <textarea class="form-control message required" rows="8" style="resize: none;" placeholder="Your Message" id="message"></textarea>
                                        <span id="message_err" class="error-msg"></span>
                                    </div>
                                    <input type="checkbox" value="Yes" id="offers">
                                    <small>I want to receive exclusive offers and updates from UNILAB Inc.</small>
                                    <div class="g-recaptcha" data-sitekey="6LdMg2MUAAAAAFifWs2qdGtBk4KQieFa4cS58EH5"></div>
                                    <span id="capcha_err" class="error-msg"></span>
                                    <button class="btn btn-primary submit-inquiry">Submit Inquiry</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inquiry_success" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Inquiry Sent!</h4>
            </div>
            <div class="modal-body">
                <h4>Thank you for your interest in our products and services. Great day!</h4>
            </div>
            <div class="modal-footer">
                <button type="button" id="close_modal" class="btn btn-primary" data-dismiss="modal">Okay</button>
            </div>
        </div>  
    </div>
</div>


<script type="text/javascript">

    $(document).on('click', '.submit-inquiry', function(){
        validate_fields();
    });

    function validate_fields(){
        var firstname = strip_tags($('#firstname').val().trim());
        var middlename = strip_tags($('#middlename').val().trim());
        var lastname = strip_tags($('#lastname').val().trim());
        var email = strip_tags($('#email').val().trim());
        var mobile = strip_tags($('#mobile').val().trim());
        var inquiry = strip_tags($('#inquiry').val().trim());
        var message = strip_tags($('#message').val().trim());
        var counter = 0;

        $('.error-msg').text('').hide();

        if(!validate.email_address(email)){
            $('#email_err').text('Invalid email').show();
            counter++;
        }

        if(!validate.mobile(mobile)){
            $('#mobile_err').text('Invalid mobile number').show();
            counter++;
        }

        $('.required').each(function(){
            var elem_id = $(this).attr('id');
            if($(this).val().length == 0){
                $('#'+elem_id+'_err').text('This field is required');
                $('#'+elem_id+'_err').show();
                $(this).css('border', 'red');
                counter++;
            }
        });

        if(counter == 0){
            $('.submit-inquiry').prop('disabled', true);
            $('.submit-inquiry').html('<i class="fa fa-spinner fa-spin"></i> Submit Inquiry');
            setTimeout(function(){
                send_inquiry();
            }, 500);
        }
    }

    function send_inquiry(){
        var url = "<?=base_url('global_controller/send_inquiry');?>";
        var data = {
            firstname : strip_tags($('#firstname').val().trim()),
            middlename : strip_tags($('#middlename').val().trim()),
            lastname : strip_tags($('#lastname').val().trim()),
            email : strip_tags($('#email').val().trim()),
            mobile : strip_tags($('#mobile').val().trim()),
            inquiry_type : strip_tags($('#inquiry').val().trim()),
            message : strip_tags($('#message').val().trim()),
            offers : strip_tags($('#offers').val().trim()),
        }

        aJax.post(url, data, function(result){
            $('.submit-inquiry').html('Submit Inquiry');
            $('#inquiry_success').modal('show');
        });
    }

    $('#inquiry_success').on('hidden.bs.modal', function(){
        location.reload();
    });

</script>