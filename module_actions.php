<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;
$created=date('Y-m-d H:i:s');

switch($act)
{
	case 'insert':
	
	if(!empty($txtModulename) ) {
		$strChk = "select count(moduleid) from ".tbl_modules."  where modulename = '$txtModulename' and isactive != '2'";		
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			$str="insert into ".tbl_modules." (modulename,Description,modulepath,isactive,userid,createddate,SortingOrder) values('".getRealescape($txtModulename)."','".getRealescape($txtModuledescription)."','".getRealescape($txtModulepath)."','".$status."','".$_SESSION["UserId"]."','".$created."',0)";
			
			$rslt = $db->insert($str);	
			
			$log = $db->insert_log("insert","".tbl_modules." ","","Module Added Newly","module",$str);
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
 
 	$today=date("Y-m-d");	
	if(!empty($txtModulename) ) {
		$strChk = "select count(moduleid) from ".tbl_modules."  where modulename = '$txtModulename' and isactive != '2' and moduleid != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			$str = "update ".tbl_modules."  set modulename = '".getRealescape($txtModulename)."', description = '".getRealescape($txtModuledescription)."', modulepath = '".getRealescape($txtModulepath)."', isactive = '".$status."', modifieddate = '$today' , userid='".$_SESSION["UserId"]."' where moduleid = '".$edit_id."'";
			
				
			$db->insert($str);
			$db->insert_log("update","".tbl_modules." ",$edit_id,"Module  updated","module",$str);

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
	  $str="update ".tbl_modules."  set isactive = '2', modifieddate = '$today' , userid='".$_SESSION["UserId"]."'  where moduleid = '".$edit_id."'  and moduleid NOT IN(1,2,3) ";
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".tbl_modules." ",$edit_id,"Module deleted","Module",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
	break;
	
	case 'changestatus':
		$edit_id = base64_decode($Id);
		$today = date("Y-m-d");
		$status = $actval;
		
		if($edit_id !="1" && $edit_id !="2" && $edit_id !="3"){			
			$str="update ".tbl_modules."  set isactive = '".$status."', modifieddate = '$today' , userid='".$_SESSION["UserId"]."'  where moduleid = '".$edit_id."' and moduleid NOT IN(1,2,3) ";
			$db->insert($str); 		
			echo json_encode(array("rslt"=>"6")); //status update success		
		}
		else{		 
			echo json_encode(array("rslt"=>"7")); // cannot change status	  
		}
			
	
	break;
}



?>