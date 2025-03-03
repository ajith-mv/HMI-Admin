<?php

$menudisp = "newseventscat";
include "includes/header.php";
include "includes/Mdme-functions.php";
$mdme = getMdmeNewsEventsCat($db, '');
include_once "includes/pagepermission.php";

$getsize = getimagesize_large($db, 'newscategory', 'thumb');
$imageval = explode('-', $getsize);
// $imgheight = 460;
// $imgwidth = 767;


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

  $str_ed = "select * from " . tbl_newscategory . "  where isactive != '2' and catid = '" . base64_decode($id) . "' ";
  $res_ed = $db->get_a_line($str_ed);

  $edit_id = $res_ed['catid'];

  $chk = '';

  if (empty($res_ed['isactive']) || $res_ed['isactive'] == '1') {
    $chk = 'checked';
  }


  $chks = '';
  if ($res_ed['ishome'] == '1') {
    $chks = 'checked';
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

$parent_category = "select * from " . tbl_newscategory . "  where isactive != '2' and subcategory = '0' ";
$parent_category_list = $db->get_rsltset($parent_category);

?>

<body>
  <!-- Navigation Bar-->

  <!-- End Navigation Bar-->

  <div class="wrapper">
    <div class="container">

      <!-- Page-Title -->
      <div class="row">
        <div class="col-sm-12">
          <h4 class="page-title"><?php echo $operation; ?> Category</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box">
            <div class="row">
              <div class="col-lg-8 m-t-20">
                <form id="jvalidate" name="frmnewseventscat" role="form" class="form-horizontal" action="#"
                  method="post">
                  <input type="hidden" name="action" value="<?php echo $act; ?>" />
                  <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> " />

                  <!-- <div class="form-group">
                  <label class="col-md-3 control-label" for="example-email">Schools Name *</label>
                  <div class="col-md-9">
                    <?php   //echo getSelectBox_schoolslist($db,'txtshlid','required',$res_ed["shlid"],'','readonly'); ?>
                  </div>
                </div> -->

                  <div class="form-group">
                    <label class="col-md-3 control-label">Category Name *</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" required name="titlename" id="titlename"
                        value="<?php echo $res_ed['name']; ?>" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Select Type *</label>
                    <div class="col-md-9">
                      <select class="form-control" name="types" id="types" required>
                        <option value="">Select Type</option>
                        <option value="1" <?php if ($res_ed['types'] == 1) {
                          echo "selected";
                        } ?>>
                          Musical Products</option>
                        <option value="2" <?php if ($res_ed['types'] == 2) {
                          echo "selected";
                        } ?>>
                          Vanity Products</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label" id="parent_category">Parent Category *</label>
                    <div class="col-md-9">
                      <select class="form-control typebase" name="subcategory" id="subcategory">
                        <option>Select parent Category</option>
                        <?php foreach ($parent_category_list as $parentcategory) {
                          if ($res_ed['catid'] != $parentcategory['catid']) { ?>

                            <option class="categorys" value="<?php echo $parentcategory['catid']; ?>" <?php if ($parentcategory['catid'] == $res_ed['subcategory']) {
                                 echo "selected";
                               } ?>>
                              <?php echo $parentcategory['name']; ?>
                            </option>
                            <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Url Slug *</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" required name="url_slug" id="url_slug"
                        value="<?php echo $res_ed['urlslug']; ?>" />
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Image *</label>
                    <div class="col-md-9 nopad">

                      <div class="col-md-8">
                        <input class="form-control product_images <?php if ($act != 'update') { ?>required<?php } ?>"
                          onchange="dimensions()" id="cat_image" name="cat_image" type="file" fi-type="">
                        <span class="help-block"> Allowed Extension ( jpg, png, gif, webp ) <br />
                          Image Size Should be <?php echo $imgwidth . ' * ' . $imgheight; ?></span>
                        <b id="img_error" style="color:red;display:none;"></b>
                      </div>
                      <div class="col-md-4">
                        <?php if (!empty($res_ed['cat_image']) && ($act == 'update')) { ?>
                          <img src="../uploads/category/<?php echo $res_ed['cat_image']; ?>" width="50px"
                            align="absmiddle" />
                        <?php } ?>
                      </div>
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
                      <textarea id="elm2" name="newscatdesc"><?php echo $res_ed['description']; ?></textarea>
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

                  <?php if ($res_ed['subcategory'] == 0) { ?>

                    <div class="form-group" id="home">
                      <label class="col-md-3 control-label">Show on Home</label>
                      <div class="col-md-1">
                        <div class="pad-tb-7">
                          <input type="checkbox" data-plugin="switchery" value=<?php echo ($res_ed['ishome'] == 1) ? '1' : '0'; ?>
                            name="ishome" id="ishome" data-color="#00b19d" data-size="small" <?php echo $chks; ?> />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Show on Home Sort Order </label>
                        <div class="col-md-2">
                          <input type="number" min="1" max="4" class="form-control" name="homeorder" id="homeorder"
                            value="<?php echo $res_ed['homeorder']; ?>" />
                        </div>
                      </div>
                    </div>

                  <?php } ?>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Status</label>
                    <div class="col-md-9">
                      <div class="pad-tb-7">
                        <input type="checkbox" data-plugin="switchery" value="<?php echo (isset($res_ed['isactive']) && $res_ed['isactive'] == 0) ? '0' : '1'; ?>" 
                         name="chkstatus" id="chkstatus" data-color="#00b19d" data-size="small" <?php echo (isset($res_ed['isactive']) && $res_ed['isactive'] == 0) ? "" : "checked"; ?>/>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9 m-t-15">

                      <button class="btn btn-default waves-effect m-l-5" type="reset"
                        onClick="javascript:funCancel('frmnewseventscat','jvalidate','news events cat','newscategories_mng.php');">Cancel</button>
                      <button class="btn btn-primary waves-effect waves-light" id="submit-form" type="button"
                        onClick="javascript:funSubmtWithImg('frmnewseventscat','newseventscat_actions.php','jvalidate','Category','newscategories_mng.php');"><span
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
      <?php if ($res_ed['types'] == 1): ?>
        <script>
          $('#subcategory').show();
          $('#parent_category').show();
        </script>
      <?php else: ?>
        <script>
          $('#subcategory').hide();
          $('#parent_category').hide();
        </script>
      <?php endif; ?>
      <script>
        function dimensions() {
          $('#img_error').hide();
          $("button").attr('disabled', false);
          var fileInput = $('input[name=cat_image]')[0];
          if (!fileInput.files.length) {
            alert("Please select an image.");
            return;
          }

          var parentcategory = $('#subcategory').val();

          var file = fileInput.files[0];
          var img = new Image();
          var objectUrl = URL.createObjectURL(file);

          img.onload = function () {
            console.log("Image Loaded: " + img.width + "x" + img.height);

            if ($.isNumeric(parentcategory) && Math.floor(parentcategory) == parentcategory) {
              // if ((img.width < 655 && img.height < 1080)) {
              //   var message = "Image size should be at least Subcategory 655x1080 pixels.";
              //   $('#img_error').html(message);
              //   $('#img_error').show();
              //   $("button").attr('disabled', true);
              // } else {
              //   if ((img.width === 655 && img.height === 1080) ||
              //     (img.width === 1310 && img.height === 2160) ||
              //     (img.width === 1965 && img.height === 3240) ||
              //     (img.width === 2620 && img.height === 4320)) {
              //     $("button").attr('disabled', false);
              //   } else {
              //     var message = "Image size should be Subcategory 655x1080 perspective size.";
              //     $('#img_error').html(message);
              //     $('#img_error').show();
              //     $("button").attr('disabled', true);
              //   }
              // }

              var expectedHeight = (216 / 131) * img.width;
              var expectedWidth = (131 / 216) * img.height;

              if (Math.abs(img.height - expectedHeight) <= 1 || Math.abs(img.width - expectedWidth) <= 1) {
                $("button").attr('disabled', false);
              } else {
                var message = "Image size should be Subcategory 655x1080 perspective size.";
                $('#img_error').html(message);
                $('#img_error').show();
                $("button").attr('disabled', true);
              }


            } else {
              // if ((img.width < 767 && img.height < 460)) {
              //   var message = "Image size should be at least Category 767x460 pixels.";
              //   $('#img_error').html(message);
              //   $('#img_error').show();
              //   $("button").attr('disabled', true);
              // } else {
              //   if ((img.width === 767 && img.height === 460) ||
              //     (img.width === 1534 && img.height === 920) ||
              //     (img.width === 2301 && img.height === 1380) ||
              //     (img.width === 3068 && img.height === 1840)) {
              //     $("button").attr('disabled', false);
              //   } else {
              //     var message = "Image size should be Category 767x460 perspective size.";
              //     $('#img_error').html(message);
              //     $('#img_error').show();
              //     $("button").attr('disabled', true);
              //   }
              // }

              var expectedHeight = (460 / 767) * img.width;
              var expectedWidth = (767 / 460) * img.height;

              if (Math.abs(img.height - expectedHeight) <= 1 || Math.abs(img.width - expectedWidth) <= 1) {
                $("button").attr('disabled', false);
              } else {
                var message = "Image size should be Category 767x460 perspective size.";
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

          img.src = objectUrl; // Set the image source
        }

      </script>
      <script type="text/javascript">
        $(document).ready(function () {
          $('#cat_image').parsley();

          $(document).on('keyup', '#titlename', function (e) {
            var newstitle = $(this).val();
            var url_slug = newstitle.replace(/\s+/g, '-').toLowerCase();
            $('#url_slug').val(url_slug);
            $('#metatitle').val(newstitle);
          })

          $(document).on('change', '#types', function (e) {

            var types = $(this).val();
            if (types == 2) {
              $('#subcategory').hide();
              $('#parent_category').val('');
              $('#parent_category').hide();
              $('#home').hide();
            } else {
              $('#subcategory').show();
              $('#parent_category').show();
              $('#home').show();

            }
          })

          $(document).on('change', '#subcategory', function (e) {

            var types = $(this).val();
            if (types == 0) {
              $('#home').show();
            } else {
              $('#home').hide();
            }

          })

          $('#homeorder').on('input', function () {
            this.value = this.value.replace(/[^1-4]/g, '');
          });
        });
      </script>
    </div>
  </div>
</body>

</html>