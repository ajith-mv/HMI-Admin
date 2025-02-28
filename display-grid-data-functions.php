<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
function checkIsactive($prefix, $value)
{
	$actives = '';
	$inactives = '';
	$activea = array("active", "Active");
	if (in_array($value, $activea)) {
		$actives = "or " . $prefix . "isactive =1";
	}

	$inactivea = array("inactive", "Inactive", "inActive");
	if (in_array($value, $inactivea)) {
		$inactives = "or " . $prefix . "isactive =0";
	}
	$statuscheck = $actives . $inactives;
	return $statuscheck;
}

//Menu Master

function getAllnewscat($db, $ctid)
{

	$str_all = "select * from " . tbl_newscategory . "  where catid = " . $ctid . " and isactive <> 2 ";
	// echo $str_all;
	// die();
	$rescntchk = $db->get_a_line($str_all);
	// 	var_dump($rescntchk);
// 	die();
	return $rescntchk;
}

function getAllgallerycat($db, $ctid)
{
	$str_all = "select * from " . tbl_gallerycategory . "  where catid = " . $ctid . " and isactive <> 2 ";
	// echo $str_all;
	// die();
	$rescntchk = $db->get_a_line($str_all);
	// 	var_dump($rescntchk);
// 	die();
	return $rescntchk;
}
function getMenuArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select count(*) as cnt from " . tbl_menus . "  where 1=1 and isactive <>2 ";
	if ($whrcon != "")

		$str_all .= $whrcon;
	$res = $db->get_a_line($str_all);
	return $res['cnt'];
}

function getMenuArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select * from " . tbl_menus . "  where 1=1 and isactive <> 2 ";
	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}

//Menu Master end

//Module List Display Grid - START

function getModuleArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select * from " . tbl_modules . "  where 1=1 and isactive <>2 ";
	if ($whrcon != "")
		$str_all .= $whrcon;
	$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}

function getModuleArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select * from " . tbl_modules . "  where 1=1 and isactive <> 2 ";

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;

	$res = $db->get_rsltset($str_all);
	$totalData = count($res);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}
//Module List Display Grid - END

//ModuleMenu List Display Grid - START

function getModuleMenuArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select * from " . tbl_menus . "  where isactive = '1' ";

	if ($whrcon != "")
		$str_all .= $whrcon;

	$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}


function getModuleMenuArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select * from " . tbl_menus . "  where isactive = '1' ";
	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;
	if (trim($ordr) != "")
		$str_all .= $ordr;
	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;

	$res = $db->get_rsltset($str_all);
	$totalData = count($res);

	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}
//ModuleMenu List Display Grid - END


//Role List Display Grid - START
function getRoleArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select * from " . tbl_roles . "  r where  r.isactive <>2 and r.RoleId <> 1";
	if ($whrcon != "")
		$str_all .= $whrcon;
	$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}

function getRoleArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$constr = "";



	$str_all = "select r.*,(case when IsAccessALL=1 then 'Yes' else 'No' end) as accessall from " . tbl_roles . "  r where  r.isactive <> 2 and r.RoleId <> 1 " . $constr;


	if ($whrcon != "")
		$str_all .= $whrcon;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;

	$res = $db->get_rsltset($str_all);


	return $res;
}
//Role List Display Grid - END


//Permission Info List Display Grid - START

function getPermissionInfoArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$constr = "";

	$str_all = "select * from " . tbl_roles . "  r  where  r.isactive <>2 and r.RoleId <> 1" . $constr;
	if ($whrcon != "")
		$str_all .= $whrcon;
	$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}


function getPermissionInfoArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$constr = "";

	$str_all = "select * from " . tbl_roles . "  r  where  r.isactive <> 2 and r.RoleId <> 1 " . $constr;

	if ($whrcon != "")
		$str_all .= $whrcon;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;

	$res = $db->get_rsltset($str_all);
	return $res;
}
//Permission Info List Display Grid - END


//User List Display Grid - START
function getUserArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	//$str_all = "select u.*,r.RoleName from " . tbl_users . "  u inner JOIN  " . tbl_roles . "  r on u.RoleId = r.RoleId  where  u.isactive <> 2 and u.userid <> 1   and u.userid <> " . $_SESSION["UserId"] . "   " . $constr;


	// $str_all = "select * from " . tbl_users . "  u inner JOIN  " . tbl_roles . "  r on u.RoleId = r.RoleId  where  u.isactive <> 2   ";

	$str_all = "select * from " . tbl_users . " where isactive <> 2   ";

	if ($whrcon != "")
		$str_all .= $whrcon;


	// print_r($str_all);
	// die();


	$res = $db->get_rsltset($str_all);
	return $totalData = count($res);
}

function getUserArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select ROW_NUMBER() OVER (ORDER BY u.userid DESC) AS serial_number ,u.userid, u.user_firstname, u.user_lastname, u.user_name, u.user_email, u.isactive, u.createdby, u.createddate, u.modifieddate, u.sroleid, u.shlid
 from " . tbl_users . "  u LEFT JOIN  " . tbl_roles . "  r on u.RoleId = r.RoleId LEFT JOIN " . tbl_schoolsname . " s on u.shlid = s.school_id where  u.isactive <> 2  " . $constr;





	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;
	// 		echo $str_all;
// 		die();

	$res = $db->get_rsltset($str_all);

	return $res;
}
//User List Display Grid - END

//NewsEvents START
function getnewseventsArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		// $cond_school =" and ".tbl_newsevents.".shlid='".$_SESSION["shlid"]."' ";
	}
	$str_all = "select count(*) as cnt from " . tbl_newsevents . "," . tbl_schoolsname . "  where " . tbl_newsevents . ".school_id=" . tbl_schoolsname . ".school_id and " . tbl_newsevents . ".isactive <> 2 " . $cond_school . " ";

	// 	$str_all="select count(*) as cnt from ".tbl_newsevents." where isactive <> 2 ".$cond_school." ";	

	if ($whrcon != "")

		$str_all .= $whrcon;

	$res = $db->get_a_line($str_all);

	return $res['cnt'];

}

function getnewseventsArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		$cond_school = " and " . tbl_newsevents . ".shlid='" . $_SESSION["shlid"] . "' ";
	}

	// $str_all = "select * from " . tbl_newsevents . "  where isactive <> 2 " . $cond_school . " ";
	// $str_all = "select " . tbl_newsevents . ".*," . tbl_schoolsname . ".shlname,DATE_FORMAT(newsdate,'%d-%m-%Y') as date from " . tbl_newsevents . "," . tbl_schoolsname . "  where " . tbl_newsevents . ".school_id=" . tbl_schoolsname . ".school_id and " . tbl_newsevents . ".isactive <> 2 " . $cond_school . " ";

	$str_all = "SELECT ROW_NUMBER() OVER (ORDER BY " . tbl_newsevents . ".newsid DESC) AS serial_number," . tbl_newsevents . ".*," . tbl_schoolsname . ".shlname,
    DATE_FORMAT(" . tbl_newsevents . ".newsdate, '%d-%m-%Y') AS date FROM " . tbl_newsevents . " INNER JOIN " . tbl_schoolsname . " ON " . tbl_newsevents . ".school_id = " . tbl_schoolsname . ".school_id 
	WHERE " . tbl_newsevents . ".isactive <> 2 " . $cond_school;

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}

//NewsEvents - END



//NewsEvents START
function getnewscategoryArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$str_all = "select count(*) as cnt from " . tbl_newscategory . " where isactive <> 2 ";

	if ($whrcon != "")

		$str_all .= $whrcon;

	$res = $db->get_a_line($str_all);

	return $res['cnt'];

}

function getnewscategoryArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	// $str_all = "select * from " . tbl_newscategory . "  where isactive <> 2 ";

	$str_all = "select ROW_NUMBER() OVER (ORDER BY catid DESC) AS serial_number, catid, name, urlslug, types, isactive, ishome, homeorder, subcategory from " . tbl_newscategory . "  where isactive <> 2 ";

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}

//NewsEvents - END


function getgallerycategoriesArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$str_all = "select count(*) as cnt from " . tbl_gallerycategory . " where isactive <> 2 ";

	if ($whrcon != "")

		$str_all .= $whrcon;

	$res = $db->get_a_line($str_all);

	return $res['cnt'];

}

function getgallerycategoriesArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{


	$str_all = "select ROW_NUMBER() OVER (ORDER BY catid DESC) AS serial_number, catid, name, slug, image, category, color, description, body_shape, specfic, hardware_color, meta_title, meta_desc, isactive, userid, createddate, modifydate from " . tbl_gallerycategory . "  where isactive <> 2 ";

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}

