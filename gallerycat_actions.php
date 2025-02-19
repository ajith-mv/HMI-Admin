<?php
// echo 23;
// die();
include 'session.php';
extract($_REQUEST);
$act = $action;

error_reporting(E_ALL);

if (isset($chkstatus) && $chkstatus != null)
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

if ($status == '') {
	$status = 0;
}


// echo $newsdate; exit;
switch ($act) {
	case 'insert':

		if (!empty($titlename)) {

			if (isset($_FILES["image"])) {

				$test = explode('.', $_FILES['image']['name']);

				$extension = end($test);

				$test_file = $_FILES['image']['name'];

				$file_wo_extension = substr($test_file, 0, strrpos($test_file, '.'));

				$filename = $file_wo_extension . '-' . rand(100, 999) . '.' . $extension;

				$location = '../uploads/gallery/' . $filename;

				move_uploaded_file($_FILES['image']['tmp_name'], $location);
			}

			$slug = slugify($url_slug);

			$sql = "INSERT INTO " . tbl_gallerycategory . " 
			(name, slug, image, category, color, description, specfic, body_shape, hardware_color, meta_title, meta_desc, 
			isactive, userid, createddate) 
		VALUES 
			('" . getRealescape($titlename) . "',
			'" . getRealescape($slug) . "',
			'" . getRealescape($filename) . "',
			'" . getRealescape($category) . "',
			'" . (empty($color) ? 'NULL' : implode(', ', $color)) . "',
			'" . (empty($color) ? 'NULL' : getRealescape($gallerycatdesc)) . "',
			'" . (empty($specfic) ? 'NULL' : getRealescape($specfic)) . "',
			'" . (empty($body_shape) ? 'NULL' : getRealescape($body_shape)) . "',
			'" . (empty($hardware_color) ? 'NULL' : getRealescape($hardware_color)) . "',
			'" . getRealescape($meta_title) . "',
			'" . getRealescape($meta_desc) . "',
			'$chkstatus', 
			'1', 
			NOW())";

			$status = $db->insert($sql);

			if ($status === TRUE) {

				if ($status == 1) {

					echo json_encode(array("rslt" => "1")); //success

				} else {

					echo json_encode(array("rslt" => "3")); //same exists

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

			$strChk = "select count(catid) from " . tbl_gallerycategory . " where name = '" . getRealescape($titlename) . "' and isactive != '2' and catid != '" . $edit_id . "' ";

			$reslt = $db->get_a_line($strChk);

			if ($reslt[0] == 0) {

				$str = "update " . tbl_gallerycategory . " set name = '" . getRealescape($titlename) . "'";

				$slug = slugify($titlename);

				if (isset($_FILES["image"])) {

					$test = explode('.', $_FILES['image']['name']);

					$extension = end($test);

					$test_file = $_FILES['image']['name'];

					$file_wo_extension = substr($test_file, 0, strrpos($test_file, '.'));

					$filename = $file_wo_extension . '-' . rand(100, 999) . '.' . $extension;

					$location = '../uploads/gallery/' . $filename;

					move_uploaded_file($_FILES['image']['tmp_name'], $location);

					$str .= ",image='" . getRealescape($filename) . "'";

				}

				$str .= ",description='" . getRealescape($gallerycatdesc) . "',slug='" . getRealescape($slug) . "',category='" . getRealescape($category) . "',color='" . (empty($color) ? 'NULL' : implode(', ', $color)) . "',specfic='" . getRealescape($specfic) . "',
					body_shape='" . getRealescape($body_shape) . "',hardware_color='" . getRealescape($hardware_color) . "',
					meta_title='" . getRealescape($meta_title) . "',meta_desc='" . getRealescape($meta_desc) . "',modifydate='" . $today . "',isactive = '" . $status . "',userid='" . $_SESSION["UserId"] . "' where catid = '" . $edit_id . "'";

				$db->insert_log("update", "" . tbl_gallerycategory . "", $edit_id, "gallery cat updated", "gallerycat", $str);
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

		$str = "update " . tbl_gallerycategory . " set isactive = '2',userid='" . $_SESSION["UserId"] . "' , modifydate='" . $today . "' where catid = '" . $edit_id . "'";


		$db->insert($str);
		echo json_encode(array("rslt" => "5")); //deletion


		break;

	case 'changestatus':
		$edit_id = base64_decode($Id);
		$today = date("Y-m-d");
		$status = $actval;

		$str = "update " . tbl_gallerycategory . " set isactive = '" . $status . "',userid='" . $_SESSION["UserId"] . "', modifydate='" . $today . "' where catid = '" . $edit_id . "'";
		//echo $str; exit;
		$db->insert_log("status", "" . tbl_gallerycategory . "", $edit_id, "gallery Status", "gallerycat", $str);
		$db->insert($str);

		echo json_encode(array("rslt" => "6")); //status update success

		break;




}



?>