<?php
ob_start();

error_reporting(0);

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);

header("Pragma: no-cache");
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '300M');

define('PROJECT_NAME', 'HMI');

if ($_SERVER['HTTP_HOST'] == '192.168.0.60') {

	define('root', 'http://192.168.0.60/website/');
	define('adminroot', 'http://192.168.0.60/website//');
	define('public_url', 'http://192.168.0.60/website/');
	define('admin_public_url', public_url . '/');

} else {

	// define('root', 'https://www.shraddhaacademy.com/');
	// define('adminroot', 'https://www.shraddhaacademy.com/final-admin/');
	// define('public_url', 'http://localhost/hmi/');

	define('root', 'http://192.168.0.60/website/');
	define('adminroot', 'http://192.168.0.60/website//');
	define('public_url', 'http://192.168.0.60/website/');

	//define('public_url', 'http://' . $_SERVER['SERVER_NAME'] . '/');


	http://localhost/hmi/final-admin
	define('admin_public_url', public_url . 'hmi-admin/');

}

$docroot = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

define('docroot', $docroot);

define('DB_PREFIX', "hmi_");

###################### New ######################
define('tbl_testimonial', DB_PREFIX . "testimonial");
define('tbl_imageconfig', DB_PREFIX . "imageconfig");
define('tbl_menus', DB_PREFIX . "menus");
define('tbl_modulemenus', DB_PREFIX . "modulemenus");
define('tbl_modules', DB_PREFIX . "modules");
define('tbl_roles', DB_PREFIX . "roles");
define('tbl_userlog', DB_PREFIX . "userlog");
define('tbl_users', DB_PREFIX . "users");
define('tbl_user_acl', DB_PREFIX . "user_acl");
define('tbl_user_session', DB_PREFIX . "user_session");
define('tbl_configuration', DB_PREFIX . "configuration");
define('tbl_newsevents', DB_PREFIX . "newsevents");
define('tbl_schoolsname', DB_PREFIX . "schoolsname");
define('tbl_moreimg', DB_PREFIX . "newsevents_moreimg");
define('tbl_gallery', DB_PREFIX . "gallery");
define('tbl_gallery_moreimg', DB_PREFIX . "gallery_moreimg");
define('tbl_noticeboard', DB_PREFIX . "noticeboard");
define('tbl_careerlisting', DB_PREFIX . "career_listing");
define('tbl_announcement', DB_PREFIX . "announcement");
define('tbl_contact', DB_PREFIX . "contact_us");
define('tbl_career', DB_PREFIX . "career");
define('tbl_alumni', DB_PREFIX . "alumni");
define('tbl_admission', DB_PREFIX . "admission");
define('tbl_department', DB_PREFIX . "department");
define('tbl_admission_new', DB_PREFIX . "admission_enquiry");
define('tbl_loginstatus', DB_PREFIX . "loginstatus");
define('tbl_newscategory', DB_PREFIX . "newscategory");
define('tbl_gallerycategory', DB_PREFIX . "gallerycategory");

define('tbl_booktour', DB_PREFIX . "book_tour");


define('IMG_BASE_URL', 'http://localhost/hmi/uploads/');


$schools = array(
	3 => 'Kottivakkam',
	2 => 'Padur',
	1 => 'Tambaram',
	9 => 'All Schools'
);

define('SCHOOLS', $schools);

################### old #########################

include_once('ez_sql_core.php');

// Include ezSQL database specific component
include_once('ez_sql_mysqli.php');

// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host
// db_host can "host:port" notation if you need to specify a custom port


// define('YOUR_HOST', 'localhost');
// define('YOUR_USER', 'root');
// define('YOUR_PASS', '');
// define('YOUR_DB', 'shardha_academy_final');


define('db_host', 'localhost');
define('db_name', 'hmi_db');
define('db_username', 'root');
define('db_password', '');


if ($_SERVER['HTTP_HOST'] == '192.168.0.60') {

	$db = new mysqli("localhost", "root", "", "hmi_db");

} else {

	$db = new mysqli("localhost", "root", "", "hmi_db");

}

ob_flush();
?>