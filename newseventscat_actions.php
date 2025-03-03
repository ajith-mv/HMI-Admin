<?php
include 'session.php';
extract($_REQUEST);
$act = $action;

// error_reporting(E_ALL);
$chkstatus = isset($chkstatus) ? $chkstatus : null;

if ($chkstatus != null)
	$status = 1;
else
	$status = 0;

include 'includes/image_thumb.php';

include 'imgsize.php';

$filename = '';

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

$created = date('Y-m-d H:i:s');


if ($status == '') {
	$status = 0;
}


switch ($act) {
	case 'insert':

		if (!empty($titlename)) {

			if (empty($ishome)) {
				$ishome = 0;
			}

			// if (isset($_FILES["cat_image"])) {

			// 	$test = explode('.', $_FILES['cat_image']['name']);

			// 	$extension = end($test);

			// 	$test_file = $_FILES['cat_image']['name'];

			// 	$file_wo_extension = substr($test_file, 0, strrpos($test_file, '.'));

			// 	$filename = $file_wo_extension . '-' . rand(100, 999) . '.' . $extension;

			// 	$location = '../uploads/category/' . $filename;

			// 	move_uploaded_file($_FILES['cat_image']['tmp_name'], $location);
			// }

			if (isset($_FILES['cat_image']) && (file_exists($_FILES['cat_image']['tmp_name']) || is_uploaded_file($_FILES['cat_image']['tmp_name']))) {
				$uploadDir = '../uploads/category/';
				$originalPath = $uploadDir . basename($_FILES['cat_image']['name']);
				$resizedPath = $uploadDir . 'resized-' . basename($_FILES['cat_image']['name']);

				if (move_uploaded_file($_FILES['cat_image']['tmp_name'], $originalPath)) {
					$maxWidth = 767;
					$maxHeight = 460;
					$filename = resizeImage($originalPath, $resizedPath, $maxWidth, $maxHeight);
				} else {
					echo json_encode(["rslt" => "error", "msg" => "Image upload failed."]);
					exit;
				}
			}

			// $urlslug = slugify($url_slug);

			$subcategory = $subcategory ?? 0;

			// $newsdate = date('Y-m-d', strtotime($newsdate));

			$currentDateTime = new DateTime();

			$newsdate = $currentDateTime->format('Y-m-d H:i:s');

			$checkSql = "SELECT COUNT(*) FROM " . tbl_newscategory . " WHERE urlslug = '" . getRealescape($url_slug) . "' AND isactive = 1";
			$reslt = $db->get_a_line($checkSql);

			if ($reslt[0] > 0) {
				echo json_encode(array("rslt" => "8", 'msg' => 'Name already exists.'));  //no values
			} else {

				$sql = "INSERT INTO " . tbl_newscategory . " (name, urlslug, types, subcategory, cat_image, short_desc, description, meta_title, meta_desc, ishome, homeorder, isactive, userid, createddate) 
				VALUES ('" . getRealescape($titlename) . "','" . getRealescape($url_slug) . "','" . getRealescape($types) . "','" . getRealescape($subcategory) . "','" . getRealescape($filename) . "','" . getRealescape($short_desc) . "','" . getRealescape($newscatdesc) . "','" . getRealescape($meta_title) . "','" . getRealescape($meta_desc) . "',
				'" . getRealescape($ishome) . "'," . (empty($homeorder) ? 'NULL' : "'" . getRealescape($homeorder) . "'") . ",'$chkstatus', '" . $_SESSION["UserId"] . "','$newsdate')";

				$status = $db->insert($sql);

				if ($status === TRUE) {

					if ($status == 1) {

						echo json_encode(array("rslt" => "1"));

					} else {

						echo json_encode(array("rslt" => "3"));

					}
				} else {

					echo json_encode(array("rslt" => "8", 'msg' => 'Category Name Required.'));  //no values

				}
			}

		} else {

			echo json_encode(array("rslt" => "4"));  //no values

		}

		break;


	case 'update':

		$today = date("Y-m-d");
		if (!empty($titlename)) {

			if (empty($ishome)) {
				$ishome = 0;
			}

			$strChk = "select count(catid) from " . tbl_newscategory . " where name = '" . getRealescape($titlename) . "' and isactive != '2' and catid != '" . $edit_id . "' ";
			$reslt = $db->get_a_line($strChk);
			if ($reslt[0] == 0) {

				$str = "update " . tbl_newscategory . " set name = '" . getRealescape($titlename) . "', ";
				$strph = '';

				// if (isset($_FILES["cat_image"])) {

				if (isset($_FILES['cat_image']) && (file_exists($_FILES['cat_image']['tmp_name']) || is_uploaded_file($_FILES['cat_image']['tmp_name']))) {
					$uploadDir = '../uploads/category/';
					$originalPath = $uploadDir . basename($_FILES['cat_image']['name']);
					$resizedPath = $uploadDir . 'resized-' . basename($_FILES['cat_image']['name']);

					if (move_uploaded_file($_FILES['cat_image']['tmp_name'], $originalPath)) {
						$maxWidth = 767;
						$maxHeight = 460;
						$filename = resizeImage($originalPath, $resizedPath, $maxWidth, $maxHeight);

						$strph = ",cat_image='" . getRealescape($filename) . "'";

					} else {
						echo json_encode(["rslt" => "error", "msg" => "Image upload failed."]);
						exit;
					}
				}
				// }
				// }

				// $urlslug = slugify($url_slug);

				$str .= "types='" . getRealescape($types) . "', urlslug='" . getRealescape($url_slug) . "',subcategory='" . getRealescape($subcategory) . "'
				,short_desc='" . getRealescape($short_desc) . "',meta_title='" . getRealescape($meta_title) . "',meta_desc='" . getRealescape($meta_desc) . "',
				ishome='" . getRealescape($ishome) . "',homeorder='" . (empty($homeorder) ? 'NULL' : getRealescape($homeorder)) . "',description='" . getRealescape($newscatdesc) . "',
				modifydate='" . $today . "',isactive = '" . $status . "' $strph,userid='" . $_SESSION["UserId"] . "' where catid = '" . $edit_id . "'";

				$db->insert_log("update", "" . tbl_newscategory . "", $edit_id, "news cat updated", "newseventscat", $str);
				$db->insert($str);

				echo json_encode(array("rslt" => "2"));
			} else {
				echo json_encode(array("rslt" => "3")); //same exists
			}
		} else {
			echo json_encode(array("rslt" => "4"));  //no values
		}

		break;




	case 'del':

		$edit_id = base64_decode($Id);

		$today = date("Y-m-d");

		$checkSql = "SELECT COUNT(*) FROM " . tbl_newscategory . " where subcategory = '" . $edit_id . "'";
		$reslt = $db->get_a_line($checkSql);

		$checksSql = "SELECT COUNT(*) FROM " . tbl_gallerycategory . " where category = '" . $edit_id . "'";
		$reslts = $db->get_a_line($checksSql);

		if ($reslt[0] > 0) {
			echo json_encode(array("rslt" => "7"));

		} else if ($reslts[0] > 0) {
			echo json_encode(array("rslt" => "7"));

		} else {
			$str = "update " . tbl_newscategory . " set isactive = '2',userid='" . $_SESSION["UserId"] . "' , modifydate='" . $today . "' where catid = '" . $edit_id . "'";

			$db->insert($str);
			echo json_encode(array("rslt" => "5"));
		}

		break;
	case 'changestatus':
		$edit_id = base64_decode($Id);
		$today = date("Y-m-d");
		$status = $actval;

		$str = "update " . tbl_newscategory . " set isactive = '" . $status . "',userid='" . $_SESSION["UserId"] . "', modifydate='" . $today . "' where catid = '" . $edit_id . "'";
		//echo $str; exit;
		$db->insert_log("status", "" . tbl_newscategory . "", $edit_id, "news Status", "newseventscat", $str);
		$db->insert($str);

		echo json_encode(array("rslt" => "6")); //status update success

		break;

	case 'changehome':
		$edit_id = base64_decode($Id);
		$today = date("Y-m-d");
		$status = $actval;

		$strChk = "select count(ishome) from " . tbl_newscategory . " where ishome = '1' and types = '1' and (subcategory is NULL or subcategory = 0) and isactive = '1'";
		$reslt = $db->get_a_line($strChk);
		if ($reslt[0] == 4) {
			$strsChk = "select count(ishome) from " . tbl_newscategory . " where ishome = '1' and types = '1' and (subcategory is NULL or subcategory = 0) and isactive = '1' and catid = '" . $edit_id . "'";
			$result = $db->get_a_line($strsChk);
			if ($result[0] == 1) {
				if ($status == 0) {
					$str = "update " . tbl_newscategory . " set ishome = '" . $status . "',homeorder = NULL,userid='" . $_SESSION["UserId"] . "', modifydate='" . $today . "' where catid = '" . $edit_id . "'";
					$db->insert_log("status", "" . tbl_newscategory . "", $edit_id, "news Status", "newseventscat", $str);
					$db->insert($str);
					echo json_encode(array("rslt" => "6")); //status update success
				} else {
					$str = "update " . tbl_newscategory . " set ishome = '" . $status . "',userid='" . $_SESSION["UserId"] . "', modifydate='" . $today . "' where catid = '" . $edit_id . "'";
					$db->insert_log("status", "" . tbl_newscategory . "", $edit_id, "news Status", "newseventscat", $str);
					$db->insert($str);
					echo json_encode(array("rslt" => "6")); //status update success
				}

			} else {
				echo json_encode(array("rslt" => "7"));
			}
		} else {

			$strsChks = "select count(catid) from " . tbl_newscategory . " where types = '1' and (subcategory is NULL or subcategory = 0) and isactive = '1' and catid = '" . $edit_id . "'";
			$results = $db->get_a_line($strsChks);

			if ($results[0] == 1) {
				if ($status == 0) {
					$str = "update " . tbl_newscategory . " set ishome = '" . $status . "',homeorder = NULL,userid='" . $_SESSION["UserId"] . "', modifydate='" . $today . "' where catid = '" . $edit_id . "'";
					$db->insert_log("status", "" . tbl_newscategory . "", $edit_id, "news Status", "newseventscat", $str);
					$db->insert($str);
					echo json_encode(array("rslt" => "6")); //status update success
				} else {
					$str = "update " . tbl_newscategory . " set ishome = '" . $status . "',userid='" . $_SESSION["UserId"] . "', modifydate='" . $today . "' where catid = '" . $edit_id . "'";
					$db->insert_log("status", "" . tbl_newscategory . "", $edit_id, "news Status", "newseventscat", $str);
					$db->insert($str);
					echo json_encode(array("rslt" => "6")); //status update success
				}
			} else {
				echo json_encode(array("rslt" => "7"));
			}
			break;
		}


}



?>