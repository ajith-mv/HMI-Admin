<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

switch($act)
{
	case 'insert':
	
	
	
	break;
	
	
	case 'update':	 	
	
		
	break;
	
	case 'del':
	  $edit_id = base64_decode($Id);
	  
	  $today = date("Y-m-d");
	   $str="update ".tbl_contact."  set isactive = '2'  where cid = '".$edit_id."'  ";
	  
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".tbl_contact." ",$edit_id,"Cantact_us deleted","Cantact_us",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	
	break;
	
	
}



?>