//Gallery START
function getGalleryArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		// $cond_school =" and ".tbl_gallery.".shlid='".$_SESSION["shlid"]."' ";
	}


	$str_all = "select count(*) as cnt from " . tbl_gallery . "," . tbl_schoolsname . "  where " . tbl_gallery . ".school_id=" . tbl_schoolsname . ".school_id and " . tbl_gallery . ".isactive <> 2 " . $cond_school . " ";


	if ($whrcon != "")

		$str_all .= $whrcon;

	// 	echo $str_all;
// 	die();
	$res = $db->get_a_line($str_all);
	return $res['cnt'];
}

function getGalleryArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		// $cond_school =" and ".tbl_gallery.".shlid='".$_SESSION["shlid"]."' ";
	}

	// 		$str_all="select *, DATE_FORMAT(glydate,'%d-%m-%Y') as glydate from ".tbl_gallery." where isactive <> 2 ".$cond_school." "; 
	$str_all = "select " . tbl_gallery . ".*," . tbl_schoolsname . ".shlname,DATE_FORMAT(glydate,'%d-%m-%Y') as date from " . tbl_gallery . "," . tbl_schoolsname . "  where " . tbl_gallery . ".school_id=" . tbl_schoolsname . ".school_id and " . tbl_gallery . ".isactive <> 2 " . $cond_school . " ";

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}

//Gallery - END


//Notice Board START
function getNoticeArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		$cond_school = " and " . tbl_noticeboard . ".shlid='" . $_SESSION["shlid"] . "' ";
	}


	$str_all = "select count(*) as cnt from " . tbl_noticeboard . "," . tbl_schoolsname . "  where " . tbl_noticeboard . ".shlid=" . tbl_schoolsname . ".shlid and " . tbl_noticeboard . ".isactive <> 2 " . $cond_school . " ";

	if ($whrcon != "")

		$str_all .= $whrcon;
	$res = $db->get_a_line($str_all);
	return $res['cnt'];
}

function getNoticeArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{


	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		$cond_school = " and " . tbl_noticeboard . ".shlid='" . $_SESSION["shlid"] . "' ";
	}

	$str_all = "select " . tbl_noticeboard . ".*,DATE_FORMAT(date,'%d-%m-%Y') as date," . tbl_schoolsname . ".shlname from " . tbl_noticeboard . "," . tbl_schoolsname . "  where " . tbl_noticeboard . ".shlid=" . tbl_schoolsname . ".shlid and " . tbl_noticeboard . ".isactive <> 2 " . $cond_school . " ";



	/*
																																																																																																																																																													  $str_all = "select *,DATE_FORMAT(newsdate,'%d-%m-%Y') as newsdate from ".tbl_newsevents." where isactive <> 2 ";
																																																																																																																																																													  */



	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}

//Notice Board - END

//Staff Listing START
function getStaffArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		$cond_school = " and " . tbl_stafflisting . ".shlid='" . $_SESSION["shlid"] . "' ";
	}
	$str_all = "select count(*) as cnt from " . tbl_stafflisting . "," . tbl_schoolsname . "  where " . tbl_stafflisting . ".shlid=" . tbl_schoolsname . ".shlid and " . tbl_stafflisting . ".isactive <> 2 " . $cond_school . " ";
	if ($whrcon != "")

		$str_all .= $whrcon;
	$res = $db->get_a_line($str_all);
	return $res['cnt'];
}

function getStaffArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		$cond_school = " and " . tbl_stafflisting . ".shlid='" . $_SESSION["shlid"] . "' ";
	}

	$str_all = "select DATE_FORMAT(" . tbl_stafflisting . ".createdate,'%d-%m-%Y') as date , " . tbl_stafflisting . ".*," . tbl_schoolsname . ".shlname," . tbl_department . ".departmentname from " . tbl_stafflisting . "," . tbl_schoolsname . "," . tbl_department . "  where " . tbl_stafflisting . ".shlid=" . tbl_schoolsname . ".shlid and " . tbl_department . ".depid=" . tbl_stafflisting . ".depid  and " . tbl_stafflisting . ".isactive <> 2 " . $cond_school . " ";

	//echo $str_all;		exit;

	/*
																																																																																																																																																													  $str_all = "select *,DATE_FORMAT(newsdate,'%d-%m-%Y') as newsdate from ".tbl_newsevents." where isactive <> 2 ";
																																																																																																																																																													  */

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}

//Staff Listing - END


