<?php
////-----------------------------------For Creating Thumbnails,screen shots i used this function------------//////	
class Gthumb
{
    /////////////////////////////////// For photos ////////////////////////////////////
	function genThumbAdminusersImage($bannertype, $indx=null)
	{      
		if($_FILES[$bannertype]["name"] != "") 
		{						
		//--------------------------------------------------------end of thumbnails--------------------------------------
		
			$strChk = "select * from tri_imageconfig where imageconfigModule = 'adminusers' and IsActive != '2'";		
 		 	$reslt = $indx->get_rsltset($strChk);		
			
				$newf=str_replace(' ','_',$_FILES[$bannertype]["name"]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"],"uploads/adminusers/". $newf);		
					
			for($mm=0;$mm<count($reslt);$mm++)
			{	
				$imagid = $reslt[$mm]['imageconfigId']; 
				$new_width = $reslt[$mm]['imageconfigWidth']; 
				$new_height = $reslt[$mm]['imageconfigHeight'];   
				$newimgnam = $imagid."_".$gallname;		
				//--------------------------------------thumbnails---------------------------	
				$filename = "uploads/adminusers/".$gallname;		
	
				list($width, $height) = getimagesize($filename);

			
				//$new_height=102;	//changing dimensions for Newry
				$image_p = imagecreatetruecolor($new_width, $new_height);
				//$image = imagecreatefromjpeg($filename);
				if ($_FILES[$bannertype]["type"] == "image/gif")
				$image = imagecreatefromgif($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				$image = imagecreatefrompng($filename);			
	
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$location = "uploads/adminusers/thumbnails/".$newimgnam;
				
				if ($_FILES[$bannertype]["type"] == "image/gif")
				imagegif($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				imagepng($image_p,$location, 9);
			
			}
		
		
		}
		return 	$newf;		
	}
	
	
	
	
	function getPDFfile($bannertype,$folder)
	{      	
 		if($_FILES[$bannertype]["name"] != "") 
		{						
			//---------------------------------------------------end of thumbnails--------------------------------------
			$newf=str_replace(' ','_',$_FILES[$bannertype]["name"]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"],"uploads/".$folder."/". $newf);		
		}
		return 	$newf;		

	}
	
	function genThumbAdminbannerImage($bannertype,$folder)
	{      	
 		if($_FILES[$bannertype]["name"] != "") 
		{						
			//---------------------------------------------------end of thumbnails--------------------------------------
			$newf=str_replace(' ','_',$_FILES[$bannertype]["name"]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"],"uploads/".$folder."/". $newf);		
		}
		return 	$newf;		

	}
	
	
	/////////////////////////////////// For photos ////////////////////////////////////
	function genThumbAdminnewsImage($bannertype, $indx=null)
	{      
		if($_FILES[$bannertype]["name"] != "") 
		{						
		//--------------------------------------------------------end of thumbnails--------------------------------------
		
			
			
				$newf=str_replace(' ','_',$_FILES[$bannertype]["name"]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"],"uploads/news/". $newf);		
					
		
				$imagid = $reslt[$mm]['imageconfigId']; 
				$new_width = $reslt[$mm]['imageconfigWidth']; 
				$new_height = $reslt[$mm]['imageconfigHeight'];   
				$newimgnam = $imagid."_".$gallname;		
				//--------------------------------------thumbnails---------------------------	
				$filename = "uploads/news/".$gallname;		
	
				list($width, $height) = getimagesize($filename);

			
				//$new_height=102;	//changing dimensions for Newry
				$image_p = imagecreatetruecolor($new_width, $new_height);
				//$image = imagecreatefromjpeg($filename);
				if ($_FILES[$bannertype]["type"] == "image/gif")
				$image = imagecreatefromgif($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				$image = imagecreatefrompng($filename);			
	
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$location = "uploads/news/".$newimgnam;
				
				if ($_FILES[$bannertype]["type"] == "image/gif")
				imagegif($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				imagepng($image_p,$location, 9);					
		}
		return 	$newf;		
	}
	
	
	 	



	
	function genThumbCatImage($bannertype, $indx=null)
	{      	
		if($_FILES[$bannertype]["name"] != "") 
		{		
		 	$strChk = "select * from tri_imageconfig where imageconfigModule = 'category' and IsActive != '2'";		
 		 	$reslt = $indx->get_rsltset($strChk);		
			// print_r($reslt);	 
	
				$newf=str_replace(' ','_',$_FILES[$bannertype]["name"]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"],"uploads/category/". $newf);		
					
			for($mm=0;$mm<count($reslt);$mm++)
			{	
				$imagid = $reslt[$mm]['imageconfigId']; 
				$new_width = $reslt[$mm]['imageconfigWidth']; 
				$new_height = $reslt[$mm]['imageconfigHeight'];   
				$newimgnam = $imagid."_".$gallname;		
				//--------------------------------------thumbnails---------------------------	
				$filename = "uploads/category/".$gallname;		
	
				list($width, $height) = getimagesize($filename);

			
				//$new_height=102;	//changing dimensions for Newry
				$image_p = imagecreatetruecolor($new_width, $new_height);
				//$image = imagecreatefromjpeg($filename);
				if ($_FILES[$bannertype]["type"] == "image/gif")
				$image = imagecreatefromgif($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				$image = imagecreatefrompng($filename);			
	
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$location = "uploads/category/thumbnails/".$newimgnam;
				
				if ($_FILES[$bannertype]["type"] == "image/gif")
				imagegif($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				imagepng($image_p,$location, 9);
			
			}

		//--------------------------------------------------------end of thumbnails--------------------------------------
		}
		return 	$newf;		
	}
	
	function genThumbConfigureImage($bannertype, $indx=null)
	{      	
		if($_FILES[$bannertype]["name"] != "") 
		{		
		 	$strChk = "select * from tri_imageconfig where imageconfigModule = 'logo' and IsActive != '2'";		
 		 	$reslt = $indx->get_rsltset($strChk);		
			// print_r($reslt);	 
	
				$newf=str_replace(' ','_',$_FILES[$bannertype]["name"]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"],"uploads/logo/". $newf);		
					
			for($mm=0;$mm<count($reslt);$mm++)
			{	
				$imagid = $reslt[$mm]['imageconfigId']; 
				$new_width = $reslt[$mm]['imageconfigWidth']; 
				$new_height = $reslt[$mm]['imageconfigHeight'];   
				$newimgnam = $imagid."_".$gallname;		
				//--------------------------------------thumbnails---------------------------	
				$filename = "uploads/logo/".$gallname;		
	
				list($width, $height) = getimagesize($filename);

			
				//$new_height=102;	//changing dimensions for Newry
				$image_p = imagecreatetruecolor($new_width, $new_height);
				//$image = imagecreatefromjpeg($filename);
				if ($_FILES[$bannertype]["type"] == "image/gif")
				$image = imagecreatefromgif($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				$image = imagecreatefrompng($filename);			
	
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$location = "uploads/logo/thumbnails/".$newimgnam;
				
				if ($_FILES[$bannertype]["type"] == "image/gif")
				imagegif($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				imagepng($image_p,$location, 9);
			
			}

		//--------------------------------------------------------end of thumbnails--------------------------------------
		}
		return 	$newf;		
	}
	
	function genThumbFaviconImage($bannertype, $indx=null)
	{      	
		if($_FILES[$bannertype]["name"] != "") 
		{		
		 	$strChk = "select * from tri_imageconfig where imageconfigModule = 'favicon' and IsActive != '2'";		
 		 	$reslt = $indx->get_rsltset($strChk);		
			// print_r($reslt);	 
	
				$newf=str_replace(' ','_',$_FILES[$bannertype]["name"]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"],"uploads/favicon/". $newf);		
					
			for($mm=0;$mm<count($reslt);$mm++)
			{	
				$imagid = $reslt[$mm]['imageconfigId']; 
				$new_width = $reslt[$mm]['imageconfigWidth']; 
				$new_height = $reslt[$mm]['imageconfigHeight'];   
				$newimgnam = $imagid."_".$gallname;		
				//--------------------------------------thumbnails---------------------------	
				$filename = "uploads/favicon/".$gallname;		
	
				list($width, $height) = getimagesize($filename);

			
				//$new_height=102;	//changing dimensions for Newry
				$image_p = imagecreatetruecolor($new_width, $new_height);
				//$image = imagecreatefromjpeg($filename);
				if ($_FILES[$bannertype]["type"] == "image/gif")
				$image = imagecreatefromgif($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				$image = imagecreatefrompng($filename);			
	
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$location = "uploads/favicon/".$newimgnam;
				
				if ($_FILES[$bannertype]["type"] == "image/gif")
				imagegif($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				imagepng($image_p,$location, 9);
			
			}

		//--------------------------------------------------------end of thumbnails--------------------------------------
		}
		return 	$newf;		
	}
	
	//genThumbManufactImage
	function genThumbManufactImage($bannertype, $indx=null)
	{      	
	
		if($_FILES[$bannertype]["name"] != "") 
		{		
		 	$strChk = "select * from tri_imageconfig where imageconfigModule = 'manufacturer' and IsActive != '2'";		
 		 	$reslt = $indx->get_rsltset($strChk);		
			// print_r($reslt);	 
	
				$newf=str_replace(' ','_',$_FILES[$bannertype]["name"]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"],"uploads/manufacturer/". $newf);		
					
			for($mm=0;$mm<count($reslt);$mm++)
			{	
				$imagid = $reslt[$mm]['imageconfigId']; 
				$new_width = $reslt[$mm]['imageconfigWidth']; 
				$new_height = $reslt[$mm]['imageconfigHeight'];   
				$newimgnam = $imagid."_".$gallname;		
				//--------------------------------------thumbnails---------------------------	
				$filename = "uploads/manufacturer/".$gallname;		
	
				list($width, $height) = getimagesize($filename);

			
				//$new_height=102;	//changing dimensions for Newry
				$image_p = imagecreatetruecolor($new_width, $new_height);
				//$image = imagecreatefromjpeg($filename);
				if ($_FILES[$bannertype]["type"] == "image/gif")
				$image = imagecreatefromgif($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				$image = imagecreatefrompng($filename);			
	
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$location = "uploads/manufacturer/thumbnails/".$newimgnam;
				
				if ($_FILES[$bannertype]["type"] == "image/gif")
				imagegif($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/jpeg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"] == "image/png")
				imagepng($image_p,$location, 9);
			
			}

		//--------------------------------------------------------end of thumbnails--------------------------------------
		}
		return 	$newf;		
	}
	
	function genThumbAttrIconImage($bannertype, $indx=null, $cnt =null)
	{     
		
		if($_FILES[$bannertype]["name"][$cnt] != "") 
		{		
		 	$strChk = "select * from tri_imageconfig where imageconfigModule = 'attributes' and IsActive != '2'";		
 		 	$reslt = $indx->get_rsltset($strChk);		
			// print_r($reslt);	 
	
				$newf=str_replace(' ','_',$_FILES[$bannertype]["name"][$cnt]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"][$cnt],"uploads/attributes/". $newf);		
					
			for($mm=0;$mm<count($reslt);$mm++)
			{	
				$imagid = $reslt[$mm]['imageconfigId']; 
				$new_width = $reslt[$mm]['imageconfigWidth']; 
				$new_height = $reslt[$mm]['imageconfigHeight'];   
				$newimgnam = $imagid."_".$gallname;		
				//--------------------------------------thumbnails---------------------------	
				$filename = "uploads/attributes/".$gallname;		
	
				list($width, $height) = getimagesize($filename);

			
				//$new_height=102;	//changing dimensions for Newry
				$image_p = imagecreatetruecolor($new_width, $new_height);
				//$image = imagecreatefromjpeg($filename);
				if ($_FILES[$bannertype]["type"][$cnt] == "image/gif")
				$image = imagecreatefromgif($filename);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/jpg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/jpeg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/png")
				$image = imagecreatefrompng($filename);			
	
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$location = "uploads/attributes/thumbnails/".$newimgnam;
				
				if ($_FILES[$bannertype]["type"][$cnt] == "image/gif")
				imagegif($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/jpg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/jpeg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/png")
				imagepng($image_p,$location, 9);
			
			}

		//--------------------------------------------------------end of thumbnails--------------------------------------
		}
		return 	$newf;		
	}
	
	function genThumbAttrIconImageEdt($bannertype, $indx=null)
	{     
		
		if($_FILES[$bannertype]["name"] != "") 
		{		
		 	$strChk = "select * from tri_imageconfig where imageconfigModule = 'attributes' and IsActive != '2'";		
 		 	$reslt = $indx->get_rsltset($strChk);		
			// print_r($reslt);	 
	
				$newf=str_replace(' ','_',$_FILES[$bannertype]["name"]);
				$newf=$gallname=time().rand(0,9).$newf;	
				move_uploaded_file($_FILES[$bannertype]["tmp_name"],"uploads/attributes/". $newf);		
					
			for($mm=0;$mm<count($reslt);$mm++)
			{	
				$imagid = $reslt[$mm]['imageconfigId']; 
				$new_width = $reslt[$mm]['imageconfigWidth']; 
				$new_height = $reslt[$mm]['imageconfigHeight'];   
				$newimgnam = $imagid."_".$gallname;		
				//--------------------------------------thumbnails---------------------------	
				$filename = "uploads/attributes/".$gallname;		
	
				list($width, $height) = getimagesize($filename);

			
				//$new_height=102;	//changing dimensions for Newry
				$image_p = imagecreatetruecolor($new_width, $new_height);
				//$image = imagecreatefromjpeg($filename);
				if ($_FILES[$bannertype]["type"][$cnt] == "image/gif")
				$image = imagecreatefromgif($filename);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/jpg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/jpeg")
				$image = imagecreatefromjpeg($filename);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/png")
				$image = imagecreatefrompng($filename);			
	
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				$location = "uploads/attributes/thumbnails/".$newimgnam;
				
				if ($_FILES[$bannertype]["type"][$cnt] == "image/gif")
				imagegif($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/jpg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/jpeg")
				imagejpeg($image_p,$location, 50);
				elseif ($_FILES[$bannertype]["type"][$cnt] == "image/png")
				imagepng($image_p,$location, 9);
			
			}

		//--------------------------------------------------------end of thumbnails--------------------------------------
		}
		return 	$newf;		
	}


function resize_image($sizes,$folder,$extension,$img)
{
	
  	/* Get original image x y*/
	if (!file_exists('../uploads/'.$folder)) {
 		mkdir('../uploads/'.$folder, 0777, true);
	}	
  
 
	$imgname=str_replace(' ','_',$img["name"]);
	$imgname=time().rand(0,9).$imgname;	
 
	 move_uploaded_file($img["tmp_name"], '../uploads/'.$folder.'/'.$imgname);
	 
  	$fpath="../uploads/".$folder."/".$imgname;
	
	foreach ($sizes as $dom1 => $sub)
	{
	$dimen = explode('-',$dom1);
	$width=$dimen[0];
	 $height=$dimen[1];
	$subfolder=$sub;
	
	list($w, $h) = getimagesize($fpath);
	
	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	/* new file name */
	
	if (!file_exists('../uploads/'.$folder.'/'.$subfolder.'')) {
		mkdir('../uploads/'.$folder.'/'.$subfolder.'', 0777, true);
	}
	 
  	 $path = '../uploads/'.$folder.'/'.$subfolder.'/'.$imgname;


	/* read binary data from image file */
	$imgString =file_get_contents($fpath);
	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
  	0, 0,
  	$x, 0,
  	$width, $height,
  	$w, $h);
	/* Save image */

	
	switch ($extension) {
		case 'image/jpeg':
			imagejpeg($tmp, $path, 100);
			break;
		case 'image/png':
			imagepng($tmp, $path, 0);
			break;
		case 'image/gif':
			imagegif($tmp, $path);
			break;
		default:
			exit;
			break;
	}
  }
return  $imgname; 
}


 

function resize_image_bulk($sizes,$folder,$extension,$img,$i)

{


			
			
  	/* Get original image x y*/
	if (!file_exists('../uploads/'.$folder)) {
		mkdir('../uploads/'.$folder, 0777, true);
	}	
  
	$imgname=str_replace(' ','_',$img["name"][$i]);
	$imgname=time().rand(0,9).$imgname;	
 
	 move_uploaded_file($img["tmp_name"][$i], '../uploads/'.$folder.'/'.$imgname);

	
	 
   $fpath="../uploads/".$folder."/".$imgname;
	
	
 	foreach ($sizes as $dom1 => $sub)
	{
	$dimen = explode('-',$dom1);
	$width=$dimen[0];
	 $height=$dimen[1];
	$subfolder=$sub;
	
	list($w, $h) = getimagesize($fpath);
	
	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	/* new file name */
	
	
	if (!file_exists('../uploads/'.$folder.'/'.$subfolder.'')) {
		mkdir('../uploads/'.$folder.'/'.$subfolder.'', 0777, true);
	}
	 
 	$path = '../uploads/'.$folder.'/'.$subfolder.'/'.$imgname;

	/* read binary data from image file */
	$imgString =file_get_contents($fpath);
	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
  	0, 0,
  	$x, 0,
  	$width, $height,
  	$w, $h);
	/* Save image */
 
 switch ($extension) {
	case 'image/jpeg':
		imagejpeg($tmp, $path, 100);
		break;
	case 'image/png':
		imagepng($tmp, $path, 0);
		break;
	case 'image/gif':
		imagegif($tmp, $path);
		break;
	default:
			exit;
			break;
	}
 }
	return  $imgname; 
	}
	
	function genmastercdepdf($pdf)
	{	

		if($_FILES["pdf"]["name"] != "") {	

				
			
				$newf=str_replace(' ','_',$_FILES["pdf"]["name"]);

				$newf=$gallname=time().rand(0,9).$newf;
								
				move_uploaded_file($_FILES["pdf"]["tmp_name"],"../uploads/noticeboardpdf/".$newf);
			}

			return 	$newf;		
	
	}
	
	
	function genannouncement($pdf)
	{	

		if($_FILES["pdf"]["name"] != "") {	

				
			
				$newf=str_replace(' ','_',$_FILES["pdf"]["name"]);

				$newf=$gallname=time().rand(0,9).$newf;
								
				move_uploaded_file($_FILES["pdf"]["tmp_name"],"../uploads/announcement/".$newf);
			}

			return 	$newf;		
	
	}
	
	
}

?>