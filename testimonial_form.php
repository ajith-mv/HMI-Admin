<?php

$menudisp = "testimonial";
include "includes/header.php"; 
include "includes/Mdme-functions.php";

include_once "includes/pagepermission.php";



//check permission - START
if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
//check permission - END

$id=$_REQUEST['id'];
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
    
    $str_ed = "select * from ".tbl_testimonial."  where isactive != '2' and testimonial_id = '".base64_decode($id)."' ";
    $res_ed = $db->get_a_line($str_ed);
    
    $edit_id = $res_ed['testimonial_id'];
    
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
        <h4 class="page-title"><?php echo $operation; ?> Testimonial</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-8 m-t-20">
              <form id="jvalidate" name="frmtestimonial" role="form" class="form-horizontal" action="#" method="post">
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
                <!-- $checkBox = implode(',', $_POST['websitetoshow']); -->
                
                
                <div class="form-group">
                  <label class="col-md-3 control-label">Parent Name *</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" required name="testimonial_name" id="testimonial_name" value="<?php echo $res_ed['testimonial_name']; ?>" />
					<input name="tittlename_url" id="tittlename_url"  type="hidden" value="<?php echo $res_ed['tittlename_url']; ?>">
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-md-3 control-label">Image </label>
                  <div class="col-md-9 nopad">
                  
					<div class="col-md-8">
                    <input class="form-control product_images " id="testimonial_image" name="testimonial_image" type="file" fi-type="" >
                    <span class="help-block"> Allowed Extension ( jpg, png, gif ) <br />
                    Image Size Should be <?php echo $imgwidth.' * '.$imgheight;?></span>
					</div>
					<div class="col-md-4">
                    <?php if (!empty($res_ed['testimonial_image']) && ($act == 'update')) {?>
                    <img src="../uploads/testimonials/<?php echo $res_ed['testimonial_image']; ?>" width="50px" align="absmiddle"/>
                    <?php  }?>
					</div>
					</div>
                </div>
				<div class="form-group">
                  <label class="col-md-3 control-label">Student Detail</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control"  name="location" id="location" value="<?php echo $res_ed['location']; ?>" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-md-3 control-label">Description</label>
                  <div class="col-md-9">
                  <?php // echo $res_ed['description']; ?>
                  <textarea id="elm1" name="describtion"><?php echo $res_ed['description']; ?></textarea>
                  </div>
                    
                    
                </div>
				
				
				
				
				<div class="form-group">
                    <label class="col-md-3 control-label">Date *</label>
                   <div class="col-md-9">
                    <input placeholder="Date"  value="<?php echo ($res_ed['testimonial_date'] != '' && $res_ed['testimonial_date'] != '0000-00-00') ?  date('d-m-Y',strtotime($res_ed['testimonial_date'])) : '';?>" required name="testimonial_date" id="testimonial_date" class="form-control datepicker" type="text" readonly>
                    <span class="font-13 text-muted">dd-mm-yyyy</span> 
				  </div>
                </div>
				
				<!-- <div class="form-group">
                  <label class="col-md-3 control-label">Branch Name</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control"  name="testimonial_branch" id="testimonial_branch" value="<?php echo $res_ed['testimonial_branch']; ?>" />
                  </div>
                </div> -->

                
				
				
				<div class="form-group">
                  <label class="col-md-3 control-label">Video Link</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control"  name="testimonial_video" id="testimonial_video" value="<?php echo $res_ed['testimonial_video']; ?>" />
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-md-3 control-label">Sorting Order</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control"  name="sort" id="sort" value="<?php echo $res_ed['sort']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Need to show home page</label>
                  <div class="col-md-9">
                    <div class="pad-tb-7">
                      <input type="checkbox" data-plugin="switchery" value="1" name="ishome" id="ishome" <?php echo $ishome; ?> data-color="#00b19d" data-size="small"/>
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
                  <div class="col-sm-offset-3 col-sm-9 m-t-15">
                   
                    <button class="btn btn-default waves-effect m-l-5" type="reset" onClick="javascript:funCancel('frmtestimonial','jvalidate','testimonial','testimonial_mng.php');" >Cancel</button>
					 <button class="btn btn-primary waves-effect waves-light" id="submit-form"   type="button" onClick="javascript:funSubmtWithImg('frmtestimonial','testimonial_actions.php','jvalidate','testimonial','testimonial_mng.php');"><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
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