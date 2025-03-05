<?php
include 'session.php';
extract($_REQUEST);
$act = $action;

if ($chkstatus != null)
	$status = 1;
else
	$status = 0;

include 'includes/image_thumb.php';
$created = date('Y-m-d H:i:s');

$getsize = getimagesize_large($db, 'gallery', 'thumb');
$sizes = getdynamicimage($db, 'gallery');
$imageval = explode('-', $getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];


if (file_exists($_FILES['galleryimage']['tmp_name']) || is_uploaded_file($_FILES['galleryimage']['tmp_name'])) {
	list($width, $height, $type, $attr) = getimagesize($_FILES["galleryimage"]['tmp_name']);
}

if ($status == '')
	$status = 0;

if ($ishome == '')
	$ishome = 0;


if ($glydate == '') {
	$glydate = '0000-00-00';
} else {
	$glydate = date('Y-m-d', strtotime($glydate));
}


switch ($act) {
	case 'insert':
		/*
																																								 echo "W : ".$width;
																																								 echo "H : ".$height;
																																								 echo "IW : ".$imgwidth;
																																								 echo "IH : ".$imgheight;
																																								 exit;
																																								 */
		if (!empty($titlename)) {
			// if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
			$strChk = "select count(glyid) from " . tbl_gallery . " where glytitle = '" . getRealescape($titlename) . "' and isactive != '2'";
			$reslt = $db->get_a_line($strChk);
			// 		if($reslt[0] == 0) {

			if (isset($_FILES["galleryimage"])) {
				//validate image file allowed (jpg,png,gif)
				// if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
				$file_info = getimagesize($_FILES["galleryimage"]['tmp_name']);
				$file_mime = explode('/', $file_info['mime']);
				if (!in_array($file_mime[1], array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'))) {
					echo json_encode(array("rslt" => "7"));
					exit();
				}

				$exten = $_FILES["galleryimage"]["type"];
				$obj = new Gthumb();

				$path = $obj->resize_image($sizes, 'gallery', $exten, $_FILES['galleryimage']);
			} else {
				echo json_encode(array("rslt" => "8", 'msg' => 'Image Size should be ' . $imgwidth . ' & ' . $imgheight . ' or ratio size not matched'));  //no values
				exit();
			}
			// 			}

			$schools_selected = implode(', ', $websitetoshow);


			$str = "insert into " . tbl_gallery . "(school_id,glytitle,glyimage,glydate,catid,ishome,isactive,userid)values(" . $schools_selected . ",'" . getRealescape($titlename) . "','" . getRealescape($path) . "','" . getRealescape($glydate) . "','" . $catid . "','" . $ishome . "','" . $status . "','" . $_SESSION["UserId"] . "')";

			$rslt = $db->insert($str);

			$log = $db->insert_log("insert", "" . tbl_gallery . "", "", "Gallery Added Newly", "Gallery", $str);
			//echo $str; exit;
			//echo json_encode(array("rslt"=>$rslt)); //success
			echo json_encode(array("rslt" => "1")); //success
			// }
			// else {
			// 	 echo json_encode(array("rslt"=>"3")); //same exists
			// }
			// }
			// 	else
			// 	{
			// 		echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or Ratio ('.round($imgheight/$imgwidth).': '.round($imgheight%$imgwidth).') size not matched'));  //no values
			// 	}	

		} else {
			echo json_encode(array("rslt" => "4"));  //no values
		}

		break;


	case 'update':
		//echo $edit_id;
		//exit();

		$today = date("Y-m-d");
		if (!empty($titlename)) {

			$schools_selected = implode(', ', $websitetoshow);

			$strChk = "select count(glyid) from " . tbl_gallery . " where glytitle = '" . getRealescape($titlename) . "' and isactive != '2' and glyid != '" . $edit_id . "' ";
			// 		echo $strChk;
// 		die();
			$reslt = $db->get_a_line($strChk);
			// 		if($reslt[0] == 0) {
			$str = "update " . tbl_gallery . " set glytitle = '" . getRealescape($titlename) . "', ";

			if (isset($_FILES["galleryimage"])) {
				//	if(($width >= $imgwidth && $height >= $imgheight) || $_POST['chooses'] == '2'){
				if ($width >= $imgwidth && $height >= $imgheight) {
					//validate image file allowed (jpg,png,gif)
					$file_info = getimagesize($_FILES["galleryimage"]['tmp_name']);
					$file_mime = explode('/', $file_info['mime']);
					if (!in_array($file_mime[1], array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'))) {
						echo json_encode(array("rslt" => "7"));
						exit();
					}

					$exten = $_FILES["galleryimage"]["type"];

					$obj = new Gthumb();
					$path = $obj->resize_image($sizes, 'gallery', $exten, $_FILES['galleryimage']);
					$strph = " ,glyimage='" . $path . "'";
				} else {
					echo json_encode(array("rslt" => "8", 'msg' => 'Image Size should be ' . $imgwidth . ' & ' . $imgheight . ' or ratio size not matched'));  //no values
					exit();
				}
			}



			$str .= " school_id = " . $schools_selected . ",  glydate='" . $glydate . "', catid='" . $catid . "', ishome='" . $ishome . "',isactive = '" . $status . "' $strph,userid='" . $_SESSION["UserId"] . "' where glyid = '" . $edit_id . "'";

			$db->insert_log("update", "" . tbl_gallery . "", $edit_id, "Gallery updated", "Gallery", $str);
			$db->insert($str);

			echo json_encode(array("rslt" => "2"));
			// 		}
// 		else {
// 			echo json_encode(array("rslt"=>"3")); //same exists
// 		}
		} else {
			echo json_encode(array("rslt" => "4"));  //no values
		}

		break;

	case 'moreimage':

		//echo count($_FILES["gallerymoreimage"]["name"]);
		//echo 'asdasd';
		//exit;

		$checkSql = "SELECT * FROM " . tbl_gallerycategory . " WHERE catid = '" . $edit_id . "'";
		$reslt = $db->get_a_line($checkSql);

		$subid = $reslt[4];

		$checksSql = "SELECT COUNT(*) FROM " . tbl_newscategory . " WHERE catid = '" . $subid . "' AND types = 2 AND isactive = 1";
		$reslts = $db->get_a_line($checksSql);



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

			$allowWidth = array("700", "800", "1400", "1600", "2100", "2400", "2800", "3000", "3500");
			$allowHeight = array("600", "1200 ", "1200", "2400", "1800", "3600", "2400", "4800", "3000");

			if (in_array($width, $allowWidth) && in_array($height, $allowHeight)) {

				$a = 1;

				for ($i = 0; $i < count($_FILES["gallerymoreimage"]["name"]); $i++) {
					if ($_FILES["gallerymoreimage"]["name"][$i] != '') {
						$_FILES["gallerymoreimage"]["name"][$i] . "<br>";
						$extension = $_FILES["gallerymoreimage"]["type"][$i];

						$obj = new Gthumb();
						$path = $obj->resize_image_bulk($sizes, 'gallery', $extension, $_FILES['gallerymoreimage'], $i);

						if ($path != '') {
							$str = "INSERT INTO  " . tbl_gallery_moreimg . "(glyid,imgname,imgorder,isactive,userid) values
							('" . $edit_id . "','" . $path . "','" . $a . "',1,'" . $_SESSION["UserId"] . "') ";

							// 			echo $str; die();
							$rslt = $db->insert($str);
							$log = $db->insert_log("insert", "" . tbl_gallery_moreimg . "", "", "Gallery Image Added Newly", "Gallery", $str);
						}
					}
				}
				echo json_encode(array("rslt" => "1")); //success

				die();
			} else {

				if ($reslts[0] > 0) {
					echo json_encode(array("rslt" => "9", "msg" => 'Image size should be 700x600 perspective size  ' . $imagenum));
				} else {
					echo json_encode(array("rslt" => "9", "msg" => 'Image size should be 800x1200  perspective size  ' . $imagenum));

				}

				die();
			}
		}

	case "moreimageupdate":

		$var = explode(',', $productimgid);



		foreach ($var as $i) {

			//	 $str = "INSERT INTO  ".tbl_gallery_img."(galleryid,imgname,imgorder,isactive,userid,createdDate) values

			if ($_REQUEST["imagestatus" . $i] != "") {

				$getimg = $db->get_a_line("select * from " . tbl_gallery_moreimg . " where glyimgid='" . $_REQUEST['image' . $i . 'id'] . "'");
				$getsiz = $db->get_rsltset("select  foldername from " . tbl_imageconfig . " where Isactive = 1 and imageconfigModule = 'gallery'");



				foreach ($getsiz as $sizval) {

					unlink("../uploads/" . $sizval['foldername'] . "/" . $getimg['imgname']);
					unlink("../uploads/" . $getimg['imgname']);
				}

				$sql1 = " imgname='',";
				$log = $db->insert_log("deleted", "" . tbl_gallery_moreimg . "", "", "Gallery Image deleted", "Gallery", $str);

				$delQry = "delete from " . tbl_gallery_moreimg . " where glyimgid=" . $_REQUEST['image' . $i . 'id'];



				$db->insert("delete from " . tbl_gallery_moreimg . " where glyimgid='" . $_REQUEST['image' . $i . 'id'] . "'");

			} else {
				$sql1 = " imgname='" . $_REQUEST['productim' . $i] . "',";
				if ($_REQUEST['status' . $i] == '')
					$statuss = '0';
				else
					$statuss = $_REQUEST['status' . $i];

				$str1 = $db->insert("update " . tbl_gallery_moreimg . " set imgorder='" . $_REQUEST['image1order' . $i] . "',imgtitle='" . $_REQUEST['image1title' . $i] . "',$sql1 Isactive='" . $statuss . "' where glyimgid='" . $_REQUEST['image' . $i . 'id'] . "'");


			}
		}

		$log = $db->insert_log("insert", "" . tbl_gallery_moreimg . "", "", "Updated", "Gallery", $str);
		echo json_encode(array("rslt" => "2")); //success
		break;


	case 'del':
		$edit_id = base64_decode($Id);

		$today = date("Y-m-d");
		$str = "update " . tbl_gallery . " set isactive = '2',userid='" . $_SESSION["UserId"] . "' where glyid = '" . $edit_id . "'";
		//echo $str;
		//exit();

		$db->insert_log("delete", "" . tbl_gallery . "", $edit_id, "Gallery deleted", "Gallery", $str);
		$db->insert($str);
		echo json_encode(array("rslt" => "5")); //deletion


		break;

	case 'changestatus':
		$edit_id = base64_decode($Id);
		$today = date("Y-m-d");
		$status = $actval;

		$str = "update " . tbl_gallery . " set isactive = '" . $status . "',userid='" . $_SESSION["UserId"] . "' where glyid = '" . $edit_id . "'";
		//echo $str; exit;
		$db->insert_log("status", "" . tbl_gallery . "", $edit_id, "Gallery Status", "Gallery", $str);
		$db->insert($str);

		echo json_encode(array("rslt" => "6")); //status update success

		break;
}



?>