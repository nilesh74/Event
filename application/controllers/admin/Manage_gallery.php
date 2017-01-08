<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_gallery extends CI_Controller
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
							'admin/manage_gallery',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'record'=>$this->common_model->get_records('wwc_manage_gallery','',array('status !='=>2),'')
									  )
					     );	
	}

	public function add_gallery()
	{
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('gallery_title', 'Gallery Title', 'trim|required');
		
		//print_r($_FILES); 		
		//echo $_FILES['file_upload']['name'][0]; exit;
		
		if (empty($_FILES['file_upload']['name'][0]))
		{
			$this->form_validation->set_rules('file_upload', 'Image', 'required');
		}
		
		$current_date = date("Y-m-d H:i:s");
		$error['error']='';
		
		if($this->form_validation->run())
		{
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
				$file=$_FILES;	
					
				for($i=0;$i<$cnt_img;$i++)
				{
					$_FILES['file_upload']['name'] = $file['file_upload']['name'][$i];					
					
					$filename = str_replace(' ','_','gallery')."_".uniqid();
					$this->load->library('upload');
					$config['file_name']     = $filename;
					$config['upload_path']   = './assets/admin/images/gallery/';
					$config['allowed_types'] = 'png|jpeg|jpg|gif';
					
					$this->upload->initialize($config);					
					
					$path = $_FILES['file_upload']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);							
					
					$final_img = $filename.".".$ext;
																
					$_FILES['file_upload']['type']=$file['file_upload']['type'][$i];
					$_FILES['file_upload']['tmp_name']=$file['file_upload']['tmp_name'][$i];
					$_FILES['file_upload']['error']=$file['file_upload']['error'][$i];
					$_FILES['file_upload']['size']=$file['file_upload']['size'][$i];
					
					if($this->upload->do_upload('file_upload'))
					{
						$data=$this->upload->data();												
						$insert_img_array=array('gallery_name'=>$this->input->post('gallery_title'), 'file_name'=>$final_img, 'status'=>$this->input->post('status'), 'created_on'=>$current_date);												
						$this->common_model->add_records('wwc_manage_gallery',$insert_img_array);						
					}					
				}			
						  
				$this->session->set_flashdata('success','Gallery added successfully');
				redirect(base_url('admin/manage_gallery')); 
			}
			else 
			{
				$error = array('error' => "Please upload valid PNG/JPG/JPEG/GIF extension images having 1000 X 600 dimensions.");
			}
			
			
		}
		
		$this->load->view(
							'admin/add_gallery',
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
				$this->session->set_flashdata('success','Category updated successfully');
				redirect(base_url('admin/manage_category')); 
			}
			else 
			{
				$this->session->set_flashdata('error','Error while updating category');
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
			$this->session->set_flashdata('success','Category deleted successfully');
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
		
			$where_array = array('id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_manage_gallery',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_gallery'));
			}
		}
		else if($_POST['status']=='false')
		{
			$update_array = array(
							'status'=>0,
							'updated_on'=>$current_date
							);
		
			$where_array = array('id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_manage_gallery',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_gallery'));
			}
		}
			
	}
}
?>