<?php include("css.php");  
 $act_id = $this->uri->segment(2); ?>
<body>
<header class="page-header home-five home-four home-three">
            <!-- BEGIN MAIN HEADER -->
            <div class="header" data-uk-sticky="{top:-200, animation: 'uk-animation-slide-top'}">
                <div class="uk-container uk-container-center">
                    <nav class="ev-navbar">
                        <div class="box uk-flex uk-flex-middle uk-flex-left uk-float-left">
                            <a href="<?php echo base_url(); ?>" class="logo"><img src="<?php echo base_url('assets/'); ?>images/logo.png" alt="Awesome Image"/></a>
                        </div>
                        <div class="uk-clearfix uk-float-right">
                            <ul class="uk-navbar-nav menu-primary uk-flex-center uk-width-small-1-1 uk-width-1-1">
                                <li class="uk-active uk-parent" id="boundary_one" data-uk-dropdown="{remaintime:'0', boundary:'#boundary_one'}">
                                    <a href="<?php echo base_url(); ?>">HOME</a>                                    
                                </li>
                                 <li class="<?php if($act_id=='event_list' || $act_id=='event_details') { ?>uk-active <?php } ?> uk-parent" id="boundary_two" data-uk-dropdown="{remaintime:'0', boundary:'#boundary_two'}">
                                    <a href="<?php echo base_url('event/event_list'); ?>">EVENT</a>
                                   
                                </li>
                               
                                <li id="boundary_four" class="<?php if($act_id=='contactus') { ?>uk-active <?php } ?>uk-parent" data-uk-dropdown="{remaintime:'0', boundary:'#boundary_four'}">
                                    <a href="<?php echo base_url('event/contactus') ?>">CONTACT</a>
                                    
                                </li>
								<?php if(!$this->session->userdata('user_id')) { ?>
                                <li><a href="<?php echo base_url('event/login'); ?>">LOGIN</a></li>
                                <li><a href="<?php echo base_url('event/register'); ?>">REGISTER</a></li>
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
            <!-- END BEGIN MAIN HEADER -->
            <div class="next-event-count-down sec-padding-big">
                <div class="uk-container uk-container-center uk-text-center">
                    <div class="count-down">
                        <ul id="count_down">
                            <li><span class="days">316</span></li>
                            <li><span class="hours">24</span></li>
                            <li><span class="minutes">36</span></li>
                            <li><span class="seconds">59</span></li>
                        </ul>
                    </div>
                    <div class="ev-box-title uk-text-center">
                        <h3>Get Ready for The Next Event. Its Beginning!</h3>
                        <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestiedolore eu <br> feugiat nulla facilisis at vero</p>
                        <div class="ev-button-center">
                            <a href="#" class="ev-button ev-button-default ev-button-text-white">Check it out</a>
                        </div>
                    </div>
                </div>
                <div class="border-bottom"></div>
            </div>
        </header>