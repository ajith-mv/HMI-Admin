<?php 
include 'session.php';
extract($_REQUEST);

try{
$user_id=$_REQUEST['user_id']; 
$user_email=$_REQUEST['user_email'];
$new_pwd=$_REQUEST['new_pwd'];  


//admin user table update 	

if($user_email){ 
//echo "update ".tbl_users." set user_pwd='".md5($new_pwd)."' where userid='".$user_id."'";
 $update1=$db->insert("update ".tbl_users." set user_pwd='".md5($new_pwd)."' where userid='".$user_id."'" );
} 
 //$update1=$db->insert("update ".tbl_users." set user_pwd='".md5($new_pwd)."' where userid='".trim($user_id)."'" );
// echo $update1;
 
 
if($update1){
	echo "Success"; //success
}
else{
	echo "There is no change in your password!"; //same exists
}
  
}

catch (Exception $e) {
	$res = "error";
	echo "error"; //same exists
}

?>