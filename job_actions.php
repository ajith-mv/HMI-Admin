<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;

if($chkstatus !=null)
	$status =1;
else
	$status =0;

//echo "Old: " . $jbregdate;

if($jbregdate=='') { $jbregdate = '0000-00-00'; } else {$jbregdate = date('Y-m-d',strtotime($jbregdate)); }
switch($act)
{
	case 'insert':
	
	if(!empty($jbtitle)) {
		$strChk = "select count(jobid) from ".tbl_jobcareer."  where jobtitle = '$jbtitle' and isactive != 2";
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			
			
			 $str="insert into ".tbl_jobcareer." (jobtitle,location,description,responsibility,qualification,regdate,isactive,userid) values ('".getRealescape($jbtitle)."','".getRealescape($jblocation)."','".getRealescape($jbdescription)."','".getRealescape($jbresponsibility)."','".getRealescape($jbqualification)."','".getRealescape($jbregdate)."',".$status.",".$_SESSION["UserId"].")"; 
			
		
			$rslt = $db->insert($str);			
			$log = $db->insert_log("insert","".tbl_jobcareer." ","","Job Openings Added Newly","Job",$str);
			
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
	//$today=date("Y-m-d");	
	if(!empty($jbtitle)) {
		$strChk = "select count(jobid) from ".tbl_jobcareer."  where jobtitle = '$jbtitle' isactive != 2 and jobid != ".$edit_id;
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			$str = "update ".tbl_jobcareer."  set jobtitle = '".getRealescape($jbtitle)."',location = '".getRealescape($jblocation)."',description='".getRealescape($jbdescription)."',responsibility='".getRealescape($jbresponsibility)."',qualification='".getRealescape($jbqualification)."', regdate='".getRealescape($jbregdate)."',isactive=".$status."  where jobid = ".$edit_id;
			
			$db->insert($str);
			$db->insert_log("update","".tbl_jobcareer." ",$edit_id,"Job Openings updated","Job",$str);

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
	  $str="update ".tbl_jobcareer."  set isactive = 2 where jobid = ".$edit_id;
	 // echo $str; exit;
	  $db->insert($str); 	 
	  
	  $db->insert_log("delete","".tbl_jobcareer." ",$edit_id,"Job Openings deleted","Job",$str);
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	$edit_id = base64_decode($Id);
	$today = date("Y-m-d");
	$status = $actval;
	
	/* if($edit_id !="1"){*/
		$str="update ".tbl_jobcareer."  set isactive = ".$status."  where jobid = ".$edit_id;
		$db->insert($str); 	
		echo json_encode(array("rslt"=>"6")); //status update success
	/* }
	 else{		 
		echo json_encode(array("rslt"=>"7")); // cannot change status	  
	 }	*/
	
	break;
	
	
}



?>