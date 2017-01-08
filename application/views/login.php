<?php include('include/event_header.php'); ?>
 <section class="contact-us-banner ev-banner ev-overlay-background sec-padding-banner uk-text-center">
            <div class="uk-container uk-container-center" id="$=NA">
                <div class="ev-box-title">
                    <h3>USER LOGIN</h3>
                    <p>Work with us</p>
                    <div class="ev-border-line-primary"></div>
                </div>
            </div>
        </section>
		
		 <section class="gmap  uk-text-center" >
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
								
                <div class="ev-box-title" >
                    <h3>User Login</h3>
                 </div>
							<?php if($this->session->flashdata('success'))
									{	?>
										<div style="color:green"> <?php echo $this->session->flashdata('success') ?></div>
								<?php } else if($this->session->flashdata('error'))
								{ ?>
									<div style="color:red"> <?php echo $this->session->flashdata('error') ?></div>
									<?php }
								
								?>
                <div class="uk-grid">
                    <div class="uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1">
                        <form id="login" class="uk-form" action="<?php echo base_url("event/login");?>" method="post">
                            <div class="uk-form-icon" style ="width:50% !important; ">
                                <i class="icon "></i>
                                <input name="email" id="email" type="email" placeholder="Email id">
								<div class="text-red"  id="eerror" ></div>
                            </div>
                            <div class="uk-form-icon" style ="width:50% !important">
                                <i class="icon "></i>
                                <input name="password" id="password" type="password" placeholder="Password">
								<div class="text-red"  id="perror" ></div>
                            </div>                           
                            <button class="ev-button ev-button-primary ev-button-text-white" style ="width:50% !important ; margin-left: 25% !important;">SUBMIT</button>
                        </form>
                    </div>                    
                </div>
            </div>
 </section>
 <style>
  .text-red
 {
	 color:red;
	 margin-bottom:10px;
 }
 </style>
 <script>

$(document).ready(function () {
	 
	 $('#email').keypress(function(){
		     $("#eerror").css("display", "none");
    }); 
	 $('#password').keypress(function(){
		     $("#perror").css("display", "none");
    }); 
	
	
	$('#login').on('submit', function(e){
		
		
		if($("#email").val()=='')
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
		
	});
	
 }); 
 
 </script>
 
 
		<?php include('include/footer.php'); ?>