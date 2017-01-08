<?php 
	include('includes/header.php');
	include('includes/sidebar.php'); 
?>

		<link href="<?php echo base_url(); ?>assets/admin/bootstrap_fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />        
		
	<div class="content-wrapper">
		<section class="content-header">
			<h1>
				Add Gallery
			</h1>
			
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="<?php echo base_url(); ?>admin/manage_gallery"> Manage Gallery</a></li>
				<li class="active">Add Gallery</li>
			</ol>
        </section>
		
		<section class="content">
			<div class="row">
				<div class="col-lg-12 col-xs-12">
					<form method="post" action="<?php echo base_url(); ?>admin/manage_gallery/add_gallery" class="form-horizontal form_block_all_page" enctype="multipart/form-data">
						
						<div class="compulsary" ><span class="text-red">Fields marked with (*) are compulsary</span></div>
						
						<div class="form-group">
							<label for="gallery_title" class="col-sm-3 control-label">Gallery Title<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="gallery_title" name="gallery_title" placeholder="Gallery Title" value="<?php echo set_value('gallery_title'); ?>">
								<div class="clearfix"></div>
								<div class="text-red" ><?php if(form_error('gallery_title')!=""){ echo form_error('gallery_title');} ?></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="file_upload" class="col-sm-3 control-label">Select Images<span class="text-red">*</span></label>
							<div class="col-sm-9">
								<input id="file_upload" name="file_upload[]" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2">
								
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
								<button type="submit" class="btn  btn-flat btn-success">Add Gallery</button>
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

<script src="<?php echo base_url(); ?>assets/admin/bootstrap_fileinput/js/fileinput.js" type="text/javascript"></script>
		
<script>
    
    $("#file_upload").fileinput({
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions :'',
        overwriteInitial: false,
        maxFileSize: '',
        maxFilesNum: '',
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
	});
    /*
    $(".file").on('fileselect', function(event, n, l) {
        alert('File Selected. Name: ' + l + ', Num: ' + n);
    });
    */
	
	
    $(document).ready(function() {
        $("#test-upload").fileinput({
            'showPreview' : false,
            'allowedFileExtensions' : ['jpg', 'png','gif'],
            'elErrorContainer': '#errorBlock'
        });
        /*
        $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
            alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
        });
        */
    });
	</script>