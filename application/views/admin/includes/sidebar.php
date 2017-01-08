	<body class="sidebar-mini skin-blue-light fixed">
    <div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo base_url(); ?>admin/dashboard" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<?php if(!$this->session->userdata('ctype')) { ?>
				<span class="logo-mini"><b>EVENT ADMIN</b></span>
				<span class="logo-lg"><b>EVENT ADMIN</b></span>
				<?php } 
				else {
				?>
				<span class="logo-mini"><b>CONTENT AUTHOR ADMIN</b></span>
				<span class="logo-lg"><b>CONTENT AUTHOR ADMIN</b></span>
				<?php } ?>
				
				<!-- logo for regular state and mobile devices -->
				
			</a>
			
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
			
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php 
									if($admin_details[0]['profile_pic']=='')
									{	?>
										<img src="<?php echo base_url(); ?>assets/admin/images/admin_profile/default.png" class="user-image">
							<?php	}
									else
									{	?>
										<img src="<?php echo base_url(); ?>assets/admin/images/admin_profile/<?php echo $admin_details[0]['profile_pic']; ?>" class="user-image">
							<?php	}	?>
								<span class="hidden-xs"><?php echo $admin_details[0]['fname'] ." ".  $admin_details[0]['lname'] ; ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<?php 
									if($admin_details[0]['profile_pic']=='')
									{	?>
										<img src="<?php echo base_url(); ?>assets/admin/images/admin_profile/default.png" class="img-circle">
							<?php	}
									else
									{	?>
										<img src="<?php echo base_url(); ?>assets/admin/images/admin_profile/<?php echo $admin_details[0]['profile_pic']; ?>" class="img-circle">
							<?php	}	?>
							
									<p>
										<?php echo $admin_details[0]['fname'] ." ".  $admin_details[0]['lname'] ; ?> - Web Developer
										<small></small>
									</p>
								</li>
								
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url()?>admin/manage_profile" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url()?>admin/login/logout" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
			
				<?php $act_id = $this->uri->segment(2) ?>
				
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li <?php if($act_id == "dashboard") { ?> class="active"  <?php } ?>>
						<a href="<?php echo base_url(); ?>admin/dashboard">
							<i class="fa fa-dashboard"></i> <span>Dashboard</span>
						</a>
					</li>
					<?php if(!$this->session->userdata('ctype')) { ?>
					<li <?php if($act_id == "manage_category") { ?> class="active"  <?php } ?>>
						<a href="<?php echo base_url(); ?>admin/manage_category">
							<i class="fa fa-dashboard"></i> <span>Manage Event Type</span>
						</a>
					</li>
					<li <?php if($act_id == "manage_user") { ?> class="active"  <?php } ?>>
						<a href="<?php echo base_url(); ?>admin/manage_user">
							<i class="fa fa-dashboard"></i> <span>Manage User</span>
						</a>
					</li>
					<li <?php if($act_id == "manage_contact") { ?> class="active"  <?php } ?>>
						<a href="<?php echo base_url(); ?>admin/manage_contact">
							<i class="fa fa-dashboard"></i> <span>Manage Contact Us</span>
						</a>
					</li>
					<?php } ?>
					<li <?php if($act_id == "manage_event") { ?> class="active"  <?php } ?>>
						<a href="<?php echo base_url(); ?>admin/manage_event">
							<i class="fa fa-dashboard"></i> <span>Manage Event</span>
						</a>
					</li>
					
					
					<!--
					
					
					<li <?php if($act_id == "manage_subcategory") { ?> class="active"  <?php } ?>>
						<a href="<?php echo base_url(); ?>admin/manage_subcategory">
							<i class="fa fa-dashboard"></i> <span>Manage Subcategory</span>
						</a>
					</li>
					<li <?php if($act_id == "manage_gallery") { ?> class="active"  <?php } ?>>
						<a href="<?php echo base_url(); ?>admin/manage_gallery">
							<i class="fa fa-dashboard"></i> <span>Manage Gallery</span>
						</a>
					</li>-->
					
					
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>