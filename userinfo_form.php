<?php
$menudisp = "user";
include "includes/header.php";
include "includes/Mdme-functions.php";
$mdme = getMdmeUser($db, '');
include_once "includes/pagepermission.php";

//check permission - START
if (!($res_modm_prm)) {
  header("Location:" . admin_public_url . "error.php");
}
//check permission - END

$id = $_REQUEST['id'];
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

  $str_ed = "select * from " . tbl_users . " where isactive != '2' and userid = '" . base64_decode($id) . "' ";
  $res_ed = $db->get_a_line($str_ed);

  $edit_id = $res_ed['userid'];

  $chk = '';
  if ($res_ed['isactive'] == '1') {
    $chk = 'checked';
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
          <h4 class="page-title"><?php echo $operation; ?> User</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box">
            <div class="row">
              <div class="col-lg-8 m-t-20">
                <form id="jvalidate" name="frmMenu" role="form" class="form-horizontal" action="#" method="post">
                  <input type="hidden" name="action" value="<?php echo $act; ?>" />
                  <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> " />
                  <div class="form-group">
                    <label class="col-md-3 control-label">First Name *</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" required name="txtuser_firstname" id="txtuser_firstname"
                        value="<?php echo $res_ed['user_firstname']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label" for="example-email">Last Name *</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" required name="txtuser_lastname" id="txtuser_lastname"
                        value="<?php echo $res_ed['user_lastname']; ?>" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email Id / Login Id *</label>
                    <div class="col-md-9">
                      <input type="email" required data-parsley-trigger="change" class="form-control" <?php if ($act == 'update')
                        echo 'readonly="readonly"'; ?> name="txtuser_email" id="txtuser_email"
                        value="<?php echo $res_ed['user_email']; ?>" />
                    </div>
                  </div>
                  <?php if ($act == 'insert') { ?>
                    <div class="form-group">
                      <label class="col-md-3 control-label">Password *</label>
                      <div class="col-md-9 p-0">
                        <div class="col-sm-6">
                          <input class="form-control" required="" name="txtuser_password" id="txtuser_password"
                            placeholder="Password" data-parsley-id="36" type="password">
                        </div>
                        <div class="col-sm-6">
                          <input class="form-control" required="" data-parsley-equalto="#txtuser_password"
                            placeholder="Re-Type Password" data-parsley-id="38" type="password">
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                  <!-- <div class="form-group">
                  <label class="col-md-3 control-label" for="example-email">Roles *</label>
                  <div class="col-md-9">
                    <?php echo getSelectBox_rolelist($db, 'txtRoleId', 'required', $res_ed['roleid']); ?>
                  </div>
                </div> -->
                  <!-- <div class="form-group">
                  <label class="col-md-3 control-label" for="example-email">Schools Name *</label>
                  <div class="col-md-9">
                    
                    // <select class="js-select2 col-12" name="txtshlid" id="txtshlid"> -->


                  <?php
                  // $campus = "select * from ".tbl_schoolsname." where isactive = '1' ORDER BY school_id DESC";
                  // $campuslist = $db->get_rsltset($campus);
                  // $m = 1;
                  //     foreach ($campuslist as $camp) {
                  //         $sel = "";
                  //         if($res_ed["shlid"] == $camp['school_id'] ){
                  //            $sel = "selected"; 
                  //         }
                  //         echo "<option $sel value='".$camp['school_id']."'>".$camp['shlname']."</option>";
                  //         $m++;
                  //     }
                  // ?>
                  <!-- </select> 
                   </div>
                 </div> -->
                  <div class="form-group">
                    <label class="col-md-3 control-label" for="example-email">Photo</label>
                    <div class="col-md-9">
                      <?php if (!empty($res_ed['user_photo']) && ($act == 'update')) { ?>
                        <img id="preview_img"
                          src="<?php echo IMG_BASE_URL; ?>adminusers/<?php echo $res_ed['user_photo']; ?>" width="50px"
                          align="absmiddle" />
                      <?php } ?>
                      <input class="product_images form-control" accept=".jpg,.png,.gif,.PNG,.JPG,.JPEG" id="user_photo"
                        name="user_photo" type="file" fi-type="">
                    </div>
                  </div>
                  <?php if (($act == 'update')) { ?>
                    <div class="form-group">
                      <label class="col-md-3 control-label">&nbsp;</label>
                      <div class="col-md-9"> <a href="javascript:void(0);"
                          class="btn btn-inverse waves-effect waves-light" data-toggle="modal"
                          data-target="#myModal">Change Password</a> </div>
                    </div>
                  <?php } ?>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-9">
                      <div class="pad-tb-7">
                        <input type="checkbox" data-plugin="switchery" value="1" name="chkstatus" id="chkstatus" <?php echo $chk; ?> data-color="#00b19d" data-size="small" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9 m-t-15">

                      <button class="btn btn-default waves-effect m-l-5" type="button"
                        onClick="javascript:funCancel('frmUser','jvalidate','user','userinfo_mng.php');">Cancel</button>
                      <button class="btn btn-primary waves-effect waves-light" id="submit-form" type="button"
                        onClick="javascript:funSubmtWithImg('frmUser','userinfo_actions.php','jvalidate','user','userinfo_mng.php');"><span
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
    </div>
    <!-- end container -->
  </div>
</body>

</html>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?> " />
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group">
            <label class="col-md-4 col-xs-12 control-label">Password</label>
            <div class="col-md-6 col-xs-12">
              <div class="input-group">
                <input type="password" class="form-control " name="newpwd" id="newpwd" value="" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
          <div class="form-group">
            <label class="col-md-4 col-xs-12 control-label">Confirm Password</label>
            <div class="col-md-6 col-xs-12">
              <div class="input-group">
                <input type="password" class="form-control " name="newcnfrmpwd" id="newcnfrmpwd" value="" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="pwdchange();">Update Password</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  function pwdchange() {
    if ($('#newpwd').val() == '' || $('#newcnfrmpwd').val() == '') {
      swal("Success!", "Please Enter password and Confirm Password Details", "red", "btn-red");
    }
    else if ($('#newpwd').val() != $('#newcnfrmpwd').val()) {
      swal("Error!", "Your password should be the same.", "red", "btn-red");

    }
    else {
      var user_id = $('#edit_id').val();
      var user_email = $('#txtuser_email').val();
      var new_pwd = $('#newpwd').val();
      $.ajax({
        url: 'userinfo_actions.php',
        type: 'POST',
        data: 'action=upass&user_id=' + user_id + '&user_email=' + user_email + '&new_pwd=' + new_pwd + '',
        success: function (result) {
          if (result == 'success') {
            swal("Success!", "Password has been changed successfully", "green", "btn-green");
            $('#myModal').modal('hide');
          }
          else {
            swal("Error!", "Error in password update", "red", "btn-red");
          }
        }
      });
    }
  }

</script>