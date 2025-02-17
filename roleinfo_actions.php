<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;


if($chkAllprod !=null)
	$chkALL =1;
else
	$chkALL =0;

$created=date('Y-m-d H:i:s');
if($status == '')$status = 0;

switch($act)
{
	case 'insert':
	
	if(!empty($txtRoleName)) {
		$strChk = "select count(roleid) from ".tbl_roles."  where rolename = '$txtRoleName' and isactive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			$str="insert into ".tbl_roles." (rolename,IsAccessALL,isactive,userid,createddate)values('".getRealescape($txtRoleName)."','".$chkALL."','".$status."','".$_SESSION["UserId"]."','".$created."')";
	
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".tbl_roles." ","","Role Added Newly","role",$str);
			
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
	if(!empty($txtRoleName)) {
		$strChk = "select count(roleid) from ".tbl_roles."  where rolename = '$txtRoleName' and isactive != '2' and  roleid != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			 $str = "update ".tbl_roles."  set RoleName = '".getRealescape($txtRoleName)."', modifieddate = '$today' , userid='".$_SESSION["UserId"]."',isactive='".$status."',IsAccessALL='".$chkALL."'  where roleid = '".$edit_id."'";
		
		
			$db->insert_log("update","".tbl_roles." ",$edit_id,"Role  updated","Role",$str);
			$db->insert($str);
			

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
	  $today = date("Y-m-d");
	  
	  if($_SESSION['RoleId'] != $edit_id) 
	  {
		  $chkReference_ed = $db->get_a_line("select userid from ".tbl_users."  where roleid = '".$edit_id."' and isactive<>2 ");
		  $chk_Ref_there = $chkReference_ed['userid'];
		  
		  if (isset($chk_Ref_there)) {
			  echo json_encode(array("rslt"=>"7")); //Reference Exists cannot delete
		  }
		  else{
			$str="update ".tbl_roles."  set isactive = '2', modifieddate = '$today' , userid='".$_SESSION["UserId"]."'  where roleid = '".$edit_id."'";
			$db->insert_log("delete","".tbl_roles." ",$edit_id,"Role deleted","Role",$str);
			$db->insert($str); 	 
		  
			
			echo json_encode(array("rslt"=>"5")); //deletion  
		  }
	   }
	   else
	   		echo json_encode(array("rslt"=>"7")); //deletion cannot be done -  self role
	  		
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);
	  
	  $today = date("Y-m-d");
	  $status = $actval;
	  
	  //update role table	 
	  if($_SESSION['RoleId'] != $edit_id) 
	  {
		  $str="update ".tbl_roles."  set isactive = '$status', modifieddate = '$today' , userid='".$_SESSION["UserId"]."'  where roleid = '".$edit_id."'";
		
		  $db->insert($str); 	
	
		  //update user table to change the status based on the role status  	 
		  $str_update_users = " update ".tbl_users."  set isactive = '$status', userid='".$_SESSION["UserId"]."' where  roleid = '".$edit_id."' and isactive <>2 ";
		    $db->insert_log("update","".tbl_roles." ",$edit_id,"Role status Change","Role",$str_update_users);
		  $db->insert($str_update_users); 	
		  
		
		  echo json_encode(array("rslt"=>"6")); //status update success
		}
		else
			echo json_encode(array("rslt"=>"7")); //status update cannot be done -  self role
	  	 
		
	break;
}



?>