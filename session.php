<?php
ob_start();

ini_set('session.name', 'ADMPHPSESSID');
ini_set('session.gc_maxlifetime', 20 * 60 * 60);
session_set_cookie_params(20 * 60 * 60);
error_reporting(-1);
session_start();

include_once("include/config_db.php");

include_once("include/database.class.php");

include_once("include/database-class-new.php");

include_once("include/common.class.php");

$db = new Databasequerynew();




$common = new common;
$path = $common->path;
$created = date('Y-m-d H:i:s');


define("SPC", "mysql_real_escape_string");

if ($_SERVER['HTTP_HOST'] == "192.168.0.60") {

	define('public_url', 'http://' . $_SERVER['HTTP_HOST'] . '/amss/website/asan_education_admin/');

	define('image_public_url', 'http://' . $_SERVER['HTTP_HOST'] . '/amss/website/asan_education_admin/');

	define('admin_public_url', public_url);

	define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/amss/website/asan_education_admin/');

	define('IMG_BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/amss/website/uploads/');

	define('BASE_URL_ADMIN', 'http://' . $_SERVER['HTTP_HOST'] . '/amss/website/asan_education_admin/');

} else {

	define('public_url', 'http://' . $_SERVER['SERVER_NAME'] . '/hmi-admin/');

	define('image_public_url', 'http://' . $_SERVER['SERVER_NAME'] . '/hmi-admin/');

	define('admin_public_url', public_url);

	define('BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/hmi-admin/');

	define('IMG_BASE_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/uploads/');

	define('BASE_URL_ADMIN', 'http://' . $_SERVER['SERVER_NAME'] . '/hmi-admin/');

}



class Session
{
	function hashgenwithsessionid()
	{
		$hash = md5(session_id());
		return $hash;
	}

	function verifylogin($db, $common, $funame, $fPass)
	{
		$funame = addslashes($funame);
		$fPass = addslashes($fPass);

		if (!empty($funame))
			$funame = str_replace("'", "", $funame);
		$funame = strtolower($funame);
		$mysqlfst = "select * from " . tbl_users . "  where user_email='" . strtolower($funame) . "'";


		// print_r($mysqlfst);
		// die();

		//$mysqlfst_result = $db->query($mysqlfst);

		//$urslt = mysqli_fetch_array($mysqlfst, MYSQLI_BOTH);

		$urslt = $db->get_a_line($mysqlfst);

		$pname = $urslt['user_pwd'];


		$mysqlsec = "select * from " . tbl_users . "  where user_email='" . strtolower($funame) . "' and user_pwd='" . md5($fPass) . "'";


		$prslt = $db->get_a_line($mysqlsec);


		$uname = trim($prslt['user_email']);

		if ($pname == "" && $uname == "") {
			header("Location:" . admin_public_url . "index.php?err=invup");
		} elseif ($pname == "" && $uname != "") {
			header("Location:" . admin_public_url . "index.php?err=invu");
		} elseif ($pname != "" && $uname == "") {
			header("Location:" . admin_public_url . "index.php?err=invp");
		} elseif ($pname != $fPass && $uname != $funame) {
			header("Location:" . admin_public_url . "index.php?err=invp");
		}

		if ($pname != "" && $uname != "") {
			$mysql = "select distinct s.userid, s.user_firstname, s.user_name, s.user_pwd, s.user_email, s.roleid, s.user_photo,  r.RoleName, s.isactive, s.shlid
					 from " . tbl_users . "  s 			
					 inner join " . tbl_roles . "  r on r.RoleId=s.RoleId and r.isactive=1  
					 where s.user_email='" . strtolower($funame) . "' and  s.user_pwd='" . md5($fPass) . "' and s.isactive = '1' ";

			$rslt = $db->get_a_line($mysql);

			if ($rslt[0] == "") {
				header("Location:" . admin_public_url . "index.php?err=ac");
			}

			if ($rslt[0] != "") {
				$username = $rslt["user_email"];
				$password = $rslt["user_pwd"];
				$userid = $rslt["userid"];
				$_SESSION["RoleId"] = $rslt["roleid"];
				$_SESSION["userPhoto"] = $rslt["user_photo"];
				$_SESSION["RoleName"] = $rslt["RoleName"];
				$_SESSION["UName"] = $rslt["user_firstname"];
				$_SESSION["UEmail"] = $rslt["user_email"];

				$_SESSION["UserId"] = $userid;
				$_SESSION["isactive"] = $rslt["isactive"];
				$_SESSION["shlid"] = $rslt["shlid"];

				$id = $userid;

				$admin_id = $_SESSION["UserId"];

				$_SESSION['TempRoleId'] = $rslt["RoleId"];

				$q = "select * from " . tbl_user_session . "  where user_id='$userid'";

				$r = $db->get_a_line($q);

				//$last_export = $r[last_export];
				$hash = $this->hashgenwithsessionid();

				setcookie("admin", $hash, 0, "/");

				$time = time();

				$str = "select * from " . tbl_user_session . "  where user_id='$userid'";
				$res = $db->get_a_line($str);

				$db->insert("insert into " . tbl_loginstatus . "  (UsrId) VALUES('" . $_SESSION['UserId'] . "')");

				$_SESSION['login_id'] = $db->insert_id;

				if ($res['user_id'] != "") {

					$mysql = "update " . tbl_user_session . "  set hash='$hash',timestamp='$time',last_export='$last_export' where user_id='$userid'";

					$db->insert($mysql);

				} else {

					$mysql = "insert into " . tbl_user_session . "  values('$userid','$hash','$time','$last_export')";

					$db->insert($mysql);

				}
				return $userid;

			} else if ($urslt == "" && $prslt == "") {

				header("Location:" . admin_public_url . "index.php?err=invup");
				exit;

			}
		}
	}
}


