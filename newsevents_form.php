<?php

$menudisp = "newsevents";
include "includes/header.php";
include "includes/Mdme-functions.php";
$mdme = getMdmeNewsEvents($db, '');
include_once "includes/pagepermission.php";

$getsize = getimagesize_large($db, 'newsevents', 'thumb');
$imageval = explode('-', $getsize);
$imgheight = 465;
$imgwidth = 1000;

//check permission - START
if (!($res_modm_prm)) {
  header("Location:" . admin_public_url . "error.php");
}
//check permission - END

$id = $_REQUEST['id'];

$category = "select * from " . tbl_newscategory . "  where isactive != '2' ";
$cats = $db->get_rsltset($category);

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


  $str_ed = "select * from " . tbl_newsevents . "  where isactive != '2' and newsid = '" . base64_decode($id) . "' ";
  $res_ed = $db->get_a_line($str_ed);

  $edit_id = $res_ed['newsid'];

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


include "common/dpselect-functions.php";

?>

<body>
  <!-- Navigation Bar-->

  <!-- End Navigation Bar-->

  <div class="wrapper">
    <div class="container">

      <!-- Page-Title -->
      <div class="row">
        <div class="col-sm-12">
          <h4 class="page-title"><?php echo $operation; ?> News Events</h4>
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

                  <!-- <div class="form-group">
                  <label class="col-md-3 control-label" for="example-email">Schools Name *</label>
                  <div class="col-md-9">
                    <?php   //echo getSelectBox_schoolslist($db,'txtshlid','required',$res_ed["shlid"],'','readonly'); ?>
                  </div>
                </div> -->

                  <!-- <div class="form-group">
                  <label class="col-md-3 control-label">Select schools</label>
                  <div class="col-md-9">
                    <div class="pad-tb-7">
                      <?php
                      // $schoolid = explode(",",$res_ed['school_id']); 
                      ?>
                      <input type="checkbox" value="9" 
                      <?php
                      // echo (in_array(9,$schoolid)) ? 'checked' : '';
                      ?> 
                      name="websitetoshow[]" id="websitetoshow"> General
                      <input type="checkbox" value="1" 
                        <?php
                        // echo (in_array(1,$schoolid)) ? 'checked' : '';
                        ?> 
                        name="websitetoshow[]" id="websitetoshow"> Tambaram
                      <input type="checkbox" value="2" 
                        <?php
                        // echo (in_array(2,$schoolid)) ? 'checked' : '';
                        ?> 
                        name="websitetoshow[]" id="websitetoshow"> Padur
                      <input type="checkbox" value="3" 
                      <?php
                      // echo (in_array(3,$schoolid)) ? 'checked' : '';
                      ?>
                       name="websitetoshow[]" id="websitetoshow"> Kottivakkam
                    </div>
                  </div>
                </div> -->

                  <!-- <div class="form-group">
                    <label class="col-md-3 control-label">Select Category</label>
                    <div class="col-md-9">
                      <div class="pad-tb-7">
                        <select name="catid">
                          <option value="0">Select Category</option> -->
                  <?php
                  // $selected = "";
                  // foreach ($cats as $category) {
                  //   if ($category['catid'] == $res_ed['catid']) {
                  //     $selected = "selected";
                  //   }
                  //   ?>
                  <!-- <option value=" -->
                  <?php
                  // echo $category['catid']; 
                  ?>
                  <?php
                  // echo $selected; 
                  ?>
                  <?php
                  // echo $category['name']; 
                  ?>
                  <!-- </option> -->
                  <?php
                  // }
                  ?>

                  <!-- </select>

                      </div>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <label class="col-md-3 control-label">News Events Title *</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" required name="titlename" id="titlename"
                        value="<?php echo $res_ed['newstitle']; ?>" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Url Slug *</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" required name="url_slug" id="url_slug"
                        value="<?php echo $res_ed['slug']; ?>" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Image *</label>
                    <div class="col-md-9 nopad">

                      <div class="col-md-8">
                        <input class="form-control product_images <?php if ($act != 'update') { ?>required<?php } ?>"
                          onchange="dimensions()" id="newsimage" name="newsimage" type="file" fi-type="">
                        <span class="help-block"> Allowed Extension ( jpg, png, gif, webp ) <br />
                          Image Size Should be <?php echo $imgwidth . ' * ' . $imgheight; ?></span>
                        <b id="img_error" style="color:red;display:none;"></b>
                      </div>
                      <div class="col-md-4">
                        <?php if (!empty($res_ed['newsimage']) && ($act == 'update')) { ?>
                          <img src="../uploads/newsevents/<?php echo $res_ed['newsimage']; ?>" width="50px"
                            align="absmiddle" />
                        <?php } ?>
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-3 control-label">Date *</label>

                    <div class="col-md-9">
                      <input placeholder="Date"
                        value="<?php echo ($res_ed['newsdate'] != '' && $res_ed['newsdate'] != '0000-00-00') ? date('d-m-Y', strtotime($res_ed['newsdate'])) : date('d-m-Y'); ?>"
                        required name="newsdate" id="newsdate" class="form-control datepicker" type="text" readonly>
                      <span class="font-13 text-muted">dd-mm-yyyy</span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Short Description</label>
                    <div class="col-md-9">
                      <textarea id="elm1" class="elm1" name="short_desc"><?php echo $res_ed['short_desc']; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Description</label>
                    <div class="col-md-9">
                      <textarea id="elm2" name="newsdesc"><?php echo $res_ed['newsdescription']; ?></textarea>
                    </div>

                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Meta Title </label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="meta_title" id="metatitle"
                        value="<?php echo $res_ed['meta_title']; ?>" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Meta Description</label>
                    <div class="col-md-9">

                      <textarea style="width:100%;height:100px;" id="meta_desc"
                        name="meta_desc"><?php echo $res_ed['meta_desc']; ?></textarea>
                    </div>

                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-9">
                      <div class="pad-tb-7">
                        <input type="checkbox" data-plugin="switchery" value="1" name="chkstatus" id="chkstatus" <?php echo $chk; ?> data-color="#00b19d" data-size="small" checked />
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9 m-t-15">

                      <button class="btn btn-default waves-effect m-l-5" type="reset"
                        onClick="javascript:funCancel('frmnewsevents','jvalidate','news events','newsevents_mng.php');">Cancel</button>
                      <button class="btn btn-primary waves-effect waves-light" id="submit-form" type="button"
                        onClick="javascript:funSubmtWithImg('frmnewsevents','newsevents_actions.php','jvalidate','news events','newsevents_mng.php');"><span
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
          $(document).on('keyup', '#titlename', function (e) {
            var newstitle = $(this).val();
            var url_slug = newstitle.replace(/\s+/g, '-').toLowerCase();
            $('#url_slug').val(url_slug);
            $('#metatitle').val(newstitle);
          })

        });
      </script>
      <script>
        function dimensions() {
          $('#img_error').hide();
          $("button").attr('disabled', false);
          var fileInput = $('input[name=newsimage]')[0];
          if (!fileInput.files.length) {
            // alert("Please select an image.");
            return;
          }

          var file = fileInput.files[0];
          var img = new Image();
          var objectUrl = URL.createObjectURL(file);

          img.onload = function () {
            console.log("Image Loaded: " + img.width + "x" + img.height);
            if (img.width < 1000 || img.height < 465) {
              var message = "Image size should be at least 1000x465 pixels.";
              $('#img_error').html(message);
              $('#img_error').show();
              $("button").attr('disabled', true);
            } else {
              if ((img.width === 1000 && img.height === 465) || (img.width === 2000 && img.height === 930) || (img.width === 3000 && img.height === 1395)) {
                $("button").attr('disabled', false);
              } else {
                var message = "Image size should be 1000x465 perspective size.";
                $('#img_error').html(message);
                $('#img_error').show();
                $("button").attr('disabled', true);
              }
            }

            URL.revokeObjectURL(objectUrl);
          };

          img.onerror = function () {
            alert("Invalid image file.");
            $("button").attr('disabled', true);
          };

          img.src = objectUrl;
        }
      </script>
    </div>
    <!-- end container -->
  </div>
</body>

</html>