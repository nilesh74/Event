<?php require_once('includes/header.php'); ?>
	
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b>Content Author Admin</b></a>
			</div><!-- /.login-logo -->
			
			<div class="login-box-body">
				<p class="login-box-msg">Sign in to start your session</p>
				<form action="<?php echo base_url(); ?>admin/clogin" method="post" enctype="multipart/form-data">
					
					<?php
						if($this->session->flashdata('error'))
						{	?>
							<div class="alert alert-danger alert-dismissible fade in" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								<?php echo $this->session->flashdata('error') ?>
							</div>
				<?php	}	?>
					
					<div class="form-group has-feedback">
						<input type="text" name="username" id="username" class="form-control" placeholder="Username">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						<div class="clearfix"></div>
                        <div class="text-red"><?php if(form_error('username')!=""){ echo form_error('username');} ?></div>
					</div>
					
					<div class="form-group has-feedback">
						<input type="password" name="password" id="password" class="form-control" placeholder="Password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						<div class="clearfix"></div>
                        <div class="text-red"><?php if(form_error('password')!=""){ echo form_error('password');} ?></div>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<div class="checkbox icheck">
								<label><input type="checkbox" name="remember" id="remember" value="1"> Remember Me</label>
							</div>
						</div><!-- /.col -->
						<div class="col-xs-4">
							<button type="submit" name="login" id="login" class="btn btn-primary btn-block btn-flat">Login</button>
						</div><!-- /.col -->
					</div>
				</form>				
				
				<a data-toggle="modal" data-target="#forget_pass_modal">I forgot my password</a>
			</div><!-- /.login-box-body -->
		</div><!-- /.login-box -->
		
		
		<div class="modal fade" id="forget_pass_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
					</div>	
					
					<form action="<?php echo base_url(); ?>admin/login/forgot_admin_password" method="post">
						<div class="modal-body">                    	         
							<div class="body">
								<?php
									if($this->session->flashdata('success_forget'))
									{	?>
										<div class="alert alert-success alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
											<?php echo $this->session->flashdata('success_forget') ?>
										</div>
							<?php	}
									else if($this->session->flashdata('error_forget'))
									{	?>
										<div class="alert alert-danger alert-dismissible fade in" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
											<?php echo $this->session->flashdata('error_forget') ?>
										</div>
							<?php	}	?>
								
								<div class="form-group">
									<input type="text" name="username_email" id="username_email" class="form-control" placeholder="Enter your registered email"/>
									<div class="clearfix"></div>
									<div class="text-red"><?php if(form_error('username_email')!=""){ echo form_error('username_email');} ?></div>
								</div>
							</div>                            
						</div>
						<div class="modal-footer" style="border-radius:0;">
							<button type="submit" name="forget_pass" id="forget_pass" class="btn bg-olive">Forgot Password</button>      					
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</form>					
				</div>
			</div>
		</div>
		
<?php require_once('includes/footer.php'); ?>

<?php
	if(form_error('username_email')!='' || $this->session->flashdata('error_forget') !='' || $this->session->flashdata('success_forget') !='')
	{	?>
		<script type="text/javascript">
			$(window).load(function(){
				$('#forget_pass_modal').modal('show');
			});
		</script>
<?php	}	?>