$obj = new Session;
if (isset($_REQUEST['mn']) && $_REQUEST['mn'] == 'fnt') {
	$_REQUEST['username'] = base64_decode($_REQUEST['username']);
	$_REQUEST['password'] = base64_decode($_REQUEST['password']);
}


if (trim($_REQUEST['submt']) == "login") {
	$admin_id = $obj->verifylogin($db, $common, $_REQUEST['username'], $_REQUEST['password']);
	$_SESSION['storeall'] = array("1", "0");
	if (isset($_REQUEST['frontlog'])) {
		echo '{"err":"0","msg":"sucess"}';
		exit;
	}
} else {
	$hash = $_COOKIE["admin"];

	$temphash = md5(session_id());

	if ($temphash == $hash && count($_SESSION) > 0) {

		$admin_id = $common->check_user_session($hash, $db);

		if ($admin_id == "" || $admin_id == 0) {
			header("Location:" . admin_public_url . "index.php?err=ses");
			exit;
		} else
			setcookie("admin", $hash, 0, "/");
		$_SESSION['storeall'] = array("1", "0");
	} else {
		header("Location:" . admin_public_url . "index.php?err=ses");
		exit;
	}
}



function getRealescape($data)
{
	$escape = str_replace("'", "\'", $data);
	return $escape;
}

function getMdme($db, $tabl = null, $col = null)
{
	$str_mdl = "SELECT mmu.modulemenuid FROM " . tbl_modules . " mdl inner join " . tbl_modulemenus . "  mmu on mdl.moduleid = mmu.moduleid and  mmu.isactive = 1 where mdl.modulepath = '" . $col . "'  and mdl.isactive = 1";
	return $db->get_a_line($str_mdl);
}

function getdynamicimage($db, $name)
{
	$getsiz = $db->get_rsltset("select concat(imageconfigWidth,'-',imageconfigHeight) as imagesize,foldername from " . tbl_imageconfig . "  where isactive = 1 and imageconfigModule = '$name'");
	foreach ($getsiz as $sizval) {
		$sizes[] = $sizval['imagesize'];
		$associativeArray[$sizval['imagesize']] = $sizval['foldername'];
	}

	foreach ($associativeArray as $k => $id) {
		$aMemberships[$k] = $id;
	}
	return $aMemberships;
}

function getimagesize_large($db, $name, $fname)
{
	$getsiz = $db->get_a_line("select concat(imageconfigWidth,'-',imageconfigHeight) as imagesize,foldername from " . tbl_imageconfig . "  where isactive = 1 and foldername = '$fname' and imageconfigModule = '$name'");
	return $getsiz['imagesize'];
}

function getUserinfo($db, $userid)
{
	$homestr_ed = "select * from " . tbl_users . " where isactive != '2' and userid = '" . $userid . "' ";
	$homeres_ed = $db->get_a_line($homestr_ed);
	return $homeres_ed;
}

function clean($string)
{
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}





ob_flush();


?>