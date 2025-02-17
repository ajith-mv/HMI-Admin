<?php

$menudisp = "careerlisting";
include "includes/header.php";
include "includes/Mdme-functions.php";
$mdme = getMdmecareerListing($db, '');
include_once "includes/pagepermission.php";

error_reporting(1);

// $getsize = getimagesize_large($db,'careerlisting','thumb');
// $imageval = explode('-',$getsize);
// $imgheight = $imageval[1];
// $imgwidth = $imageval[0];

//check permission - START
if (!($res_modm_prm)) {
  header("Location:" . admin_public_url . "error.php");
}
//check permission - END

$id = $_REQUEST['id'];
// echo base64_decode($id);
// die();
// echo base64_decode($id);
// die();
if ($id != "") {
  //check edit permission - START	
  if (trim($res_modm_prm['editprm']) == "0") { ?>
    <script>
      window.location = "error.php";
    </script>
    <?php
  }
  //check edit permission - END	

  $operation = "Edit";
  $act = "update";
  $btn = 'Update';

  $str_ed = "select * from " . tbl_careerlisting . "  where isactive != '2' and id = '" . base64_decode($id) . "' ";
  $res_ed = $db->get_a_line($str_ed);

  $edit_id = $res_ed['id'];

  $chk = '';
  if ($res_ed['isactive'] == '1') {
    $chk = 'checked';
  }
  $ishome = '';
  if ($res_ed['ishome'] == '1') {
    $ishome = 'checked';
  }
} else {
  //check edit permission - START	
  if (trim($res_modm_prm['addprm']) == "0") {
    ?>
    <script>
      window.location = "error.php";
    </script>
    <?php
  }
  //check edit permission - END
  $operation = "Add";
  $act = "insert";
  $btn = 'Save';
}

include "common/dpselect-functions.php"; ?>

<body>
  <!-- Navigation Bar-->

  <!-- End Navigation Bar-->

  <div class="wrapper">
    <div class="container">

      <!-- Page-Title -->
      <div class="row">
        <div class="col-sm-12">
          <h4 class="page-title"><?php echo $operation; ?> Color </h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box">
            <div class="row">
              <div class="col-lg-8 m-t-20">
                <form id="jvalidate" name="frmnewsevents" role="form" class="form-horizontal" action="#" method="post">
                  <input type="hidden" name="action" value="<?php echo $act; ?>" />
                  <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> " />



                  <div class="form-group">
                    <label class="col-md-3 control-label">Color Name </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" required name="job_title" id="job_title"
                        value="<?php echo $res_ed['title']; ?>" />
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-3 control-label">Color </label>
                    <div class="col-md-6">
                      <input type="color" class="form-control" required name="job_type" id="job_type"
                        value="<?php echo $res_ed['job_type']; ?>" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Color Code </label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="color" id="color"
                        value="<?php echo $res_ed['job_type']; ?>" />
                    </div>
                  </div>

                  <!-- <div class="form-group">
                  <label class="col-md-3 control-label">Qualifications</label>
                  <div class="col-md-9">
                  <textarea id="elm1" name="description">
                    <?php
                    // echo $res_ed['qualifications']; 
                    ?>
                  </textarea>
                  </div>
                </div>
        
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sort Order</label>
                        <div class="col-md-9">
                          <input type="text" data-parsley-type="number" class="form-control" name="sortingorder" id="sortingorder" value="
                          <?php
                          //echo $res_ed['sortby']; 
                          ?>" 
                        </div>
                    </div> -->

                  <div class="form-group">
                    <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-9">
                      <div class="pad-tb-7">
                        <input type="checkbox" data-plugin="switchery" value="1" name="chkstatus" id="chkstatus" <?php echo $chk; ?> data-color="#00b19d" data-size="small" checked />
                      </div>
                    </div>
                  </div>

                  <!-- <div class="form-group">
                    <label class="col-md-3 control-label">Show on Home</label>
                    <div class="col-md-9">
                      <div class="pad-tb-7">
                        <input type="checkbox" data-plugin="switchery" value="1" name="ishome" id="ishome" 
                         <?
                         // php echo $ishome; 
                         ?> 
                        data-color="#00b19d" data-size="small" />
                      </div>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9 m-t-15">
                      <button class="btn btn-default waves-effect m-l-5" type="reset"
                        onClick="javascript:funCancel('frmcareer','jvalidate','careerlisting','careerlisting_mng.php');">Cancel</button>
                      <button class="btn btn-primary waves-effect waves-light" id="submit-form" type="button"
                        onClick="javascript:funSubmtWithImg('frmcareer','careerlisting_actions.php','jvalidate','career listing','careerlisting_mng.php');"><span
                          id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- end col -->

              <!-- end col -->

            </div>
            <!-- end row -->
          </div>
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->

      <?php include("includes/footer.php"); ?>
      <script type="text/javascript">
        $(document).ready(function () {


          $(document).on('click', '#job_type', function (e) {

            var color = $(this).val();
            $('#color').val(color);

          })

          $(document).on('keyup', '#color', function (e) {

            var color = $(this).val();
            $('#job_type').val(color);
          })

          $("#job_type").on("input", function () {
            $("#color").val($(this).val());
          });

        });
      </script>
    </div>
    <!-- end container -->
  </div>
</body>

</html>