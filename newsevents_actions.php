<?php

include 'session.php';
extract($_REQUEST);
$act = $action;

// error_reporting(1);

if ($chkstatus != null)
	$status = 1;
else
	$status = 0;

include 'includes/image_thumb.php';

include 'imgsize.php';


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

$getsize = getimagesize_large($db, 'newsevents', 'thumb');
$sizes = getdynamicimage($db, 'newsevents');
$imageval = explode('-', $getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

if (file_exists($_FILES['newsimage']['tmp_name']) || is_uploaded_file($_FILES['newsimage']['tmp_name'])) {
	list($width, $height, $type, $attr) = getimagesize($_FILES["newsimage"]['tmp_name']);
}

if ($status == '') {
	$status = 0;
}

if ($ishome == '') {
	$ishome = 0;
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


			// if (isset($_FILES["newsimage"])) {

			// 	$test = explode('.', $_FILES['newsimage']['name']);

			// 	$extension = end($test);

			// 	$test_file = $_FILES['newsimage']['name'];

			// 	$file_wo_extension = substr($test_file, 0, strrpos($test_file, '.'));

			// 	$filename = $file_wo_extension . '-' . rand(100, 999) . '.' . $extension;

			// 	$location = '../uploads/newsevents/' . $filename;

			// 	move_uploaded_file($_FILES['newsimage']['tmp_name'], $location);
			// }


			$image_info = $_FILES["newsimage"]["tmp_name"];

			// echo 'Hellow';
			// print_r($image_info);
			// die();

			if (isset($_FILES['newsimage']) && (file_exists($_FILES['newsimage']['tmp_name']) || is_uploaded_file($_FILES['newsimage']['tmp_name']))) {
				$uploadDir = '../uploads/newsevents/';
				$originalPath = $uploadDir . basename($_FILES['newsimage']['name']);
				$resizedPath = $uploadDir . 'resized-' . basename($_FILES['newsimage']['name']);

				if (move_uploaded_file($_FILES['newsimage']['tmp_name'], $originalPath)) {
					$maxWidth = 450;
					$maxHeight = 350;
					$filename = resizeImage($originalPath, $resizedPath, $maxWidth, $maxHeight);
				} else {
					echo json_encode(["rslt" => "error", "msg" => "Image upload failed."]);
					exit;
				}
			}




			$schools_selected = 1;

			$slug = slugify($titlename);

			$checkSql = "SELECT COUNT(*) FROM " . tbl_newsevents . " WHERE slug = '" . getRealescape($slug) . "' AND isactive = 1";
			$reslt = $db->get_a_line($checkSql);

			if ($reslt[0] > 0) {
				echo json_encode(array("rslt" => "8", 'msg' => ' Title already exists.'));  //no values

			} else {

				$sql = "INSERT INTO " . tbl_newsevents . " (school_id, newstitle, slug, newsimage, newsdate, short_desc, newsdescription, catid,meta_title,meta_desc,ishome, isactive, userid) 
				VALUES ('$schools_selected', '" . getRealescape($titlename) . "', '$slug', '$filename', '$newsdate', '" . getRealescape($short_desc) . "', '" . getRealescape($newsdesc) . "','$catid','" . getRealescape($meta_title) . "','" . getRealescape($meta_desc) . "','$ishome','$chkstatus', '1')";


				$status = $db->insert($sql);

				if ($status === TRUE) {

					if ($status == 1) {

						echo json_encode(array("rslt" => "1")); //success

					} else {

						echo json_encode(array("rslt" => "3")); //same exists

					}
				} else {

					echo json_encode(array("rslt" => "8", 'msg' => 'Image Size should be ' . $imgwidth . ' & ' . $imgheight . ' or Ratio (' . round($imgheight / $imgwidth) . ': ' . round($imgheight % $imgwidth) . ') size not matched'));  //no values

				}

			}

		} else {

			echo json_encode(array("rslt" => "4"));  //no values

		}

		break;


	case 'update':

		$today = date("Y-m-d");
		if (!empty($titlename)) {



			$strChk = "select count(newsid) from " . tbl_newsevents . " where newstitle = '" . getRealescape($titlename) . "' and isactive != '2' and newsid != '" . $edit_id . "' ";
			$reslt = $db->get_a_line($strChk);
			if ($reslt[0] == 0) {

				$str = "update " . tbl_newsevents . " set newstitle = '" . getRealescape($titlename) . "', ";

				// if (isset($_FILES["newsimage"])) {
				// 	if ($width >= $imgwidth && $height >= $imgheight) {
				// 		//validate image file allowed (jpg,png,gif)
				// 		$file_info = getimagesize($_FILES["newsimage"]['tmp_name']);
				// 		$file_mime = explode('/', $file_info['mime']);
				// 		if (!in_array($file_mime[1], array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'))) {
				// 			echo json_encode(array("rslt" => "7"));
				// 			exit();
				// 		}

				// 		$exten = $_FILES["newsimage"]["type"];

				// 		$obj = new Gthumb();
				// 		$path = $obj->resize_image($sizes, 'newsevents', $exten, $_FILES['newsimage']);
				// 		$strph = " ,newsimage='" . $path . "'";
				// 	} else {
				// 		echo json_encode(array("rslt" => "8", 'msg' => 'Image Size should be ' . $imgwidth . ' & ' . $imgheight . ' or ratio size not matched'));  //no values
				// 		exit();
				// 	}
				// }

				// $image_info = $_FILES["newsimage"]["tmp_name"];

				// echo 'Hwl';


				// 			list($width, $height) = getimagesize($image_info);
				// 			print_r($image_info);
				// die();


				if (isset($_FILES['newsimage']) && (file_exists($_FILES['newsimage']['tmp_name']) || is_uploaded_file($_FILES['newsimage']['tmp_name']))) {



					$uploadDir = '../uploads/newsevents/';
					$originalPath = $uploadDir . basename($_FILES['newsimage']['name']);
					$resizedPath = $uploadDir . 'resized-' . basename($_FILES['newsimage']['name']);

					if (move_uploaded_file($_FILES['newsimage']['tmp_name'], $originalPath)) {

						$maxWidth = 1000;
						$maxHeight = 465;
						$filename = resizeImage($originalPath, $resizedPath, $maxWidth, $maxHeight);

						$strph = " ,newsimage='" . $filename . "'";

					} else {
						echo json_encode(["rslt" => "error", "msg" => "Image upload failed."]);
						exit;
					}
				}


				$schools_selected = 1;

				$slug = slugify($titlename);

				$str .= " slug = '" . $slug . "',school_id = '" . $schools_selected . "', newsdescription='" . getRealescape($newsdesc) . "', short_desc='" . getRealescape($short_desc) . "',meta_title='" . getRealescape($meta_title) . "',meta_desc='" . getRealescape($meta_desc) . "',catid='" . $catid . "',ishome='" . $ishome . "', newsdate='" . $newsdate . "',isactive = '" . $status . "' $strph,userid='" . $_SESSION["UserId"] . "' where newsid = '" . $edit_id . "'";

				$db->insert_log("update", "" . tbl_newsevents . "", $edit_id, "news updated", "newsevents", $str);
				$db->insert($str);

				echo json_encode(array("rslt" => "2"));
			} else {
				echo json_encode(array("rslt" => "3")); //same exists
			}
		} else {
			echo json_encode(array("rslt" => "4"));  //no values
		}

		break;

	case 'moreimage':


		$file = $_FILES["gallerymoreimage"]["tmp_name"];

		$i = 0;
		foreach ($file as $single_file) {
			if (!empty($single_file)) {
				$imageinfo[$i] = getimagesize($single_file);
			}

			$i++;
		}

		$total_files_uploaded = count($file);

		for ($x = 0; $x <= $total_files_uploaded; $x++) {

			$width = $imageinfo[$x][0];
			$height = $imageinfo[$x][1];

			$allowWidth = array("450", "900", "1350", "1800", "2250");
			$allowHeight = array("350", "700", "1050", "1400", "1750");

			if (in_array($width, $allowWidth) && in_array($height, $allowHeight)) {

				$a = 1;

				for ($i = 0; $i < count($_FILES["gallerymoreimage"]["name"]); $i++) {
					if ($_FILES["gallerymoreimage"]["name"][$i] != '') {
						$_FILES["gallerymoreimage"]["name"][$i] . "<br>";
						$extension = $_FILES["gallerymoreimage"]["type"][$i];



						$obj = new Gthumb();
						$path = $obj->resize_image_bulk($sizes, 'newsevents', $extension, $_FILES['gallerymoreimage'], $i);

						if ($path != '') {
							$str = "INSERT INTO  " . tbl_moreimg . "(newsid,imgname,imgorder,isactive,userid) values
										('" . $edit_id . "','" . $path . "','" . $a . "',1,'" . $_SESSION["UserId"] . "') ";


							$rslt = $db->insert($str);
							$log = $db->insert_log("insert", "" . tbl_moreimg . "", "", "News Image Added Newly", "news", $str);
						}
					}
				}
				echo json_encode(array("rslt" => "1")); //success

				die();
			} else {
				echo json_encode(array("rslt" => "9", "msg" => 'Image size should be 450x350 perspective size  ' . $imagenum));
				die();
			}

		}

	case "moreimageupdate":

		$var = explode(',', $productimgid);



		foreach ($var as $i) {
			//	 $str = "INSERT INTO  ".tbl_gallery_img."(galleryid,imgname,imgorder,isactive,userid,createdDate) values
			if ($_REQUEST["imagestatus" . $i] != "") {
				$getimg = $db->get_a_line("select * from " . tbl_moreimg . " where moreimgid='" . $_REQUEST['image' . $i . 'id'] . "'");
				$getsiz = $db->get_rsltset("select  foldername from " . tbl_imageconfig . " where Isactive = 1 and imageconfigModule = 'newsevents'");



				foreach ($getsiz as $sizval) {

					unlink("../uploads/" . $sizval['foldername'] . "/" . $getimg['imgname']);
					unlink("../uploads/" . $getimg['imgname']);
				}

				$sql1 = " imgname='',";
				$log = $db->insert_log("deleted", "" . tbl_moreimg . "", "", "News Image deleted", "news", $str);

				$delQry = "delete from " . tbl_moreimg . " where moreimgid=" . $_REQUEST['image' . $i . 'id'];

				//echo $delQry;	exit();

				$db->insert("delete from " . tbl_moreimg . " where moreimgid='" . $_REQUEST['image' . $i . 'id'] . "'");

			} else {
				$sql1 = " imgname='" . $_REQUEST['productim' . $i] . "',";
				if ($_REQUEST['status' . $i] == '')
					$statuss = '0';
				else
					$statuss = $_REQUEST['status' . $i];

				$str1 = $db->insert("update " . tbl_moreimg . " set imgorder='" . $_REQUEST['image1order' . $i] . "',imagetitle='" . $_REQUEST['image1title' . $i] . "',$sql1 Isactive='" . $statuss . "' where moreimgid='" . $_REQUEST['image' . $i . 'id'] . "'");

			}
		}

		$log = $db->insert_log("insert", "" . tbl_moreimg . "", "", "Updated", "news", $str);
		echo json_encode(array("rslt" => "2")); //success
		break;


	case 'del':

		$edit_id = base64_decode($Id);

		$today = date("Y-m-d");

		$str = "update " . tbl_newsevents . " set isactive = '2',userid='" . $_SESSION["UserId"] . "' where newsid = '" . $edit_id . "'";


		$db->insert($str);
		echo json_encode(array("rslt" => "5")); //deletion


		break;

	case 'changestatus':
		$edit_id = base64_decode($Id);
		$today = date("Y-m-d");
		$status = $actval;

		$str = "update " . tbl_newsevents . " set isactive = '" . $status . "',userid='" . $_SESSION["UserId"] . "' where newsid = '" . $edit_id . "'";
		//echo $str; exit;
		$db->insert_log("status", "" . tbl_newsevents . "", $edit_id, "news Status", "news", $str);
		$db->insert($str);

		echo json_encode(array("rslt" => "6")); //status update success

		break;




}



?>