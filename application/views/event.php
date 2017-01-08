<?php include('include/event_header.php'); ?>
 <section class="event-grid-3-column-banner ev-banner ev-overlay-background sec-padding-banner uk-text-center">
            <div class="uk-container uk-container-center">
                <div class="ev-box-title">
                    <h3>Event List</h3>
                    <p></p>
                    <div class="ev-border-line-primary"></div>
                </div>
            </div>
        </section>
        <!-- END BEGIN BANNER -->
        <!-- BEGIN CONTACT US -->
        <section class="event-grid-3-column-page home-four sec-padding uk-text-center">
            <div class="uk-container uk-container-center">
                <div class="ev-title-page">
                    <h3>
                        <a href="<?php echo base_url(); ?>"><span>Home page</span></a>
                        <a href="#"><span>Event List</span></a>                       
                    </h3>
                </div>
								<?php 
									if($this->session->flashdata('result'))
									{	?>
										<div style="color:red"> <?php echo $this->session->flashdata('result') ?></div>
								<?php }?>
                <div class="find-event">
                    <div class="uk-container uk-container-center">
                        <div class="uk-grid uk-grid-collapse">
                            <div class="uk-width-medium-2-10 uk-width-small-1-1 uk-width-1-1">
                                <div class="ev-box-title">
                                    <h3>Search for event</h3>
                                </div>
                            </div>
                            <div class="uk-width-medium-8-10 uk-width-small-1-1 uk-width-1-1">
								
                                <form id="find_event" class="uk-form" method="post" 
								action="<?php echo base_url("event/search_event_list") ?>" >
                                    <div class="uk-form-icon">
                                        <i class="icon icon_search"></i>
                                        <input id="search_keyword" name="search_keyword" class="search-keyword" type="text" placeholder="Search keyword">
                                    </div>
                                    <div class="uk-form-icon">
                                        <i class="icon icon_calendar"></i>
                                        <input type="text" id="start_date" name="start_date" placeholder="Start date" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>
									<div class="uk-form-icon">
                                        <i class="icon icon_calendar"></i>
                                        <input type="text" id="end_date" name="end_date" placeholder="End date" data-uk-datepicker="{format:'DD-MM-YYYY'}">
                                    </div>
                                    <div class="uk-form-icon">
                                        <i class="icon icon_menu"></i>
                                        <label>
                                            <select id="category_list" name="category_list">
												<option value="">Select value</option>
											<?php foreach($cat_list as $cat_record ){ ?>
                                <option value="<?php echo $cat_record['cat_id'] ?>"><?php echo $cat_record['cat_name'] ?></option>
													<?php } ?>
											</select>
                                        </label>
                                    </div>
                                    <button type="submit" style="margin-left: 20px !important;" class="ev-button ev-button-primary ev-button-text-white">Find event</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-grid">  
					
                       <?php foreach($event_list as $event_info) { ?>
					   <div class="uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1">
					   <div class="box">
                            <div class="box-img ev-overlay-background">
                                <?php if(!empty($event_info['event_image_path'])) { ?>
   <img src="<?php echo base_url('assets/admin/images/event/'.$event_info['id'].'/'.$event_info['event_image_path']); ?>" alt="#">
									<?php } 
									else {
									?>
									 <img src="<?php echo base_url('assets/'); ?>images/upcomingson/upcoming-event-home-five-1-2.jpg" alt="#">
									<?php } ?>
                                <a href="#">
                                    <span class="icon icon_calendar"></span>
                                   <?php echo 'Start : '.$event_info['event_startdate']; ?>
								    
                                   <?php echo 'End :' .$event_info['event_enddate']; ?>
                                </a> 
								
                            </div>
                            <div class="box-content">
                                <a href="#"><h3><?php echo $event_info['event_title'] ?></h3></a>
                                <span><?php echo $event_info['event_location'] ?></span><br>
								<span>Event Type - <?php echo $event_info['cat_name'] ?></span>
                                <p><?php
								$event_description=$this->common_model->niceTrim($event_info['event_description']);

								echo strip_tags($event_description[0]) ?></p>
                                <a href="<?php echo base_url('event/event_details?id='.base64_encode($event_info['id'])) ?>" class="ev-button ev-button-default">Read more</a>
                            </div>
						</div>
					</div>
					   <?php } ?> 					
                </div>
				
            </div>
        </section>
        <!-- END BEGIN CONTACT US -->
        <!-- BEGIN CAROUSEL -->
  <style>
.event-grid-3-column-page .box .box-img a:hover {
	
	width: 80% !important;
    background: rgba(98, 189, 92, 0.5);
    transition: all .5s ease;
	
}

.home-four .find-event .uk-form {
    float: right;
    height: 125px;
    line-height: 84px;
    margin-left: -1%;
}
.home-four .find-event {
	height: 170px;
    position: relative;
}
</style> 

<?php include('include/footer.php'); ?>