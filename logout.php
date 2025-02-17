<?php include_once "session.php";

			$time=time();

			//Logoutadmin($db);

			

		//	$getlogouturl = getlogouturl($db);

			


		 

		 	//$url = $getlogouturl['logouturl'];

			

			session_destroy();

			if($_REQUEST['f'] == '1'){

			header("Location:index.php");			

			exit;	

			}

			else

			{

			header("Location:index.php?err=lo");

			setcookie("admin","",0,"/");

			exit;

			}

?>