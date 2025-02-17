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
	
	if(!empty($departmentname)) {
		$strChk = "select count(depid) from ".tbl_department."  where departmentname = '$departmentname' and isactive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			if(empty($sortingorder)){
			    $sortingorder = 0;
			}
			
			
			
			$str="insert into ".tbl_department." (departmentname,sortingorder,isactive,userid)values('".getRealescape($departmentname)."','".$sortingorder."','".$status."','".$_SESSION["UserId"]."')";
			
			
			

			
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".tbl_department." ","","Department Added Newly","menu",$str);
			
 			echo json_encode(array("rslt"=>"1")); //success
		}
		else {
			 echo json_encode(array("rslt"=>"3")); //same exists
		}
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	
	break;
	
	
	case 'update':	 	
	//$edit_id
	$today=date("Y-m-d");	
	if(!empty($departmentname)) {
		$strChk = "select count(depid) from ".tbl_department."  where departmentname = '$departmentname' and isactive != '2' and depid != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			$str = "update ".tbl_department."  set departmentname = '".getRealescape($departmentname)."',sortingorder = '".getRealescape($sortingorder)."', userid='".$_SESSION["UserId"]."',isactive='".$status."'  where depid = '".$edit_id."'";
		
			$db->insert($str);
			$db->insert_log("update","".tbl_department." ",$edit_id,"Department updated","Department",$str);

			echo json_encode(array("rslt"=>"2"));
		}
		else {
			echo json_encode(array("rslt"=>"3")); //same exists
		}
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
		
	break;
	
	case 'del':
	  $edit_id = base64_decode($Id);
	  
	  $str="update ".tbl_department."  set isactive = '2', userid='".$_SESSION["UserId"]."'  where depid = '".$edit_id."'  ";
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".tbl_department." ",$edit_id,"Department deleted","Department",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	
	$status = $actval;

		$str="update ".tbl_department."  set isactive = '".$status."', userid='".$_SESSION["UserId"]."'  where depid = '".$edit_id."'  ";
		
		$db->insert($str); 	
		echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
	
	
}



?>