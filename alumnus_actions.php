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
	  $str="update ".tbl_alumni."  set isactive = '2'  where aluid = '".$edit_id."'  ";
	 //echo $str; exit;
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".tbl_alumni." ",$edit_id,"Alumni deleted","Alumni",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	
	break;
	
	
}



?>