<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Manage Event Type
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Manage Event Type</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">                     
				<div class="col-lg-12 col-xs-12">
					<div class="add_btn">
						<a href="manage_category/add_category" class="btn btn-flat bg-olive">Add New Event Type</a>      		
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-12 col-xs-12">

				<?php 
						if($this->session->flashdata('success'))
						{	?>
                        	<div class="row">                     
                        		<div class="col-lg-12 col-xs-12">
                        			<div class="alert alert-success alert-dismissable">
                                    	<i class="fa fa-check"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <?php echo $this->session->flashdata('success') ?>
                                    </div>
                                </div>
                            </div>
				<?php	}
						if($this->session->flashdata('error'))
						{	?>
                        	<div class="row">                     
                        		<div class="col-lg-12 col-xs-12">
                            		<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <?php echo $this->session->flashdata('error') ?>
                                    </div>
                                </div>
                            </div>
				<?php	}	?>
				
				    <div class="row">                     
                        <div class="col-lg-12 col-xs-12">
                        	<div class="box-body ">
                                <table id="example1" class="table table-bordered table-hover">
                                	<thead>
                                    	<tr>
                                        	<th>Sr. No.</th>
                                            <th>Event Type</th>
                                            <th>Status</th>
                                            <th style="min-width:130px;" class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$i = 1;
										foreach($record as $result)
										{	?>
											<tr>
												<td><?php echo $i; $i++; ?></td>
												<td><?php echo $result['cat_name']; ?></td>
												<td>
													<?php
														if($result['status']==1)
														{	?>
															<input checked value="<?php echo $result['cat_id']; ?>" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" class="xxx" type="checkbox">
												<?php	}
														else if($result['status']==0)
														{	?>
															<input data-toggle="toggle" value="<?php echo $result['cat_id']; ?>" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" class="xxx" type="checkbox">
												<?php	}	?>
												</td>
												<td>
													<a href="<?php echo base_url(); ?>admin/manage_category/edit_category?id=<?php echo base64_encode($result['cat_id']); ?>" class="btn btn-info btn-flat">Edit</a>
													<a onclick="return confirm('Are you sure you want to delete this record?');" href="<?php echo base_url(); ?>admin/manage_category/delete_category?id=<?php echo base64_encode($result['cat_id']); ?>" class="btn btn-danger btn-flat">Delete</a>
												</td>
											</tr>                                            
								<?php	}	?>                                    	
                                    </tbody>
                                </table>
                            </div>                                    
                        </div>                        
                    </div>
				
				
			</div>
		</section>
	</div>
	
	<footer class="main-footer">
		
    </footer>
</div>

<?php include('includes/footer.php'); ?>

<script>
  $(function() 
  {
	$('.xxx').change(function() 
	{
		var data = {
						'id': $(this).val(),
						'status' : $(this).prop('checked')
					};
		$.ajax(
				{
					type: "POST",
					url: '<?php echo base_url(); ?>admin/manage_category/change_status',
					data: data
				}
			  );
	})
  })
</script>
