<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('common_model');	
		
	}
	public function index()
	{
		$sql="SELECT id,event_title,event_image_path FROM wwc_manage_event order by event_startdate limit 4";
		$sql_query=$this->db->query($sql)->result_array();		
		$this->load->view('main',array('event_record'=>$sql_query));
	}
	public function event_list()
	{
		$sql="SELECT e.*,c.cat_name FROM wwc_manage_event e , wwc_manage_category c where c.cat_id=e.cat_id order by event_startdate";
		$sql_query=$this->db->query($sql)->result_array();
		$cat_list=$this->common_model->get_records('wwc_manage_category','',array('status !='=>2));
		$this->load->view('event',array('event_list'=>$sql_query,'cat_list'=>$cat_list));
	}
	public function login()
	{
		$this->form_validation->set_rules('email', 'First Name', 'trim|required');
		$this->form_validation->set_rules('password', 'Last Name', 'trim|required');
		if($this->form_validation->run())
		{
			$email= $this->input->post('email');
			$password =$this->input->post('password');
			$sql="SELECT * FROM wwc_user where email='".$email."' and password='".base64_encode($password)."'";
			$sql_query=$this->db->query($sql);
			$get_result=$sql_query->row_array();
			//print_r($get_result);exit;
			if($get_result)
			{
				$this->session->set_userdata($get_result);
				$this->session->set_flashdata('success','You are login is successful');	
				if(empty($this->session->userdata('join_event')))
				{
				redirect(base_url('event'));
				}
				else
				{
					redirect(base_url('event/event_details?id='.$this->session->userdata('event_id')));
				}
			}
			else
			{
				//$this->session->set_flashdata('success','Your password successfully updated');
				$this->session->set_flashdata('error','Incorrect username or password');
				redirect(base_url('event/login#$=NA')); 
			}
		}
		else
		{
		$this->load->view('login');
		}
	}
	public function register()
	{
		//print_r($_POST);exit;
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Event Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Event Password', 'trim|required');
		if($this->form_validation->run())
		{
			$insert_array = array(
								'first_name'=>ucfirst($this->input->post('first_name')),
								'last_name'=>ucfirst($this->input->post('last_name')),
								'password'=>base64_encode($this->input->post('password')),
								'email'=>$this->input->post('email'),								
								'status'=>'1',								
								);
			$this->common_model->add_records('wwc_user',$insert_array);
			$this->session->set_flashdata('success','You are registration is successfully done. Please login with continue');
			redirect(base_url('event/login#$=NA')); 
		}
		else
		{
		$this->load->view('register');
		}
	}
	public function event_details()
	{
		$id = base64_decode($_GET['id']);
		$sql="SELECT e.*,c.cat_name FROM wwc_manage_event e , wwc_manage_category c where c.cat_id=e.cat_id 
		and e.id=".$id."
		order by event_startdate";
		$sql_query=$this->db->query($sql)->result_array();
		 $sql_seat="Select * from wwc_manage_seat where event_id=".$id;
		 $sql_query[0]['reserved_seat']=count($this->db->query($sql_seat)->result_array());		
		$this->load->view('event_details',array('event_details'=>$sql_query));
	}
	public function logout()
	{
		$user_data = $this->session->all_userdata();
		//print_r($user_data);exit;
		foreach ($user_data as $key => $value) {
        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity' && $key != 'user_name') {
            $this->session->unset_userdata($key);
			}
		}
		
		redirect(base_url('event'));
	}
	public function search_event_list()
	{
		$sql="";
		$mainWhere='';
		$sql1='';
		$sql2='';
		$sql3='';	
		if(!empty($_POST['start_date']) && !empty($_POST['end_date']))
		{
		//	$sql1="(`event_startdate`>= '".$_POST['start_date']."' and `event_enddate` <= '".$_POST['end_date']."')";
			$sql1="(STR_TO_DATE(event_startdate,'%d-%m-%Y') >= STR_TO_DATE('".$_POST['start_date']."','%d-%m-%Y')) and (STR_TO_DATE(event_enddate,'%d-%m-%Y') <= STR_TO_DATE('".$_POST['end_date']."','%d-%m-%Y'))";
			
			
		}
		if(!empty($_POST['search_keyword']))
		{
			$sql2=" ((`event_title` LIKE '%".$_POST['search_keyword']."%') OR (`event_location` LIKE '%".$_POST['search_keyword']."%' ) OR (`event_description` LIKE '%".$_POST['search_keyword']."%'))";
		}
		if(!empty($_POST['category_list']))
		{
			$sql3=" e.cat_id=".$_POST['category_list'];
		}
			if($sql1 != '' || $sql2!= '' || $sql3 != '')
			{
				if($sql1 != ''){
					$mainWhere .= $sql1 . " and";
				}
				if($sql2 != ''){
					$mainWhere .= $sql2 . " and";
				}
				if($sql3 != ''){
					$mainWhere .= $sql3 . " and";
				}				
				$mainWhere = trim($mainWhere,'and');
				if($mainWhere != ''){
					$mainWhere = " and (".$mainWhere.")";
				}				
			}		
		 $sql="SELECT e.*,c.cat_name FROM wwc_manage_event e , wwc_manage_category c where c.cat_id=e.cat_id 
		 ".$mainWhere."
		order by event_startdate";
		$sql_query=$this->db->query($sql)->result_array();
		if(count($sql_query)==0)
		{
			$this->session->set_flashdata('result',"No records found");
		}
		$cat_list=$this->common_model->get_records('wwc_manage_category','',array('status !='=>2));
		$this->load->view('event',array('event_list'=>$sql_query,'cat_list'=>$cat_list));
	}
	public function join_event()
	{
		if(!empty($this->session->userdata('user_id')) && !empty($_POST['event_id']))
		{
			$user_id=$this->session->userdata('user_id');
			$sql="SELECT * from wwc_manage_seat where user_id='".$user_id."' and event_id='".$_POST['event_id']."'";
			$sql_query=$this->db->query($sql)->row_array();
			if(count($sql_query)>0)
			{
				  echo '2';
				  $this->session->set_flashdata('error','You are seat already reserved');
				//  redirect(base_url('event/event_details?id='.base64_encode($_POST['event_id'])));
			}
			else
			{
				  $sql_event="select id,event_title,event_seats from wwc_manage_event where id='".$_POST['event_id']."' and STR_TO_DATE(event_startdate,'%d-%m-%Y') >= STR_TO_DATE('".date('d-m-Y')."','%d-%m-%Y')";
				$sql_event_result=$this->db->query($sql_event)->row_array();
				$sql_result=count($this->db->query($sql_event)->result_array());
				
				$sql_seat="Select * from wwc_manage_seat where event_id=".$_POST['event_id'];
				$seat_count=count($this->db->query($sql_seat)->result_array());
				//echo $sql_event_result['event_seats']."gfrgfg";
				//echo $seat_count;exit;
								
				if($sql_result>0)
				{
				 if($seat_count<$sql_event_result['event_seats'])
				 {
				$insert_array=array(
								'user_id'=>$user_id,
								'event_id'=>$_POST['event_id'],
								'seat_book_date'=>date('d-m-Y')	
				);
				 echo "2";
				$this->common_model->add_records('wwc_manage_seat',$insert_array);
				$this->session->set_flashdata('success','You are seat reserved successfully');
				//redirect(base_url('event/event_details?id='.base64_encode($_POST['event_id'])));
				 }
				 else
				 {					
				  echo "2";
				  $this->session->set_flashdata('error','Seats are not available');
				 // redirect(base_url('event/event_details?id='.base64_encode($_POST['event_id'])));			  
				 }
				}
				else
				{
					echo "2";
					$this->session->set_flashdata('error','Event date is expire');
					//redirect(base_url('event/event_details?id='.base64_encode($_POST['event_id'])));
				}
			  }
			 
			  
					
			
		}
		else
		{
			$join_event=array('join_event'=>'event_details','event_id'=>base64_encode($_POST['event_id']));
			$this->session->set_flashdata('error','Please join event after login');
			$this->session->set_userdata($join_event);			
			echo "1";
			//redirect(base_url('event/event_details?id='.base64_encode($_POST['event_id'])));
		}
	}
	public function contactus()
	{
		if(!empty($_POST))
		{
			$to="ahernilesh74@gmail.com";
			$first_name=ucfirst($this->input->post('first_name'));
			$last_name=ucfirst($this->input->post('last_name'));
			$phone='';
			if(!empty(($this->input->post('phone'))))
			{
				$phone=$_POST['phone'];
			}

			$from=$this->input->post('email');
			$comment=$this->input->post('comment');
			
			$insert_array = array(
								'first_name'=>ucfirst($this->input->post('first_name')),
								'last_name'=>ucfirst($this->input->post('last_name')),
								'phone'=>base64_encode($this->input->post('phone')),
								'email'=>$this->input->post('email'),								
								'comment'=>	$comment,
								'status'=>'1'
								);
			$this->common_model->add_records('wwc_contact_us',$insert_array);
			//$this->session->set_flashdata('success','');
			
			
			
			$support_email="noreply@gmail.com";
			 $subject="Regarding user feedback";
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
												<h3 style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;">Dear Admins,<br/>
												The following user has submitted content from the contact us form</h3>
																							
												<br/>
												<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;">
														First Name :'.$first_name.'<br>
														Last Name  :'.$last_name.'<br>
														Email Id   :'.$from.'<br>
														Contact No.:'.$phone.'<br>
														Comment    :'.$comment.'<br>
												</p>
												
												
												<br/>
												<p>
												
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
			 $headers  = 'From: '.$from. "\r\n" .
								'Reply-To: '.$from. "\r\n" .
								'MIME-Version: 1.0' . "\r\n" .
								'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
								'X-Mailer: PHP/' . phpversion();
			if(@mail($to, $subject, $message, $headers))
			{
			  // echo "Sent successfully";
			}
			else
			{
				//echo "Not Sent";
			}
			
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
												<h3 style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;">Dear '.$first_name.' ,<br>
												Thank you for sharing your valuable feedback, below are the details you have submitted.
</h3>
																							
												<br/>
												<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;">
														First Name :'.$first_name.'<br>
														Last Name  :'.$last_name.'<br>
														Email Id   :'.$from.'<br>
														Contact No.:'.$phone.'<br>
														Comment    :'.$comment.'<br>
												</p>
												
												
												<br/>
												<p>
												Thanks,<br> 
												Admin.

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
			$headers  = 'From: '.$to. "\r\n" .
								'Reply-To: '.$to. "\r\n" .
								'MIME-Version: 1.0' . "\r\n" .
								'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
								'X-Mailer: PHP/' . phpversion();		
			if(@mail($from, $subject, $message, $headers))
			{
			  // echo "Sent successfully";
			}
			else
			{
				//echo "Not Sent";
			}
			
			redirect(base_url('event/contactus'));
			$this->session->set_flashdata('success','Your feedback successfully sent');
		}
		else
		{
		$this->load->view('contact_us');
		}
	}
}
