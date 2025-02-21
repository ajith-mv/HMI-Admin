<?php
include 'session.php';
extract($_REQUEST);
$act = $action;

error_reporting(1);
function slugify($text)
{
	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, '-');

	// remove duplicated - symbols
	$text = preg_replace('~-+~', '-', $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;
}


// $txtshlid =1;




if ($status == '')
	$status = 0;

if ($ishome == '')
	$ishome = 0;

//if($newsdate == '') { $newsdate = '0000-00-00';}else{$newsdate = date('Y-m-d',strtotime($newsdate));}


switch ($act) {
	case 'insert':


		$slug = slugify($job_title);

		$checkSql = "SELECT COUNT(*) FROM " . tbl_careerlisting . " WHERE title = '" . getRealescape($job_title) . "'";
		$reslt = $db->get_a_line($checkSql);

		if ($reslt[0] > 0) {
			echo json_encode(array("rslt" => "8", 'msg' => 'already exists.'));  //no values

		} else {

			$str = "insert into " . tbl_careerlisting . "(title,slug,job_type,qualifications,school_id,no_of_openings,ishome,status,sortby)values('" . getRealescape($job_title) . "','" . $slug . "','" . getRealescape($job_type) . "', '" . getRealescape('Test') . "', '" . getRealescape(1) . "', '" . getRealescape(1) . "','" . $ishome . "', '" . getRealescape(1) . "', '" . getRealescape(1) . "')";

			$rslt = $db->insert($str);

			if (!empty($rslt)) {

				if (!empty($rslt)) {

					echo json_encode(array("rslt" => "1")); //success
				} else {
					echo json_encode(array("rslt" => "3")); //same exists
				}

			} else {
				echo json_encode(array("rslt" => "4"));  //no values
			}
		}
		break;


	case 'update':
		//echo $edit_id;
		//exit();
		$today = date("Y-m-d");
		if (!empty($job_title)) {
			$strChk = "select count(id) as cnt from " . tbl_careerlisting . "  where title = '" . getRealescape($job_title) . "' and isactive != '2' and id != '" . $edit_id . "' ";
			$reslt = $db->get_a_line($strChk);
			$slug = slugify($job_title);

			$str = "update " . tbl_careerlisting . " set title = '" . getRealescape($job_title) . "', slug = '" . getRealescape($slug) . "',";

			$str .= " job_type = '" . getRealescape($job_type) . "', qualifications = '" . getRealescape('Test') . "',school_id='" . getRealescape(1) . "',no_of_openings='" . getRealescape(1) . "',ishome='" . $ishome . "', status='" . getRealescape(1) . "',sortby= " . getRealescape(1) . ",isactive = '" . 1 . "' where id = '" . $edit_id . "'";

			$db->insert_log("update", "" . tbl_careerlisting . "", $edit_id, "stafflisting updated", "stafflisting", $str);
			$db->insert($str);

			echo json_encode(array("rslt" => "2"));

		} else {
			echo json_encode(array("rslt" => "4"));  //no values
		}

		break;

	case 'del':
		$edit_id = base64_decode($Id);

		$today = date("Y-m-d");
		$str = "update " . tbl_careerlisting . " set isactive = '2' where id = '" . $edit_id . "'";
		//echo $str;
		//exit();

		$db->insert_log("delete", "" . tbl_careerlisting . "", $edit_id, "stafflisting deleted", "stafflisting", $str);
		$db->insert($str);
		echo json_encode(array("rslt" => "5")); //deletion


		break;

	case 'changestatus':
		$edit_id = base64_decode($Id);
		$today = date("Y-m-d");
		$status = $actval;

		$str = "update " . tbl_careerlisting . " set isactive = '" . $status . "' where id = '" . $edit_id . "'";
		//echo $str; exit;
		$db->insert_log("status", "" . tbl_careerlisting . "", $edit_id, "stafflisting Status", "stafflisting", $str);
		$db->insert($str);

		echo json_encode(array("rslt" => "6")); //status update success

		break;
}



?>