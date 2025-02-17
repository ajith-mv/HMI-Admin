<?php
include 'session.php';
extract($_REQUEST);
$act = $action;

error_reporting(1);

if ($chkstatus != null)
	$status = 1;
else
	$status = 0;

include 'includes/image_thumb.php';


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

if (file_exists($_FILES['cat_image']['tmp_name']) || is_uploaded_file($_FILES['cat_image']['tmp_name'])) {
	list($width, $height, $type, $attr) = getimagesize($_FILES["cat_image"]['tmp_name']);
}

if ($status == '') {
	$status = 0;
}

if ($newsdate == '') {
	$newsdate = '0000-00-00';
} else {
	$newsdate = date('Y-m-d', strtotime($newsdate));
}

// echo $newsdate; exit;
switch ($act) {
	case 'insert':

		if (!empty($titlename)) {

			if (empty($ishome)) {
				$ishome = 0;
			}

			if (isset($_FILES["cat_image"])) {

				$test = explode('.', $_FILES['cat_image']['name']);

				$extension = end($test);

				$test_file = $_FILES['cat_image']['name'];

				$file_wo_extension = substr($test_file, 0, strrpos($test_file, '.'));

				$filename = $file_wo_extension . '-' . rand(100, 999) . '.' . $extension;

				$location = '../uploads/category/' . $filename;

				move_uploaded_file($_FILES['cat_image']['tmp_name'], $location);
			}

			$urlslug = slugify($url_slug);

			$subcategory = $subcategory ?? 0;

			$sql = "INSERT INTO " . tbl_newscategory . " (name, urlslug, types, subcategory, cat_image, short_desc, description,meta_title,meta_desc, ishome, isactive, userid, createddate) 
				VALUES ('" . getRealescape($titlename) . "','" . getRealescape($urlslug) . "','" . getRealescape($types) . "','" . getRealescape($subcategory) . "','" . getRealescape($filename) . "','" . getRealescape($short_desc) . "','" . getRealescape($newscatdesc) . "','" . getRealescape($meta_title) . "','" . getRealescape($meta_desc) . "','" . getRealescape($ishome) . "','$chkstatus', '1','$newsdate')";

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

				if (isset($_FILES["cat_image"])) {

					$test = explode('.', $_FILES['cat_image']['name']);

					$extension = end($test);

					$test_file = $_FILES['cat_image']['name'];

					$file_wo_extension = substr($test_file, 0, strrpos($test_file, '.'));

					$filename = $file_wo_extension . '-' . rand(100, 999) . '.' . $extension;

					$location = '../uploads/category/' . $filename;

					move_uploaded_file($_FILES['cat_image']['tmp_name'], $location);

					$strph = ",cat_image='" . getRealescape($filename) . "'";
				}

				$urlslug = slugify($url_slug);

				$str .= "types='" . getRealescape($types) . "', urlslug='" . getRealescape($urlslug) . "',subcategory='" . getRealescape($subcategory) . "',short_desc='" . getRealescape($short_desc) . "',meta_title='" . getRealescape($meta_title) . "',meta_desc='" . getRealescape($meta_desc) . "',ishome='" . getRealescape($ishome) . "',
				description='" . getRealescape($newscatdesc) . "', modifydate='" . $today . "',isactive = '" . $status . "' $strph,userid='" . $_SESSION["UserId"] . "' where catid = '" . $edit_id . "'";

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

		$str = "update " . tbl_newscategory . " set isactive = '2',userid='" . $_SESSION["UserId"] . "' , modifydate='" . $today . "' where catid = '" . $edit_id . "'";


		$db->insert($str);
		echo json_encode(array("rslt" => "5")); //deletion


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




}



?>