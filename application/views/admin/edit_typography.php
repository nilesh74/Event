<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Edit Typography
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="<?php echo base_url(); ?>admin/manage_typography"> Manage Typography</a></li>
				<li class="active">Edit Typography</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<form method="post" action="<?php echo base_url(); ?>admin/manage_typography/edit_typography?id=<?php echo base64_encode($typography_info[0]['id']); ?>" class="form-horizontal form_block_all_page" enctype="multipart/form-data">
						
						<div class="compulsary" ><span class="text-red">Fields marked with (*) are compulsary</span></div>
						
						<div class="form-group">
							<label for="fname" class="col-sm-3 control-label">First Name<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name // accepts only letters" value="<?php echo $typography_info[0]['first_name']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('fname')!=""){ echo form_error('fname');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="fullname" class="col-sm-3 control-label">Full Name<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name // accepts only letters and space" value="<?php echo $typography_info[0]['name']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('fullname')!=""){ echo form_error('fullname');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Email<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $typography_info[0]['email']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('email')!=""){ echo form_error('email');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="contact" class="col-sm-3 control-label">Contact Number<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number // only number //min length 9 // max length 12" value="<?php echo $typography_info[0]['contact']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('contact')!=""){ echo form_error('contact');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="already_exist" class="col-sm-3 control-label">Already Exist<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="already_exist" name="already_exist" placeholder="Already exist // check whether entry is already exist or not" value="<?php echo $typography_info[0]['already_exist']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('already_exist')!=""){ echo form_error('already_exist');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="select_dropdown" class="col-sm-3 control-label">Select<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<select id="select_dropdown" name="select_dropdown" class="form-control">
									<option value="">Select </option>
									<option value="1" <?php if($typography_info[0]['only_dropdown']==1) { echo "selected"; } ?>>one</option>
									<option value="2" <?php if($typography_info[0]['only_dropdown']==2) { echo "selected"; } ?>>Two</option>
									<option value="3" <?php if($typography_info[0]['only_dropdown']==3) { echo "selected"; } ?>>Three</option>
									<option value="4" <?php if($typography_info[0]['only_dropdown']==4) { echo "selected"; } ?>>Four</option>
									<option value="5" <?php if($typography_info[0]['only_dropdown']==5) { echo "selected"; } ?>>Five</option>
								</select>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('select_dropdown')!=""){ echo form_error('select_dropdown');} ?></div>
							</div>
						</div>

						<div class="form-group">
							<label for="select_category" class="col-sm-3 control-label">Select category<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<select id="select_category" name="select_category" class="form-control" onchange="chng_subcat(this.value)">
									<option value="">Select category</option>
									
									<?php
										if($category_details!="")
										{	
											foreach($category_details as $result)
											{	?>
												<option value="<?php echo $result['cat_id']; ?>" <?php echo set_select('select_category',$result['cat_id']); ?>><?php echo $result['cat_name']; ?> </option>
									<?php	}
										}	?>									
								</select>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('select_category')!=""){ echo form_error('select_category');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="subcat_name" class="col-sm-3 control-label">Select Subcategory<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<select class="form-control" name="subcat_name" id="subcat_name">
									<option value="">Select subcategory</option>
									<?php 
									if(set_value('select_category'))
									{	
										$id = set_value('select_category');
										$get_subcat_res = $this->common_model->get_records('wwc_manage_subcategory','',array('cat_id'=>$id,'status'=>1),'');
										
										foreach($get_subcat_res as $result_subcat)
										{	?>
												<option value="<?php echo $result_subcat['subcat_id']; ?>" <?php echo set_select('subcat_name',$result_subcat['subcat_id']); ?> ><?php echo $result_subcat['subcat_name'] ?></option>
								<?php	}	?>
										
							<?php	}	?>
									
								</select>
								<div class="text-red" ><?php if(form_error('subcat_name')!=""){ echo form_error('subcat_name');} ?></div>
							</div>
						</div>
					
						<div class="form-group">
							<label for="editor1" class="col-sm-3 control-label">Textarea<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<textarea id="editor1" name="editor1" rows="10" cols="80"><?php echo $typography_info[0]['textarea']; ?></textarea>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('editor1')!=""){ echo form_error('editor1');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="only_datepicker" class="col-sm-3 control-label">Datepicker<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="only_datepicker" readonly class="form-control"  id="only_datepicker" name="only_datepicker" placeholder="Datepicker" value="<?php echo $typography_info[0]['datepicker']; ?>" />
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('only_datepicker')!=""){ echo form_error('only_datepicker');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="date_timepicker_start" class="col-sm-3 control-label">Start Date <span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="date_timepicker_start" name="date_timepicker_start" placeholder="Start Date" value="<?php echo $typography_info[0]['datepicker_start']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('date_timepicker_start')!=""){ echo form_error('date_timepicker_start');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="date_timepicker_end" class="col-sm-3 control-label">End Date <span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" readonly class="form-control" id="date_timepicker_end" name="date_timepicker_end" placeholder="End Date" value="<?php echo $typography_info[0]['datepicker_end']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('date_timepicker_end')!=""){ echo form_error('date_timepicker_end');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="time_timepicker" class="col-sm-3 control-label">Time <span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" readonly  class="form-control" id="time_timepicker" name="time_timepicker" placeholder="Time" value="<?php echo $typography_info[0]['timepicker']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('time_timepicker')!=""){ echo form_error('time_timepicker');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="status" class="col-sm-3 control-label">Status<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<div class="radio">
									<label>
										<input type="radio" value="1" id="active" name="status" <?php if($typography_info[0]['status']==1) {  echo "checked"; } ?>> Active
									</label>
								
									<label>
										<input type="radio" value="0" id="inactive" name="status" <?php if($typography_info[0]['status']==0) {  echo "checked"; } ?>> Inactive
									</label>
								</div>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('status')!=""){ echo form_error('status');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="accept_terms" class="col-sm-3 control-label">Accept term<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<div class="checkbox">
									<label>
									  <input type="checkbox" name="accept_terms" value="1" <?php if($typography_info[0]['accept_term']==1) {  echo "checked"; } ?> >
									</label>
								</div>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('accept_terms')!=""){ echo form_error('accept_terms');} ?></div>
							</div>
						</div>
								
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-10">
								<button type="submit" class="btn  btn-flat btn-success">Update Typography</button>
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