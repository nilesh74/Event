<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_subcategory extends CI_Controller
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
							'admin/manage_subcategory',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'record'=>$this->common_model->get_records_subcat()
									  )
					     );	
	}

	public function add_subcategory()
	{
		$this->form_validation->set_rules('select_category', 'category', 'trim|required');
		$this->form_validation->set_rules('subcategory', 'Subcategory', 'trim|required|callback_subcatExists['.$this->input->post('select_category').'@'."".']');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');		
		
		$current_date = date("Y-m-d H:i:s");
		$error='';
		
		if($this->form_validation->run())
		{
			$insert_array = array(
								'cat_id'=>$this->input->post('select_category'),
								'subcat_name'=>ucfirst($this->input->post('subcategory')),
								'status'=>$this->input->post('status'),
								'created_on'=>$current_date
								);
			
			if ($this->common_model->add_records('wwc_manage_subcategory',$insert_array))
			{
				$this->session->set_flashdata('success','Record added successfully');
				redirect(base_url('admin/manage_subcategory')); 
			}
			else 
			{
				$this->session->set_flashdata('error','Error while adding record');
				redirect(base_url('admin/manage_subcategory')); 
			}			
		}
		
		$this->load->view(
							'admin/add_subcategory',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'category_record'=>$this->common_model->get_records('wwc_manage_category','',array('status'=>1),''),
										'error'=>$error
									  )
					     );	
	}
	
	public function edit_subcategory()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_subcategory')); 
		}
		
		$this->form_validation->set_rules('select_category', 'category', 'trim|required');
		$this->form_validation->set_rules('subcategory', 'Subcategory', 'trim|required|callback_subcatExists['.$this->input->post('select_category').'@'.$id.']');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');		
		
		$current_date = date("Y-m-d H:i:s");
		$error='';
        
		$current_date = date("Y-m-d H:i:s");
		
		if($this->form_validation->run())
		{
			$update_array = array(
								'cat_id'=>$this->input->post('select_category'),
								'subcat_name'=>ucfirst($this->input->post('subcategory')),
								'status'=>$this->input->post('status'),
								'updated_on'=>$current_date
								);
			$where_array = array('subcat_id'=>$id);
			
			if ($this->common_model->update_records('wwc_manage_subcategory',$update_array,$where_array)) 
			{
				$this->session->set_flashdata('success','Subcategory updated successfully');
				redirect(base_url('admin/manage_subcategory')); 
			}
			else 
			{
				$this->session->set_flashdata('error','Error while updating subcategory');
				redirect(base_url('admin/manage_subcategory')); 
			}
		}
		
		$this->load->view(
							'admin/edit_subcategory',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'category_record'=>$this->common_model->get_records('wwc_manage_category','',array('status'=>1),''),
										'subcategory_info'=>$this->common_model->get_records('wwc_manage_subcategory','',array('subcat_id'=>$id),''),
										'error'=>$error
									  )
					     );		
	}
	
	public function delete_subcategory()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_subcategory')); 
		}
		
		$current_date = date("Y-m-d H:i:s");
		
		$update_array = array(
							'status'=>2,
							'deleted_on'=>$current_date
							);
		
		$where_array = array('subcat_id'=>$id);
		
		if($this->common_model->update_records('wwc_manage_subcategory',$update_array,$where_array)) 
		{
			$this->session->set_flashdata('success','Subcategory deleted successfully');
			redirect(base_url('admin/manage_subcategory')); 
		} 
	}
	
	public function delete_all()
	{
		$current_date = date("Y-m-d H:i:s");
		foreach($_POST['id'] as $delete_id)
		{
			$update_array = array(
							'status'=>2,
							'deleted_on'=>$current_date
							);
		
			$where_array = array('subcat_id'=>$delete_id);
			$this->common_model->update_records('wwc_manage_subcategory',$update_array,$where_array);
		}
		
		$this->session->set_flashdata('success','Subcategory deleted successfully');
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
		
			$where_array = array('subcat_id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_manage_subcategory',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_subcategory'));
			}
		}
		else if($_POST['status']=='false')
		{
			$update_array = array(
							'status'=>0,
							'updated_on'=>$current_date
							);
		
			$where_array = array('subcat_id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_manage_subcategory',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_subcategory'));
			}
		}
			
	}
	
	
	//entry already exist or not
	public function subcatExists($str,$id)
	{
		$explode_arr = explode('@', $id);
		$cat_id = $explode_arr[0];
		$subcat_id = $explode_arr[1];
		
		$chk_array=array();
		if($str!="" && $cat_id!="" && $subcat_id!="")
		{
			$chk_array=array('subcat_name'=>$str, 'status !='=>'2', 'cat_id '=>$cat_id, 'subcat_id !='=>$subcat_id);
		}
		else
		{
			$chk_array=array('subcat_name'=>$str,'cat_id'=>$cat_id,'status !='=>'2');
		}
		
		$result = $this->db->get_where('wwc_manage_subcategory',$chk_array);
		echo $this->db->last_query(); 
		if($result->num_rows()>0)
		{   $this->form_validation->set_message('subcatExists','Subcategory already exists.');
			return false;
		} 
		else 
		{
			return true;
		}
	}
	
}
?>