<?php

$menudisp = "gallery";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeGallery($db,'');
include_once "includes/pagepermission.php";

$getsize = getimagesize_large($db,'gallery','thumb');
$imageval = explode('-',$getsize);
$imgheight = $imageval[1];
$imgwidth = $imageval[0];

//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

$id=$_REQUEST['id'];
$category = "select * from ".tbl_gallerycategory."  where isactive != '2' ";
$cats =  $db->get_rsltset($category); 
if($id!=""){	
//check edit permission - START	
if(trim($res_modm_prm['editprm'])=="0") {?>
<script>
      window.location="error.php";
    </script>
<?php	
    }
    //check edit permission - END	
    
    $operation="Edit";
    $act="update";
    $btn='Update';
    
    $str_ed = "select * from ".tbl_gallery."  where isactive != '2' and glyid = '".base64_decode($id)."' ";
    $res_ed = $db->get_a_line($str_ed);
    
    $edit_id = $res_ed['glyid'];
    
    $chk='';
    if($res_ed['isactive']=='1'){
        $chk='checked';
    }
    $ishome='';
    if($res_ed['ishome']=='1'){
        $ishome='checked';
    }
}
else
{
	//check edit permission - START	
	if(trim($res_modm_prm['addprm'])=="0") {
	?>
<script>
	  window.location="error.php";
	</script>
<?php	
	}
//check edit permission - END
 	$operation="Add";
	$act="insert";
	$btn='Save';
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
        <h4 class="page-title"><?php echo $operation; ?> Gallery</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-8 m-t-20">
              <form id="jvalidate" name="frmnewsevents" role="form" class="form-horizontal" action="#" method="post">
                <input type="hidden" name="action" value="<?php echo $act; ?>" />
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
				
                <div class="form-group">
                  <label class="col-md-3 control-label">Select schools</label>
                  <div class="col-md-9">
                    <div class="pad-tb-7">
                      <?php 
                          $schoolid = explode(",",$res_ed['school_id']); 
                      ?>
                      <input type="checkbox" value="9" <?php echo (in_array(9,$schoolid)) ? 'checked' : '';?> name="websitetoshow[]" id="websitetoshow"> General
                      <input type="checkbox" value="1" <?php echo (in_array(1,$schoolid)) ? 'checked' : '';?> name="websitetoshow[]" id="websitetoshow"> Tambaram
                      <input type="checkbox" value="2" <?php echo (in_array(2,$schoolid)) ? 'checked' : '';?> name="websitetoshow[]" id="websitetoshow"> Padur
                      <input type="checkbox" value="3" <?php echo (in_array(3,$schoolid)) ? 'checked' : '';?> name="websitetoshow[]" id="websitetoshow"> Kottivakkam
                    </div>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-md-3 control-label">Select Category</label>
                  <div class="col-md-9">
                    <div class="pad-tb-7">
                        <select name="catid">
                            <option value="0">Select Category</option>
                            <?php
                            $selected = "";
                            foreach($cats as $category){
                                if($category['catid'] == $res_ed['catid']){
                                    $selected = "selected";
                                }
                                ?>
                                <option value="<?php echo $category['catid']; ?>"  <?php echo $selected; ?>><?php echo $category['name']; ?></option>
                                <?php
                            }
                            ?>
                            
                        </select>
                      
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Gallery Title *</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" required name="titlename" id="titlename" value="<?php echo $res_ed['glytitle']; ?>" />
                  </div>
                </div>
				
				<div class="form-group">
                    <label class="col-md-3 control-label">Date *</label>
                  
                  <div class="col-md-9">
                    <input placeholder="Date" value="<?php echo ($res_ed['glydate'] != '' && $res_ed['glydate'] != '0000-00-00') ?  date('d-m-Y',strtotime($res_ed['glydate'])) : '';?>" required name="glydate" id="glydate" class="form-control datepicker" type="text" readonly>
                    <span class="font-13 text-muted">dd-mm-yyyy</span> </div>
                </div>
				
				<div class="form-group">
                  <label class="col-md-3 control-label">Image *</label>
                  <div class="col-md-9 nopad">
                  
					<div class="col-md-8">
                    <input class="form-control product_images <?php if($act != 'update'){?>required<?php }?>" id="galleryimage" name="galleryimage" type="file" fi-type="" >
                    <span class="help-block"> Allowed Extension ( jpg, png, gif ) <br />
                    Image Size Should be <?php echo $imgwidth.' * '.$imgheight;?></span>
					</div>
					<div class="col-md-4">
                    <?php if (!empty($res_ed['glyimage']) && ($act == 'update')) {?>
                    <img src="../uploads/gallery/<?php echo $res_ed['glyimage']; ?>" width="50px" align="absmiddle"/>
                    <?php  }?>
					</div>
					</div>
                </div>
				
				
				 <div class="form-group">
                  <label class="col-md-3 control-label">Status</label>
                  <div class="col-md-9">
                    <div class="pad-tb-7">
                      <input type="checkbox" data-plugin="switchery" value="1" name="chkstatus" id="chkstatus" <?php echo $chk; ?> data-color="#00b19d" data-size="small"/>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Show on Home</label>
                  <div class="col-md-9">
                    <div class="pad-tb-7">
                      <input type="checkbox" data-plugin="switchery" value="1" name="ishome" id="ishome" <?php echo $ishome; ?> data-color="#00b19d" data-size="small"/>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9 m-t-15">
                   
                      <button class="btn btn-default waves-effect m-l-5" type="reset" onClick="javascript:funCancel('frmgallery','jvalidate','gallery','gallery_mng.php');" >Cancel</button>
					            <button class="btn btn-primary waves-effect waves-light" id="submit-form"   type="button" onClick="javascript:funSubmtWithImg('frmgallery','gallery_actions.php','jvalidate','gallery','gallery_mng.php');"><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
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
    
    <?php include("includes/footer.php");?>
</div>
<!-- end container -->
</div>
</body>
</html>