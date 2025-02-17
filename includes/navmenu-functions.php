<?php 

function getTopMenuArray($db, $RoleId=null,$admin_id=null){
	$str_Pra="";
	if($admin_id != '' && $_SESSION['RoleId'] != '0') { 
		$strmenu=" m_us.userid = '".$admin_id."' and m_md.isactive=1 ";
		if($_SESSION['RoleId']==1)
			$strmenu=" m_md.isactive=1 and m_rp.roleid=1 ";	
	
	
		$select_mnu = "SELECT distinct m_me.menuname,m_mdm.menuid,m_me.moduleicon FROM ".tbl_modules."  m_md inner join ".tbl_modulemenus."  m_mdm on m_mdm.moduleid = m_md.moduleid inner join ".tbl_menus."  m_me on m_me.menuid = m_mdm.menuid inner join ".tbl_user_acl."  m_rp on m_rp.modulemenuid = m_mdm.modulemenuid inner join ".tbl_users."  m_us on m_us.roleid = m_rp.roleid and m_us.isactive = '1' WHERE m_rp.roleid=".$_SESSION['RoleId']." and m_md.isactive = '1' and m_mdm.isactive = 1 and m_me.isactive = 1 and m_rp.isactive = 1  group by m_rp.modulemenuid order by m_me.SortingOrder, m_mdm.menuid, m_mdm.SortingOrder ";	
		} 	




		return $db->get_rsltset($select_mnu); 
}

function getTopMenuModuleArray($db, $RoleId=null,$admin_id=null,$MnuId){
	$str_Pra="";
	if($admin_id != '' && $_SESSION['RoleId'] != '0') { 
		$strmenu=" m_us.UserId = '".$admin_id."' and m_md.isactive=1 ";
		if($_SESSION['RoleId']==1)
			$strmenu=" m_md.isactive=1 and m_rp.roleid=1 ";
			
	  	 $select_modm = "SELECT m_me.menuname,m_md.modulename, m_md.modulepath,m_md.Description, m_rp.modulemenuid FROM ".tbl_modules."  m_md inner join ".tbl_modulemenus."  m_mdm on m_mdm.moduleid = m_md.moduleid inner join ".tbl_menus."  m_me on m_me.menuid = m_mdm.menuid inner join ".tbl_user_acl."  m_rp on m_rp.modulemenuid = m_mdm.modulemenuid inner join ".tbl_users."  m_us on m_us.roleid = m_rp.roleid and m_us.isactive = '1' WHERE m_rp.roleid=".$_SESSION['RoleId']."  and m_me.isactive = 1 and m_md.isactive=1 and m_mdm.menuid = ".$MnuId." and m_rp.isactive = 1  and m_mdm.isactive = 1 group by m_rp.modulemenuid order by m_me.SortingOrder, m_mdm.menuid, m_mdm.SortingOrder ";
	}		
	return $db->get_rsltset($select_modm); 
}

function getModuleTitle($db,$modulePath){
	$str_Pra="";	 	
	$select_modm = "SELECT modulename FROM ".tbl_modules."  where modulepath = '$modulePath' ";		
	return $db->get_rsltset($select_modm); 
}

function getStoreLogo($db,$Path=null){
	$str_Pra="";	 	
	$select_modm = "SELECT `key`, `value` FROM ".tbl_configuration." where `key`  = 'ecomLogo' and isactive = '1' ";		
	return $db->get_a_line($select_modm); 
}

function getStorefavi($db,$Path=null){
	$str_Pra="";	 	
	$select_modm = "SELECT `key`, `value` FROM ".tbl_configuration." where `key`  = 'favIcon' and isactive = '1' ";		
	return $db->get_a_line($select_modm); 
}

function getStoreTitle($db,$Path=null){
	$str_Pra="";	 	
	$select_modm = "SELECT `key`, `value` FROM ".tbl_configuration." where `key`  = 'storeName' and isactive = '1' ";		
	$rslt= $db->get_a_line($select_modm); 
	return $rslt['value'];
}

function getStoreDate($db,$Path=null){
	$str_Pra="";	 
	$select_modm = "SELECT `key`, `value` FROM ".tbl_configuration." where `key` = 'dateFormat' and isactive = '1' ";	
	return $db->get_a_line($select_modm); 
}

function getAdminUsrDet($db, $RoleId=null,$admin_id=null) {
	$str_Pra="";
	if($admin_id != '' && $_SESSION['RoleId'] != '0') { 
		$select_mnu = "SELECT user_photo from ".tbl_users."  where isactive = 1 and userid = $admin_id";			
	} 	
	return $db->get_a_line($select_mnu); 
}
?>