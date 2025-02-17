<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;


include 'includes/image_thumb.php';

// $getsize = getimagesize_large($db,'testimonials','thumb');// 500-500
// $sizes = getdynamicimage($db,'testimonials');
// $imageval = explode('-',$getsize); //array[0]=>500; array[1]=> 500
// $imgheight = $imageval[1];
// $imgwidth = $imageval[0];

// list($width, $height, $type, $attr) = getimagesize($_FILES["testimonial_image"]['tmp_name']);

if (file_exists($_FILES['testimonial_image']['tmp_name']) || is_uploaded_file($_FILES['testimonial_image']['tmp_name'])) 
{
	list($width, $height, $type, $attr) = getimagesize($_FILES["testimonial_image"]['tmp_name']);
}
 if($testimonial_date == '') { $testimonial_date = '0000-00-00';}else{$testimonial_date = date('Y-m-d',strtotime($testimonial_date));}

$date_time = date('Y-m-d H:i:s'); 
$sort=0;
// if($sort){
// 	$sort=$sort;
// }
if($chkstatus !=null)
	$status =1;
else
	$status =0;
if($ishome == ''){
     $ishome = 0;
 }
switch($act)
{
	case 'insert':

		$selectedschools = implode(',', $websitetoshow);
            $strph = "";

        	if(isset($_FILES["testimonial_image"])){
			//	if(($width >= $imgwidth && $height >= $imgheight) || $_POST['chooses'] == '2'){
				// if($width >= $imgwidth && $height >= $imgheight){
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["testimonial_image"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp','webp') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				
				$exten  =$_FILES["testimonial_image"]["type"];
				
				$obj=new Gthumb();	
				$path =	$obj->resize_image($sizes,'testimonials',$exten,$_FILES['testimonial_image']);
				$strph = $path;	
				// echo $strph; die();
							
			}
		$sql = "INSERT INTO ".tbl_testimonial." (school_id, testimonial_name, tittlename_url, testimonial_date,description,  location, testimonial_video, testimonial_image, sort,ishome, isactive) 
				VALUES ('$selectedschools','$testimonial_name', '$tittlename_url', '$date_time', '".getRealescape($describtion)."','".getRealescape($location)."', '$testimonial_video','$strph', '$sort', '$ishome', '$chkstatus')";
// 		echo $sql;
// 		die();
		$status = $db->insert($sql);

		if ( $status === TRUE) {

			if($status == 1){

	
	// if(!empty($testimonial_name)) {
	// 	$strChk = "select count(testimonial_id) from ".tbl_testimonial."  where testimonial_name = '$testimonial_name' and isactive != '2'";
 	// 	$reslt = $db->get_a_line($strChk);
	// 	if($reslt[0] == 0) {
			
	// 		$tittlename_url = clean(trim($testimonial_name));
	// 		$tittlename_url = urlencode(strtolower($tittlename_url));
			
	// 			if(isset($_FILES["testimonial_image"])){
	// 				//echo $width.'-'.$imgwidth.'-'.$height.'-'.$imgheight; die();
	// 			//validate image file allowed (jpg,png,gif)
	// 			if(($width >= $imgwidth && $height >= $imgheight) && $height == round($width * $imgheight / $imgwidth)){
	// 			$file_info = getimagesize($_FILES["testimonial_image"]['tmp_name']);
				
	// 			$file_mime = explode('/',$file_info['mime']);				
	// 			if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
	// 				echo json_encode(array("rslt"=>"7"));
					
	// 				exit();
	// 			}	
 	 
	// 			$exten  =$_FILES["testimonial_image"]["type"];
	// 			$obj=new Gthumb();	
			
	// 			$path =	$obj->resize_image($sizes,'testimonials',$exten,$_FILES['testimonial_image']);
	// 			}
	// 				else
	// 			{
	// 				echo json_encode(array("rslt"=>"8",'msg'=>'Image Size should be '.$imgwidth.' & '.$imgheight.' or ratio size not matched'));  //no values
	// 					exit();
	// 			}
	// 		}
			
	// 		$str="insert into ".tbl_testimonial." (testimonial_name,tittlename_url,userid,testimonial_date,describtion,testimonial_image,testimonial_branch,location,testimonial_video,sort,isactive,createdate)values('".getRealescape($testimonial_name)."','".getRealescape($tittlename_url)."','".$_SESSION["UserId"]."','".getRealescape($testimonial_date)."','".getRealescape($describtion)."','".getRealescape($path)."','".getRealescape($testimonial_branch)."','".getRealescape($location)."','".getRealescape($testimonial_video)."',".getRealescape($sort).",".$status.",'".$date_time."')";
	// 		//echo $str; die();
	// 		$rslt = $db->insert($str);			
	// 		$log = $db->insert_log("insert","".tbl_testimonial." ","","Testimonial Added Newly","testimonial",$str);
			
 			echo json_encode(array("rslt"=>"1")); //success
		}
		else {
			 echo json_encode(array("rslt"=>"3")); //same exists
		}
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	
	break;
	
	
	case 'update':	 	
	//$edit_id
	$today=date("Y-m-d");
// 	echo 23;
// 			    die();
	if(!empty($testimonial_name)) {
// 		$strChk = "select count(testimonial_id) from ".tbl_testimonial."  where testimonial_name = '$testimonial_name' and isactive != '2' and testimonial_id != '".$edit_id."' ";
//  		$reslt = $db->get_a_line($strChk);
// 		if($reslt[0] == 0) {
		
            $tittlename_url = clean(trim($testimonial_name));
			$tittlename_url = urlencode(strtolower($tittlename_url));
			
		
		$str = "update ".tbl_testimonial." set testimonial_name = '".addslashes(trim($testimonial_name))."', tittlename_url = '".getRealescape($tittlename_url)."',";
			
		$strph = "";
		
			
			
			if(isset($_FILES["testimonial_image"])){
			    
			//	if(($width >= $imgwidth && $height >= $imgheight) || $_POST['chooses'] == '2'){
				// if($width >= $imgwidth && $height >= $imgheight){
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["testimonial_image"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp','webp') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				
				$exten  =$_FILES["testimonial_image"]["type"];
				
				$obj=new Gthumb();	
				$path =	$obj->resize_image($sizes,'testimonials',$exten,$_FILES['testimonial_image']);
				$strph = " ,testimonial_image='".$path."'";	
			//	echo $strph; die();
							
			}
			 //echo $describtion;
			 //die();
		 $selectedschools = implode(',', $websitetoshow);
		 	$str .= " school_id='".$selectedschools."',description='".getRealescape($describtion)."', testimonial_date='".$testimonial_date."',location='".getRealescape($location)."',testimonial_video='".addslashes(trim($testimonial_video))."',sort='".addslashes(trim($sort))."',ishome = '".$ishome."',isactive = '".$status."' $strph where testimonial_id = '".$edit_id."'";
			
// 			echo $str; die();
			
			$db->insert($str);
			$db->insert_log("update","".tbl_testimonial." ",$edit_id,"testimonial updated","announcements",$str);

			echo json_encode(array("rslt"=>"2"));
// 		}
// 		else {
// 			echo json_encode(array("rslt"=>"3")); //same exists
// 		}
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
		
	break;
	
	case 'del':
	
	  $edit_id = base64_decode($Id);
	 
	  $today = date("Y-m-d");
	  $str="update ".tbl_testimonial."  set isactive = '2' where testimonial_id = '".$edit_id."'  ";
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".tbl_testimonial." ",$edit_id,"testimonial deleted","testimonial",$str);
	  
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  
	  break;	
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	$today = date("Y-m-d");
	$status = $actval;
	
	// if($edit_id !="1"){
		$str="update ".tbl_testimonial."  set isactive = '".$status."' where testimonial_id = '".$edit_id."'";
		$db->insert($str); 	
		echo json_encode(array("rslt"=>"6")); //status update success
	 /*}
	 else{		 
		echo json_encode(array("rslt"=>"7")); // cannot change status	  
	 }*/
	
	break;
	
}



?>
