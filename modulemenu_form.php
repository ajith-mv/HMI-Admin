<?php 
$moduledisp = "modulemenu";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmeModulemenu($db,'');
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
    $edit_id = base64_decode($id);
	
	$str_ed = "select group_concat(`moduleid`) as modulelist from ".tbl_modulemenus."  where 1=1 and `isactive`=1 and `menuid` =".$edit_id."  ";
    $res_ed = $db->get_a_line($str_ed);
    
    $module_listall = $res_ed['modulelist'];
	$module_listarray = explode(",",$module_listall); 
  
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
        <h4 class="page-title"><?php echo $operation; ?> ModuleMenu</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-12">
              <form id="jvalidate" name="frmModule" role="form" class="form-horizontal" action="#" method="post" >
                <input type="hidden" name="action" value="<?php echo $act; ?>" />
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                <div class="form-group">
                  <label class="col-md-2 control-label">Menu Name</label>
                  <div class="col-md-10">
                    <?php 
						  echo getSelectBox_menulist($db,'dpmenuid','required','disabled',$edit_id);
						 ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Module List</label>
                  <div class="col-md-10">
                    <?php 
                              $module_list = $db->get_rsltset("select moduleid,modulename from ".tbl_modules."  where 1=1 and isactive = 1");
                              foreach($module_list as $module_list_S)
                              {
								  
                                  $chek='';
                                  if (in_array($module_list_S['moduleid'], $module_listarray)) {
                                        $chek = 'checked';
                                  }
                            ?>
                    <div class="col-sm-3 icheck modulecheckbox">
                      <label>
                        <input type="checkbox" name="modulecheck_list[]" value="<?php echo $module_list_S['moduleid']; ?>" <?php echo $chek; ?> />
                        <?php echo $module_list_S['modulename']; ?> </label>
                    </div>
                    <?php }?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10 m-t-15">
                    <button class="btn btn-default waves-effect m-l-5" type="button" onClick="javascript:funCancel('frmModuleMenu','jvalidate','modulemenu','modulemenu_mng.php');" >Cancel</button>
					<button class="btn btn-primary waves-effect waves-light" id="submit-form" onClick="javascript: return validate_all();"  type="button" ><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
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
    
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Module</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tblresult" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Menu Name</th>
                      <th>Module Name</th>
                      <th>Sorting Order</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					    $modulesorting_list = $db->get_rsltset("select t1.*,t2.menuname,t3.modulename,t3.description,t3.modulepath from ".tbl_modulemenus."  t1 inner join ".tbl_menus."  t2 on t1.menuid = t2.menuid and t2.isactive =1 inner join ".tbl_modules."  t3 on t1.moduleid = t3.moduleid and t3.isactive =1 where 1=1 and  t1.isactive =1 and t1.menuid='".$edit_id."' order by t1.sortingorder asc ");
                        foreach($modulesorting_list as $modulesorting_list_S)
						{							
						?>
                    <tr>
                      <td><?php echo $modulesorting_list_S['menuname']; ?></td>
                      <td><?php echo $modulesorting_list_S['description']; ?></td>
                      <td><input type="text" value="<?php echo $modulesorting_list_S['sortingorder']; ?>" class="form-control"  onkeypress="return isNumber(event)" onChange="changesortingorder('<?php echo $modulesorting_list_S['modulemenuid']; ?>',this.value)"  /></td>
                    </tr>
                    <?php			
						}
					   ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include("includes/footer.php");?>
</div>
<!-- end container -->
</div>
</body>
</html><script type="text/javascript"> 
	$(function () {
		$('#tblresult_modulesorting').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
	});
	
  function validate_all(){ 
    var chkmodulesel=0;
	if(chkmodulesel == 0){	
		var chkModule=document.getElementsByName('modulecheck_list[]');
		for (var i = 0; i < chkModule.length; i++) {
				if(chkModule[i].checked == true){
					if(chkmodulesel ==0){
						chkmodulesel =1;
					}
				}	
		}
		if(chkmodulesel == 0){	
			swal("Failure!", "Please selecte one or more module permission to this menu.", "orange","btn-orange");							
 			return false;	
		}
		else{
			funSubmt('frmModuleMenu','modulemenu_actions.php','jvalidate','modulemenu','modulemenu_mng.php');
			return true;
		}		
	}     
  }	

  function changesortingorder(modulemenuId,txtval){	 
   
	  if(txtval !=""){		  
		  $.ajax({
			url        : 'others_actions.php',
			method     : 'POST',
			dataType   : 'json',
			data	   : 'pagename=modulemenusorting&modulemenuId='+modulemenuId+'&sort_value='+txtval+'',			
			success	   : function(response){ 						  		
			}
		});
		  
	  }  
  }
  
</script>