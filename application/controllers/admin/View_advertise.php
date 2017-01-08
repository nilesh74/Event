  <?php
include("connect.php");
  
	$query="SELECT * FROM `tbl_advertise` WHERE status='1' ORDER BY advertise_id DESC";
	$sql=mysql_query($query);
	
	$jsonObj= array();
	$response=array();
	while($image=mysql_fetch_array($sql))
	{
			   $response["adv_id"] = $image["advertise_id"];
			   $response["adv_title"] = $image["advertise_title"];
			   $response["adv_image"] = "http://event.framework4.net/admin_new/assets/admin/images/advertise/thumb/".$image["advertise_image"];
			   $response["adv_link"] = $image["advertise_url"];
			  
			   $final_res[]=$response;
    
	}
	 echo json_encode(array('success'=>"Image List",'Result'=>$final_res));
?>
