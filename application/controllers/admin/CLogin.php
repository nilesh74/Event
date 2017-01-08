<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CLogin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();		
		//$this->load->library('logged_user');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('cookie');			
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('common_model');			
	}
	
	public function index()
	{   
		if(isset($_POST['login']))
		{
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('password','Password','required');	
			if($this->form_validation->run())
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');	
				$remember = $this->input->post('remember');						
				if($remember==1)
				{
					$cookie = array(
									'username' =>  $username,
									'password' => md5($password),
									'expire' => time()+86500,
									);
					$this->input->set_cookie($cookie);
				}
				
				$this->db->where('username',$username);
				$this->db->where('password',md5($password));
				$this->db->where('status',1);
				$get_admin_details_qry = $this->db->get('wwc_admin');			
				$cnt = $get_admin_details_qry->num_rows();
				$get_admin_details_res = $get_admin_details_qry->row_array();
				//print_r($get_admin_details_res);exit;							
				
				if($cnt==0)
				{
					$this->session->set_flashdata('error','Enter valid Username and Password');
					redirect(base_url('admin/clogin'),'refresh');
				}
				else
				{
					$newdata = array(
									'id' => $get_admin_details_res['id'],
									'admin_fname' => $get_admin_details_res['fname'],
									'admin_mname' => $get_admin_details_res['mname'],
									'admin_lname' => $get_admin_details_res['lname'],
									'admin_username' => $get_admin_details_res['username'],
									'admin_email' => $get_admin_details_res['email'],
									'admin_contact' => $get_admin_details_res['contact'],
									'admin_profile' => $get_admin_details_res['profile_pic'],
									'admin_type' => $get_admin_details_res['type'],
									'admin_status' => $get_admin_details_res['status'],
									'ctype' => 'subadmin'
									);
					$this->session->set_userdata($newdata);	
					redirect(base_url('admin/dashboard'));
				}		
			}			
		}	
				
		$this->load->view('admin/clogin');
	}
	
	public function forgot_admin_password()
    {
		if(isset($_POST['forget_pass']))
		{
			$this->form_validation->set_rules('username_email','Email Address','required|valid_email');
            if($this->form_validation->run())
			{
				$this->db->where('email',$this->input->post('username_email'));
				$this->db->where('status',1);
				$get_admin_forgot_qry = $this->db->get('wwc_admin');			
				
				$get_admin_forgot_details_res = $get_admin_forgot_qry->row_array();	
				//print_r($get_admin_forgot_details_res); exit;
				
				if( count($get_admin_forgot_details_res) > 0)
				{
					$alphabet = "abcdefghijklmnopqrstuvwxyz0123456789";
					$pass="";
					$pass_encrypt="";
					for ($i = 0; $i < 6; $i++)
					{
						$n = rand(0, strlen($alphabet)-1);
						$pass= $pass.$alphabet[$n];
					}
					$pass_encrypt=md5($pass);
					
					$update_array = array('password'=>$pass_encrypt);
					$where_array = array('id'=>$get_admin_forgot_details_res['id']);
					$this->db->where($where_array);
					$this->db->update('wwc_admin',$update_array);
					
					$message="	<html>
										Your new password is as below,<br/>
										Password : ".$pass."
									</html>						
							";
					
					$this->load->library('email'); // load email library
				
					$config['protocol']     = 'smtp';
					$config['smtp_host']    = 'ssl://smtp.gmail.com';
					$config['smtp_port']    = '465';
					$config['smtp_timeout'] = '7';
					$config['smtp_user']    = 'smtpmpa@gmail.com';
					$config['smtp_pass']    = 'smtpmpa@12345';
					$config['charset']     = 'utf-8';
					$config['newline']     = "\r\n";
					$config['mailtype']  = 'html'; // or html
					$config['validation']  = TRUE; // bool whether to validate email or not  
   
					$this->email->initialize($config);
					$this->email->from('noreply@wwcadmin.com', 'WWC');
					$this->email->to($get_admin_forgot_details_res['email']);
					$this->email->subject('Reset Password');
					$this->email->message($message);
					
					if ($this->email->send())
					{
						$this->session->set_flashdata('success_forget','Password successfully sent on your email address');
						redirect(base_url('admin/login'));
					}
					else
					{
						$this->session->set_flashdata('error_forget','Error while resetting the password. Please try after sometime.');
						redirect(base_url('admin/login'));
					}					
				}
				else
				{
					$this->session->set_flashdata('error_forget','Please enter your registered email address.');
					redirect(base_url('admin/login'));
				}
			}
        }        
		$this->load->view('admin/login');		
    }
	
	public function logout()
	{
		$newdata = array(
						'id' =>'',
						'admin_fname' => '',
						'admin_mname' => '',
						'admin_lname' => '',
						'admin_username' => '',
						'admin_email' => '',
						'admin_contact' => '',
						'admin_profile' => '',
						'admin_status' => ''
             			);			
		$this->session->sess_destroy();
		$this->session->unset_userdata($newdata);
		redirect(base_url('admin'));
	}
	
}
?>