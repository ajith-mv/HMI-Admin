<?php 
$menudisp = "career";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeJobOpenings($db,'');
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
    
    $str_ed = "select * from ".tbl_jobcareer."  where isactive != '2' and jobid = '".base64_decode($id)."' ";
    $res_ed = $db->get_a_line($str_ed);
    
    $edit_id = $res_ed['jobid'];
    
    $chk='';
    if($res_ed['isactive']=='1'){
        $chk='checked';
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
        <h4 class="page-title"><?php echo $operation; ?> Job</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-8 m-t-20">
              <form id="jvalidate" name="frmjob" role="form" class="form-horizontal" action="#" method="post" >
                <input type="hidden" name="action" value="<?php echo $act; ?>" />
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                <div class="form-group">
                  <label class="col-md-3 control-label">Job Title *</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" required name="jbtitle" id="jbtitle" value="<?php echo $res_ed['jobtitle']; ?>" />
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-md-3 control-label">Location *</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" required name="jblocation" id="jblocation" value="<?php echo $res_ed['location']; ?>" />
                  </div>
                </div>
               
                <div class="form-group">
                  <label class="col-md-3 control-label">Description</label>
                  <div class="col-md-9">
                    <textarea class="form-control"  name="jbdescription" id="elm1"><?php echo $res_ed['description']; ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-md-3 control-label">Responsibility</label>
                  <div class="col-md-9">
                    <textarea class="form-control"  name="jbresponsibility" id="elm2"><?php echo $res_ed['responsibility']; ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-md-3 control-label">Qualification</label>
                  <div class="col-md-9">
                    <textarea class="form-control"  name="jbqualification" id="elm3"><?php echo $res_ed['qualification']; ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                    <label class="col-md-3 control-label">Date *</label>
                  
                  <div class="col-md-9">
                    <input placeholder="Date" value="<?php echo ($res_ed['regdate'] != '' && $res_ed['regdate'] != '0000-00-00') ?  date('d-m-Y',strtotime($res_ed['regdate'])) : '';?>" required name="jbregdate" id="jbregdate" class="form-control datepicker" type="text">
                    <span class="font-13 text-muted">dd-mm-yyyy</span> </div>
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
                   
                    <button class="btn btn-default waves-effect m-l-5" type="reset" onClick="javascript:funCancel('frmjob','jvalidate','job','job_mng.php');" >Cancel</button>
					 <button class="btn btn-primary waves-effect waves-light" id="submit-form"   type="button" onClick="javascript:funSubmtWithImg('frmjob','job_actions.php','jvalidate','job','job_mng.php');" ><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
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