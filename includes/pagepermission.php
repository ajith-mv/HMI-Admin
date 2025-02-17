<?php 

if($_SESSION["UserId"] != '' && $_SESSION['RoleId'] != '0') {
	
	if($mdme != '')
	    
		$sel_modm_prm = "SELECT m_rp.addprm, m_rp.editprm, m_rp.deleteprm, m_rp.viewprm, m_rp.approvalprm, m_rp.isactive FROM ".tbl_user_acl."  m_rp inner join ".tbl_users."  m_us on m_us.roleid = m_rp.roleid WHERE  m_rp.modulemenuid = '".base64_decode($mdme)."' and m_rp.roleid=".$_SESSION['RoleId']."  group by m_rp.modulemenuid"; 
	else
	   $sel_modm_prm = "SELECT m_rp.addprm, m_rp.editprm, m_rp.deleteprm, m_rp.viewprm, m_rp.approvalprm, m_rp.isactive FROM ".tbl_user_acl."  m_rp inner join ".tbl_users."  m_us on m_us.roleid = m_rp.roleid WHERE  m_rp.modulemenuid = '".base64_decode($_REQUEST['mdme'])."' and m_rp.roleid=".$_SESSION['RoleId']."  group by m_rp.modulemenuid"; 
	
		
 	 $res_modm_prm = $db->get_a_line($sel_modm_prm); 
	 // var_dump($res_modm_prm); exit;
 } 
?>



