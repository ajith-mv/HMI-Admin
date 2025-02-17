<?php 
$menudisp = "career";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeJobOpenings($db,'');

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
        <div class="btn-group pull-right m-t-15"> <a href="job_form.php" class="btn btn-custom dropdown-toggle waves-effect waves-light">Add Job Openings <span class="m-l-5"><i class="fa fa-plus"></i></span></a> </div>
        <?php }?>
        <h4 class="page-title">Manage Job Openings</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "job"; ?>" />
          <table id="tblresult" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Job Title</th>
                <th>Location</th>
				<th>Qualification</th>
				<th>Date</th>
				<th>Author</th>
				<th>Status</th>
				<th>Action</th>
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
datatblCal(dataGridHdn);
</script>