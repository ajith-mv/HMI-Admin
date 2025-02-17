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
	
	if(!empty($txtMenuname)) {
		$strChk = "select count(menuid) from ".tbl_menus."  where menuname = '$txtMenuname' and isactive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			$str="insert into ".tbl_menus." (menuname,description,isactive,sortingorder,userid,parent,moduleicon)values('".getRealescape($txtMenuname)."','".getRealescape($txtMenuDesc)."','".$status."','".$txtSortingorder."','".$_SESSION["UserId"]."','0','".$menuicon."')";
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".tbl_menus." ","","Menu Added Newly","menu",$str);
			
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
	if(!empty($txtMenuname)) {
		$strChk = "select count(menuid) from ".tbl_menus."  where menuname = '$txtMenuname' and isactive != '2' and menuid != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			$str = "update ".tbl_menus."  set menuname = '".getRealescape($txtMenuname)."',description='".getRealescape($txtMenuDesc)."', sortingorder = '".$txtSortingorder."', modifieddate = '$today' , userid='".$_SESSION["UserId"]."',moduleicon='".$menuicon."',isactive='".$status."'  where menuid = '".$edit_id."'";
		
			$db->insert($str);
			$db->insert_log("update","".tbl_menus." ",$edit_id,"Menu updated","Menu",$str);

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
	  $str="update ".tbl_menus."  set isactive = '2', modifieddate = '$today' , userid='".$_SESSION["UserId"]."'  where menuid = '".$edit_id."'  ";
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".tbl_menus." ",$edit_id,"Menu deleted","Menu",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	$today = date("Y-m-d");
	$status = $actval;
	
	 if($edit_id !="1"){
		$str="update ".tbl_menus."  set isactive = '".$status."', modifieddate = '$today' , userid='".$_SESSION["UserId"]."'  where menuid = '".$edit_id."'  ";
		$db->insert($str); 	
		echo json_encode(array("rslt"=>"6")); //status update success
	 }
	 else{		 
		echo json_encode(array("rslt"=>"7")); // cannot change status	  
	 }	
	
	break;
	
	
}



?>