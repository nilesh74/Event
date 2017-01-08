		<!-- jQuery 2.1.4 -->
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		
		<!-- jQuery UI 1.11.4 -->
		<script src="<?php echo base_url(); ?>assets/admin/js/jquery-ui.min.js"></script>
		
		<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-toggle.js"></script>
		
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button);
		</script>
		
		<!-- Bootstrap 3.3.5 -->
		<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
		
		
		
		<!-- Morris.js charts -->
		<script src="<?php echo base_url(); ?>assets/admin/js/raphael-min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/morris/morris.min.js"></script>
		
		<!-- Sparkline -->
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/sparkline/jquery.sparkline.min.js"></script>
		
		<!-- jvectormap -->
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		
		<!-- jQuery Knob Chart -->
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/knob/jquery.knob.js"></script>
		
		<!-- daterangepicker >
		<script src="<?php echo base_url(); ?>assets/admin/js/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/daterangepicker/daterangepicker.js"></script-->
		
		<!-- datepicker >
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/datepicker/bootstrap-datepicker.js"></script-->
		
		<!-- Bootstrap WYSIHTML5 -->
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		
		<!-- Slimscroll -->
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		
		<!-- FastClick -->
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/fastclick/fastclick.min.js"></script>
		
		<!-- AdminLTE App -->
		<script src="<?php echo base_url(); ?>assets/admin/js/app.min.js"></script>
		
		<!-- iCheck -->
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/iCheck/icheck.min.js"></script>
		
		<!-- Outside from default admin -->
		<!-- CK Editor -->
		<script src="<?php echo base_url(); ?>assets/admin/js/ckeditor/ckeditor.js"></script>
		
		<!-- Datepicker -->
		<script src="<?php echo base_url(); ?>assets/admin/datepicker/jquery.datetimepicker.js"></script>
		
		<script>
		$('#only_datepicker').datetimepicker(
		{
			yearOffset:0,
			lang:'en',
			timepicker:false,
			format:'d-m-Y',
			formatDate:'d-m-Y',
			closeOnDateSelect:true,
			scrollInput : false,
			scrollMonth:false
		});
		
		jQuery(function()
			{
				jQuery('#date_timepicker_start').datetimepicker(
				{
					//format:'Y/m/d',
					yearOffset:0,
					lang:'en',
					timepicker:false,
					format:'d-m-Y',
					formatDate:'d-m-Y',
					//minDate:'-1970/01/02', 
					closeOnDateSelect:true,
					scrollInput : false,
					scrollMonth:false,
					onShow:function( ct )
					{
						this.setOptions(
						{
							maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
						})
					}
				});
				
				jQuery('#date_timepicker_end').datetimepicker(
				{
					//format:'Y/m/d',
					yearOffset:0,
					lang:'en',
					timepicker:false,
					format:'d-m-Y',
					formatDate:'d-m-Y',
					//minDate:'-1970/01/02', 
					closeOnDateSelect:true,
					scrollInput : false,
					scrollMonth:false,
					onShow:function( ct )
					{
						this.setOptions(
						{
							minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
						})
					}
				});
			});
			
			jQuery(function()
			{
				jQuery('#time_timepicker').datetimepicker(
				{
					datepicker:false,
					format:'H:i',
					step:15,
					closeOnDateSelect:true,
					scrollInput : false,
					onShow:function( ct )
					{
						this.setOptions(
						{
							maxDate:jQuery('#time_timepicker_end').val()?jQuery('#time_timepicker_end').val():false
						})
					}
				});				
				
			});
			
		</script>	
		
		<script>
			$(function () 
			{
				$('input').iCheck(
				{
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' // optional
				});
			});
		</script>
		
		<!-- DataTables -->
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
		
		<script>
      $(function () {
        $("#example1").DataTable( 
		{
			"columnDefs": [ {
			"targets": 'no-sort',
			"orderable": false,
			} ]
		});
		
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
	
	<script src="<?php echo base_url(); ?>assets/admin/bootstrap_fileinput/js/fileinput.js" type="text/javascript"></script>		
	<script>    
		$("#file_upload").fileinput({
			uploadUrl: '#', // you must set a valid URL here else you will get an error
			allowedFileExtensions :'',
			overwriteInitial: false,
			maxFileSize: '',
			maxFilesNum: '10',
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
	
	</body>
</html>