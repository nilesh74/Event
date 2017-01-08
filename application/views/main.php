<?php include('include/header.php'); ?>
<section class="about-event-home-five about-event-home-four sec-padding">
            <div class="uk-container uk-container-center uk-text-center">
                <div class="ev-box-title wow fadeIn" data-wow-darution="2s">
                    <h3><span>What</span> about event</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt <br> ut laoreet dolore magna aliquam erat volutpat</p>
                </div>
                <div class="uk-grid uk-grid-collapse">
                    <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 uk-position wow fadeInLeft" data-wow-darution="2s" data-wow-delay="1s">
                        <div class="bg-img">
                            <img src="<?php echo base_url('assets/'); ?>images/about/about-event-home-five-1.jpg" alt="">
                            <a href="#"><span class="icon icon_lightbulb_alt"></span></a>
                            <div class="overlay uk-overlay-panel uk-flex uk-flex-center uk-flex-middle"></div>
                        </div>
                        <div class="ev-box-title">
                            <a href="#"><h3>What we do ?</h3></a>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat</p>
                            <div class="ev-button-center"><a href="#" class="ev-button ev-button-default">Read more</a></div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 uk-position box-mid  wow fadeInLeft" data-wow-darution="2s" data-wow-delay=".5s">
                        <div class="bg-img-top">
                            <img src="<?php echo base_url('assets/'); ?>images/about/about-event-home-five-2.jpg" alt="">
                            <a href="#"><span class="icon icon_compass_alt"></span></a>
                            <div class="overlay uk-overlay-panel uk-flex uk-flex-center uk-flex-middle"></div>
                        </div>
                        <div class="ev-box-title">
                            <a href="#"><h3>What choose us ?</h3></a>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat</p>
                            <div class="ev-button-center"><a href="#" class="ev-button ev-button-default">Read more</a></div>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 uk-position wow fadeInLeft" data-wow-darution="2s">
                        <div class="bg-img">
                            <img src="<?php echo base_url('assets/'); ?>images/about/about-event-home-five-3.jpg" alt="">
                            <a href="#"><span class="icon icon_error-circle_alt"></span></a>
                            <div class="overlay uk-overlay-panel uk-flex uk-flex-center uk-flex-middle"></div>
                        </div>
                        <div class="ev-box-title">
                            <a href="#"><h3>Who we are ?</h3></a>
                            <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat</p>
                            <div class="ev-button-center"><a href="#" class="ev-button ev-button-default">Read more</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END BEGIN ABOUT EVENT -->       
        
        <!-- BEGIN UPCOMING EVENT -->
        <section class="upcoming-event-home-four sec-padding">
            <div class="uk-container uk-container-center uk-text-center">
                <div class="uk-grid">
           <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 wow fadeInLeft" data-wow-darution="2s" data-wow-delay="1s">
                        <div class="box-circle">
                            <div class="box-content">
                                <div class="uk-slidenav-position" data-uk-slideshow="{autoplay: true}">
                                    <ul class="uk-slideshow">
                                        <li>
                                            <div class="box-icon">
                                                <span class="icon icon_ribbon_alt"></span>
                                            </div>
                                            <div class="ev-box-title">
                                                <h3><span>Upcoming</span> event</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</p>
                                            </div>
                                        </li>                                       
                                    </ul>
                                    <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
                                        <li data-uk-slideshow-item="0"><a href="#"></a></li>                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
					foreach($event_record as $event_info)
					{
					?>
                    <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 wow fadeInLeft" data-wow-darution="2s" data-wow-delay=".5s">
                        <div class="box-circle">
                            <div class="box-circle-small">
                                <div class="uk-overlay">
									<?php if(!empty($event_info['event_image_path'])) { ?>
                                    <img src="<?php echo base_url('assets/admin/images/event/'.$event_info['id'].'/'.$event_info['event_image_path']); ?>" alt="#">
									<?php } 
									else {
									?>
									 <img src="<?php echo base_url('assets/'); ?>images/upcomingson/upcoming-event-home-five-1-2.jpg" alt="#">
									<?php } ?>
                                    <div class="box-icon uk-overlay-background uk-overlay-panel uk-flex uk-flex-center uk-flex-middle">
                                        <span class="icon icon_ribbon_alt"></span>
                                    </div>
                                    <div class="overlay-hover">
                                        <a href="#"><h3><?php echo $event_info['event_title']; ?></h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php } ?>                  
                    <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 wow fadeInRight" data-wow-darution="2s" data-wow-delay="1s">
                        <div class="box-circle">
                            <div class="box-circle-two">
                                <div class="box-circle-three">
                                    <div class="box-circle-four"></div>
                                </div>
                            </div>
                            <div class="box-circle-five">
                                <a href="<?php echo base_url('event/event_list') ?>">All event</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END BEGIN UPCOMING EVENT -->
       
        <!-- BEGIN JOING OUR EVENT -->
        <section class="joing-our-event-home-five joing-our-event-home-three sec-padding">
            <div class="uk-container uk-container-center uk-text-center">
                <div class="ev-box-title">
                    <img src="<?php echo base_url('assets/'); ?>images/interlinked-joing-our-event.png" alt="">
                    <h3>Are you ready joing our event?</h3>
                    <p>Lorem ipsum dolor sit amet</p>
                    <div class="ev-button-center">
                        <a href="<?php echo base_url('event/event_list'); ?>" class="ev-button ev-button-default ev-button-text-white">Find out more</a>
                    </div> 
                </div>
            </div>
        </section>
<?php include('include/footer.php'); ?>