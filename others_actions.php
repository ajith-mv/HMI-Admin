<?php 
include 'session.php';
extract($_REQUEST);

$pagename=$_REQUEST['pagename']; 

if($pagename == "modulemenusorting")
{
	$modulemenuId=$_REQUEST['modulemenuId']; 
	$sort_value=$_REQUEST['sort_value']; 
	
	$str = "update ".tbl_modulemenus." set sortingorder='".$sort_value."' where modulemenuid ='".$modulemenuId."'  ";

	 $db->insert_log("changestatus","".tbl_modulemenus."",$modulemenuId,"Module menu Changed","Module menu",$str);
	$db->insert("update ".tbl_modulemenus." set sortingorder='".$sort_value."' where modulemenuid ='".$modulemenuId."'  ");
	
	echo "success";
}
 
 

 
 

?>