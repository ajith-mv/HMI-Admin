<?php 
$menudisp = "menu";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeMenu($db,'');
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
    
    $str_ed = "select * from ".tbl_menus."  where isactive != '2' and menuid = '".base64_decode($id)."' ";
    $res_ed = $db->get_a_line($str_ed);
    
    $edit_id = $res_ed['menuid'];
    
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
        <h4 class="page-title"><?php echo $operation; ?> Menu</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-8 m-t-20">
              <form id="jvalidate" name="frmMenu" role="form" class="form-horizontal" action="#" method="post" >
                <input type="hidden" name="action" value="<?php echo $act; ?>" />
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                <div class="form-group">
                  <label class="col-md-3 control-label">Menu Name *</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" required name="txtMenuname" id="txtMenuname" value="<?php echo $res_ed['menuname']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label" for="example-email">Menu Icon *</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" required name="menuicon" id="menuicon" value="<?php echo $res_ed['moduleicon']; ?>" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Description</label>
                  <div class="col-md-9">
                    <textarea class="form-control"  name="txtMenuDesc" id="txtMenuDesc"><?php echo $res_ed['description']; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-3 control-label">Sortorder</label>
                  <div class="col-md-9">
                    <input type="text" data-parsley-type="number" class="form-control" name="txtSortingorder" id="txtSortingorder" value="<?php echo $res_ed['sortingorder']; ?>" />
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
                   
                    <button class="btn btn-default waves-effect m-l-5" type="button" onClick="javascript:funCancel('frmMenu','jvalidate','menu','menu_mng.php');" >Cancel</button>
					 <button class="btn btn-primary waves-effect waves-light" id="submit-form"   type="button" onClick="javascript:funSubmt('frmMenu','menu_actions.php','jvalidate','menu','menu_mng.php');" ><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
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