<?php

$menudisp = "announcement";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeAnnouncement($db,'');
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
    
    $str_ed = "select * from ".tbl_announcement."  where isactive != '2' and anmtid = '".base64_decode($id)."' ";
    $res_ed = $db->get_a_line($str_ed);
    
    $edit_id = $res_ed['anmtid'];
    
    $chk='';
    if($res_ed['isactive']=='1'){
        $chk='checked';
    }
    $ishome ='';
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
        <h4 class="page-title"><?php echo $operation; ?> Announcement</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-8 m-t-20">
              <form id="jvalidate" name="frmnewsevents" role="form" class="form-horizontal" action="#" method="post" >
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
                  <label class="col-md-3 control-label">Announcement Title*</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" required name="titlename" id="titlename" value="<?php echo $res_ed['announcement']; ?>" />
                  </div>
                </div>
				
			
				<div class="form-group">
                    <label class="col-md-3 control-label">Date *</label>
                  
                  <div class="col-md-9">
                    <input placeholder="Date" value="<?php echo ($res_ed['date'] != '' && $res_ed['date'] != '0000-00-00') ?  date('d-m-Y',strtotime($res_ed['date'])) : '';?>" required name="date" id="date" class="form-control datepicker" type="text" readonly>
                    <span class="font-13 text-muted">dd-mm-yyyy</span> </div>
                </div>
				
				 <div class="form-group">
                  <label class="col-md-3 control-label">Link </label>
                  <div class="col-md-9">
                    <input type="text" class="form-control"  name="link" id="link" value="<?php echo $res_ed['link']; ?>"/>
                  </div>
                </div>
				
				<div class="form-group">
                  <label class="col-md-3 control-label">PDF </label>
                  <div class="col-md-9 nopad">
                  
					<div class="col-md-8">
                    <input class="form-control product_images" id="pdf" name="pdf" type="file" accept="application/pdf" fi-type="" >
                  
					</div>
					<div class="col-md-4">
                    <?php if (!empty($res_ed['pdf']) && ($act == 'update')) {?>
                     <a href="<?php echo IMG_BASE_URL;?>announcement/<?php echo $res_ed['pdftitle']; ?>" target="_blank"><?php echo $res_ed['pdf']; ?></a>
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
                   
                    <button class="btn btn-default waves-effect m-l-5" type="reset" onClick="javascript:funCancel('frmannounce','jvalidate','announcement','announcement_mng.php');" >Cancel</button>
					 <button class="btn btn-primary waves-effect waves-light" id="submit-form"   type="button" onClick="javascript:funSubmtWithImg('frmannounce','announcement_actions.php','jvalidate','announcement','announcement_mng.php');"><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
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