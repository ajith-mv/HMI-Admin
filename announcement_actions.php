<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

include 'includes/image_thumb.php';
$created=date('Y-m-d H:i:s');

if($status == '')$status=0;
if($ishome == '')$ishome=0;
 if($date == '') { $date = '0000-00-00';}else{$date = date('Y-m-d',strtotime($date));}
 
 
switch($act)
{
	case 'insert':	
	
	if(!empty($titlename)) {
		
		// $strChk = "select count(anmtid) from ".tbl_announcement." where announcement = '$titlename' and isactive != '2'";

 		// $reslt = $db->get_a_line($strChk);

		// if($reslt[0] == 0) {
			
			$obj=new Gthumb();	

			$pdf=$_FILES["pdf"]["name"];	

	        $pdfpath=$obj->genannouncement($pdf);

			$selectedschools = implode(',', $websitetoshow);
			
			$str="insert into ".tbl_announcement."(school_id, shlid,announcement,date,link,pdf,pdftitle,ishome,isactive,userid)values('".$selectedschools."','".getRealescape($txtshlid)."','".getRealescape($titlename)."','".getRealescape($date)."','".getRealescape($link)."','".getRealescape($pdf)."','".getRealescape($pdfpath)."','".$ishome."','".$status."','".$_SESSION["UserId"]."')";

			$rslt = $db->insert($str);			
			
			 $log = $db->insert_log("insert","".tbl_announcement."","","Announcement Added Newly","Announcement",$str);
			
			//echo json_encode(array("rslt"=>$rslt)); //success
			echo json_encode(array("rslt"=>"1")); //success
		// }
		// else {
		// 	 echo json_encode(array("rslt"=>"3")); //same exists
		// }

		
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
	
	break;
	
	
	case 'update':	 	
	
	$today=date("Y-m-d");	
	if(!empty($titlename)) {
		
	
		
		// $strChk = "select count(anmtid) from ".tbl_announcement." where announcement = '$titlename' and isactive != '2' and anmtid != '".$edit_id."' ";
 		// $reslt = $db->get_a_line($strChk);
		// if($reslt[0] == 0) {
			$str = "update ".tbl_announcement." set announcement = '".getRealescape($titlename)."', ";
		
		   if(isset($_FILES["pdf"])){
				$obj=new Gthumb();	
				$pdf=$_FILES["pdf"]["name"];	
	            $pdfpath=$obj->genannouncement($pdf);
	
	            $strph = " ,pdf='".$pdf."' ,pdftitle='".$pdfpath."'";
	
		
			}
		
			$schools_selected = implode(', ', $websitetoshow);
		 
			$str .= " school_id = '".$schools_selected."', date='".$date."',link='".$link."',ishome = '".$ishome."',isactive = '".$status."' $strph,userid='".$_SESSION["UserId"]."' where anmtid = '".$edit_id."'";
			
			$db->insert_log("update","".tbl_announcement."",$edit_id,"Announcement updated","Announcement",$str);
			$db->insert($str);

			echo json_encode(array("rslt"=>"2"));
		// }
		// else {
		// 	echo json_encode(array("rslt"=>"3")); //same exists
		// }
	}
	else {
		echo json_encode(array("rslt"=>"4"));  //no values
	}
		
	break;

	case 'del':
	  $edit_id = base64_decode($Id);
	  
	  $today = date("Y-m-d");
	  $str="update ".tbl_announcement." set isactive = '2',userid='".$_SESSION["UserId"]."' where anmtid = '".$edit_id."'";
	  
	  
	  $db->insert_log("delete","".tbl_announcement."",$edit_id,"Announcement deleted","Announcement",$str);
	   $db->insert($str); 	 
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	$today = date("Y-m-d");
	$status = $actval;
	
	 $str="update ".tbl_announcement." set isactive = '".$status."',userid='".$_SESSION["UserId"]."' where anmtid = '".$edit_id."'";
	 //echo $str; exit;
	  $db->insert_log("status","".tbl_announcement."",$edit_id,"Announcement Status","Announcement",$str);
	 $db->insert($str); 	
	
	echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
}



?>