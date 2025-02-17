<?php 
//include "../includes/header.php";
function getSelectBox_rolelist($db, $SelName, $Attr,$selId=null,$storeId=null,$otherAttr=null) {
		$StrQry="select RoleId AS Id,RoleName AS Name from ".tbl_roles."  where isactive = '1' and RoleId <> 1 ".$strCon." order by RoleName asc";
		$resQry = $db->get_rsltset($StrQry);		
		$strSelHtml =  "<select ".$otherAttr." class='form-control select2'  ".$Attr." id='".$SelName."' name='".$SelName."' >
							<option value=''   selected='selected' disabled=''  >Select</option>";

		if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}


function getSelectBox_menulist($db, $SelName, $jrequired,$Attr,$selId=null) {
	$StrQry="select menuid AS Id,menuname AS Name from ".tbl_menus."  where isactive = '1' order by menuname asc";
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2' ".$jrequired." id='".$SelName."' name='".$SelName."'  ".$Attr." >
						<option value=''  selected='selected' disabled=''>Select</option>";

	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}	
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}

function getSelectBox_smomaster($db, $SelName, $jrequired,$Attr,$selId=null) {
	$StrQry="select smomid AS Id,title AS Name from ".tbl_smomaster."  where isactive = '1' order by title asc";
	$resQry = $db->get_rsltset($StrQry);		
	$strSelHtml =  "<select class='form-control select2' ".$jrequired." id='".$SelName."' name='".$SelName."'  ".$Attr." >
						<option value=''  selected='selected' disabled=''>Select</option>";

	if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}	
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}

function getSelectBox_ProjectCategorylist($db, $SelName, $Attr,$selId=null,$storeId=null,$otherAttr=null) {
		$StrQry="select pcid AS Id,pctitle AS Name from ".tbl_projectcategory."  where isactive = '1' ".$strCon." order by pctitle asc";
		$resQry = $db->get_rsltset($StrQry);		
		$strSelHtml =  "<select ".$otherAttr." class='form-control select2'  ".$Attr." id='".$SelName."' name='".$SelName."' >
							<option value=''   selected='selected' disabled=''  >Select</option>";

		if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}

function getSelectBox_ProjectStatuslist($db, $SelName, $Attr,$selId=null,$storeId=null,$otherAttr=null) {
		$StrQry="select psid AS Id,pstitle AS Name from ".tbl_projectstatus."  where isactive = '1' ".$strCon." order by pstitle asc";
		$resQry = $db->get_rsltset($StrQry);		
		$strSelHtml =  "<select ".$otherAttr." class='form-control select2'  ".$Attr." id='".$SelName."' name='".$SelName."' >
							<option value=''   selected='selected' disabled=''  >Select</option>";

		if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}

function getSelectBox_schoolslist($db, $SelName, $Attr,$selId=null,$storeId=null,$otherAttr=null) {
	
	
	    $cond_school ='';
	
		if($_SESSION["shlid"]!= 1){
		$cond_school =" and shlid='".$_SESSION["shlid"]."' ";
		}
		
		$StrQry="select shlid AS Id,shlname AS Name from ".tbl_schoolsname."  where isactive = '1'".$strCon."".$cond_school." order by shlid asc";
		$resQry = $db->get_rsltset($StrQry);		
		$strSelHtml =  "<select ".$otherAttr." class='form-control select2'  ".$Attr." id='".$SelName."' name='".$SelName."'  >
							<option value=''   selected='selected' disabled=''  >Select</option>";

		if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			//$sel=' disabled = "disabled" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	$strSelHtml=$strSelHtml."</select>";

	return $strSelHtml;	
}











function getSelectBox_Departmentlist($db, $SelName, $Attr,$selId=null,$storeId=null,$otherAttr=null) {
	
	
	    $StrQry="select depid AS Id,departmentname AS Name from ".tbl_department."  where isactive = '1'".$strCon." order by depid asc";
		$resQry = $db->get_rsltset($StrQry);		
		$strSelHtml =  "<select ".$otherAttr." class='form-control select2'  ".$Attr." id='".$SelName."' name='".$SelName."'  >
							<option value=''   selected='selected' disabled=''  >Select</option>";

		if(!empty($resQry)) {
		foreach($resQry as $val) {
		$sel='';
			if($selId==$val['Id'])
				$sel=' selected="selected" ';
			//$sel=' disabled = "disabled" ';
			$strSelHtml=$strSelHtml."<option value=".$val['Id']." ".$sel.">".$val['Name']."</option>";
		}
	}
	$strSelHtml=$strSelHtml."</select>";
	return $strSelHtml;	
}

?>