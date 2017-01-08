<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_contact extends CI_Controller
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
							'admin/manage_contact',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'record'=>$this->common_model->get_records('wwc_contact_us','',array('status !='=>2),'')
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
		
			$where_array = array('contact_id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_contact_us',$update_array,$where_array))
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
		
			$where_array = array('contact_id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_contact_us',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_user'));
			}
		}			
	}
	
	public function delete_contact()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_contact')); 
		}
		
		$current_date = date("Y-m-d H:i:s");
		
		$update_array = array(
							'status'=>2,
							'deleted_on'=>$current_date
							);
		
		$where_array = array('contact_id'=>$id);
		
		if($this->common_model->update_records('wwc_contact_us',$update_array,$where_array)) 
		{
			$this->session->set_flashdata('success','User deleted successfully');
			redirect(base_url('admin/manage_contact')); 
		} 
	}
	
	
}
?>