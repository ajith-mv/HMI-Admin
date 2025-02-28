<?php
date_default_timezone_set("Asia/Kolkata");

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


include_once "session.php";
include "includes/Mdme-functions.php";


$requestData = $_REQUEST;
include_once "display-grid-data-functions.php";

$getuser = $db->get_a_line("select a.roleid,b.IsAccessALL from  " . tbl_users . "  a inner join " . tbl_roles . "  b ON b.roleid = a.roleid where a.userid = '" . $_SESSION["UserId"] . "'");

$wrcon = "";
$srchcollen = count($requestData['search']);


$stt = $requestData['start'];
$len = $requestData['length'];

switch ($_REQUEST['finaltab']) {

	// Admin setting		
	case "menu":
		$dispFields = array("menuname");
		$disporder_ID = "menuid";
		$mdme = getMdmeMenu($db, '');

		$wrcon .= " and (menuname like '%" . $requestData['search']['value'] . "%')";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";

		$totalData = getMenuArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getMenuArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "module":
		$dispFields = array("modulename", "description", "modulepath");
		$disporder_ID = "moduleid";
		$mdme = getMdmeModule($db, '');

		$wrcon = " and (modulename like '%" . $requestData['search']['value'] . "%' or description like '%" . $requestData['search']['value'] . "%' or modulepath like '%" . $requestData['search']['value'] . "%')";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";

		$totalData = getModuleArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getModuleArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "modulemenu":
		$dispFields = array("menuname");
		$disporder_ID = "menuid";
		$mdme = getMdmeModulemenu($db, '');

		$wrcon = " and (menuname like '%" . $requestData['search']['value'] . "%')";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";

		$totalData = getModuleMenuArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getModuleMenuArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "roleinfo":
		$dispFields = array("rolename");
		$disporder_ID = "roleid";
		$mdme = getMdmeRole($db, '');

		$wrcon = " and (r.rolename like '%" . $requestData['search']['value'] . "%')";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";

		$totalData = getRoleArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getRoleArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "permissioninfo":
		$dispFields = array("rolename");
		$disporder_ID = "roleid";
		$mdme = getMdmePermissioninfo($db, '');

		$wrcon = " and (r.rolename like '%" . $requestData['search']['value'] . "%')";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";

		$totalData = getPermissionInfoArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getPermissionInfoArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "userinfo":
		$dispFields = array("user_firstname", "user_lastname", "user_email");
		$disporder_ID = "userid";
		$mdme = getMdmeUser($db, '');

		// $wrcon = " and (user_name like '%" . $requestData['search']['value'] . "%' or user_firstname like '%" . $requestData['search']['value'] . "%' or user_lastname like '%" . $requestData['search']['value'] . "%' or r.rolename like '%" . $requestData['search']['value'] . "%')";
		$wrcon = " and (user_name like '%" . $requestData['search']['value'] . "%' or user_firstname like '%" . $requestData['search']['value'] . "%' or user_lastname like '%" . $requestData['search']['value'] . "%' )";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by serial_number $order_oper ";




		$totalData = getUserArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getUserArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);



		// print_r($res);
		// die();


		break;

	case "newsevents":

		$dispFields = array("newsdate", "newstitle");

		$disporder_ID = "newsid";

		$mdme = getMdmeNewsEvents($db, '');

		$wrcon .= " and (newsdate like '%" . $requestData['search']['value'] . "%' or shlname like '%" . $requestData['search']['value'] . "%' or newstitle like '%" . $requestData['search']['value'] . "%')";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by newsid desc ";

		$totalData = getnewseventsArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getnewseventsArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "newseventscat":

		$dispFields = array("name", "homeorder");

		$disporder_ID = "catid";

		$mdme = getMdmeNewsEventsCat($db, '');

		$wrcon .= " and (name like '%" . $requestData['search']['value'] . "%' )";

		//$order_clmn = $requestData['order'][0]['column'];
		//$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by catid desc ";

		$totalData = getnewscategoryArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getnewscategoryArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "gallerycategories":

		$dispFields = array("name");

		$disporder_ID = "catid";

		$mdme = getMdmeGalleryCat($db, '');

		$wrcon .= " and (name like '%" . $requestData['search']['value'] . "%' )";

		//$order_clmn = $requestData['order'][0]['column'];
		//$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by catid desc ";

		$totalData = getgallerycategoriesArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getgallerycategoriesArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "gallery":
		$dispFields = array("glydate", "glytitle");
		$disporder_ID = "glyid";
		$mdme = getMdmeGallery($db, '');

		$wrcon .= " and (glydate like '%" . $requestData['search']['value'] . "%' or shlname like '%" . $requestData['search']['value'] . "%' or glytitle like '%" . $requestData['search']['value'] . "%')";

		// 		$wrcon .= "";
		// 		$order_clmn = $requestData['order'][0]['column'];
		// $order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by glyid desc ";


		$totalData = getGalleryArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getGalleryArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "noticeboard":
		$dispFields = array("date", "noticeboard");
		$disporder_ID = "noticeid";
		$mdme = getMdmeNoticeBoard($db, '');

		$wrcon .= " and (date like '%" . $requestData['search']['value'] . "%' or shlname like '%" . $requestData['search']['value'] . "%' or noticeboard like '%" . $requestData['search']['value'] . "%')";

		//$order_clmn = $requestData['order'][0]['column'];
		//$order_oper = $requestData['order'][0]['dir'];			
		//$ordr = " order by $dispFields[$order_clmn] $order_oper ";
		$ordr = " order by noticeid desc ";

		$totalData = getNoticeArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getNoticeArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "careerlisting":
		$dispFields = array("title", "job_type");
		$disporder_ID = "id";
		// $mdme = getMdmecareerListing($db, '');

		$wrcon .= " and ( job_type like '%" . $requestData['search']['value'] . "%' or title like '%" . $requestData['search']['value'] . "%')";


		$ordr = " order by id desc ";

		$totalData = getCareerlistingArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getCareerlistingArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);
		break;

	case "announcement":

		$dispFields = array("date", "announcement");

		$disporder_ID = "anmtid";

		$mdme = getMdmeAnnouncement($db, '');

		$wrcon .= " and (date like '%" . $requestData['search']['value'] . "%' or shlname like '%" . $requestData['search']['value'] . "%' or announcement like '%" . $requestData['search']['value'] . "%')";

		$order_clmn = $requestData['order'][0]['column'];

		$order_oper = $requestData['order'][0]['dir'];

		$ordr = " order by anmtid desc ";

		$totalData = getAnnouncementArray_tot($db, $act, $wrcon, $ordr, $stt, $len);

		$res = getAnnouncementArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	case "enquiries":
		$dispFields = array("date", "name", "email", "phone", "message", "types");
		$disporder_ID = "cid";
		$mdme = getMdmeEnquiries($db, '');
		$wrcon = " WHERE " . tbl_contact . ".isactive <> 2 ";

		if (!empty($requestData['search']['value'])) {
			$searchValue = trim($requestData['search']['value']);
			$wrcon .= " AND (name LIKE '%$searchValue%' 
							 OR email LIKE '%$searchValue%' 
							 OR phone LIKE '%$searchValue%' 
							 OR message LIKE '%$searchValue%') ";
		}

		$ordr = " ORDER BY cid DESC ";

		$totalData = getEnquiriesArray_tot($db, $act, $wrcon, $ordr, $stt, $len);


		// 		print_r($totalData);
