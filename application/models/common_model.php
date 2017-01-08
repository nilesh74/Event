<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model 
{
	public function add_records($table_name,$insert_array)
	{
		if (is_array($insert_array)) 
		{
			if ($this->db->insert($table_name,$insert_array))
				return true;
			else
				return false;
		}
		else 
		{
			return false; 
		}
	}
	
	
	public function update_records($table_name,$update_array,$where_array)
	{
		if (is_array($update_array) && is_array($where_array)) 
		{
			$this->db->where($where_array);
			if($this->db->update($table_name,$update_array))
			{				 
				return true;
			}	
			else
			{
				return false;
			}	
		} 
		else 
		{
			return false;
		}
	}
	
	
	public function delete_records($table_name,$where_array)
	{ 
		if (is_array($where_array)) 
		{  
			$this->db->where($where_array);
			if($this->db->delete($table_name))
				return true;
			else
				return false;
		} 
		else 
		{
			return false;
		}
	}
	
	public function get_records($table_name,$filed_name_array=FALSE,$where_array=FALSE,$single_result=FALSE)
	{
		if(is_array($filed_name_array) && isset($filed_name_array))
	  	{
	  		$str=implode(',',$filed_name_array);
			$this->db->select($str);
		}
		
		if(is_array($where_array)&& isset($where_array))
		{
			$this->db->where($where_array);
		}

		$result=$this->db->get($table_name);
		
		if($single_result==true && isset($single_result))
		{
			return $result->row_array();
		} 
		else 
		{
			return $result->result_array();			
		}		
	}
	
	public function get_records_with_sort($table_name,$filed_name_array=FALSE,$where_array=FALSE,$single_result=FALSE,$sort_order=FALSE)
	{
		if(is_array($filed_name_array) && isset($filed_name_array))
	  	{
	  		$str=implode(',',$filed_name_array);
			$this->db->select($str);
		}
		
		if(is_array($where_array)&& isset($where_array))
		{
			$this->db->where($where_array);
		}
		
		if(isset($sort_order) && $sort_order!='')
		{
			$this->db->order_by($sort_order);
		}

		$result=$this->db->get($table_name);
		
		if($single_result==true && isset($single_result))
		{
			return $result->row_array();
		} 
		else 
		{
			return $result->result_array();			
		}		
	}
	
	public function get_records_subcat()
	{
		$this->db->select('wwc_manage_subcategory.*,wwc_manage_category.cat_name');
		$this->db->where('wwc_manage_subcategory.status !=','2');
		$this->db->where('wwc_manage_category.status ','1');
		$this->db->join('wwc_manage_category','wwc_manage_category.cat_id=wwc_manage_subcategory.cat_id');
		$result=$this->db->get('wwc_manage_subcategory');
		return $result->result_array();
	}
	public function niceTrim($string)
	{
		$sentences = preg_split('/(?<=[.?!;])\s+(?=\p{Lu})/', $string);

		$ii = 0;
		$paragraphs = array();
		foreach ( $sentences as $value ) {
			if ( isset($paragraphs[$ii]) ) { $paragraphs[$ii] .= $value; }
			else { $paragraphs[$ii] = $value; }
			if ( 19 < str_word_count($paragraphs[$ii]) ) {
				$ii++;
			}
		}
		return $paragraphs;
		
	}

	
}
