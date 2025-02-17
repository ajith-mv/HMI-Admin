<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

switch($act)
{
	case 'insert':			
	break;
		
	case 'update':	 	
 	$today=date("Y-m-d");	
	
	$mainmenu_list = $db->get_rsltset("select t1.menuid,t2.menuname from ".tbl_modulemenus."  t1 inner join ".tbl_menus."  t2 on t1.menuid = t2.menuid and t2.isactive =1 where 1=1 and t1.isactive = 1 group by t1.menuid");
	foreach($mainmenu_list as $mainmenu_list_S)
	{
	 $page_list =$db->get_rsltset("select t1.*,t2.menuname,t3.modulename,t3.description,t3.modulepath from ".tbl_modulemenus."  t1 inner join ".tbl_menus."  t2 on t1.menuid = t2.menuid and t2.isactive =1 inner join ".tbl_modules."  t3 on t1.moduleid = t3.moduleid and t3.isactive =1 	 where 1=1 and  t1.isactive =1 and t1.menuid='".$mainmenu_list_S['menuid']."' order by t1.moduleid asc ");
	    foreach($page_list as $page_list_S)
		{
			$chk_modulemenuid = $page_list_S['modulemenuid'];
            $chk_addprm = 0; 
			$chk_editprm = 0;
			$chk_deleteprm = 0; 
			$chk_viewprm = 0;									 				
			
			if(isset($_POST['addprm_'.$chk_modulemenuid]))
				$chk_addprm = 1;
			if(isset($_POST['editprm_'.$chk_modulemenuid]))
				$chk_editprm = 1;
			if(isset($_POST['deleteprm_'.$chk_modulemenuid]))
				$chk_deleteprm = 1;
			if(isset($_POST['viewprm_'.$chk_modulemenuid]))
				$chk_viewprm = 1;
			
			if($chk_addprm == 1 || $chk_editprm == 1 || $chk_deleteprm == 1 || $chk_viewprm == 1){
				
				$chkexists_ed = $db->get_a_line("select acl_Id from ".tbl_user_acl."  where roleid = '".$edit_id."' and modulemenuid = '".$chk_modulemenuid."' ");
				$chk_aclid = $chkexists_ed['acl_Id'];
				
				if (isset($chk_aclid)) {					
					 $db->insert("update ".tbl_user_acl."  set addprm = '".$chk_addprm."',editprm = '".$chk_editprm."',deleteprm = '".$chk_deleteprm."',viewprm = '".$chk_viewprm."', userid='".$_SESSION["UserId"]."', isactive=1  where acl_Id ='".$chk_aclid."' ");
				}
				else{
 					
					$db->insert("insert into ".tbl_user_acl." (roleid,modulemenuid,addprm,editprm,deleteprm,viewprm,userid,isactive,approvalprm,createdDate)values('".$edit_id."','".$chk_modulemenuid."','".$chk_addprm."','".$chk_editprm."','".$chk_deleteprm."','".$chk_viewprm."','".$_SESSION["UserId"]."','1',0,'".date('Y-m-d')."')  ");
				}
			}
			else{
				$chkexists_ed = $db->get_a_line("select acl_Id from ".tbl_user_acl."  where roleid = '".$edit_id."' and modulemenuid = '".$chk_modulemenuid."' ");
				$chk_aclid = $chkexists_ed['acl_Id'];
				
				if (isset($chk_aclid)) {
					 $db->insert("update ".tbl_user_acl."  set addprm = '".$chk_addprm."',editprm = '".$chk_editprm."',deleteprm = '".$chk_deleteprm."',viewprm = '".$chk_viewprm."', userid='".$_SESSION["UserId"]."',isactive=0  where acl_Id ='".$chk_aclid."' ");
				}
			}	
		}
	}	
	echo json_encode(array("rslt"=>"2")); //update success
						
	break;
	
	case 'del':
 	  echo json_encode(array("rslt"=>"7")); // cannot change status	  	 
	  	 		
	break;
	
	case 'changestatus':
 	  echo json_encode(array("rslt"=>"7")); // cannot change status	  	 
		
	break;
	
}



?>