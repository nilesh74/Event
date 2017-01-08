<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Add  Event Type
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="<?php echo base_url(); ?>admin/manage_category"> Manage  Event Type</a></li>
				<li class="active">Add  Event Type</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<form method="post" action="<?php echo base_url(); ?>admin/manage_category/edit_category?id=<?php echo base64_encode($category_info[0]['cat_id']); ?>" class="form-horizontal form_block_all_page" enctype="multipart/form-data">
						
						<div class="compulsary" ><span class="text-red">Fields marked with (*) are compulsary</span></div>
						
						<div class="form-group">
							<label for="category" class="col-sm-3 control-label"> Event Type<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="category" name="category" placeholder=" Event Type" value="<?php echo $category_info[0]['cat_name']; ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('category')!=""){ echo form_error('category');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="status" class="col-sm-3 control-label">Status<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<div class="radio">
									<label>
										<input type="radio" value="1" id="active" name="status" <?php if($category_info[0]['status']==1){ echo "checked"; } ?> > Active
									</label>
								
									<label>
										<input type="radio" value="0" id="inactive" name="status" <?php if($category_info[0]['status']==0){ echo "checked"; } ?> > Inactive
									</label>
								</div>
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('status')!=""){ echo form_error('status');} ?></div>
							</div>
						</div>
								
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-10">
								<button type="submit" class="btn  btn-flat btn-success">Add Category</button>
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
		
<?php include('includes/footer.php'); ?>