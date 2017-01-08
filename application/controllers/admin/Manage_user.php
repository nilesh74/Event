<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_user extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('common_model');		
		$user_id = $this->session->userdata('id');
		if (!isset($user_id) || $user_id==false)
        {
            redirect('admin/login','refresh');
        }
	}	 
	public function index()
	{
		$this->load->view(
							'admin/manage_user',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'record'=>$this->common_model->get_records('wwc_user','',array('status !='=>2),'')
									  )
					     );	
	}

	
	public function reset_password()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_user')); 
		}
		
		
		$this->form_validation->set_rules('npassword', 'New Password', 'trim|required');
		$this->form_validation->set_rules('ncpassword', 'Confirm Password', 'trim|required');
	
		$current_date = date("Y-m-d H:i:s");
		$error='';
		
		if($this->form_validation->run())
		{
			$email=$this->input->post('email');
			$insert_array = array(
								
								'password'=>base64_encode($this->input->post('npassword')),						
								'updated_on'=>$current_date
								);
			$where=array('user_id'=>$id);
			if ($this->common_model->update_records('wwc_user',$insert_array,$where))
			{
				$this->session->set_flashdata('success','Your password successfully updated');
				
				
			$support_email="noreply@gmail.com";
			 $subject="Regarding Password changed";
			 $message='<!doctype html>
						<html dir="ltr" lang="en-US">
						<head>
						<meta name="viewport" content="width=device-width" />
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<title>Event Management System</title>
						</head> 
						<body  bgcolor="#FFFFFF">
						<table style="width: 100%;font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;">
							<tr>
								<td></td>
								<td style="display:block!important; max-width:600px!important; margin:0 auto!important; clear:both!important;">
									<div style="padding:15px; max-width:600px; margin:0 auto; display:block;">
										<table style="width: 100%;" bgcolor="#104945">
											<tr>
												<td align="center">
													<a href="http://loadapp.org/" target="_blank">
														Event Us
													</a>
												</td>
											</tr>
										</table>
									</div>
								</td>
								<td></td>
							</tr>
						</table>
						<table style=" width: 100%;">
							<tr>
								<td></td>
								<td style="background-color: rgb(253, 253, 253);clear: both !important; display: block !important; margin: 0 auto !important; max-width: 600px !important;">
						<div style="display: block; margin: 0 auto; max-width: 600px; padding: 15px;">
									<table style="width: 100%;">
										
										<tr>
											<td align="center">
												<h3 style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;">Dear User,<br/>
																							
												<br/>
												<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;">
														YOUR NEW PASSWORD IS - '.$this->input->post('npassword').'
														</p>
												
												
												<br/>
												<p>
												Thanks,<br>
												Admin
												</p>
												
											</td>
										</tr>
									</table>
									</div>
								</td>
								<td></td>
							</tr>
						</table>
						</body>
						</html>';
			 $headers  = 'From: '.$support_email. "\r\n" .
								'Reply-To: '.$support_email. "\r\n" .
								'MIME-Version: 1.0' . "\r\n" .
								'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
								'X-Mailer: PHP/' . phpversion();
			if(@mail($email, $subject, $message, $headers))
			{
			  // echo "Sent successfully";
			}
			else
			{
				//echo "Not Sent";
			}
				redirect(base_url('admin/manage_user')); 
			}
			else 
			{
				$this->session->set_flashdata('error','Error while updating password');
				redirect(base_url('admin/manage_user')); 
			}			
		}
		
		$this->load->view(
							'admin/reset_password',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'user_info'=>$this->common_model->get_records('wwc_user','',array('user_id'=>$id),''),										
										'error'=>$error
									  )
					     );	
	}
	
	public function change_status()
	{
		$current_date = date("Y-m-d H:i:s");
		
		if($_POST['status']=='true')
		{
			$update_array = array(
							'status'=>1,
							'updated_on'=>$current_date
							);
		
			$where_array = array('user_id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_user',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_user'));
			}
		}
		else if($_POST['status']=='false')
		{
			$update_array = array(
							'status'=>0,
							'updated_on'=>$current_date
							);
		
			$where_array = array('user_id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_user',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_user'));
			}
		}			
	}
	
	public function delete_user()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_user')); 
		}
		
		$current_date = date("Y-m-d H:i:s");
		
		$update_array = array(
							'status'=>2,
							'deleted_on'=>$current_date
							);
		
		$where_array = array('user_id'=>$id);
		
		if($this->common_model->update_records('wwc_user',$update_array,$where_array)) 
		{
			$this->session->set_flashdata('success','User deleted successfully');
			redirect(base_url('admin/manage_user')); 
		} 
	}
	
	
}
?>