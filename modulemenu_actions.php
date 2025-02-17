<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;


$moduleid_chkall = $_REQUEST['modulecheck_list'];

switch($act)
{
	case 'insert':			
	break;
		
	case 'update':	 	
	//$edit_id
	$today=date("Y-m-d");	
if( $admin_id == '')$admin_id = 0;
	
	if(count($moduleid_chkall) > 0)
	{
        $str = "update ".tbl_modulemenus."  set isactive = 0, userid='".$_SESSION["UserId"]."'  where menuid = '".$edit_id."'"; 
		$db->insert($str);
 		foreach ($moduleid_chkall as $moduleid_chkall_S)
		{
 			$chkmodulethere_ed = $db->get_a_line("select modulemenuid from ".tbl_modulemenus."  where menuid = '".$edit_id."' and moduleid = '".$moduleid_chkall_S."' ");
			$chk_modulemenuid = $chkmodulethere_ed['modulemenuid'];
			
		
			
			if (isset($chk_modulemenuid)) {		
 				 $db->insert("update ".tbl_modulemenus."  set isactive = '1', userid='".$_SESSION["UserId"]."' where  modulemenuid ='".$chk_modulemenuid."'  ");
			}
			else{
 				
			$db->insert("insert into ".tbl_modulemenus." (moduleid,menuid,sortingorder,userid,isactive)values('".$moduleid_chkall_S."','".$edit_id."',0,'".$_SESSION["UserId"]."','1')  ");
					
			
				
			  $str = "insert into ".tbl_user_acl."  (roleid, modulemenuid, addprm, editprm, deleteprm, viewprm, approvalprm,expoprm,isactive,createdDate) values ('1','".$db->insert_id."', '1','1','1','1','1','1','1','".$today."')";

				$db->insert($str);
			
				
					/*	$str_sad_appr = "insert into m_rolepermissions (RoleId, Modulemenuid, AdminId, addprm, editprm, deleteprm, viewprm, approvalprm) values ('1','".$lst_insertid."', '".$admin_id."', '1','1','1','1','1')"; */
				
			}
		}	
	 	echo json_encode(array("rslt"=>"2")); //update success
	}
	else{
		echo json_encode(array("rslt"=>"4"));  //no values
	}
				
	break;
	
	case 'del':
	  /*$edit_id = base64_decode($Id);	  
	  $today = date("Y-m-d");*/		
	 
	  echo json_encode(array("rslt"=>"7")); // cannot change status	  	 
	  	 		
	break;
	
	case 'changestatus':
	  /*$edit_id = base64_decode($Id);	  
	  $today = date("Y-m-d");
	  $status = $actval;*/	  
	 echo json_encode(array("rslt"=>"7")); // cannot change status	  	
	  
	  
	  /*$edit_id = base64_decode($Id);	  
	  $today = date("Y-m-d");
	  $status = $actval;	
	  $str="update ".tbl_modulemenus."  set isactive = '".$status."', userid='".$_SESSION["UserId"]."' where menuid = '".$edit_id."'";
	
	  $db->insert($str); 
	  
	  $db->insert_log("changestatus","".tbl_modulemenus." ",$edit_id,"Status Changed","Module Menu Mapping",$str);	
	  echo json_encode(array("rslt"=>"6")); // cannot change status	   */
		
	break;
	
}



?>