<?php 
$menudisp = "book_a_tour";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeBooktour($db,'');

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
        
        <h4 class="page-title">Book A Tour</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <input type="hidden" name="disptblname" id="disptblname" value="<?php echo "book_a_tour"; ?>" />
          <table id="tblresult" class="table table-striped table-bordered">
            <thead>
              <tr>
			     <th>Date</th>
			     <th>Time</th>
                <th>Parents First Name</th>
                <th>Parents Last Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Message</th>
                <th>Branch</th>
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
datatblCal(dataGridHdn);
</script>