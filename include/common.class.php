<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// error_reporting(0);


class common{



	var $min_logout_time;

	var $root_path;

	var $http_path;

	var $prtfol_imgpath ;



	//===================================================================================







	// constructor



	function __construct()

	{



		include "config_db.php";

		$this->min_logout_time=20*60;

		$this->path       = $path;

		$this->root_path  = $root_path;

		$this->http_path   = $http_path;

		$this->attach_rpath  = $attach_rpath;

		$this->attach_hpath   = $attach_hpath;

		$this->prtfol_imgpath = $prtfol_imgpath ;



	}







	//====================================================================================







	//=====================================================================================







	//to generate a secure unique sessionkey



	function hashgen(){
		$hash = md5(uniqid(rand(),1));
		return $hash;
	}

	//=====================================================================================
	function return_file_content($db_domain,$xpath){

		$fp=fopen("$xpath","r"); 
		$fullcontent=fread($fp,filesize("$xpath"));



		fclose($fp);



		return $fullcontent;



	}





	function prefix_table($tablename)

	{

		$prefix=$this->prefix;

		$tablename=$prefix.$tablename;

		return $tablename;

	}





 //checks if the site was last accessed before 20min and if so prompts user to relogin



function check_user_session($hash,$db_domain){

	 	$qry="Select user_id,timestamp from ".tbl_user_session." where hash='$hash'";

		$line = $db_domain->get_a_line($qry);

		$userid=$line['user_id'];

		$min_logout_time=$this->min_logout_time;

		 $min=$min_logout_time*20*60*60;

    		if( (time() - $line['timestamp'] ) > $min ){

      			return 0;

    		}else{

		        $timestmp=time();

  			    $qry="Update ".tbl_user_session." set timestamp='$timestmp' where hash='$hash'";

  			    $result = $db_domain->insert("$qry");

        		/*if (! ($result = $db_domain->insert("$qry")))
        		{
        		echo "Update ".tbl_user_session." set timestamp='$timestmp' where hash='$hash'";

          		        echo 'hhhhh';  die();

          			return '0';

			        exit;

        		}else{ */

          			return $userid;

        		/*}*/
    		}
	}

	//===================================================

}//end class





// while(list($key,$value)=@each($_POST))



// 	{



// 		$$key=$value;



// 	}







// while(list($key,$value)=@each($_GET))



// 	{



// 		$$key=$value;



// 	}



?>