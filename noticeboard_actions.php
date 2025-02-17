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

 if($noticedate == '') { $noticedate = '0000-00-00';}else{$noticedate = date('Y-m-d',strtotime($noticedate));}
 
 
switch($act)
{
	case 'insert':	
	
	if(!empty($titlename)) {
		
		$strChk = "select count(noticeid) from ".tbl_noticeboard." where noticeboard = '$titlename' and isactive != '2'";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			$obj=new Gthumb();	
				$pdf=$_FILES["pdf"]["name"];	
	            $pdfpath=$obj->genmastercdepdf($pdf);
			
			 $str="insert into ".tbl_noticeboard."(shlid,noticeboard,date,link,pdf,pdftitle,isactive,userid)values(".getRealescape($txtshlid).",'".getRealescape($titlename)."','".getRealescape($noticedate)."','".getRealescape($link)."','".getRealescape($pdf)."','".getRealescape($pdfpath)."','".$status."','".$_SESSION["UserId"]."')";
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".tbl_noticeboard."","","NoticeBoard Added Newly","NoticeBoard",$str);
			
			//echo json_encode(array("rslt"=>$rslt)); //success
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
	
	$today=date("Y-m-d");	
	if(!empty($titlename)) {
		
	
		
		$strChk = "select count(noticeid) from ".tbl_noticeboard." where noticeboard = '$titlename' and isactive != '2' and noticeid != '".$edit_id."' ";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			$str = "update ".tbl_noticeboard." set noticeboard = '".getRealescape($titlename)."', ";
		
		   if(isset($_FILES["pdf"])){
				$obj=new Gthumb();	
				$pdf=$_FILES["pdf"]["name"];	
	            $pdfpath=$obj->genmastercdepdf($pdf);
	
	            $strph = " ,pdf='".$pdf."' ,pdftitle='".$pdfpath."'";
	
		
			}
			
		 $str .= " shlid = ".$txtshlid.",link = '".getRealescape($link)."', date='".$noticedate."',isactive = '".$status."' $strph,userid='".$_SESSION["UserId"]."' where noticeid = '".$edit_id."'";
			
			$db->insert_log("update","".tbl_noticeboard."",$edit_id,"NoticeBoard updated","NoticeBoard",$str);
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
	  $str="update ".tbl_noticeboard." set isactive = '2',userid='".$_SESSION["UserId"]."' where noticeid = '".$edit_id."'";
	  
	  
	  $db->insert_log("delete","".tbl_noticeboard."",$edit_id,"NoticeBoard deleted","NoticeBoard",$str);
	   $db->insert($str); 	 
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	$today = date("Y-m-d");
	$status = $actval;
	
	 $str="update ".tbl_noticeboard." set isactive = '".$status."',userid='".$_SESSION["UserId"]."' where noticeid = '".$edit_id."'";
	 //echo $str; exit;
	  $db->insert_log("status","".tbl_noticeboard."",$edit_id,"NoticeBoard Status","NoticeBoard",$str);
	 $db->insert($str); 	
	
	echo json_encode(array("rslt"=>"6")); //status update success
	
	break;
}



?>