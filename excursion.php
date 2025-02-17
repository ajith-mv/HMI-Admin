<?php 
$menudisp = "excursion";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeExcursion($db,'');

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
        
        <h4 class="page-title">Excursion</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "excursion"; ?>" />
          <table id="tblresult" class="table table-striped table-bordered">
            <thead>
              <tr>
			     <th>ID</th>
			     <th>Student Name</th>
                <th>Class</th>
                <th>Admission Number</th>
                <th>Phone Number</th>
                <th>Transaction Number</th>
                <th>Sumission Date</th>
                <!--<th>Status</th>-->
                <!--<th>Actions</th>-->
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