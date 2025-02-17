<?php
$menudisp = "dashboard";
include "includes/header.php";







include "includes/Mdme-functions.php";

// $newsletter = $db->get_rsltset("select *,DATE_FORMAT(createddate,'%d-%m-%Y') as cdate from ".tbl_newsletter." where  isactive = 1 order by ID desc Limit 0,10 ");
//   $residency =  $db->get_rsltset("select *,DATE_FORMAT(createddate,'%d-%m-%Y') as cdate from ".tbl_residencyenquiry." where  isactive = 1 order by enquiryid desc LIMIT 0,10"); 	

// $locationcount = $db->get_a_line("select count(*) as tot from ".tbl_location." where isactive = 1");
// $residencycount = $db->get_a_line("select count(*) as tot from ".tbl_residency." where isactive = 1");
// $exhibitioncount = $db->get_a_line("select count(*) as tot from ".tbl_exhibitions." where isactive = 1");
?>

<div class="wrapper">
  <div class="container">

    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
        <h4 class="page-title">Welcome Dashboard</h4>
      </div>
    </div>

    <?php /*?>
<div class="row">
<div class="col-lg-4 col-md-6">
<div class="card-box widget-user">
 <div> <img src="assets/images/map-icon.png" class="img-responsive img-circle" alt="user">
   <div class="wid-u-info">
     <a href="locations_mng.php"><h4 class="m-t-0 m-b-5 font-600"> News</h4>
<small class="text-custom"><b><?php echo $locationcount['tot'];?></b></small> </a></div>
 </div>
</div>
</div>
<!-- end col -->

<div class="col-lg-4 col-md-6">
<div class="card-box widget-user">
 <div> <img src="assets/images/resident.png" class="img-responsive img-circle" alt="user">
   <div class="wid-u-info">
     <a href="residency_mng.php"> <h4 class="m-t-0 m-b-5 font-600">Announcements</h4>
      <small class="text-success"><b><?php echo $residencycount['tot'];?></b></small></a> </div>
 </div>
</div>
</div>
<!-- end col -->

<div class="col-lg-4 col-md-6">
<div class="card-box widget-user">
 <div> <img src="assets/images/exhibition.png" class="img-responsive img-circle" alt="user">
   <div class="wid-u-info">
    <a href="exhibitions_mng.php">  <h4 class="m-t-0 m-b-5 font-600">Gallery</h4>
      <small class="text-info"><b><?php echo $exhibitioncount['tot'];?></b></small> 
      </a></div>
 </div>
</div>
</div>
<!-- end col --> 
</div>
<div class="row">
<div class="col-lg-4">
<div class="card-box">
 <div class="dropdown pull-right"> 
             <a href="newsletter_mng.php">  <span class="label label-primary">View All</span></a>
</div>
 <h4 class="header-title m-t-0 m-b-30">Enquiries</h4>
 <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden;" tabindex="5000">
   <?php if(count($newsletter) > 0){foreach($newsletter as $news){?>
   <a href="#">
   <div class="inbox-item">
     <div class="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" class="img-circle" alt=""></div>
     <p class="inbox-item-author"><?php echo $news['EmailID'];?></p>
     <p class="inbox-item-text"><?php echo $news['createddate'];?></p>
   </div>
   </a>
   <?php }
 }else{ echo "No Record Found";}?>
 </div>
</div>
</div>
<!-- end col -->

<div class="col-lg-8">
<div class="card-box">
 <div class="dropdown pull-right"> 
  <a href="residencyenquiry_mng.php"> <span class="label label-primary">View All</span> </a>
 </div>
 <h4 class="header-title m-t-0 m-b-30">Letter To The Principal</h4>
 <div class="table-responsive">
   <table class="table">
     <thead>
       <tr>
         <th>#</th>
         <th>Customer Name</th>
         <th>Emailid</th>
         <th>Phone No</th>
         <th>Enquiry On</th
           >
       </tr>
     </thead>
     <tbody>
       <?php if(count($residency) > 0){$sno=1;foreach($residency as $residencys){?>
       <tr>
         <td><?php echo $sno++;?></td>
         <td><?php echo $residencys['firstname'];?></td>
         <td><?php echo $residencys['emailid'];?></td>
         <td><?php echo $residencys['mobileno'];?></td>
         <td><?php echo $residencys['createddate'];?></td>
       </tr>
       <?php }
   }else{ echo "No Record Found";}?>
     </tbody>
   </table>
 </div>
</div>
</div>
<!-- end col --> 
</div><?php */ ?>
    <?php include "includes/footer.php"; ?>
    </body>

    </html>