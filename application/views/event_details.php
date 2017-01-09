<?php include('include/event_header.php'); ?>
<script>
$(function() 
	{
$("#set_focus").focus();
}
</script>
 <section class="event-detail-banner ev-banner ev-overlay-background sec-padding-banner uk-text-center">
            <div class="uk-container uk-container-center">
                <div class="ev-box-title">
                    <h3>Event details</h3>
                    <p>Event list width sidebar</p>
                    <div class="ev-border-line-primary"></div>
                </div>
            </div>
        </section>
        <!-- END BEGIN BANNER -->
        <!-- BEGIN CONTACT US -->
        <section class="event-detail-page sec-padding">
            <div class="uk-container uk-container-center"  id="set_focus">
                <div class="ev-title-page">
                    <h3>
                        <a href="#"><span>Home page</span></a>
                        <a href="#"><span>Event category</span></a>
                        <a href="#"><span>Event list width sidebar</span></a>
                    </h3>
                </div>
                <div class="uk-grid sec-padding-left">
                    <div class="event-grid-2-column-page uk-width-medium-2-3 uk-width-small-1-1 uk-width-1-1">
                        <div class="box-body box">
                            <div class="event-price">
                                <span><?php echo $event_details[0]['event_cost']." $"; ?></span>
                            </div>
							
							
							
                            <h3><?php echo strtoupper($event_details[0]['event_title']); ?></h3>
                            <span><?php echo ($event_details[0]['event_location']); ?></span>
                            <p><?php
									$event_description=$this->common_model->niceTrim($event_details[0]['event_description']);
							echo ($event_description[0]); ?></p>
                            <div class="box-img">
							 <?php if(!empty($event_details[0]['event_image_path'])) { ?>
   <img src="<?php echo base_url('assets/admin/images/event/'.$event_details[0]['id'].'/'.$event_details[0]['event_image_path']); ?>" alt="#">			<?php } 
									else {
									?>
									 <img src="<?php echo base_url('assets/'); ?>images/event/event-detail-img.jpg" alt="#">
									<?php } ?>                               
                            </div>
                            <p><?php
										for($i=1;$i<count($event_description);$i++)
										{
											echo $event_description[$i];
										}
							?></p> 
							
							<button type="submit" style="line-height: 0px !important;" class="ev-button ev-button-primary ev-button-text-white" onclick="join_event('<?php echo $event_details[0]['id']; ?>')">Join event</button>
							
							<?php if($this->session->flashdata('success'))
									{	?>
										<h4><div id="set_msg" style="color:green;font-size:18px"><b><?php echo $this->session->flashdata('success') ?></b></div></h4>
								<?php } else if($this->session->flashdata('error'))
								{ ?>
									<h4><div id="set_msg" style="color:red;font-size:18px"><b> <?php echo $this->session->flashdata('error') ?></b></div></h4>
									<?php }								
								?>
							
                        </div>                 
                    </div>
                    <div class="event-list-width-sidebar-page uk-width-medium-1-3 uk-width-small-1-1 uk-width-1-1 uk-text-center">
                        <div class="sidebar-event">
                            <div class="event-detail category-event">
                                <div class="box-circle">
                                    <span class="icon icon_pencil-edit"></span>
                                </div>
                                <div class="ev-box-title">
                                    <h3>Event details</h3>
                                    <div class="ev-border-line-primary"></div>
                                </div>
                                <table class="uk-table">
                                    <tr>
                                        <th>START:</th>
                                        <td>
                                            <p>
                                                <span><?php echo $event_details[0]['event_startdate']?></span>              
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>END:</th>
                                        <td>
                                            <p>
                                                <span><?php echo $event_details[0]['event_enddate']?></span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>COST:</th>
                                        <td>
                                            <p><?php echo $event_details[0]['event_cost']?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>CATEGORIES:</th>
                                        <td>
                                            <p><?php echo $event_details[0]['cat_name']?></p>
                                        </td>
                                    </tr>
									<tr>
                                        <th>AVAILABEL SEATS:</th>
                                        <td>
                                            <p><?php echo ($event_details[0]['event_seats']-$event_details[0]['reserved_seat']) ?></p>
                                        </td>
                                    </tr>  
                                </table>
                            </div>
                            <div class="event-organizer event-detail category-event">
                                <div class="box-circle">
                                    <span class="icon icon_mail_alt"></span>
                                </div>
                                <div class="ev-box-title">
                                    <h3>Event Organizer</h3>
                                    <div class="ev-border-line-primary"></div>
                                </div>
                                <table class="uk-table">
                                    <tr>
                                        <th>ORGANIZER:</th>
                                        <td>
                                            <p><?php echo $event_details[0]['event_organizer']?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>PHONE:</th>
                                        <td>
                                            <p><?php echo $event_details[0]['event_contact']?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>EMAIL:</th>
                                        <td>
                                            <p><?php echo $event_details[0]['event_email']?></p>
                                        </td>
                                    </tr>                                   
                                </table>
                            </div>
                            <div class="event-venue category-event">
                                <div class="box-circle">
                                    <span class="icon icon_ribbon_alt"></span>
                                </div>
                                <div class="ev-box-title">
                                    <h3>Event Venue</h3>
                                    <div class="ev-border-line-primary"></div>
                                </div>
                                <div class="map">
                                    <h3>VENUE:<span><?php echo $event_details[0]['event_location']?></span></h3>
                                    <div class="google-map-wrapper">
                                        <div class="google-map" id="contact-page-google-map"></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
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


<script>
	
	function join_event(event_id)
	{
		
		var formdata={ 'event_id':event_id };
		$.ajax(
				{
					type: "POST",
					url: '<?php echo base_url(); ?>event/join_event',
					data: formdata,
					success:function(data)
					{
						
						if(data==1)
						{
							window.location = "<?php echo base_url(); ?>event/login";
						}
						else if(data==2)
						{
							//window.location ="#set_msg";
							location.reload();
						}
					}
				});
	}
	
	$(function(){
		
        setTimeout(function(){
		
        $('#set_msg').fadeOut('slow');
    },10000);

});

</script>  
<?php include('include/footer.php'); ?>
