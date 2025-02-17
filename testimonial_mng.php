<?php 
$menudisp = "testimonial";
include "includes/header.php"; 
// include "includes/Mdme-functions.php";
// $mdme = getMdmetestimonial($db,'');

include_once "includes/pagepermission.php";


//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
else if(trim($res_modm_prm['viewprm'])=="0") {
	header("Location:".admin_public_url."error.php");
}
//check permission - END
?>

<!-- End Navigation Bar-->

<div class="wrapper">
  <div class="container"> 
    <!-- Page-Title -->
    <div class="row">
      <div class="col-sm-12">
        <?php  if(trim($res_modm_prm['addprm'])=="1") { ?>


        <div class="btn-group pull-right m-t-15">
          <a style="float:right" class="btn btn-primary" href="export.php?action=testimonial">Export all Testimonial list</a>
             &nbsp;
           <a href="testimonial_form.php" class="btn btn-custom dropdown-toggle waves-effect waves-light">Add Testimonial
             <span class="m-l-5">
              <i class="fa fa-plus"></i>
            </span>
          </a> 
        </div>


        <?php }?>
        <h4 class="page-title">Testimonial</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "testimonial"; ?>" />
          <table id="tblresult" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Customer Name</th>
				<th>Date </th>
				<th>Student Detail</th>
        <th>Branch</th>
                <th>Status</th>
                <!-- <th>Is Home</th> -->
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <!-- end col --> 
    </div>
    <!-- end row -->
    <?php include("includes/footer.php");?>
</body></html><script type="text/javascript">
datatblCal(Showing 1 to 1 of 1 entries
);
</script>