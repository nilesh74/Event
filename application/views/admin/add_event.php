<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Add Event
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="<?php echo base_url(); ?>admin/manage_typography"> Manage Event</a></li>
				<li class="active">Add Event</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<form method="post" action="<?php echo base_url(); ?>admin/manage_event/add_event" class="form-horizontal form_block_all_page" enctype="multipart/form-data">
						
						<div class="compulsary" ><span class="text-red">Fields marked with (*) are compulsary</span></div>
						
						<div class="form-group">
							<label for="etitle" class="col-sm-3 control-label">Event Title<span class="text-red">*</span></label>
							<div class="col-sm-9">
							<input type="text" class="form-control" id="etitle" name="etitle" placeholder="Event Title // accepts only letters" value="<?php echo set_value('etitle'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('etitle')!=""){ echo form_error('etitle');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="elocation" class="col-sm-3 control-label">Event Venue<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<!--<input type="text" class="form-control" id="elocation" name="elocation" placeholder="Event Venue // accepts only letters and space" value="<?php echo set_value('elocation'); ?>">-->
								
						<textarea id="elocation" name="elocation" rows="10" cols="75"><?php echo set_value('elocation'); ?></textarea>
								
								
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('elocation')!=""){ echo form_error('elocation');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="eemail" class="col-sm-3 control-label">Event Contact Email<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="eemail" name="eemail" placeholder="Email" value="<?php echo set_value('eemail'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('eemail')!=""){ echo form_error('eemail');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="econtact" class="col-sm-3 control-label">Event Contact Number<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="econtact" name="econtact" placeholder="Contact Number // only number //min length 9 // max length 12" value="<?php echo set_value('econtact'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('econtact')!=""){ echo form_error('econtact');} ?></div>
							</div>
						</div>
						<div class="form-group">
							<label for="ecost" class="col-sm-3 control-label">Event Cost(Only in Dollar)<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="ecost" name="ecost" placeholder="0" 
									value="<?php echo set_value('ecost'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('ecost')!=""){ echo form_error('ecost');} ?></div>
							</div>
						</div>
						<div class="form-group">
							<label for="eseats" class="col-sm-3 control-label">Event Seats<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="eseats" name="eseats" placeholder="0" 
								value="<?php echo set_value('eseats'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('eseats')!=""){ echo form_error('eseats');} ?></div>
							</div>
						</div>
						<div class="form-group">
							<label for="eorganizer" class="col-sm-3 control-label">Event Organizer<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="eorganizer" name="eorganizer" 
								placeholder="Event Organizer (John Doe)" value="<?php echo set_value('eorganizer'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('eorganizer')!=""){ echo form_error('eorganizer');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="select_category" class="col-sm-3 control-label">Event Type<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<select id="select_category" name="select_type" class="form-control" >
									<option value="">Select Event Type</option>									
									<?php
										if($event_details!="")
										{	
											foreach($event_details as $result)
											{	?>
												<option value="<?php echo $result['cat_id']; ?>" <?php echo set_select('select_category',$result['cat_id']); ?>><?php echo $result['cat_name']; ?> </option>
									<?php	}
										}	?>									
								</select>								
								<div class="text-red" ><?php if(form_error('select_category')!="")
								{ echo form_error('select_category');} ?>
								</div>
							</div>
						</div>				
						<div class="form-group">
							<label for="edescription" class="col-sm-3 control-label">Event Description<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<textarea id="editor1" name="edescription" rows="10" cols="80"><?php echo set_value('edescription'); ?></textarea>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('edescription')!=""){ echo form_error('edescription');} ?></div>
							</div>
						</div>
						<div class="form-group">
							<label for="estart_date" class="col-sm-3 control-label">Event Start Date <span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="date_timepicker_start" name="estart_date" placeholder="Start Date" value="<?php echo set_value('estart_date'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('estart_date')!=""){ echo form_error('estart_date');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="eend_date" class="col-sm-3 control-label">Event End Date <span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="date_timepicker_end" name="eend_date" placeholder="End Date" value="<?php echo set_value('eend_date'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('eend_date')!=""){ echo form_error('eend_date');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="etime" class="col-sm-3 control-label">Event Time <span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" readonly  class="form-control" id="time_timepicker" name="etime" placeholder="Time" value="<?php echo set_value('etime'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('etime')!=""){ echo form_error('etime');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="file_upload" class="col-sm-3 control-label">Select Event Image<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input id="" name="file_upload" type="file" >
								
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('file_upload')!=""){ echo form_error('file_upload');} ?></div>
								<div class="text-red" ><?php if($error['error']!=""){ echo $error['error'];} ?></div>
							</div>
						</div>					
						<div class="form-group">
							<label for="status" class="col-sm-3 control-label">Status<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<div class="radio">
									<label>
										<input type="radio" value="1" id="active" name="status" <?php echo set_radio('status', '1', TRUE); ?>> Active
									</label>
								
									<label>
										<input type="radio" value="0" id="inactive" name="status" <?php echo set_radio('status', '0', TRUE); ?>> Inactive
									</label>
								</div>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('status')!=""){ echo form_error('status');} ?></div>
							</div>
						</div>							
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-10">
								<button type="submit" class="btn  btn-flat btn-success">Add Event</button>
							</div>
						</div>
					</form> 
				</div>
			</div>
		</section>
	</div>
	
	<footer class="main-footer">
		
    </footer>
</div>

<script>

function chng_subcat(id)
{
	var cat_id = id;
	var data = {
				'id': cat_id
				};
	$baselink = "<?php echo base_url(); ?>";
	$.ajax({
            type: "POST",
            url: $baselink + 'admin/ajax/get_subcat',
            data: data,
            success: function(result) 
			{
                $('#subcat_name').html(result);
            }
        });
}
</script>
		
<?php include('includes/footer.php'); ?>

<script>
	$(function () 
	{
		CKEDITOR.replace('editor1');
		$(".textarea").wysihtml5();
	});
</script>