<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Manage Profile
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Manage Profile</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<div class="form-horizontal form_block_all_page">
						<?php 
							if($this->session->flashdata('success'))
							{	?>
								<div class="row">                     
									<div class="col-lg-12 col-xs-12">
										<div class="alert alert-success alert-dismissable">
											<i class="fa fa-check"></i>
											<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
											<?php echo $this->session->flashdata('success') ?>
										</div>
									</div>
								</div>
					<?php	}
							if($this->session->flashdata('error'))
							{	?>
								<div class="row">                     
									<div class="col-lg-12 col-xs-12">
										<div class="alert alert-danger alert-dismissable">
											<i class="fa fa-ban"></i>
											<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
											<?php echo $this->session->flashdata('error') ?>
										</div>
									</div>
								</div>
					<?php	}	?>
										
						<div class="user_profile">
							<div class="profile_pic_img">
							
								<?php 
									if($admin_details[0]['profile_pic']=='')
									{	?>
										<img src="<?php echo base_url(); ?>assets/admin/images/admin_profile/default.png">
							<?php	}
									else
									{	?>
										<img src="<?php echo base_url(); ?>assets/admin/images/admin_profile/<?php echo $admin_details[0]['profile_pic']; ?>">
							<?php	}	?>
							
							</div>
							
							<div class="profile_pic_details">
							
							<h2>
							<?php 
								if($admin_details[0]['fname']!='') { echo ucfirst(strtolower($admin_details[0]['fname'])); echo " ";}										
								if($admin_details[0]['mname']!='') { echo ucfirst(strtolower($admin_details[0]['mname'])); echo " ";}										
								if($admin_details[0]['lname']!='') { echo ucfirst(strtolower($admin_details[0]['lname'])); }
							?>
							</h2>
							
							<ul>
								<?php 
									if($admin_details[0]['username']!='')
									{	?>
										<li><i class="fa fa-briefcase" title="Username"></i> <?php echo $admin_details[0]['username']; ?></li>
							<?php	}	?>
							
							<?php 
									if($admin_details[0]['contact']!='')
									{	?>
										<li><i class="fa fa-phone" title="Mobile"></i> <?php echo $admin_details[0]['contact']; ?></li>
							<?php	}	?>
							
							<?php 
									if($admin_details[0]['email']!='')
									{	?>
										<li><i class="fa fa-envelope" title="Email"></i> <?php echo $admin_details[0]['email']; ?></li>
							<?php	}	?>
							</ul>
							
							<a href="<?php echo base_url(); ?>admin/manage_profile/edit_profile?id=<?php echo base64_encode($admin_details[0]['id']); ?>" class="btn btn-success" type="submit">Edit Profile</a>
							
							</div>
							
						<div class="clearfix"></div>
						</div>                        
                    </div>
				</div>
			</div>
		</section>
	</div>
	
	<footer class="main-footer">
		<strong>Copyright &copy; 2014-2015 <a href="#">WWC</a>.</strong> All rights reserved.
    </footer>
</div>

<?php include('includes/footer.php'); ?>