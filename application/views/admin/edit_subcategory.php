<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Edit Subcategory
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="<?php echo base_url(); ?>admin/manage_category"> Manage Subcategory</a></li>
				<li class="active">Edit Subcategory</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<form method="post" action="<?php echo base_url(); ?>admin/manage_subcategory/edit_subcategory?id=<?php echo base64_encode($subcategory_info[0]['subcat_id']); ?>" class="form-horizontal form_block_all_page" enctype="multipart/form-data">
						
						<div class="compulsary" ><span class="text-red">Fields marked with (*) are compulsary</span></div>
						
						<div class="form-group">
							<label for="select_category" class="col-sm-3 control-label">Select category<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<select id="select_category" name="select_category" class="form-control">
									<?php
										if($category_record!="")
										{	?>
											<option value="">Select Category</option>
											<?php
												foreach($category_record as $result)
												{	?>
													<option value="<?php echo $result['cat_id']; ?>" <?php if($subcategory_info[0]['cat_id'] == $result['cat_id']) { echo "selected"; } ?> ><?php echo $result['cat_name'] ?></option>
										<?php	}
										}
										else
										{	?>
											<option value="">No category available</option>
								<?php	}	?>									
								</select>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('select_category')!=""){ echo form_error('select_category');} ?></div>
							</div>
						</div>		
						
						<div class="form-group">
							<label for="subcategory" class="col-sm-3 control-label">Subcategory<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="subcategory" name="subcategory" placeholder="subcategory" value="<?php echo $subcategory_info[0]['subcat_name']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('subcategory')!=""){ echo form_error('subcategory');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="status" class="col-sm-3 control-label">Status<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<div class="radio">
									<label>
										<input type="radio" value="1" id="active" name="status" <?php if($subcategory_info[0]['status'] == 1) { echo "checked"; } ?>> Active
									</label>
								
									<label>
										<input type="radio" value="0" id="inactive" name="status" <?php if($subcategory_info[0]['status'] == 0) { echo "checked"; } ?>> Inactive
									</label>
								</div>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('status')!=""){ echo form_error('status');} ?></div>
							</div>
						</div>
								
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-10">
								<button type="submit" class="btn  btn-flat btn-success">Update Subcategory</button>
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