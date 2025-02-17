<?php 
include 'session.php';
extract($_REQUEST);
$act=$action;


if($chkstatus !=null)
	$status =1;
else
	$status =0;

include 'includes/image_thumb.php';
$getsize = getimagesize_large($db,'adminusers','thumb');
$sizes = getdynamicimage($db,'adminusers');

$created=date('Y-m-d H:i:s');


switch($act)
{
	case 'insert':
	
	if(!empty($txtuser_firstname)) {
		
		$strChk = "select count(userid) from ".tbl_users." where user_email = '$txtuser_email' and isactive != '2' ";		
 		$reslt = $db->get_a_line($strChk);
 		$path = "";
		if($reslt[0] == 0) {			
			if(isset($_FILES["user_photo"])){
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["user_photo"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				//image upload path - starts			
			 $exten  =$_FILES["user_photo"]["type"];
				 $obj=new Gthumb();	
				 $path =	$obj->resize_image($sizes,'adminusers',$exten,$_FILES['user_photo']);						
				//image upload path - ends	
			}
			
		 $newpwd  =trim($txtuser_password);
		 $lastInserId = $db->insert_id;
		 
			$str="insert into ".tbl_users."(user_firstname,user_lastname,user_name,user_email,user_pwd,roleid,shlid,user_photo,isactive,createdby,createddate)
			values('".getRealescape($txtuser_firstname)."','".getRealescape($txtuser_lastname)."','".getRealescape($txtuser_email)."','".getRealescape($txtuser_email)."','".md5($newpwd)."','".getRealescape($txtRoleId)."','".getRealescape($txtshlid)."','".$path."','".$status."','".$_SESSION["UserId"]."','".$created."')";
			
			$rslt = $db->insert($str);	
			$log = $db->insert_log("insert","".tbl_users."",$lastInserId,"User Added Newly","user",$str);
						
		//print_r('----------------');	
			
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
	//$edit_id
	$today=date("Y-m-d");	
	
	if(!empty($txtuser_firstname)) {
		$strChk = "select count(userid) from ".tbl_users." where user_email = '$txtuser_email' and isactive != '2' and userid != '".$edit_id."'" ;		
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			 $str = "update ".tbl_users." set  user_firstname = '".getRealescape($txtuser_firstname)."',user_lastname='".getRealescape($txtuser_lastname)."', user_email='".getRealescape($txtuser_email)."' , user_name='".getRealescape($txtuser_email)."' , roleid='".getRealescape($txtRoleId)."' ,shlid='".getRealescape($txtshlid)."' ";
			
		
			if(isset($_FILES["user_photo"])){
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["user_photo"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				 
				 $exten  =$_FILES["user_photo"]["type"];
				 $obj=new Gthumb();	
				$path =	$obj->resize_image($sizes,'adminusers',$exten,$_FILES['user_photo']);
				
				$str .= " ,user_photo='".$path."'  ";	
				$imgchk = " ,userphoto = '".$path."'";			
			}
			$str .= " ,isactive = '".$status."', modifieddate = '$today' , createdby ='".$_SESSION["UserId"]."'  where userid = '".$edit_id."' ";			
			$db->insert_log("update","".tbl_users."",$edit_id,"User updated","User",$str);
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
	  $str="update ".tbl_users." set isactive = '2', modifieddate = '$today' , createdby='".$_SESSION["UserId"]."'  where userid = '".$edit_id."'";
	  $db->insert_log("delete","".tbl_users."",$edit_id,"User deleted","User",$str);
	  $db->insert($str); 	 
	  
	
 	  echo json_encode(array("rslt"=>"5")); //deletion
	  	 
		
	break;
	
	case 'changestatus':
	  $edit_id = base64_decode($Id);
	  
	  $today = date("Y-m-d");
	  $status = $actval;
	  $str="update ".tbl_users." set isactive = '$status', modifieddate = '$today' where userid = '".$edit_id."'";
	  //echo $str; exit;
	  $db->insert_log("update","".tbl_users."",$edit_id,"Userinfo status changed","User",$str);
	  $db->insert($str); 	 
	  
	 
 	  echo json_encode(array("rslt"=>"6")); //deletion
	  	 
		
	break;
	
	case 'profileupdate':	 	
	//$edit_id
	$today=date("Y-m-d");	
	
	if(!empty($txtuser_firstname)) {
		$strChk = "select count(userid) from ".tbl_users." where user_email = '$txtuser_email' and isactive != '2' and userid != '".$edit_id."'" ;		
 		$reslt = $db->get_a_line($strChk);
		if($reslt[0] == 0) {
			 $str = "update ".tbl_users." set  user_firstname = '".getRealescape($txtuser_firstname)."',user_lastname='".getRealescape($txtuser_lastname)."', user_email='".getRealescape($txtuser_email)."' ";
			
		
			if(isset($_FILES["user_photo"])){
				//validate image file allowed (jpg,png,gif)
				$file_info = getimagesize($_FILES["user_photo"]['tmp_name']);
				$file_mime = explode('/',$file_info['mime']);				
				if(!in_array($file_mime[1],array('jpg','jpeg','gif','png','bmp') ) ){
					echo json_encode(array("rslt"=>"7"));
					exit();
				}
				 
				 $exten  =$_FILES["user_photo"]["type"];
				 $obj=new Gthumb();	
				$path =	$obj->resize_image($sizes,'adminusers',$exten,$_FILES['user_photo']);
				
				$str .= " ,user_photo='".$path."'  ";			
					$imgchk = " ,userphoto = '".$path."'";
			}
			$str .= " , modifieddate = '$today' , createdby ='".$_SESSION["UserId"]."'  where userid = '".$edit_id."' ";	
			
			$db->insert_log("update","".tbl_users."",$edit_id,"User updated","User",$str);
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
	
	case 'upass':
	$user_id=$_REQUEST['user_id']; 
	$user_email=$_REQUEST['user_email'];
	$new_pwd=$_REQUEST['new_pwd'];  
 
	$update=$db->insert("update ".tbl_users." set user_pwd='".md5($new_pwd)."' where userid='".trim($user_id)."'" );	 	 
	if($update){
		echo "success"; //success
	}
	else{
		echo "error1"; //same exists
	}
	  
	break;
	
}



?>