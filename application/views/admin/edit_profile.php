<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Edit Profile
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="<?php echo base_url(); ?>admin/manage_profile"> Manage Profile</a></li>
				<li class="active">Edit Profile</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<form method="post" action="<?php echo base_url(); ?>admin/manage_profile/edit_profile?id=<?php echo base64_encode($admin_details[0]['id']); ?>" class="form-horizontal form_block_all_page" enctype="multipart/form-data">
						<div class="compulsary" ><span class="text-red">Fields marked with (*) are compulsary</span></div>
						<div class="form-group">
							<label for="fname" class="col-sm-3 control-label">First Name<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo $admin_details[0]['fname']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('fname')!=""){ echo form_error('fname');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="mname" class="col-sm-3 control-label">Middle Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name" value="<?php echo $admin_details[0]['mname']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('mname')!=""){ echo form_error('mname');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="lname" class="col-sm-3 control-label">Last Name<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" value="<?php echo $admin_details[0]['lname']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('lname')!=""){ echo form_error('lname');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="banner_title" class="col-sm-3 control-label">Old profile Image</label>
							<div class="col-sm-9">
								<input type="hidden" name="old_image_name" id="old_image_name" value=<?php echo $admin_details[0]['profile_pic'] ?>>
								<?php 
									if($admin_details[0]['profile_pic']=='')
									{	?>
										
										<img style="width:150px;" src="<?php echo base_url(); ?>assets/admin/images/admin_profile/default.png">
							<?php	}	
									else
									{	?>
										<img style="width:150px;" src="<?php echo base_url(); ?>assets/admin/images/admin_profile/<?php echo $admin_details[0]['profile_pic']; ?>">
							<?php	}	?>									
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">New Profile Image</label>
							<div class="col-md-9">
								<div class="fileinput fileinput-new" data-provides="fileinput" style="width:100%;">
									<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 150px;"></div>
									<div>
										<span class="btn btn-file btn-info btn-flat">
											<span class="fileinput-new ">Select image</span>
											<span class="fileinput-exists">Change</span>
											<input type="file" name="file_img" id="file_img" data-bv-file="true" data-bv-file-extension="jpeg,png,jpg" data-bv-file-type="image/jpeg,image/png/,image/jpg" data-bv-file-maxsize="200097152" data-bv-file-message="The selected file is not valid">
										</span>
										<a href="#" class="btn btn-danger btn-flat fileinput-exists" data-dismiss="fileinput">Remove</a>
									</div>											
								</div>
								<p style="color:#333;"><strong>Note</strong> : Upload only png / jpg / jpeg / gif extension images having width=250 and height=250.</p>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('file_img')!=""){ echo form_error('file_img');} ?></div>
								<?php 
									if($error!='')
									{	?>
										<div class="text-red" ><?php echo $error['error']; ?></div>
							<?php	}	?>
								<div class="clearfix"></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="username" class="col-sm-3 control-label">Username<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $admin_details[0]['username']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('username')!=""){ echo form_error('username');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="Password" class="col-sm-3 control-label">Password<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input style="cursor: auto;" type="password" readonly class="form-control" id="Password" name="Password" placeholder="Password" value="<?php echo $admin_details[0]['password']; ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label for="newpassword" class="col-sm-3 control-label">New Password</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" value="">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('newpassword')!=""){ echo form_error('newpassword');} ?></div>
							</div>
						</div>								
						
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $admin_details[0]['email']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('email')!=""){ echo form_error('email');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="contact" class="col-sm-3 control-label">Contact Number<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" value="<?php echo $admin_details[0]['contact']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('contact')!=""){ echo form_error('contact');} ?></div>
							</div>
						</div>                      
						
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-10">
								<button type="submit" class="btn btn-success btn-flat">Update Profile</button>
							</div>
						</div>
					</form> 
				</div>
			</div>
		</section>
	</div>
	
	<footer class="main-footer">
		<strong>Copyright &copy; 2014-2015 <a href="#">WWC</a>.</strong> All rights reserved.
    </footer>
</div>

<?php include('includes/footer.php'); ?>