//Announcement START
function getAnnouncementArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$cond_school = '';

	// if($_SESSION["shlid"]!= 1){
	// 		$cond_school =" and ".tbl_announcement.".shlid='".$_SESSION["shlid"]."' ";
	// }
	$str_all = "select count(*) as cnt from " . tbl_announcement . "," . tbl_schoolsname . "  where " . tbl_announcement . ".school_id=" . tbl_schoolsname . ".school_id and " . tbl_announcement . ".isactive <> 2 " . $cond_school . " ";



	// 	$str_all="select count(*) as cnt from ".tbl_announcement."  where isactive <> 2 ".$cond_school." ";	




	if ($whrcon != "")

		$str_all .= $whrcon;

	$res = $db->get_a_line($str_all);
	return $res['cnt'];
}

function getAnnouncementArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{


	$cond_school = '';

	// if($_SESSION["shlid"]!= 1){
	// $cond_school =" and ".tbl_announcement.".shlid='".$_SESSION["shlid"]."' ";
	// }
	$str_all = "select " . tbl_announcement . ".*," . tbl_schoolsname . ".shlname,DATE_FORMAT(date,'%d-%m-%Y') as date from " . tbl_announcement . "," . tbl_schoolsname . "  where " . tbl_announcement . ".school_id=" . tbl_schoolsname . ".school_id and " . tbl_announcement . ".isactive <> 2 " . $cond_school . " ";

	// 		$str_all="select * , DATE_FORMAT(date,'%d-%m-%Y') as date from ".tbl_announcement." where isactive <> 2 ".$cond_school." "; 



	/*
																																																																																																																																																													  $str_all = "select *,DATE_FORMAT(newsdate,'%d-%m-%Y') as newsdate from ".tbl_newsevents." where isactive <> 2 ";
																																																																																																																																																													  */

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	// echo $str_all; exit;	
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}

//Announcement - END


//Cantact Enquiries START
function getEnquiriesArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		//	$cond_school =" and ".tbl_contact.".shlid='".$_SESSION["shlid"]."' ";
	}
	$str_all = "SELECT DATE_FORMAT(" . tbl_contact . ".createdate, '%d-%m-%Y') as date,
		" . tbl_contact . ".cid, 
		" . tbl_contact . ".name, 
		" . tbl_contact . ".email, 
		" . tbl_contact . ".phone, 
		" . tbl_contact . ".message,
		" . tbl_contact . ".types
		FROM " . tbl_contact;

	if (!empty($whrcon)) {
		$str_all .= " " . $whrcon; // Ensure proper spacing
	}

	// 	if (!empty($cond_school)) {
// 		$str_all .= " AND " . $cond_school;
// 	}

	if (!empty($ordr)) {
		$str_all .= " " . $ordr; // Ensure spacing
	}

	// 	if (!empty($stt) && !empty($len)) {
// 		$str_all .= " LIMIT " . intval($stt) . ", " . intval($len);
// 	}

	// 	print_r($str_all);
// 	die();



	$res = $db->get_rsltset($str_all);
	return count($res);
}

function getEnquiriesArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = "";
	if ($_SESSION["shlid"] != 1) {
		// $cond_school = " AND " . tbl_contact . ".shlid='" . $_SESSION["shlid"] . "' ";
	}
	// Start query with SELECT
	$str_all = "SELECT ROW_NUMBER() OVER (ORDER BY cid DESC) AS serial_number, DATE_FORMAT(" . tbl_contact . ".createdate, '%d-%m-%Y') as date,
					" . tbl_contact . ".cid, 
					" . tbl_contact . ".name, 
					" . tbl_contact . ".email, 
					" . tbl_contact . ".phone, 
					" . tbl_contact . ".message,
					" . tbl_contact . ".types 
					FROM " . tbl_contact;

	if (!empty($whrcon)) {
		$str_all .= " " . $whrcon; // Ensure proper spacing
	}

	if (!empty($cond_school)) {
		$str_all .= " AND " . $cond_school;
	}

	// Group and order
	//$str_all .= " GROUP BY " . tbl_contact . ".cid";
	if (!empty($ordr)) {
		$str_all .= " " . $ordr; // Ensure spacing
	}

	// Pagination
	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;

	// Debugging: Print the final SQL query (remove in production)


	$res = $db->get_rsltset($str_all);
	return $res;



}
// Career Enquiries START
function getCareerArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$cond_school = '';


	//".$cond_school." 

	// 	if($_SESSION["shlid"]!= 1){
	// //	$cond_school =" and ".tbl_career.".shlid='".$_SESSION["shlid"]."' ";
	// 	}

	//$str_all="select count(*) as cnt from ".tbl_career.",".tbl_schoolsname."  where ".tbl_career.".shlid=".tbl_schoolsname.".shlid and ".tbl_career.".isactive <> 2 ".$cond_school." ";

	$str_all = "select * from " . tbl_career . "," . tbl_schoolsname . "  where " . tbl_career . ".isactive <> 2";

	// $str_all = "select count(*) as cnt from ".tbl_career." where ".tbl_career.".isactive <> 2";
	if ($whrcon != "")

		$str_all .= $whrcon;
	$str_all .= " group by " . tbl_career . ".id ";


	$res = $db->get_rsltset($str_all);
	return count($res);
}

function getCareerArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$cond_school = '';
	$str_all = "select " . tbl_career . ".*," . tbl_schoolsname . ".shlname , DATE_FORMAT(" . tbl_career . ".createddate,'%d-%m-%Y') as date from " . tbl_career . "," . tbl_schoolsname . "  where " . tbl_career . ".isactive <> 2 " . $cond_school . " ";

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;
	$str_all .= " group by " . tbl_career . ".id ";
	//$totalFiltered =  $totalData; 

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;

	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}
//Career Enquiries end


// Alumini START
function getBooktour_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		//$cond_school =" and ".tbl_alumni.".shlid='".$_SESSION["shlid"]."' ";
	}

	$str_all = "select count(*) as cnt from " . tbl_booktour . " where isactive <> 2 " . $cond_school . " ";



	if ($whrcon != "")

		$str_all .= $whrcon;

	$res = $db->get_a_line($str_all);

	return $res['cnt'];
}

function getBooktourArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	// if($_SESSION["shlid"]!= 1){
	// 	$cond_school =" and ".tbl_alumni.".shlid='".$_SESSION["shlid"]."' ";
	// }

	$str_all = "select * from " . tbl_booktour . " where isactive <> 2 " . $cond_school . " ";

	$rescntchk = $db->get_rsltset($str_all);

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}
//Alumini  end

// Admission START
function getAdmissionArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		//$cond_school =" and ".tbl_admission_new.".shlid='".$_SESSION["shlid"]."' ";
	}

	$str_all = "select count(*) as cnt from " . tbl_admission_new . "  where isactive <> 2 " . $cond_school . " ";

	//     if($whrcon != "")

	// 	$str_all .= $whrcon;

	// 	$str_all .= " group by ".tbl_admission_new.".id "; 



	if ($whrcon != "")

		$str_all .= $whrcon;

	$res = $db->get_a_line($str_all);

	return $res['cnt'];
}

function getAdmissionArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		//	$cond_school =" and ".tbl_admission.".shlid='".$_SESSION["shlid"]."' ";
	}

	$str_all = "select * from " . tbl_admission_new . "  where isactive <> 2 " . $cond_school . " ";


	$rescntchk = $db->get_rsltset($str_all);

	//	$rescntchk =  $db->get_rsltset($str_all); 

	if ($whrcon != "")
		$str_all .= $whrcon;
	// $str_all .= " group by ".tbl_admission_new.".admissionid "; 
	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;
	// echo $str_all; exit;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}
//Admission end


//Department Start

function getDepartmentArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select count(*) as cnt from " . tbl_department . "  where 1=1 and isactive <>2 ";
	if ($whrcon != "")

		$str_all .= $whrcon;
	$res = $db->get_a_line($str_all);
	return $res['cnt'];
}

function getDepartmentArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$str_all = "select * from " . tbl_department . "  where 1=1 and isactive <> 2 ";
	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		//$str_all .= $ordr;
		$str_all .= " order by sortingorder asc ";
	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;
	//echo $str_all; exit;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return count($res);
}

//Department end


//Career START
function getCareerlistingArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		// 	$cond_school = " and " . tbl_careerlisting . ".shlid='" . $_SESSION["shlid"] . "' ";
	}

	$str_all = "select * from " . tbl_careerlisting . "  where isactive = 1";

	if (!empty($whrcon)) {
		$str_all .= " " . $whrcon; // Ensure proper spacing
	}

	if (!empty($whrcon)) {
		$str_all .= " " . $whrcon; // Ensure proper spacing
	}

	if (!empty($ordr)) {
		$str_all .= " " . $ordr; // Ensure spacing
	}

	if ($stt != "")
		//$str_all .= "limit " . $stt . "," . $len;

		// print_r($str_all);
		// die();

		// $res = $db->get_a_line($str_all);

		$res = $db->get_rsltset($str_all);

	return count($res);
}

function getCareerlistingArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$cond_school = '';

	// $str_all = "select * from " . tbl_careerlisting . " where isactive <> 2 ";

	$str_all = "SELECT 
    ROW_NUMBER() OVER (ORDER BY id DESC) AS serial_number,
    " . tbl_careerlisting . ".id,
    " . tbl_careerlisting . ".title,
    " . tbl_careerlisting . ".slug,
    " . tbl_careerlisting . ".job_type,
    " . tbl_careerlisting . ".school_id,
    " . tbl_careerlisting . ".no_of_openings,
    " . tbl_careerlisting . ".qualifications,
    " . tbl_careerlisting . ".ishome,
    " . tbl_careerlisting . ".status,
    " . tbl_careerlisting . ".created_on,
    " . tbl_careerlisting . ".sortby,
    " . tbl_careerlisting . ".isactive
	FROM " . tbl_careerlisting . " WHERE isactive <> 2";

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;

	return $res;


}

function getAlumnusArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$str_all = "select count(*) as cnt from " . tbl_alumni . "," . tbl_schoolsname . "  where " . tbl_alumni . ".shlid=" . tbl_schoolsname . ".school_id and " . tbl_alumni . ".isactive <>2   ";

	if ($whrcon != "")

		$str_all .= $whrcon;
	$res = $db->get_a_line($str_all);
	return $res['cnt'];
}
function getAlumnusArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{


	$str_all = "select " . tbl_alumni . ".*," . tbl_schoolsname . ".shlname,DATE_FORMAT(" . tbl_alumni . ".createdate,'%d-%m-%Y') as createdate from " . tbl_alumni . "," . tbl_schoolsname . "  where " . tbl_alumni . ".shlid=" . tbl_schoolsname . ".school_id and " . tbl_alumni . ".isactive <> 2  ";
	// 		echo $str_all;
// 	die();
	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}

function gettestimonialArray_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{

	$str_all = "select count(*) as cnt from " . tbl_testimonial . "," . tbl_schoolsname . "  where " . tbl_testimonial . ".school_id=" . tbl_schoolsname . ".school_id and " . tbl_testimonial . ".isactive <>2   ";
	if ($whrcon != "")

		$str_all .= $whrcon;
	$res = $db->get_a_line($str_all);
	return $res['cnt'];
}

function gettestimonialArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{


	$str_all = "select " . tbl_testimonial . ".*," . tbl_schoolsname . ".shlname,DATE_FORMAT(testimonial_date,'%d-%m-%Y') as testimonial_date from " . tbl_testimonial . "," . tbl_schoolsname . "  where " . tbl_testimonial . ".school_id=" . tbl_schoolsname . ".school_id and " . tbl_testimonial . ".isactive <> 2  ";
	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($len > 0)
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}




















function getBookexcursion_tot($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	if ($_SESSION["shlid"] != 1) {
		//$cond_school =" and ".tbl_alumni.".shlid='".$_SESSION["shlid"]."' ";
	}

	$str_all = "select count(*) as cnt from `sda_excursion` where isactive <> 2 " . $cond_school . " ";

	if ($whrcon != "")

		$str_all .= $whrcon;

	$res = $db->get_a_line($str_all);

	return $res['cnt'];
}

function getBookexcursionArray_Ajx($db, $act = null, $whrcon = null, $ordr = null, $stt = null, $len = null)
{
	$cond_school = '';

	// if($_SESSION["shlid"]!= 1){
	// 	$cond_school =" and ".tbl_alumni.".shlid='".$_SESSION["shlid"]."' ";
	// }

	$str_all = "select * from `sda_excursion` where isactive <> 2 " . $cond_school . " ";

	$rescntchk = $db->get_rsltset($str_all);

	$rescntchk = $db->get_rsltset($str_all);

	if ($whrcon != "")
		$str_all .= $whrcon;

	$totalFiltered = $totalData;

	if (trim($ordr) != "")
		$str_all .= $ordr;

	if ($stt != "")
		$str_all .= "limit " . $stt . "," . $len;
	$res = $db->get_rsltset($str_all);
	$totalData = count($rescntchk);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	return $res;
}











?>