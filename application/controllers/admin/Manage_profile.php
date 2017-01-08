<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_profile extends CI_Controller
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
							'admin/manage_profile',
							array(
									'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),'')
								  )
						  );	
	}	
	 
	public function edit_profile()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_profile')); 
		}
		
		$error='';
		$this->form_validation->set_rules('fname', 'First name', 'trim|required');
        $this->form_validation->set_rules('mname', 'Middle name', 'trim');
		$this->form_validation->set_rules('lname', 'Last name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('contact', 'Contact number', 'trim|required');
        
		$current_date = date("Y-m-d H:i:s");
		
		if($this->form_validation->run())
		{
			$old_image_name = $this->input->post('old_image_name');
			$new_file_name = "";
			
			$this->load->library('upload');
			if (!empty($_FILES['file_img']['name']))	
			{
				$temp_filename = $_FILES['file_img']['tmp_name']; 
				list($width, $height) = getimagesize($temp_filename);
			
				if($width==250 && $height==250)
				{
					$newFileName = $_FILES['file_img']['name'];
					$fileExt = array_pop(explode(".", $newFileName));
					$filename= str_replace(' ','_',$this->input->post('banner_name'))."_".time().".".$fileExt;
					
					$config['file_name'] = $filename;
					$config['create_thumb'] = TRUE;
					$config['upload_path']   = "./assets/admin/images/admin_profile/";
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config[''] = '';
				
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('file_img'))
					{
						$new_file_name = $old_image_name;
						$error = array('error' => $this->upload->display_errors());	
					}				
					else if ($this->upload->do_upload('file_img')) 
					{
						$data=$this->upload->data();
						unlink("./assets/admin/images/admin_profile/".$old_image_name);
						$new_file_name = $data['file_name'];
					}
				}
				else
				{
					$error = array('error' => "Please upload valid PNG/JPG/JPEG/GIF image having 250 X 250 dimensions.");
				}
			}
			else 
			{
				$new_file_name = $old_image_name;
			}			
			
				if($this->input->post('newpassword')!='')
				{
					$update_array = array(
									'fname'=>ucfirst(strtolower($this->input->post('fname'))),
									'mname'=>ucfirst(strtolower($this->input->post('mname'))),
									'lname'=>ucfirst(strtolower($this->input->post('lname'))),
									'username'=>$this->input->post('username'),
									'password'=>md5($this->input->post('newpassword')),
									'profile_pic'=>$new_file_name,
									'email'=>$this->input->post('email'),
									'contact'=>$this->input->post('contact'),
									'updated_on'=>$current_date
									);
				}
				else
				{
					$update_array = array(
									'fname'=>ucfirst(strtolower($this->input->post('fname'))),
									'mname'=>ucfirst(strtolower($this->input->post('mname'))),
									'lname'=>ucfirst(strtolower($this->input->post('lname'))),
									'username'=>$this->input->post('username'),
									'profile_pic'=>$new_file_name,
									'email'=>$this->input->post('email'),
									'contact'=>$this->input->post('contact'),
									'updated_on'=>$current_date
									);
				}			
				
				$where_array = array('id'=>$id);
								
				if ($this->common_model->update_records('wwc_admin',$update_array,$where_array)) 
	            {
					$this->session->set_flashdata('success','Profile updated successfully');
					redirect(base_url('admin/manage_profile')); 
				} 
				else 
				{
					$this->session->set_flashdata('error','Error while updating profile');
					redirect(base_url('admin/manage_profile')); 
				}
		}
		$this->load->view(
							'admin/edit_profile',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'error'=>$error
									  )
						  );	
	}	
}
?>