<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_typography extends CI_Controller
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
							'admin/manage_typography',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'record'=>$this->common_model->get_records('wwc_manage_typograpohy','','','')
									  )
					     );	
	}

	public function add_typography()
	{
		$this->form_validation->set_rules('fname', 'Fname', 'trim|required|alpha');
		$this->form_validation->set_rules('fullname', 'Full name', 'trim|required|callback_alpha_dash_space');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('contact', 'Contact Number', 'trim|required|numeric|min_length[9]|max_length[12]');
		$this->form_validation->set_rules('already_exist', 'already exist', 'trim|required|callback_already_exist');
		$this->form_validation->set_rules('select_dropdown', 'select dropdown', 'trim|required');
		$this->form_validation->set_rules('select_category', 'select category', 'trim|required');
		$this->form_validation->set_rules('subcat_name', 'subcategory', 'trim|required');
		$this->form_validation->set_rules('editor1', 'textarea', 'trim|required');
		$this->form_validation->set_rules('only_datepicker', 'Date', 'trim|required');
		$this->form_validation->set_rules('date_timepicker_start', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('date_timepicker_end', 'End Date', 'trim|required');
		$this->form_validation->set_rules('time_timepicker', 'Time', 'trim|required');
		$this->form_validation->set_rules('accept_terms', 'Checkbox', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		
		if (empty($_FILES['file_upload']['name'][0]))
		{
			$this->form_validation->set_rules('file_upload', 'Image', 'required');
		}
		
		$current_date = date("Y-m-d H:i:s");
		$error='';
		$error['error']='';
		
		if($this->form_validation->run())		{
			
			$cnt_img = count($_FILES['file_upload']['name']);
			$flag = 0;
				
			for($i=0;$i<$cnt_img;$i++)
			{
				$path_img = $_FILES['file_upload']['name'][$i];
				$ext_img = pathinfo($path_img, PATHINFO_EXTENSION);
					
				$valid_ext_arr = array('png','jpg','jpeg','gif');
				
				if(!in_array(strtolower($ext_img),$valid_ext_arr))
				{
					$flag = 1;						
					break;
				}

				$temp_filename = $_FILES['file_upload']['tmp_name'][$i]; 
				list($width, $height) = getimagesize($temp_filename);
				
				if($width!=2592 && $height!=1944)
				{
					$flag = 1;
					break;
				}							
			}
			
			if($flag==0)
			{
				$insert_array = array(
								'first_name'=>ucfirst($this->input->post('fname')),
								'name'=>ucfirst($this->input->post('fullname')),
								'email'=>$this->input->post('email'),
								'contact'=>$this->input->post('contact'),
								'already_exist'=>$this->input->post('already_exist'),								
								'only_dropdown'=>$this->input->post('select_dropdown'),
								'cat_id'=>$this->input->post('select_category'),
								'subcat_id'=>$this->input->post('subcat_name'),
								'textarea'=>$this->input->post('editor1'),
								'datepicker'=>$this->input->post('only_datepicker'),
								'datepicker_start'=>$this->input->post('date_timepicker_start'),
								'datepicker_end'=>$this->input->post('date_timepicker_end'),
								'timepicker'=>$this->input->post('time_timepicker'),
								'accept_term'=>$this->input->post('accept_terms'),
								'status'=>$this->input->post('status'),
								'created_on'=>$current_date
								);
								
				$this->common_model->add_records('wwc_manage_typograpohy',$insert_array);
				$insert_id = $this->db->insert_id();
								
				if(is_dir('./assets/admin/images/gallery/'.$insert_id)) 
				{
				}
				else
				{ 
					$dir=mkdir('./assets/admin/images/gallery/'.$insert_id,0755);
					$dir1=mkdir('./assets/admin/images/gallery/'.$insert_id.'/thumb',0755);
				}
			
				$file=$_FILES;	
					
				for($i=0;$i<$cnt_img;$i++)
				{
					$_FILES['file_upload']['name'] = $file['file_upload']['name'][$i];					
					
					$filename = str_replace(' ','_','gallery')."_".uniqid();
					$path = $_FILES['file_upload']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);							
					
					$final_img = $filename.".".$ext;					
					
					$this->load->library('upload');
					$config['file_name']     = $filename;
					$config['upload_path']   = './assets/admin/images/gallery/'.$insert_id;
					$config['allowed_types'] = 'png|jpeg|jpg|gif';
								
					$this->upload->initialize($config);					
																
					$_FILES['file_upload']['type']=$file['file_upload']['type'][$i];
					$_FILES['file_upload']['tmp_name']=$file['file_upload']['tmp_name'][$i];
					$_FILES['file_upload']['error']=$file['file_upload']['error'][$i];
					$_FILES['file_upload']['size']=$file['file_upload']['size'][$i];
					
					if($this->upload->do_upload('file_upload'))
					{
						$data=$this->upload->data();												
						$insert_img_array=array('typography_id'=>$insert_id, 'file_name'=>$final_img, 'status'=>$this->input->post('status'), 'created_on'=>$current_date);												
						$this->common_model->add_records('wwc_manage_gallery',$insert_img_array);						
					}
					else
					{
						$error = array('error' => $this->upload->display_errors());
					}
				}			
						  
				$this->session->set_flashdata('success','Typography added successfully');
				redirect(base_url('admin/manage_typography')); 
			}
			else 
			{
				$error = array('error' => "Please upload valid PNG/JPG/JPEG/GIF extension images having 1000 X 600 dimensions.");
			}						
		}
		
		$this->load->view(
							'admin/add_typography',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'category_details'=>$this->common_model->get_records('wwc_manage_category','',array('status'=>1),''),
										'error'=>$error
									  )
					     );	
	}
	
	public function edit_typography()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_typography')); 
		}
		
		
		$this->form_validation->set_rules('fname', 'Fname', 'trim|required|alpha');
		$this->form_validation->set_rules('fullname', 'Full name', 'trim|required|callback_alpha_dash_space');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('contact', 'Contact Number', 'trim|required|numeric|min_length[9]|max_length[12]');
		$this->form_validation->set_rules('already_exist', 'already exist', 'trim|required|callback_already_exist');
		$this->form_validation->set_rules('select_dropdown', 'select dropdown', 'trim|required');
		$this->form_validation->set_rules('select_category', 'select category', 'trim|required');
		$this->form_validation->set_rules('subcat_name', 'subcategory', 'trim|required');
		$this->form_validation->set_rules('editor1', 'textarea', 'trim|required');
		$this->form_validation->set_rules('only_datepicker', 'Date', 'trim|required');
		$this->form_validation->set_rules('date_timepicker_start', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('date_timepicker_end', 'End Date', 'trim|required');
		$this->form_validation->set_rules('time_timepicker', 'Time', 'trim|required');
		$this->form_validation->set_rules('accept_terms', 'Checkbox', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		
		
		$current_date = date("Y-m-d H:i:s");
		$error='';
		
		if($this->form_validation->run())
		{
			$insert_array = array(
								'first_name'=>ucfirst($this->input->post('fname')),
								'name'=>ucfirst($this->input->post('fullname')),
								'email'=>$this->input->post('email'),
								'contact'=>$this->input->post('contact'),
								'already_exist'=>$this->input->post('already_exist'),								
								'only_dropdown'=>$this->input->post('select_dropdown'),
								'textarea'=>$this->input->post('editor1'),
								'datepicker'=>$this->input->post('only_datepicker'),
								'datepicker_start'=>$this->input->post('date_timepicker_start'),
								'datepicker_end'=>$this->input->post('date_timepicker_end'),
								'timepicker'=>$this->input->post('time_timepicker'),
								'accept_term'=>$this->input->post('accept_terms'),
								'status'=>$this->input->post('status'),
								'created_on'=>$current_date
								);
			
			if ($this->common_model->add_records('wwc_manage_typograpohy',$insert_array))
			{
				$this->session->set_flashdata('success','Record added successfully');
				redirect(base_url('admin/manage_typography')); 
			}
			else 
			{
				$this->session->set_flashdata('error','Error while adding record');
				redirect(base_url('admin/manage_typography')); 
			}			
		}
		
		$this->load->view(
							'admin/edit_typography',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'typography_info'=>$this->common_model->get_records('wwc_manage_typograpohy','',array('id'=>$id),''),
										'category_details'=>$this->common_model->get_records('wwc_manage_category','',array('status'=>1),''),
										'subcategory_details'=>$this->common_model->get_records('wwc_manage_subcategory','',array('status'=>1),''),
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
		
			$where_array = array('id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_manage_typograpohy',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_typography'));
			}
		}
		else if($_POST['status']=='false')
		{
			$update_array = array(
							'status'=>0,
							'updated_on'=>$current_date
							);
		
			$where_array = array('id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_manage_typograpohy',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_typography'));
			}
		}			
	}
	
	//accept only letters and space
	function alpha_dash_space($str)
	{
		$pattern = "/^([-a-z_ ])+$/i";
		if (!preg_match($pattern, $str))
		{            
			$this->form_validation->set_message('alpha_dash_space', 'The full name is not vaild.');
			return FALSE;
		} 
		return TRUE;
	}
	
	
	//entry already exist or not
	public function already_exist($str,$id)
	{
		$chk_array=array();
		if($str!="" && $id!="")
		{
			$chk_array=array('already_exist'=>$str,'status !='=>'2','id !='=>$id);
		}
		else
		{
			$chk_array=array('already_exist'=>$str,'status !='=>'2');
		}
		
		$result = $this->db->get_where('wwc_manage_typograpohy',$chk_array);
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