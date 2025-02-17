<?php 
$menudisp = "permissioninfo";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
$mdme = getMdmePermissioninfo($db,'');

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
	//echo "select r.RoleName from ".tbl_roles."  r  where  r.isactive <> 2 and r.RoleId='".$edit_id."' ";
	

	$resrole_name = $db->get_a_line("select r.RoleName from ".tbl_roles."  r  where  r.isactive <> 2 and r.RoleId='".$edit_id."' ");
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
        <h4 class="page-title"><?php echo $operation; ?> Permission</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box">
          <div class="row">
            <div class="col-lg-12">
              <form id="jvalidate" name="frmPermission" role="form" class="form-horizontal" action="#" method="post" >
                <input type="hidden" name="action" value="<?php echo $act; ?>" />
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?> "  />
                
                <div class="form-group">
                  <label class="col-md-2 control-label">Role Name</label>
                  <div class="col-md-10">
                    <input disabled id="txtRolename" class="form-control" required type="text" value="<?php echo $resrole_name['RoleName']; ?>" name="txtRolename">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">Permission List </label>
                  <div class="col-md-10">
                    <?php
									$mainmenu_list = $db->get_rsltset("select t1.menuid,t2.menuname from ".tbl_modulemenus."  t1 inner join ".tbl_menus."  t2 on t1.menuid = t2.menuid and t2.isactive =1 
									 inner join ".tbl_modules."  t3 on t1.moduleid = t3.moduleid and t3.isactive =1 and t3.IsDisplay=1
									where 1=1 and t1.isactive = 1 group by t1.menuid");
									foreach($mainmenu_list as $mainmenu_list_S)
									{
								?>
                    <h4 class="box-title permission_subtitle"><?php echo $mainmenu_list_S['menuname']; ?></h4>
                    <table class="table table-striped permission_info_table">
                      <thead>
                        <tr>
                          <th width="20%" style="vertical-align:super;">Page Name</th>
                          <th width="20%"><i class="fa fa-plus" style="font-size:12px;"></i> Add <br />
                            <input class="checker" type="checkbox" id="AdPrm_<?php echo $mainmenu_list_S['menuid']; ?>" />
                          </th>
                          <th width="20%"><i class="fa fa-pencil-square-o" style="font-size:13px;"></i> Edit <br />
                            <input class="checker"   type="checkbox" id="EdPrm_<?php echo $mainmenu_list_S['menuid']; ?>" /></th>
                          <th width="20%"><i class="fa fa-trash-o" style="font-size:13px;"></i> Delete <br />
                            <input class="checker"   type="checkbox" id="DePrm_<?php echo $mainmenu_list_S['menuid']; ?>" />
                          </th>
                          <th width="20%"><i class="fa fa-eye" style="font-size:13px;"></i> View <br />
                            <input class="checker"  type="checkbox" id="ViPrm_<?php echo $mainmenu_list_S['menuid']; ?>" />
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
						//echo "select t1.*,t2.menuname,t3.modulename,t3.description,t3.modulepath from ".tbl_modulemenus."  t1 									 inner join ".tbl_menus."  t2 on t1.menuid = t2.menuid and t2.isactive =1 									 inner join ".tbl_modules."  t3 on t1.moduleid = t3.moduleid and t3.isactive =1 and t3.IsDisplay=1									 where 1=1  and t1.moduleid  NOT IN (1,2,3) and  t1.isactive =1 and t1.menuid='".$mainmenu_list_S['menuid']."' order by t1.moduleId asc ";
									 
									 $page_list =$db->get_rsltset("select t1.*,t2.menuname,t3.modulename,t3.description,t3.modulepath from ".tbl_modulemenus."  t1 
									 inner join ".tbl_menus."  t2 on t1.menuid = t2.menuid and t2.isactive =1 
									 inner join ".tbl_modules."  t3 on t1.moduleid = t3.moduleid and t3.isactive =1 and t3.IsDisplay=1
									 where 1=1  and t1.moduleid  NOT IN (1,2,3) and  t1.isactive =1 and t1.menuid='".$mainmenu_list_S['menuid']."' order by t1.moduleId asc ");
									 foreach($page_list as $page_list_S)
									 {
									   $pagepermission_all = $db->get_a_line("select * from ".tbl_user_acl."  where 1=1 and isactive =1 and roleid='".$edit_id."' and modulemenuid='".$page_list_S['modulemenuid']."' ");									   
									 ?>
                        <tr>
                          <td style="text-align:left"><?php echo $page_list_S['description']; ?></td>
                          <td><div class="icheck">
                              <label>
                                <input class="AdPrm_<?php echo $mainmenu_list_S['menuid']; ?>" type="checkbox" name="addprm_<?php echo $page_list_S['modulemenuid']; ?>" <?php if($pagepermission_all['addprm'] == 1 ) echo "checked"; ?>  />
                              </label>
                            </div></td>
                          <td><div class="icheck">
                              <label>
                                <input class="EdPrm_<?php echo $mainmenu_list_S['menuid']; ?>" type="checkbox" name="editprm_<?php echo $page_list_S['modulemenuid']; ?>"  <?php if($pagepermission_all['editprm'] == 1 ) echo "checked"; ?>  />
                              </label>
                            </div></td>
                          <td><div class="icheck">
                              <label>
                                <input class="DePrm_<?php echo $mainmenu_list_S['menuid']; ?>" type="checkbox" name="deleteprm_<?php echo $page_list_S['modulemenuid']; ?>" <?php if($pagepermission_all['deleteprm'] == 1 ) echo "checked"; ?>  />
                              </label>
                            </div></td>
                          <td><div class="icheck">
                              <label>
                                <input class="ViPrm_<?php echo $mainmenu_list_S['menuid']; ?>" type="checkbox" name="viewprm_<?php echo $page_list_S['modulemenuid']; ?>"   <?php if($pagepermission_all['viewprm'] == 1 ) echo "checked"; ?> />
                              </label>
                            </div></td>
                        </tr>
                        <?php	 
									 }
									?>
                      </tbody>
                    </table>
                    <div class="clearfix"></div>
                    <?php											
									}
								?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-9 m-t-15">
                   
                    <button class="btn btn-default waves-effect m-l-5" type="button" onClick="javascript:funCancel('frmPermission','jvalidate','modulemenu','permissioninfo_mng.php');" >Cancel</button>
					 <button class="btn btn-primary waves-effect waves-light" id="submit-form"   type="button" onClick="javascript: funSubmt('frmPermission','permissioninfo_actions.php','jvalidate','permissioninfo','permissioninfo_mng.php');"><span id="spSubmit"><i class="fa fa-save"></i> <?php echo $btn; ?></span></button>
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
</html><script type="text/javascript">  
$(function(){
   $(".checker").click(function () {
	  
	    var chkid = $(this).attr('id');	
 		if (undefined != chkid)
		{
			if ($("#"+chkid).is(':checked')){
			  $("."+chkid).prop('checked', 'checked');
              $("."+chkid).parent('div').addClass('checked');  
			}
			else{
			  $("."+chkid).prop('checked', false);
              $("."+chkid).parent('div').removeClass('checked');  
			} 
		}	
	});
});

</script>