// 		die();


		$res = getEnquiriesArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);





		break;
	case "career":

		$dispFields = array("createddate", "name", "email", "phone", "applyfor", "cover_letter");
		$disporder_ID = "id";
		$mdme = getMdmeCareers($db, '');

		$wrcon .= " and (name like '%" . $requestData['search']['value'] . "%' or email like '%" . $requestData['search']['value'] . "%' or phone like '%" . $requestData['search']['value'] . "%' or cover_letter like '%" . $requestData['search']['value'] . "%' or applyfor like '%" . $requestData['search']['value'] . "%')";

		//$order_clmn = $requestData['order'][0]['column'];
		//$order_oper = $requestData['order'][0]['dir'];			
		$ordr = " order by id desc ";

		$totalData = getCareerArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getCareerArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);
		break;

	case "book_a_tour":

		$dispFields = array("date", "time", "parent_first_name", "parent_last_name", "phone", "email", "message");
		$disporder_ID = "id";
		$mdme = getMdmeBooktour($db, '');

		$wrcon .= " and (parent_first_name like '%" . $requestData['search']['value'] . "%' or parent_last_name  like '%" . $requestData['search']['value'] . "%' or phone like '%" . $requestData['search']['value'] . "%' or email like '%" . $requestData['search']['value'] . "%')";

		$ordr = " order by id desc ";

		$totalData = getBooktour_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getBooktourArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);
		break;



	case "excursion":



		$dispFields = array("id", "student_name", "class", "admission_number", "phone_number", "transaction_number", "upated_on");
		$disporder_ID = "id";
		$mdme = getMdmeExcursion($db, '');

		//$wrcon .= " and (parent_first_name like '%".$requestData['search']['value']."%' or parent_last_name  like '%".$requestData['search']['value']."%' or phone like '%".$requestData['search']['value']."%' or email like '%".$requestData['search']['value']."%')";	


		$wrcon .= " ";

		$ordr = " order by id desc ";

		$totalData = getBookexcursion_tot($db, $act, $wrcon, $ordr, $stt, $len);

		$res = getBookexcursionArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;


	case "admission":


		$dispFields = array("created_on", "name", "parents_name", "phone", "email", "year", "class", "campaign", "message");
		$disporder_ID = "id";
		$mdme = getMdmeAdmission($db, '');

		$wrcon .= " and (name like '%" . $requestData['search']['value'] . "%' or parents_name like '%" . $requestData['search']['value'] . "%' or phone like '%" . $requestData['search']['value'] . "%' or email like '%" . $requestData['search']['value'] . "%' or year like '%" . $requestData['search']['value'] . "%' or class like '%" . $requestData['search']['value'] . "%'  )";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by id desc ";

		$totalData = getAdmissionArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getAdmissionArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);
		break;

	case "alumnus":


		$dispFields = array("createdate", "name", "phone", "email", "yofp", "message");
		$disporder_ID = "aluid ";
		$mdme = getMdmeAlumnus($db, '');

		$wrcon .= " and (name like '%" . $requestData['search']['value'] . "%' or phone like '%" . $requestData['search']['value'] . "%' or email like '%" . $requestData['search']['value'] . "%' or yofp like '%" . $requestData['search']['value'] . "%' or shlname like '%" . $requestData['search']['value'] . "%'  )";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by aluid desc ";

		$totalData = getAlumnusArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getAlumnusArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);
		break;


	case "department":
		$dispFields = array("departmentname");
		$disporder_ID = "depid";
		$mdme = getMdmeDepartment($db, '');

		$wrcon .= " and (departmentname like '%" . $requestData['search']['value'] . "%')";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by $dispFields[$order_clmn] $order_oper ";

		$totalData = getDepartmentArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = getDepartmentArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;



	case "testimonial":
		$dispFields = array("testimonial_name", "testimonial_date", "location");
		$disporder_ID = "testimonial_id";
		$mdme = getMdmetestimonial($db, '');

		$wrcon .= " and (testimonial_name like '%" . $requestData['search']['value'] . "%' or testimonial_date like '%" . $requestData['search']['value'] . "%' or location like '%" . $requestData['search']['value'] . "%' or shlname like '%" . $requestData['search']['value'] . "%' )";

		$order_clmn = $requestData['order'][0]['column'];
		$order_oper = $requestData['order'][0]['dir'];
		$ordr = " order by testimonial_id desc ";

		$totalData = gettestimonialArray_tot($db, $act, $wrcon, $ordr, $stt, $len);
		$res = gettestimonialArray_Ajx($db, $act, $wrcon, $ordr, $stt, $len);

		break;

	default:
		echo "No-Data";
}

