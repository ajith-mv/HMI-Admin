<?php

$menudisp = "gallerycategories";
include "includes/header.php";
include "includes/Mdme-functions.php";
$mdme = getMdmeGalleryCat($db, '');
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
  $imgwidth = 700;
  $imgheight = 600;


  $operation = "Edit";
  $act = "update";
  $btn = 'Update';

  error_reporting(1);

  $str_ed = "select * from " . tbl_gallerycategory . "  where isactive != '2' and catid = '" . base64_decode($id) . "' ";
  $res_ed = $db->get_a_line($str_ed);

  $edit_id = $res_ed['catid'];

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

$parent_category = "select * from " . tbl_careerlisting . "  where isactive != '2' and isactive = '1' ";
$parent_category_list = $db->get_rsltset(sqlqry: $parent_category);

$category = "select * from " . tbl_newscategory . "  where isactive != '2' and subcategory = '0' ";
$category_list = $db->get_rsltset($category);

include "common/dpselect-functions.php";
?>
<style>
  .select2 {
    width: 100% !important;
  }

  /* .card-box {
    margin-top: 4rem;
  }

  .page-title {
    margin-top: 2rem;
  } */
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

<body>
  <!-- Navigation Bar-->

  <!-- End Navigation Bar-->

  <div class="wrapper">
    <div class="container">

      <!-- Page-Title -->
      <div class="row">
        <div class="col-sm-12">
          <h4 class="page-title"><?php echo $operation; ?> Products</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box">
            <div class="row">
              <div class="col-lg-8 m-t-20">
                <form id="jvalidate" name="frmgallerycategories" role="form" class="form-horizontal" action="#"
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
                    <label class="col-md-3 control-label">Product Name *</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" required name="titlename" id="titlename"
                        value="<?php echo $res_ed['name']; ?>" />
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
                    <label class="col-md-3 control-label">Parent Category *</label>
                    <div class="col-md-9">
                      <select class="form-control" name="category" id="category">
                        <option>Select parent Category</option>
                        <?php foreach ($category_list as $categorys) {

                          $parentcatid = $categorys['catid'];

                          $subcategory = "select * from " . tbl_newscategory . "  where isactive != '2' and subcategory = $parentcatid";

                          $subcategory_list = $db->get_rsltset($subcategory);
                          ?>
                          <option value="<?php echo $categorys['catid']; ?>" <?php if ($categorys['catid'] == $res_ed['category']) {
                               echo "selected";
                             } ?>>
                            <?php echo $categorys['name']; ?>
                          </option>
                          <?php


                          foreach ($subcategory_list as $subcategorys) {
                            ?>
                            <option value="<?php echo $subcategorys['catid']; ?>" <?php if ($subcategorys['catid'] == $res_ed['category']) {
                                 echo "selected";
                               } ?>>
                              ├─<?php echo $subcategorys['name']; ?>
                            </option>
                          <?php }
                        } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Image *</label>
                    <div class="col-md-9 nopad">

                      <div class="col-md-8">
                        <input class="form-control product_images <?php if ($act != 'update') { ?>required<?php } ?>"
                          id="image" name="image" onchange="dimensions()" type="file" fi-type="">
                        <span class="help-block"> Allowed Extension ( jpg, png, gif, webp ) <br />
                          Image Size Should be <?php echo $imgwidth . ' * ' . $imgheight; ?></span>
                        <b id="img_error" style="color:red;display:none;"></b>
                      </div>
                      <div class="col-md-4">
                        <?php if (!empty($res_ed['image']) && ($act == 'update')) { ?>
                          <img src="../uploads/gallery/<?php echo $res_ed['image']; ?>" width="50px" align="absmiddle" />
                        <?php } ?>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Select Color *</label>
                    <div class="col-md-9">

                      <?php

                      $color = $res_ed['color'];

                      $color_array = explode(',', $color);

                      ?>

                      <select type="select" name="color[]" class="form-control select2" id="color" multiple="multiple">
                        <?php foreach ($parent_category_list as $parentcategory) { ?>
                          <option value="<?php echo $parentcategory['id']; ?>" <?php if (in_array($parentcategory['id'], $color_array)) {
                               echo "selected";
                             } ?>>
                            <?php echo $parentcategory['title']; ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Specifications</label>
                    <div class="col-md-9">
                      <textarea id="elm1" class="elm1" name="specfic"><?php echo $res_ed['specfic']; ?></textarea>
                    </div>
                  </div>

                  <!-- 
                  <div class="form-group">
                    <label class="col-md-3 control-label">Body Shape *</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" name="body_shape" id="body_shape"
                        value="<?php // echo $res_ed['body_shape']; ?>" />
                    </div>
                  </div> -->


                  <div class="form-group">
                    <label class="col-md-3 control-label">Hardware Color *</label>
                    <div class="col-md-9">
                      <select class="form-control select2" name="hardware_color" id="hardware_color">
                        <option>Select Hardware Color</option>
                        <?php foreach ($parent_category_list as $color) { ?>
                          <option value="<?php echo $color['id']; ?>" <?php if ($color['id'] == $res_ed['hardware_color']) {
                               echo "selected";
                             } ?>>
                            <?php echo $color['title']; ?>
                          </option>
                          <?php
                        } ?>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-3 control-label">Description</label>
                    <div class="col-md-9">
                      <textarea id="elm2" name="gallerycatdesc"><?php echo $res_ed['description']; ?></textarea>
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
                        onClick="javascript:funCancel('frmgallerycategories','jvalidate','Products','gallerycategories_mng.php');">Cancel</button>
                      <button class="btn btn-primary waves-effect waves-light" id="submit-form" type="button"
                        onClick="javascript:funSubmtWithImg('frmgallerycategories','gallerycat_actions.php','jvalidate','Products','gallerycategories_mng.php');"><span
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
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function () {
          $('#color').select2({
            placeholder: "Select colors",
            allowClear: true
          });
          $('#related').select2({
            placeholder: "Select related products",
            allowClear: true
          });

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
          var fileInput = $('input[name=image]')[0];
          if (!fileInput.files.length) {
            // alert("Please select an image.");
            return;
          }

          var file = fileInput.files[0];
          var img = new Image();
          var objectUrl = URL.createObjectURL(file);

          img.onload = function () {
            console.log("Image Loaded: " + img.width + "x" + img.height);
            if ((img.width < 700 || img.height < 600) && (img.width < 1000 || img.height < 1500)) {
              var message = "Image size should be at least 700x600 or 1000x1500  pixels.";
              $('#img_error').html(message);
              $('#img_error').show();

              $("button").attr('disabled', true);
            } else {
              if ((img.width === 700 && img.height === 600) ||
                (img.width === 1000 && img.height === 1500) ||
                (img.width === 1400 && img.height === 1200) ||
                (img.width === 2000 && img.height === 3000) ||
                (img.width === 2100 && img.height === 1800) ||
                (img.width === 3000 && img.height === 4500)) {
                $("button").attr('disabled', false);
              } else {
                var message = "Image size should be 700x600 or 1000x1500 actual size.";
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
    </div>
    <!-- end container -->
  </div>
</body>

</html>