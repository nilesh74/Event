<?php include('include/event_header.php'); ?>
 <section class="contact-us-banner ev-banner ev-overlay-background sec-padding-banner uk-text-center">
            <div class="uk-container uk-container-center">
                <div class="ev-box-title">
                    <h3>USER REGISTER</h3>
                    <p>Work with us</p>
                    <div class="ev-border-line-primary"></div>
                </div>
            </div>
        </section>
		
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
		
		<section class="contact-us-page sec-padding uk-text-center">
            <div class="uk-container uk-container-center">
                <div class="ev-box-title">
                    <h3>User Register</h3>
                 </div>
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1">
                        <form id="login" class="uk-form" action="<?php echo base_url("event/register");?>" method="post">
                            <div class="uk-form-icon" style ="width:50% !important; ">
                                <i class="icon"></i>
                                <input name="first_name" id="first_name" type="text" placeholder="First Name" value="<?php echo set_value('first_name'); ?>">
								<div class="text-red" id="ferror" ><?php if(form_error('first_name')!=""){ echo form_error('first_name');} ?></div>
                            </div>
                            <div class="uk-form-icon" style ="width:50% !important">
                                <i class="icon"></i>
                                <input name="last_name" id="last_name" type="text" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>">
								<div class="text-red"  id="lerror" ><?php if(form_error('last_name')!=""){ echo form_error('last_name');} ?></div>
                            </div>
                            <div class="uk-form-icon" style ="width:50% !important">
                                <i class="icon icon_mail_alt"></i>
                                <input name="email"  id="email" type="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
								<div class="text-red"  id="eerror" ><?php if(form_error('email')!=""){ echo form_error('email');} ?></div>
                            </div>
                            <div class="uk-form-icon" style ="width:50% !important" >
                                <i class="icon icon_globe"></i>
                                <input name="password"  id="password" type="password" placeholder="Password" 
								value="<?php echo set_value('password'); ?>">
								<div class="text-red"  id="perror" ><?php if(form_error('password')!=""){ echo form_error('password');} ?></div>
                            </div>
							<div class="uk-form-icon" style ="width:50% !important">
                                <i class="icon icon_globe"></i>
                                <input name="cpassword" type="password" id="cpassword" placeholder="confirm_Password" value="<?php echo set_value('cpassword'); ?>">
								<div class="text-red" id="cperror" ></div>
                            </div>
                            <div class="uk-form-icon" style ="width:50% !important">
                                <i class="icon"></i>
								 <input type="text" id="txtCaptcha" class="captcha_image" />
							<input type="button" id="btnrefresh" value="Refresh" onclick="DrawCaptcha();" class="captcha"/>							</div>
							 <div class="uk-form-icon" style ="width:50% !important">
                                <i class="icon"></i>
							<input type="text" id="txtInput" placeholder="Enter captcha numbers here .." /> 
							<div class="text-red" id="captcha_error" ></div>
							</div>
                            <button class="ev-button ev-button-primary ev-button-text-white" style ="width:50% !important ; margin-left: 25% !important;">SUBMIT</button>
                        </form>
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
	 $('#password').keypress(function(){
		     $("#perror").css("display", "none");
    }); 
	 $('#cpassword').keypress(function(){
		     $("#cperror").css("display", "none");
    }); 
	
	$('#login').on('submit', function(e){
		var pass=$("#password").val();
		var cpass=$("#cpassword").val();
		
		
		if($("#first_name").val()=='')
		{
			 $("#ferror").css("display", "block");
			$('#ferror').html("Please enter first name");
			return false;
		}
		else if($("#last_name").val()=='')
		{
			 $("#lerror").css("display", "block");
			$('#lerror').html("Please enter last name");
			return false;
		}
		else if($("#email").val()=='')
		{
			 $("#eerror").css("display", "block");
			$('#eerror').html("Please enter valid email address");
			return false;
		}else if($("#password").val()=='')
		{
			 $("#perror").css("display", "block");
			$('#perror').html("Please enter password");
			return false;
		}
		
		if(pass != cpass)
		{
			 $("#cperror").css("display", "block");
			$('#cperror').html("Confirm password is not correct");
			return false;
		}
		if(ValidCaptcha()==false)
		{
			 $("#captcha_error").css("display", "block");
			$('#captcha_error').html("Please enter correct number of captcha");
			return false;
		}
	});
	
 });
    </script>

		<?php include('include/footer.php'); ?>