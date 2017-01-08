<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('cookie');			
		$this->load->helper('url');
		$this->load->helper('form');
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
							'admin/manage_category',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'record'=>$this->common_model->get_records('wwc_manage_category','',array('status !='=>2),'')
									  )
					     );	
	}

	public function add_category()
	{
		$this->form_validation->set_rules('category', ' Event Type', 'trim|required|callback_already_exist');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');		
		
		$current_date = date("Y-m-d H:i:s");
		$error='';
		
		if($this->form_validation->run())
		{
			$insert_array = array(
								'cat_name'=>ucfirst($this->input->post('category')),
								'status'=>$this->input->post('status'),
								'created_on'=>$current_date
								);
			
			if ($this->common_model->add_records('wwc_manage_category',$insert_array))
			{
				$this->session->set_flashdata('success','Record added successfully');
				redirect(base_url('admin/manage_category')); 
			}
			else 
			{
				$this->session->set_flashdata('error','Error while adding record');
				redirect(base_url('admin/manage_category')); 
			}			
		}
		
		$this->load->view(
							'admin/add_category',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'error'=>$error
									  )
					     );	
	}
	
	public function edit_category()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_category')); 
		}
		
		$error='';
		$this->form_validation->set_rules('category', 'Category name', 'trim|required|callback_already_exist['.$id.']');
        
		$current_date = date("Y-m-d H:i:s");
		
		if($this->form_validation->run())
		{
			$update_array = array(
								'cat_name'=>ucfirst($this->input->post('category')),
								'status'=>$this->input->post('status'),
								'updated_on'=>$current_date
								);
			$where_array = array('cat_id'=>$id);
			
			if ($this->common_model->update_records('wwc_manage_category',$update_array,$where_array)) 
			{
				$this->session->set_flashdata('success',' Event Type updated successfully');
				redirect(base_url('admin/manage_category')); 
			}
			else 
			{
				$this->session->set_flashdata('error','Error while updating  Event Type');
				redirect(base_url('admin/manage_category')); 
			}
		}
		
		$this->load->view(
							'admin/edit_category',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'category_info'=>$this->common_model->get_records('wwc_manage_category','',array('cat_id'=>$id),''),
										'error'=>$error
									  )
					     );		
	}
	
	public function delete_category()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_category')); 
		}
		
		$current_date = date("Y-m-d H:i:s");
		
		$update_array = array(
							'status'=>2,
							'deleted_on'=>$current_date
							);
		
		$where_array = array('cat_id'=>$id);
		
		if($this->common_model->update_records('wwc_manage_category',$update_array,$where_array)) 
		{
			$this->session->set_flashdata('success',' Event Type deleted successfully');
			redirect(base_url('admin/manage_category')); 
		} 
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
		
			$where_array = array('cat_id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_manage_category',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_category'));
			}
		}
		else if($_POST['status']=='false')
		{
			$update_array = array(
							'status'=>0,
							'updated_on'=>$current_date
							);
		
			$where_array = array('cat_id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_manage_category',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_category'));
			}
		}
			
	}
	
	//entry already exist or not
	public function already_exist($str,$id)
	{
		$chk_array=array();
		if($str!="" && $id!="")
		{
			$chk_array=array('cat_name'=>$str,'status !='=>'2','cat_id !='=>$id);
		}
		else
		{
			$chk_array=array('cat_name'=>$str,'status !='=>'2');
		}
		
		$result = $this->db->get_where('wwc_manage_category',$chk_array);
		if($result->num_rows()>0)
		{   $this->form_validation->set_message('already_exist','Record already exists.');
			return false;
		} 
		else 
		{
			return true;
		}
	}
	
}
?>