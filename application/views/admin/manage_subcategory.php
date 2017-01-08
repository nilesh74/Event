<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Manage Subcategory
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Manage SubCategory</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">                     
				<div class="col-lg-12 col-xs-12">
					<div class="add_btn">
						<a href="<?php echo base_url(); ?>admin/manage_subcategory/add_subcategory" class="btn btn-flat bg-olive">Add New Subcategory</a>      		
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
											<th style="display:none;"></th>
											<th class="no-sort"><input name="checkboxlist_all" id="checkboxlist_all" type="checkbox" > &nbsp;&nbsp;Select all</th>
                                        	<th>Sr. No.&nbsp;&nbsp;</th>
                                            <th>Category&nbsp;&nbsp;</th>
											<th>Subcategory&nbsp;&nbsp;</th>
                                            <th class="no-sort">Status&nbsp;&nbsp;</th>
                                            <th style="min-width:130px;" class="no-sort">Action&nbsp;&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									//print_r($banner_details);
										$i = 1;
										if(count($record)>0)
										{
											foreach($record as $result)
											{	?>
                                                <tr>
													<td style="display:none;"></td>
													<td><input name="checkboxlist" class="checkboxlist" type="checkbox" onclick="chechch()" value="<?php echo $result['subcat_id']; ?>"></td>
                                                    <td><?php echo $i; $i++; ?></td>
                                                    <td><?php echo $result['cat_name']; ?></td>
													<td><?php echo $result['subcat_name']; ?></td>
                                                    <td>
														<?php
														if($result['status']==1)
														{	?>
															<input checked value="<?php echo $result['subcat_id']; ?>" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" class="xxx" type="checkbox">
												<?php	}
														else if($result['status']==0)
														{	?>
															<input data-toggle="toggle" value="<?php echo $result['subcat_id']; ?>" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" class="xxx" type="checkbox">
												<?php	}	?>
													</td>
                                                    <td>
														<a href="<?php echo base_url(); ?>admin/manage_subcategory/edit_subcategory?id=<?php echo base64_encode($result['subcat_id']); ?>" class="btn btn-info btn-flat">Edit</a>
														<a onclick="return confirm('Are you sure you want to delete this record?');" href="<?php echo base_url(); ?>admin/manage_subcategory/delete_subcategory?id=<?php echo base64_encode($result['subcat_id']); ?>" class="btn btn-danger btn-flat">Delete</a>
													</td>
                                                </tr>                                            
                              		<?php	}	
										}	?>                                    	
                                    </tbody>
                                </table>
								<a class="btn btn-danger btn-flat" id="delete_all">Delete</a>
                            </div>                                    
                        </div>                        
                    </div>
				
				
			</div>
		</section>
	</div>
	
	<footer class="main-footer">
		<strong>Copyright &copy; 2014-2015 <a href="#">WWC</a>.</strong> All rights reserved.
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
						url: '<?php echo base_url(); ?>admin/manage_subcategory/change_status',
						data: data
					}
				  );
		})
	});
	
		
		
		//if select all checkbox is checked then checked all checkbok
		$('#checkboxlist_all').on('ifChecked', function(event) 
		{
			//alert("1");
			$('.checkboxlist').each(function() 
			{
				$('.checkboxlist').iCheck('check');
			});			
		});
		
		
		//if select all checkbox in unchecked then unchecked all checkbox
		$('#checkboxlist_all').on('ifUnchecked', function(event) 
		{ 
			//alert("2");
			$('.checkboxlist').each(function() 
			{ 
				$('.checkboxlist').iCheck('uncheck');
			});			
		});	
		
		
		$('.checkboxlist').on('ifUnchecked', function(event) 
		{ 
			$("th .icheckbox_square-blue").removeClass("checked");
		});
		
		
  
  $(function() 
  {
	$('#delete_all').click(function() 
	{
		var checkValues = $('input[name=checkboxlist]:checked').map(function()
            {
                return $(this).val();
            }).get();
			
		if(checkValues=="")
		{
			alert("Please select at least one record to delete");
		}
		else
		{
			var data = {
						'id': checkValues
					};
					
			$.ajax(
				{
					type: "POST",
					url: '<?php echo base_url(); ?>admin/manage_subcategory/delete_all',
					data: data,
					success:function(data)
					{
						location.reload();
					}
				}
			  );
		}
	})
  });
</script>