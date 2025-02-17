<?php 

function getMdmeMenu($db,$temp=null){
$mdme_rslt = getMdme($db,'','menu_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeMenumaster($db,$temp=null){
$mdme_rslt = getMdme($db,'','menumaster_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeModule($db,$temp=null){
$mdme_rslt = getMdme($db,'','module_mng.php');

return base64_encode($mdme_rslt[0]);
}

function getMdmeModulemenu($db,$temp=null){
$mdme_rslt = getMdme($db,'','modulemenu_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmePermissioninfo($db,$temp=null){
$mdme_rslt = getMdme($db,'','permissioninfo_mng.php');

$rslt_data = base64_encode($mdme_rslt[0]);

return $rslt_data;

}

function getMdmeRole($db,$temp=null){
$mdme_rslt = getMdme($db,'','roleinfo_mng.php');
return base64_encode($mdme_rslt[0]);
}

//getMdmealbum
function getMdmealbum($db,$temp=null){
$mdme_rslt = getMdme($db,'','album_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeUser($db,$temp=null){
$mdme_rslt = getMdme($db,'','userinfo_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeConfigure($db,$temp=null){
$mdme_rslt = getMdme($db,'','configuration_mng.php');
return base64_encode($mdme_rslt[0]);
}
   
function getMdmeDashboard($db,$temp=null){
$mdme_rslt = getMdme($db,'','dashboard.php');
return base64_encode($mdme_rslt[0]);
}  


function getMdmeNewsEvents($db,$temp=null){
$mdme_rslt = getMdme($db,'','newsevents_mng.php');
return base64_encode($mdme_rslt[0]);
} 

function getMdmeNewsEventsCat($db,$temp=null){
$mdme_rslt = getMdme($db,'','newscategories_mng.php');
return base64_encode($mdme_rslt[0]);
} 

function getMdmeGalleryCat($db,$temp=null){
$mdme_rslt = getMdme($db,'','gallerycategories_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeGallery($db,$temp=null){
$mdme_rslt = getMdme($db,'','gallery_mng.php');
return base64_encode($mdme_rslt[0]);
}   

function getMdmeNoticeBoard($db,$temp=null){
$mdme_rslt = getMdme($db,'','noticeboard_mng.php');
return base64_encode($mdme_rslt[0]);
}   

function getMdmecareerListing($db,$temp=null){
$mdme_rslt = getMdme($db,'','careerlisting_mng.php');
return base64_encode($mdme_rslt[0]);
} 

function getMdmeStaffListing($db,$temp=null){
$mdme_rslt = getMdme($db,'','stafflisting_mng.php');
return base64_encode($mdme_rslt[0]);
}   

function getMdmeAnnouncement($db,$temp=null){
$mdme_rslt = getMdme($db,'','announcement_mng.php');
return base64_encode($mdme_rslt[0]);
}   

function getMdmeEnquiries($db,$temp=null){
$mdme_rslt = getMdme($db,'','enquiries_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeCareers($db,$temp=null){
$mdme_rslt = getMdme($db,'','career_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeBooktour($db,$temp=null){
$mdme_rslt = getMdme($db,'','book_a_tour_mng.php');
return base64_encode($mdme_rslt[0]);
}



function getMdmeExcursion($db,$temp=null){
$mdme_rslt = getMdme($db,'','excursion.php');
return base64_encode($mdme_rslt[0]);
}





function getMdmeAdmission($db,$temp=null){
$mdme_rslt = getMdme($db,'','admission_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeAlumnus($db,$temp=null){
$mdme_rslt = getMdme($db,'','alumnus_mng.php');
return base64_encode($mdme_rslt[0]);
}

function getMdmeDepartment($db,$temp=null){
$mdme_rslt = getMdme($db,'','department_mng.php');
return base64_encode($mdme_rslt[0]);
}


function getMdmetestimonial($db,$temp=null){
    $mdme_rslt = getMdme($db,'','testimonial_mng.php');
    return base64_encode($mdme_rslt[0]);
    }

?>