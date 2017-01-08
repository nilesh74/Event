<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_event extends CI_Controller
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
							'admin/manage_event',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'record'=>$this->common_model->get_records('wwc_manage_event','',array('status !='=>2),'')
									  )
					     );	
	}

	public function add_event()
	{
		
		$this->form_validation->set_rules('etitle', 'Event Title', 'trim|required');
		$this->form_validation->set_rules('elocation', 'Event Location', 'trim|required');
		$this->form_validation->set_rules('eemail', 'Event Contact Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('econtact', 'Event Contact Number', 'trim|required|numeric|min_length[9]|max_length[12]');
		$this->form_validation->set_rules('select_type', 'Select Event Type', 'trim|required');
		$this->form_validation->set_rules('edescription', 'Event Description', 'trim|required');
		$this->form_validation->set_rules('estart_date', 'Event Start Date', 'trim|required');
		$this->form_validation->set_rules('eend_date', 'Event End Date', 'trim|required');
		$this->form_validation->set_rules('etime', 'Event Time', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('ecost', 'Event Cost', 'trim|required|numeric');
		$this->form_validation->set_rules('eorganizer', 'Event Organizer', 'trim|required');
		$this->form_validation->set_rules('eseats', 'Event Seats', 'trim|required|numeric');
		
		if (empty($_FILES['file_upload']['name'][0]))
		{
			$this->form_validation->set_rules('file_upload', 'Image', 'required');
		}		
		$current_date = date("Y-m-d H:i:s");
		$error='';
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
					//$flag = 1;						
					//break;
				}

				$temp_filename = $_FILES['file_upload']['tmp_name'][$i]; 
				list($width, $height) = getimagesize($temp_filename);
				
				if($width!=2592 && $height!=1944)
				{
					//$flag = 1;
					//break;
				}							
			}
			
			if($flag==0)
			{
				$insert_array = array(
								'event_title'=>ucfirst($this->input->post('etitle')),
								'event_location'=>ucfirst($this->input->post('elocation')),
								'event_email'=>$this->input->post('eemail'),
								'event_contact'=>$this->input->post('econtact'),								
								'cat_id'=>$this->input->post('select_type'),								
								'event_description'=>$this->input->post('edescription'),
								'event_startdate'=>$this->input->post('estart_date'),
								'event_enddate'=>$this->input->post('eend_date'),
								'event_time'=>$this->input->post('etime'),
								'status'=>$this->input->post('status'),
								'event_cost'=>$this->input->post('ecost'),
								'event_seats'=>$this->input->post('eseats'),
								'event_organizer'=>$this->input->post('eorganizer'),
								
								'created_on'=>$current_date
								);
								
				$this->common_model->add_records('wwc_manage_event',$insert_array);
				$insert_id = $this->db->insert_id();
								
				if(is_dir('./assets/admin/images/event/'.$insert_id)) 
				{
				}
				else
				{ 
					$dir=mkdir('./assets/admin/images/event/'.$insert_id,0755);
				}
			
					$file=$_FILES;			
					$_FILES['file_upload']['name'] = $file['file_upload']['name'];			
					$filename = str_replace(' ','_','Event')."_".uniqid();
					$path = $_FILES['file_upload']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);							
					$final_img = $filename.".".$ext;					
					$this->load->library('upload');
					$config['file_name']     = $filename;
					$config['upload_path']   = './assets/admin/images/event/'.$insert_id;
					$config['allowed_types'] = 'png|jpeg|jpg|gif';							
					$this->upload->initialize($config);															
					$_FILES['file_upload']['type']=$file['file_upload']['type'];
					$_FILES['file_upload']['tmp_name']=$file['file_upload']['tmp_name'];
					$_FILES['file_upload']['error']=$file['file_upload']['error'];
					$_FILES['file_upload']['size']=$file['file_upload']['size'];
					
					if($this->upload->do_upload('file_upload'))
					{
						$data=$this->upload->data();												
						$insert_img_array=array('event_image_path'=>$final_img);
						$where=array('id'=>$insert_id);
						$this->common_model->update_records('wwc_manage_event',$insert_img_array,$where);		
					}
					else
					{
						$error = array('error' => $this->upload->display_errors());						
					}
										  
				$this->session->set_flashdata('success','Event added successfully');
				redirect(base_url('admin/manage_event')); 
			}
			else 
			{
				$error = array('error' => "Please upload valid PNG/JPG/JPEG/GIF extension images having 1000 X 600 dimensions.");
			}						
		}
		
		$this->load->view(
							'admin/add_event',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'event_details'=>$this->common_model->get_records('wwc_manage_category','',array('status'=>1),''),
										'error'=>$error
									  )
					     );	
	}
	
	public function edit_event()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_typography')); 
		}
		
		
		$this->form_validation->set_rules('etitle', 'Event Title', 'trim|required');
		$this->form_validation->set_rules('elocation', 'Event Location', 'trim|required');
		$this->form_validation->set_rules('eemail', 'Event Contact Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('econtact', 'Event Contact Number', 'trim|required|numeric|min_length[9]|max_length[12]');
		$this->form_validation->set_rules('select_type', 'Select Event Type', 'trim|required');
		$this->form_validation->set_rules('edescription', 'Event Description', 'trim|required');
		$this->form_validation->set_rules('estart_date', 'Event Start Date', 'trim|required');
		$this->form_validation->set_rules('eend_date', 'Event End Date', 'trim|required');
		$this->form_validation->set_rules('etime', 'Event Time', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('ecost', 'Event Cost', 'trim|required|numeric');
		$this->form_validation->set_rules('eorganizer', 'Event Organizer', 'trim|required');
		$this->form_validation->set_rules('eseats', 'Event Seats', 'trim|required|numeric');
		
		
		$current_date = date("Y-m-d H:i:s");
		$error='';
		
		if($this->form_validation->run())
		{
			$insert_array = array(
								'event_title'=>ucfirst($this->input->post('etitle')),
								'event_location'=>ucfirst($this->input->post('elocation')),
								'event_email'=>$this->input->post('eemail'),
								'event_contact'=>$this->input->post('econtact'),								
								'cat_id'=>$this->input->post('select_type'),								
								'event_description'=>$this->input->post('edescription'),
								'event_startdate'=>$this->input->post('estart_date'),
								'event_enddate'=>$this->input->post('eend_date'),
								'event_time'=>$this->input->post('etime'),
								'status'=>$this->input->post('status'),
								'event_cost'=>$this->input->post('ecost'),
								'event_seats'=>$this->input->post('eseats'),
								'event_organizer'=>$this->input->post('eorganizer'),
								'updated_on'=>$current_date
								);
			$where=array('id'=>$id);
			if ($this->common_model->update_records('wwc_manage_event',$insert_array,$where))
			{
				$this->session->set_flashdata('success','Record updated successfully');
				redirect(base_url('admin/manage_event')); 
			}
			else 
			{
				$this->session->set_flashdata('error','Error while updating record');
				redirect(base_url('admin/manage_event')); 
			}			
		}
		
		$this->load->view(
							'admin/edit_event',
								array(
										'admin_details'=>$this->common_model->get_records('wwc_admin','',array('id'=>$this->session->userdata('id')),''),
										'typography_info'=>$this->common_model->get_records('wwc_manage_event','',array('id'=>$id),''),
										'category_details'=>$this->common_model->get_records('wwc_manage_category','',array('status'=>1),''),										
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
			
			if($this->common_model->update_records('wwc_manage_event',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_event'));
			}
		}
		else if($_POST['status']=='false')
		{
			$update_array = array(
							'status'=>0,
							'updated_on'=>$current_date
							);
		
			$where_array = array('id'=>$_POST['id']);
			
			if($this->common_model->update_records('wwc_manage_event',$update_array,$where_array))
			{
				
			}
			else
			{
				redirect(base_url('admin/manage_event'));
			}
		}			
	}
	
	public function delete_event()
	{
		$id = base64_decode($_GET['id']);
		if($id=='')
		{
			redirect(base_url('admin/manage_event')); 
		}
		
		$current_date = date("Y-m-d H:i:s");
		
		$update_array = array(
							'status'=>2,
							'deleted_on'=>$current_date
							);
		
		$where_array = array('id'=>$id);
		
		if($this->common_model->update_records('wwc_manage_event',$update_array,$where_array)) 
		{
			$this->session->set_flashdata('success','Event deleted successfully');
			redirect(base_url('admin/manage_event')); 
		} 
	}
	
	
}
?>