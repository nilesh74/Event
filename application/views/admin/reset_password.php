<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Reset User Password
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="<?php echo base_url(); ?>admin/manage_event"> Manage User</a></li>
				<li class="active">Reset User Password</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<form method="post" action="<?php echo base_url(); ?>admin/manage_user/reset_password?id=<?php echo base64_encode($user_info[0]['user_id']); ?>" class="form-horizontal form_block_all_page" enctype="multipart/form-data">
						
						<div class="compulsary" ><span class="text-red">Fields marked with (*) are compulsary</span></div>
						
						<div class="form-group">
							<label for="epassword" class="col-sm-3 control-label"> Password<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="hidden" class="form-control" id="email"  name="email"  value="<?php echo ($user_info[0]['email']); ?>">
								<input type="text" class="form-control" id="epassword" name="epassword" placeholder="Password" value="<?php echo base64_decode($user_info[0]['password']); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('epassword')!=""){ echo form_error('epassword');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="npassword" class="col-sm-3 control-label">New Password<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="npassword" class="form-control" id="npassword" 
								name="npassword" placeholder="Password">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('npassword')!=""){ echo form_error('npassword');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="ncpassword" class="col-sm-3 control-label">Confirm New Password<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="ncpassword" name="ncpassword" placeholder="Confirm password" >
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('ncpassword')!=""){ echo form_error('ncpassword');} ?></div>
							</div>
						</div>		
								
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-10">
								<button type="submit" class="btn  btn-flat btn-success">Save </button>
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