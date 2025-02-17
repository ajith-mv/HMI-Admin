<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

include 'includes/image_thumb.php';


function slugify($text){
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














$created=date('Y-m-d H:i:s');

if($status == ''){
	$status=0;
}

if($newsdate == '') { $newsdate = '0000-00-00';}else{$newsdate = date('Y-m-d',strtotime($newsdate));}
 
// echo $newsdate; exit;
switch($act)
{
	case 'insert':	

	if(!empty($titlename)) {

		$slug = slugify($titlename);

		$sql = "INSERT INTO ".tbl_newscategory." (name, description, isactive, userid, createddate) 
				VALUES ('".getRealescape($titlename)."','".getRealescape($newscatdesc)."','$chkstatus', '1','$newsdate')";


		
		$status = $db->insert($sql);

		if ( $status === TRUE) {

			if($status == 1){

				echo json_encode(array("rslt"=>"1")); //success

			}else {

				echo json_encode(array("rslt"=>"3")); //same exists

			}
		}else{
			
			echo json_encode(array("rslt"=>"8",'msg'=>'Category Name Required.'));  //no values
		
		}	
		
	}
	else {

		echo json_encode(array("rslt"=>"4"));  //no values

	}
	
	break;
	
	
	case 'update':	
		
		$today=date("Y-m-d");	
		if(!empty($titlename)) {
			
	
			
			$strChk = "select count(catid) from ".tbl_newscategory." where name = '".getRealescape($titlename)."' and isactive != '2' and catid != '".$edit_id."' ";
			 $reslt = $db->get_a_line($strChk);
			if($reslt[0] == 0) {
				
				$str = "update ".tbl_newscategory." set name = '".getRealescape($titlename)."', ";
			
			
				$slug = slugify($titlename);
			 
				$str .= " description='".getRealescape($newscatdesc)."', modifydate='".$today."',isactive = '".$status."' $strph,userid='".$_SESSION["UserId"]."' where catid = '".$edit_id."'";

				$db->insert_log("update","".tbl_newscategory."",$edit_id,"news cat updated","newseventscat",$str);
				$db->insert($str);
	
				echo json_encode(array("rslt"=>"2"));
			}
			else {
				echo json_encode(array("rslt"=>"3")); //same exists
			}
		}
		else {
			echo json_encode(array("rslt"=>"4"));  //no values
		}
			
		break;
	
	
	  
	  
	  case 'del':

		$edit_id = base64_decode($Id);
		
		$today = date("Y-m-d");

		$str="update ".tbl_newscategory." set isactive = '2',userid='".$_SESSION["UserId"]."' , modifydate='".$today."' where catid = '".$edit_id."'";
	

		 $db->insert($str); 	 
		 echo json_encode(array("rslt"=>"5")); //deletion
			 
		  
	  break;
	  
	  case 'changestatus':
	  $edit_id = base64_decode($Id);
	  $today = date("Y-m-d");
	  $status = $actval;
	  
	   $str="update ".tbl_newscategory." set isactive = '".$status."',userid='".$_SESSION["UserId"]."', modifydate='".$today."' where catid = '".$edit_id."'";
	   //echo $str; exit;
		$db->insert_log("status","".tbl_newscategory."",$edit_id,"news Status","newseventscat",$str);
	   $db->insert($str); 	
	  
	  echo json_encode(array("rslt"=>"6")); //status update success
	  
	  break;



	
}



?>