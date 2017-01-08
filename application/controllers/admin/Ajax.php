<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
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
	
	public function get_subcat()
	{
		$id=$_POST['id'];
		$get_subcat_res = $this->common_model->get_records('wwc_manage_subcategory','',array('cat_id'=>$id,'status'=>1),'');
		
		$html = '';	
		if(count($get_subcat_res)>0)
		{
			$html .="<option value=''>Select subcategory</option>";
			
			foreach($get_subcat_res as $res)
			{
				$html .="<option value='".$res['subcat_id']."'>".ucfirst($res['subcat_name'])."</option>";
			}
		}
		else
		{
			$html .="<option value=''>No subcategory available</option>";
		}		
		echo $html;
	}


	public function  remove_image()
	{
		$product_id=$_POST['prod_id']; 
		$img_id=$_POST['img_id']; 
		$img_name=$_POST['img_name']; 
		$this->db->where('product_img_id',$img_id);
		if($this->db->delete('wwc_manage_product_images'))
		{
			@unlink(realpath('assets/admin/images/product/'.$product_id.'/'.$img_name));
		}	
	}
	
	public function set_front()
    {		$product_id = $_POST['prod_id']; 
		    $img_id = $_POST['img_id']; 
		    $this->db->where('product_id',$product_id);
			$this->db->update('wwc_manage_product_images',array('status'=>'0'));
			$this->db->where('product_img_id',$img_id);
			if($this->db->update('wwc_manage_product_images',array('status'=>'1')))
			{
			  echo "set";
			}
	}

	
}
?>