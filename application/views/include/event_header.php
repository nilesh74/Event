<?php include("css.php");  
 $act_id = $this->uri->segment(2); ?>

 <body>
        <!-- BEGIN HEADER -->
        <header class="page-header home-two">
            <!-- BEGIN TOP BAR -->
            <div class="top-bar" >
                <div class="uk-container uk-container-center">
                    <div class="uk-grid uk-grid-small">
                        <div class="logo-margin uk-width-medium-1-4 uk-width-small-1-1 uk-width-1-1">
                            <div class="box uk-flex uk-flex-middle uk-flex-left">
                                <a href="index-2.html" class="logo"><img src="<?php echo base_url('assets/'); ?>images/logo.png" alt="Awesome Image"/></a>
                            </div>
                        </div>
                        <div class="meta-header-home-two uk-width-medium-3-4 uk-width-small-1-1 uk-width-1-1">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-medium-3-10 uk-width-small-1-1 uk-width-1-1">
                                    <div class="box uk-flex uk-flex-middle uk-flex-left">
                                        <div class="box-icon">
                                            <span class="icon icon_clock_alt"></span>
                                        </div>
                                        <div class="box-content">
                                            <p>15 July, 2016 <br/>8:00 AM - 05:00 PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-medium-4-10 uk-width-small-1-1 uk-width-1-1">
                                    <div class="box uk-flex uk-flex-middle uk-flex-left">
                                        <div class="box-icon">
                                            <span class="icon icon_pin_alt"></span>
                                        </div>
                                        <div class="box-content">
                                            <p>North Avenue 34521<br/>James Street, Vancouver, Canada</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-width-medium-3-10 uk-width-small-1-1 uk-width-1-1">
                                    <div class="box uk-flex uk-flex-middle">
                                        <div class="box-icon">
                                            <span class="icon  icon_mail_alt"></span>
                                        </div>
                                        <div class="box-text">
                                            <p>M<br>N</p>
                                        </div>
                                        <div class="box-content">
                                            <p>+ (400) 0123 456 789 <br/>support@victhemes.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END BEGIN TOP BAR -->
            <!-- BEGIN MAIN HEADER -->
            <div class="header" data-uk-sticky="{top:-200, animation:'uk-animation-slide-top'}">
                <div class="uk-container uk-container-center">
                    <div class="uk-grid">
                        <nav class="ev-navbar uk-width-medium-1-1 uk-width-small-1-1 uk-width-1-1">
                            <ul class="uk-navbar-nav menu-home uk-width-medium-1-10 uk-width-small-1-10 uk-width-1-10">
                                <li><a href="index-2.html" class=""><span class="icon icon_house_alt"></span></a></li>
                            </ul>
                            <ul class="uk-navbar-nav menu-primary uk-flex uk-flex-center uk-width-medium-8-10 uk-width-small-1-1 uk-width-1-1">
                                <li id="boundary_one" class="uk-parent" data-uk-dropdown="{remaintime:'0', boundary:'#boundary_one'}">
                                    <a href="<?php echo base_url(); ?>">HOME</a>
                                    
                                </li>
                                <li class="<?php if($act_id=='event_list' || $act_id=='event_details') { ?>uk-active <?php } ?> uk-parent" id="boundary_two" data-uk-dropdown="{remaintime:'0', boundary:'#boundary_two'}">
                                    <a href="<?php echo base_url('event/event_list'); ?>">EVENT</a>
                                   
                                </li>
                                
                                <li id="boundary_four" class="<?php if($act_id=='contactus') { ?>uk-active <?php } ?>uk-parent" data-uk-dropdown="{remaintime:'0', boundary:'#boundary_four'}">
                                    <a href="<?php echo base_url('event/contactus') ?>">CONTACT</a>
                                    
                                </li>
                                <?php if(!$this->session->userdata('user_id')) { ?>
                                <li id="boundary_four" class="<?php if($act_id=='login') { ?>uk-active <?php } ?>uk-parent" data-uk-dropdown="{remaintime:'0', boundary:'#boundary_four'}"><a href="<?php echo base_url('event/login'); ?>">LOGIN</a></li>
                                <li id="boundary_four" class="<?php if($act_id=='register') { ?>uk-active <?php } ?>uk-parent" data-uk-dropdown="{remaintime:'0', boundary:'#boundary_four'}"><a href="<?php echo base_url('event/register'); ?>">REGISTER</a></li>
								<?php } else {
								?>
								<li><a href="#"><span><?php echo "WELCOME ".strtoupper($this->session->userdata('first_name'))." ".strtoupper($this->session->userdata('last_name'))  ?></span></a></li>
                                <li><a href="<?php echo base_url('event/logout'); ?>">LOGOUT</a></li>
								<?php } ?>
                            </ul>
                            <ul class="uk-float-right">
                                <li>
                                    <a href="#" id="menu_primary_toggle"><span class="icon icon_menu"></span></a>
                                </li>
                            </ul>
                            <div class="uk-button-dropdown uk-width-medium-1-10 uk-width-small-1-10 uk-width-1-10" data-uk-dropdown="{mode:'click', pos:'bottom-right'}">
                                <ul class="uk-navbar-nav menu-search">
                                    <li><a href="#" class=""><span class="icon icon_search"></span></a></li>
                                </ul>
                                <div class="uk-dropdown uk-dropdown-bottom">
                                    <form id="form_search" action="#" method="post">
                                        <input type="text" placeholder="Search">
                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
					<div class="menu-media">
                    <nav class="nav-holder">
                        <ul class="nav">
                             <li><a href="<?php echo base_url(); ?>">HOME</a></li>
							  <li> <a href="<?php echo base_url('event/event_list'); ?>">EVENT</a></li>
								<li><a href="#">ABOUT</a></li>
							    <li><a href="#">CONTACT US</a></li>
							
							<?php if(!$this->session->userdata('user_id')) { ?>
                                <li><a href="<?php echo base_url('event/login'); ?>">LOGIN</a></li>
                                <li><a href="<?php echo base_url('event/register'); ?>">REGISTER</a></li>
								<?php } else {
								?>
								<li><a href="#"><span><?php echo "WELCOME ".strtoupper($this->session->userdata('first_name'))." ".strtoupper($this->session->userdata('last_name'))  ?></span></a></li>
                                <li><a href="<?php echo base_url('event/logout'); ?>">LOGOUT</a></li>
								<?php } ?>
						</ul>
                    </nav>
                </div>
                </div>                
            </div>
            <div class="uk-clearfix"></div>
            <!-- END BEGIN MAIN HEADER -->
        </header>