$totalFiltered = $totalData;
$data = array();

$slno = 1;

foreach ($res as $r) {
	// 	var_dump($r);
// 	die();
	$nestedData = array();

	$nestedData[] = $r['serial_number'];

	$editid = base64_encode($r[$disporder_ID]);
	$stats = $r['isactive'];
	$actmodul = $_REQUEST['finaltab'];


	///////////from here, newly added for act status	
	if ($_REQUEST['finaltab'] != 'enquiries' && $_REQUEST['finaltab'] != 'career' && $_REQUEST['finaltab'] != 'alumnus' && $_REQUEST['finaltab'] != 'alumni' && $_REQUEST['finaltab'] != 'admission' && $_REQUEST['finaltab'] != 'book_a_tour') {

		if ($r['isactive'] == '1') {

			//change status active to inactive
			//echo 	$_REQUEST['finaltab']."_actions.php"; exit;	
			$statusurl = "'" . $_REQUEST['finaltab'] . "_actions.php','Id=$editid&action=changestatus&actval=0'";
			$incstat = '<div class="btn-group" data-toggle="btn-toggle">		   
							<button class="btn btn-success btn-xs active" type="button"><i class="fa fa-square text-red"></i> Active</button>
							<button class="btn btn-default btn-xs" type="button" onclick="funchangestatus(this,' . $statusurl . ');"><i class="fa fa-square text-red"></i> &nbsp;</button>
					   </div>';

		} else {
			//change status inactive to active

			$statusurl = "'" . $_REQUEST['finaltab'] . "_actions.php','Id=$editid&action=changestatus&actval=1'";	//echo 	$_REQUEST['finaltab']."_actions.php"; exit;	
			$incstat = '<div class="btn-group" data-toggle="btn-toggle" >		
							<button class="btn btn-default btn-xs" type="button" onclick="funchangestatus(this,' . $statusurl . ');"><i class="fa fa-square text-green"></i> &nbsp;</button>
							<button class="btn btn-danger btn-xs active" type="button"><i class="fa fa-square text-green"></i> InActive</button>
											 
						</div>';
		}

	}

	//edit
	if ($_REQUEST['finaltab'] != 'enquiries' && $_REQUEST['finaltab'] != 'career' && $_REQUEST['finaltab'] != 'alumnus' && $_REQUEST['finaltab'] != 'alumni' && $_REQUEST['finaltab'] != 'admission' && $_REQUEST['finaltab'] != 'book_a_tour') {
		$edtstat = '<a href="' . $actmodul . '_form.php?act=edit&id=' . $editid . '" title="edit" data-toggle="tooltip" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i></a>';
	}

	//del 

	$delurl = "'" . $_REQUEST['finaltab'] . "_actions.php','Id=$editid&action=del'";
	$delstat = '<a href="javascript:void(0);" title="delete" data-toggle="tooltip" class="btn btn-danger btn-xs" onClick="javascript:funStats(this,' . $delurl . ')" >
				<i class="fa fa-trash"></i>
			  </a>';


	include_once "includes/pagepermission.php";

	if (trim($res_modm_prm['editprm']) == "1") {
		$edtstat = $edtstat;
	} else {
		$edtstat = "";
	}

	if (trim($res_modm_prm['deleteprm']) == "1") {
		$delstat = $delstat;
	} else {
		$delstat = "";
	}

	if (trim($res_modm_prm['editprm']) != "1" && trim($res_modm_prm['deleteprm']) != "1") {
		$delstat = "-";
	}

	///////////till here newly added for act inact status
	foreach ($dispFields as $dispFields_S) {

		$nestedData[] = $r[$dispFields_S];

	}




	if ($_REQUEST['finaltab'] == 'floorplans') {



		if ($r['floorfeatureimg'] != '') {
			$nestedData[] = '<img src="../uploads/floorfeatureimg/' . $r['floorfeatureimg'] . '" width="50px" height="50px">';
		} else {
			$nestedData[] = 'No Image';
		}


		if ($r['floorfullimg'] != '') {

			$nestedData[] = '<img src="../uploads/floorfullimg/' . $r['floorfullimg'] . '" width="50px" height="50px">';

		} else {
			$nestedData[] = 'No Image';
		}

	}


	if ($_REQUEST['finaltab'] == 'media') {


		if ($r['mediapdf'] != '') {
			$nestedData[] = '<a class="btn btn-primary btn-xs" href="' . IMG_BASE_URL . 'mediaimg/pdf/' . $r['mediapdftitle'] . '" download><i class="fa fa-download"></i> Download</a>';
		} else {
			$nestedData[] = '-';
		}

		if ($r['mediaimg'] != '') {
			$nestedData[] = '<img src="../uploads/mediaimg/' . $r['mediaimg'] . '" width="50px" height="50px">';
		} else {
			$nestedData[] = 'No Image';
		}

	}

	$branch_to_display = [];

	// if ($_REQUEST['finaltab'] == 'userinfo') {
	// 	$nestedData[] = $r['shlname'];
	// }
	if ($_REQUEST['finaltab'] == 'alumnus') {


		$selected_branches = explode(', ', $r['shlid']);

		$all_branches = SCHOOLS;

		foreach ($selected_branches as $selected_branch) {


			$schoolname = array_key_exists($selected_branch, $all_branches);

			if ($schoolname) {
				$branch_to_display[] = $all_branches[$selected_branch];
			} else {
				$branch_to_display[] = "";
			}


		}


		$implode = implode(', ', $branch_to_display);
		//print_r($implode);

		$nestedData[] = $implode;
	}
	if ($_REQUEST['finaltab'] == 'announcement' || $_REQUEST['finaltab'] == 'testimonial' || $_REQUEST['finaltab'] == 'book_a_tour' || $_REQUEST['finaltab'] == 'admission') {



		$selected_branches = explode(', ', $r['school_id']);

		$all_branches = SCHOOLS;

		foreach ($selected_branches as $selected_branch) {


			$schoolname = array_key_exists($selected_branch, $all_branches);

			if ($schoolname) {
				$branch_to_display[] = $all_branches[$selected_branch];
			} else {
				$branch_to_display[] = "";
			}


		}


		$implode = implode(', ', $branch_to_display);
		//print_r($implode);

		$nestedData[] = $implode;
	}
	// if ($_REQUEST['finaltab'] == 'careerlisting') {
	// 	$selected_type = $r['job_type'];
	// 	if ($selected_type == 2) {
	// 		$nestedData[] = "Part Time";
	// 	} else if ($selected_type == 1) {
	// 		$nestedData[] = "Full Time";
	// 	}
	// }

	// if ($_REQUEST['finaltab'] == 'newsevents') {
	// 	$ctid = $r['catid'];

	// 	if ($ctid != 0) {
	// 		$categories = getAllnewscat($db, $ctid);

	// 		$nestedData[] = $categories['name'];

	// 	} else {
	// 		$nestedData[] = "--";
	// 	}
	// }

	if ($_REQUEST["finaltab"] == "newseventscat") {

		if ($r['subcategory'] != 0) {
			$categories = getAllnewscat($db, $r['subcategory']);
		} else {
			$categories = getAllnewscat($db, $r['subcategory']);
		}

		// if ($r['isactive'] == '1') {

		// 	$statusurl = "'" . $_REQUEST['finaltab'] . "_actions.php','Id=$editid&action=changestatus&actval=0'";
		// 	$incstat = '<div class="btn-group" data-toggle="btn-toggle">		   
		// 					<button class="btn btn-success btn-xs active" type="button"><i class="fa fa-square text-red"></i> Active</button>
		// 					<button class="btn btn-default btn-xs" type="button" onclick="funchangestatus(this,' . $statusurl . ');"><i class="fa fa-square text-red"></i> &nbsp;</button>
		// 			   </div>';

		// } else {

		// 	$statusurl = "'" . $_REQUEST['finaltab'] . "_actions.php','Id=$editid&action=changestatus&actval=1'";	//echo 	$_REQUEST['finaltab']."_actions.php"; exit;	
		// 	$incstat = '<div class="btn-group" data-toggle="btn-toggle" >		
		// 					<button class="btn btn-default btn-xs" type="button" onclick="funchangestatus(this,' . $statusurl . ');"><i class="fa fa-square text-green"></i> &nbsp;</button>
		// 					<button class="btn btn-danger btn-xs active" type="button"><i class="fa fa-square text-green"></i> InActive</button>

		// 				</div>';
		// }


		$nestedData[] = $categories['name'];

	}

	if ($_REQUEST['finaltab'] == 'gallery') {
		$ctid = $r['catid'];

		if ($ctid != 0) {
			$categories = getAllgallerycat($db, $ctid);
			//     var_dump($categories);
			// die();
			$nestedData[] = $categories['name'];
			//  echo $r['catid'];
			//  die();
		} else {
			$nestedData[] = "--";
		}

	}
	if ($_REQUEST['finaltab'] == 'newsevents') {


		if ($r['newsimage'] != '') {

			$nestedData[] = '<img src="../uploads/newsevents/' . $r['newsimage'] . '" width="50px" height="50px">';

		} else {

			$nestedData[] = 'No Image';

		}

		$nestedData[] = '<a href="news_moreimage.php?id=' . $r['newsid'] . '"> Add / View </a>';


	}

	if ($_REQUEST['finaltab'] == 'gallery') {

		if ($r['image'] != '') {
			$nestedData[] = '<img src="../uploads/gallery/' . $r['image'] . '" width="50px" height="50px">';
		} else {
			$nestedData[] = 'No Image';
		}

		$nestedData[] = '<a href="gallery_moreimage.php?id=' . $r['glyid'] . '"> Add / View </a>';


	}

	if ($_REQUEST['finaltab'] == 'gallerycategories') {

		if ($r['image'] != '') {
			$nestedData[] = '<img src="../uploads/gallery/' . $r['image'] . '" width="50px" height="50px">';
		} else {
			$nestedData[] = 'No Image';
		}

		$nestedData[] = '<a href="gallery_moreimage.php?id=' . $r['catid'] . '"> Add / View </a>';

	}

	if ($_REQUEST['finaltab'] == 'noticeboard') {


		if ($r['pdf'] != '') {
			$nestedData[] = '<a class="btn btn-primary btn-xs" href="' . IMG_BASE_URL . 'noticeboardpdf/' . $r['pdftitle'] . '" download><i class="fa fa-download"></i> Download</a>';
		} else {
			$nestedData[] = '-';
		}

		if ($r['link'] != '') {
			$nestedData[] = '<a class="btn btn-primary btn-xs" href="' . $r['link'] . '" target="_blank" link><i class="fa fa-link"></i> LINK</a>';
		} else {
			$nestedData[] = '-';
		}

	}

	if ($_REQUEST['finaltab'] == 'stafflisting') {



		if ($r['image'] != '') {
			$nestedData[] = '<img src="../uploads/stafflisting/' . $r['image'] . '" width="50px" height="50px">';
		} else {
			$nestedData[] = 'No Image';
		}


	}

	if ($_REQUEST['finaltab'] == 'announcement') {


		if ($r['pdf'] != '') {
			$nestedData[] = '<a class="btn btn-primary btn-xs" href="' . IMG_BASE_URL . 'announcement/' . $r['pdftitle'] . '"  download><i class="fa fa-download"></i> Download</a>';
		} else {
			$nestedData[] = '-';
		}

		if ($r['link'] != '') {
			$nestedData[] = '<a class="btn btn-primary btn-xs" href="' . $r['link'] . '" target="_blank" link><i class="fa fa-link"></i> LINK</a>';
		} else {
			$nestedData[] = '-';
		}

	}

	if ($_REQUEST['finaltab'] == 'career') {


		if ($r['resume'] != '') {
			$nestedData[] = '<a class="btn btn-primary btn-xs" href="../' . $r['resume'] . '"  download><i class="fa fa-download"></i> Download</a>';
		} else {
			$nestedData[] = '-';
		}

	}

	if ($_REQUEST['finaltab'] == 'newseventscat') {

		if ($r['ishome'] == '1') {


			$statusurl = "'" . $_REQUEST['finaltab'] . "_actions.php','Id=$editid&action=changehome&actval=0'";

			$nestedData[] = '<div class="btn-group" data-toggle="btn-toggle">		   
							<button class="btn btn-success btn-xs active" type="button"><i class="fa fa-square text-red"></i> Yes</button>
							<button class="btn btn-default btn-xs" type="button" onclick="funchangestatus(this,' . $statusurl . ');"><i class="fa fa-square text-red"></i> &nbsp;</button>

					   </div>';

		} else {

			$statusurl = "'" . $_REQUEST['finaltab'] . "_actions.php','Id=$editid&action=changehome&actval=1'";
			$nestedData[] = '<div class="btn-group" data-toggle="btn-toggle" >		
										<button class="btn btn-default btn-xs" type="button" onclick="funchangestatus(this,' . $statusurl . ');"><i class="fa fa-square text-green"></i> &nbsp;</button>
										<button class="btn btn-danger btn-xs active" type="button"><i class="fa fa-square text-green"></i> No</button>			 
									</div>';
		}

	}


	// 		  				var_dump($nestedData);
// 			die();	
	if ($_REQUEST['finaltab'] != 'enquiries' && $_REQUEST['finaltab'] != 'career' && $_REQUEST['finaltab'] != 'alumnus' && $_REQUEST['finaltab'] != 'alumni' && $_REQUEST['finaltab'] != 'admission' && $_REQUEST['finaltab'] != 'book_a_tour') {


		$nestedData[] = $incstat;


	}
	$nestedData[] = $edtstat . '&nbsp;' . $delstat;


	$data[] = $nestedData;

	// $slno++;


}
$json_data = array(
	"draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal" => intval($totalData),  // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data" => $data   // total data array			
);


echo json_encode($json_data);  // send data as json format
?>