<?php include('include/event_header.php'); ?>
<!-- BEGIN BANNER -->
        <section class="contact-us-banner ev-banner ev-overlay-background sec-padding-banner uk-text-center">
            <div class="uk-container uk-container-center">
                <div class="ev-box-title">
                    <h3>Contact us</h3>
                    <p>Work with us</p>
                    <div class="ev-border-line-primary"></div>
                </div>
            </div>
        </section>
        <!-- END BEGIN BANNER -->
 <section class="gmap  uk-text-center">
            <div class="uk-container uk-container-center">
                <div class="ev-title-page">
                    <h3>
                        <a href="#"><span>Home page</span></a>
                        <a href="#"><span>Contact us</span></a>
                        <a href="#"><span>Work with us</span></a>
                    </h3>
                 </div>                
            </div>
        </section>
<section class="contact-us-page uk-text-center">
            <div class="uk-container uk-container-center">
                <div class="ev-box-title">
                    <h3>Contact us</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt <br> ut laoreet dolore magna aliquam erat volutpat</p>
                </div>
                <div class="uk-grid">
                    <div class="uk-width-medium-1-2 uk-width-small-1-1 uk-width-1-1">
                        <form id="contactus" class="uk-form" action="<?php echo base_url('event/contactus'); ?>" method="post">
                            <div class="uk-form-icon" >
                                <i class="icon icon_id"></i>
								
								<input name="first_name" id="first_name" type="text" placeholder="First Name" value="<?php echo set_value('first_name'); ?>">
								<div class="text-red" id="ferror" ></div>
								
                            </div>
							<div class="uk-form-icon">
                                <i class="icon"></i>
                                <input name="last_name" id="last_name" type="text" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>">
								<div class="text-red"  id="lerror" ></div>
                            </div>
							 <div class="uk-form-icon">
                                <i class="icon icon_mail_alt"></i>
                                <input name="email"  id="email" type="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
								<div class="text-red"  id="eerror" ></div>
                            </div>							
                            <div class="uk-form-icon">
                                <i class="icon icon_mobile"></i>
                                <input name="phone" id="phone" type="text" placeholder="Phone">
								
                            </div>                                                     
                            <div class="uk-form-icon">
                                <i class="icon icon_pens_alt"></i>
                                <textarea name="comment" id="comment" rows="5" placeholder="Comment"></textarea>
								<div class="text-red" id="cerror" ></div>
                            </div>
							 <div class="uk-form-icon" >
                                <i class="icon"></i>
								 <input type="text" id="txtCaptcha" class="captcha_image" />
							<input type="button" id="btnrefresh" value="Refresh" onclick="DrawCaptcha();" class="captcha"/>							</div>
							 <div class="uk-form-icon" >
                                <i class="icon"></i>
							<input type="text" id="txtInput" placeholder="Enter captcha numbers here .." /> 
							<div class="text-red" id="captcha_error" ></div>
							</div>
                            <button class="ev-button ev-button-primary ev-button-text-white">Send message</button>
                        </form>				
						
                    </div>
                    <div class="uk-width-medium-1-2 uk-width-small-1-1 uk-width-1-1">
                        <div class="meta">
                            <div class="box-meta">
                                <a href="#"><span class="icon icon_clock_alt"></span></a>
                                <div class="box-content">
                                    <p>15 July, 2016</p>
                                    <p>Monday - Friday 8:00 AM - 05:00 PM</p>
                                </div>
                            </div>
                            <div class="box-meta">
                                <a href="#"> <span class="icon icon_pin_alt"></span></a>
                                <div class="box-content">
                                    <p>North Avenue 34521</p>
                                    <p>James Street, Vancouver, Canada</p>
                                </div>
                            </div>
                            <div class="box-meta">
                                <a href="#"><span class="icon icon_mail_alt"></span></a>
                                <div class="box-content">
                                    <p>0123 456 789</p>
                                    <p>support@victhemes.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<style>
 .captcha
 {
	width: 17% !important;
     color: white !important;
    background: red  !important;
    font-size: 15 !important;
    font-weight: bold !important;
	 
    line-height: 1px !important;
 }
 .captcha_image
 {
	 background:grey !important; 
	 text-align:center;
	 color: white !important;
	 border:none;
	 font-weight:bold !important;
	 font-family:Modern !important;
	 
	 width:40% !important;
 }
 .text-red
 {
	 color:red;
	 margin-bottom:10px;
 }
 </style>
 
 <script type="text/javascript">

   //Created / Generates the captcha function    
    function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 10)+ '';
        var b = Math.ceil(Math.random() * 10)+ '';       
        var c = Math.ceil(Math.random() * 10)+ '';  
        var d = Math.ceil(Math.random() * 10)+ '';  
        var e = Math.ceil(Math.random() * 10)+ '';  
        var f = Math.ceil(Math.random() * 10)+ '';  
        var g = Math.ceil(Math.random() * 10)+ '';  
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' '+ f + ' ' + g;
        document.getElementById("txtCaptcha").value = code
    }

    // Validate the Entered input aganist the generated security code function   
    function ValidCaptcha(){
        var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
        var str2 = removeSpaces(document.getElementById('txtInput').value);
        if (str1 == str2) return true;        
        return false;
        
    }

    // Remove the spaces from the entered and generated code
    function removeSpaces(string)
    {
        return string.split(' ').join('');
    }
    DrawCaptcha();
	
 $(document).ready(function () {
	  $("#first_name").keypress(function(){
		    $("#ferror").css("display", "none");
    }); 
	  $('#last_name').keypress(function(){
		     $("#lerror").css("display", "none");
    }); 
	 $('#email').keypress(function(){
		     $("#eerror").css("display", "none");
    }); 
	  $('#comment').keypress(function(){
		     $("#cerror").css("display", "none");
    }); 
	
	$('#contactus').on('submit', function(e){
		var pass=$("#password").val();
		var cpass=$("#cpassword").val();
		
		
		if($("#first_name").val()=='')
		{
			$("#first_name").focus();
			 $("#ferror").css("display", "block");
			$('#ferror').html("Please enter first name");
			return false;
		}
		else if($("#last_name").val()=='')
		{
			$("#last_name").focus();
			 $("#lerror").css("display", "block");
			$('#lerror').html("Please enter last name");
			return false;
		}
		else if($("#email").val()=='')
		{
			$("#email").focus();
			 $("#eerror").css("display", "block");
			$('#eerror').html("Please enter valid email address");
			return false;
		}else if($("#comment").val()=='')
		{
			$("#comment").focus();
			 $("#cerror").css("display", "block");
			$('#cerror').html("Please enter comment");
			return false;
		}
		if(ValidCaptcha()==false)
		{
			$("#captcha_error").focus();
			 $("#captcha_error").css("display", "block");
			$('#captcha_error').html("Please enter correct number of captcha");
			return false;
		}
	});
	
 });
    </script>
<?php include('include/footer.php'); ?>