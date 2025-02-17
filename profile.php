<?php 
$menudisp = "user";
include "includes/header.php"; 
include "includes/Mdme-functions.php";
//$mdme = getMdmeUser($db,'');
include_once "includes/pagepermission.php";

//check permission - START
/*if(!($res_modm_prm)){
	header("Location:".admin_public_url."error.php");
}
*///check permission - END

$id=$_REQUEST['id'];
if($id!="")
{
	
//check edit permission - START	
if(trim($res_modm_prm['editprm'])=="0") {
?>
<!--<script>
  window.location="error.php";
</script>
--><?php	
}
//check edit permission - END	

$operation="Edit";
$act="update";
$btn='Update';

$str_ed = "select * from ".tbl_users." where isactive != '2' and userid = '".base64_decode($id)."' ";
$res_ed = $db->get_a_line($str_ed);

$edit_id = $res_ed['userid'];

$chk='';
	if($res_ed['isactive']=='1'){	
	$chk='checked';
	}
}
else
{
if(trim($res_modm_prm['addprm'])=="0") {
?>
<!--<script>
  window.location="error.php";
</script>
--><?php	
}
	//check edit permission - END
	$operation="Add";
	$act="insert";
	$btn='Save';
}

include "includes/top.php";?>
 <?php include "common/dpselect-functions.php"; 
 $str_ed = "select * from ".tbl_users." where isactive != '2' and userid = '".$_SESSION['UserId']."' ";
$res_ed = $db->get_a_line($str_ed);

 ?>
 <link href="assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<!-- BEGIN HEADER -->
 
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	 
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			 
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="#">Home</a><i class="fa fa-circle"></i>
				</li>
				 
				<li class="active">
					 User Account
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
				<div class="col-md-12">
					<!-- BEGIN PROFILE SIDEBAR -->
					
					<!-- END BEGIN PROFILE SIDEBAR -->
					<!-- BEGIN PROFILE CONTENT -->
					<div class="profile-content">
						<div class="row">
                        <div class="col-md-3">
                        <div class="profile-sidebar" >
						<!-- PORTLET MAIN -->
						<div class="portlet light profile-sidebar-portlet text-center">
							<!-- SIDEBAR USERPIC -->
							<div class="profile-userpic">
                             <?php 
							// if(file_exists(docroot.'adminusers/'.$homeres_ed['user_photo']) && $res_ed['user_photo'] != '')
							 if( $res_ed['user_photo'] != ''){?>
                              <img class="img-responsive center-block" src="<?php echo IMG_BASE_URL;?>adminusers/<?php echo $res_ed['user_photo']; ?>" />
                                <?php }else{?>
                            <img class="img-responsive sprofile center-block" src="<?php echo IMG_BASE_URL;?>adminusers/NoImageAvailable.png" />
                            <?php }?>
							</div>
							<!-- END SIDEBAR USERPIC -->
							<!-- SIDEBAR USER TITLE -->
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									<?php echo $res_ed['user_firstname'].' '.$res_ed['user_lastname']; ?>
								</div>
							 
							</div>
                            <?php 
							if($_SESSION['RoleId'] == 3 || $_SESSION['RoleId'] == 4)
							{
								if(isset($centerdet) && !empty($centerdet))
								for($m=0;$m<count($centerdet);$m++)
								{
								
								
							?>
                            <div class="profile-usertitle">
								<div class="profile-usertitle-name">
									<?php if($_SESSION['RoleId'] == 4)
									echo $centerdet[$m]['centername'].' ('.$centerdet[$m]['centercode'].')';
								else									
									echo $centerdet[$m]['centercode'];
									if( $m < (count($centerdet)-1))
									echo ' | '; ?>
								</div>
							 
							</div>
                            <?php
								}
							}
							?>
							<!-- END SIDEBAR USER TITLE -->
							<!-- SIDEBAR BUTTONS -->
							<div class="profile-userbuttons"> 
								<button type="button" class="btn btn-circle btn-danger btn-sm"><?php echo $_SESSION['RoleName']; ?></button>
							</div>
                            <div style="clear:both">&nbsp;</div>
							<!-- END SIDEBAR BUTTONS -->
							<!-- SIDEBAR MENU -->
							 
							<!-- END MENU -->
						</div>
						<!-- END PORTLET MAIN -->
						<!-- PORTLET MAIN -->
						 
						<!-- END PORTLET MAIN -->
					</div>
                    </div>
							<div class="col-md-9">
								<div class="portlet light">
									
									<div class="portlet-body col-md-12">
									<div class="form-group">
										<h3>
											
											<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
										</h3>
										
									</div>
									<ul class="nav nav-tabs">
											<li class="active">
												<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
											</li>
											 
											<li>
												<a href="#tab_1_3" data-toggle="tab">Change Password</a>
											</li>
										 
										</ul>
										<div class="tab-content col-md-12">
											<!-- PERSONAL INFO TAB -->
											<div class="tab-pane active col-md-12" id="tab_1_1">
										<form action="#" method="post" id="jvalidate" class="form-horizontal">
                                              <input type="hidden" name="action" value="profileupdate" />
                 			 <input type="hidden" name="edit_id" value="<?php echo $_SESSION['UserId']; ?> "  />
                              <input type="hidden" name="franchiseeid" value="<?php echo $res_ed['franchiseeid']; ?>"  />
                             
													<div class="form-group">
													<div class="col-md-6">
														<label class="control-label">First Name</label>
															 <input type="text" class="form-control required" name="txtuser_firstname" id="txtuser_firstname" value="<?php echo $res_ed['user_firstname']; ?>" />
													</div>
													<div class="col-md-6">
														<label class="control-label">Last Name</label>
														 <input type="text" class="form-control required" name="txtuser_lastname" id="txtuser_lastname" value="<?php echo $res_ed['user_lastname']; ?>" />
													</div>
													</div>
													<div class="form-group">
													<div class="col-md-6">
														<label class="control-label">Email</label>
														<input type="email" readonly="readonly" class="form-control required email" name="txtuser_email" id="txtuser_email"  value="<?php echo $res_ed['user_email']; ?>" />
													</div>
                                                    
													<div class="col-md-6">
														<label class="control-label">Profile</label>
														 					
							 				   <input class="product_images form-control" accept=".jpg,.png,.gif,.PNG,.JPG,.JPEG" id="user_photo" name="user_photo" type="file" fi-type="" >
													</div>
													</div>
													 <div class="form-group">
													<div class=" col-md-12 margiv-top-10" align="right">
                                                    
                                                     <button type="button" class="btn green-haze"  onClick="javascript:funSubmtWithImg('frmUser','userinfo_actions.php','jvalidate','profile','profile.php');">Update Profile</button>
										     
													</div>
													</div>
												</form>
											</div>
											<!-- END PERSONAL INFO TAB -->
											<!-- CHANGE AVATAR TAB -->
											 
											<!-- END CHANGE AVATAR TAB -->
											<!-- CHANGE PASSWORD TAB -->
											<div class="tab-pane col-md-12" id="tab_1_3">
												<form action="#">
												<div class="col-md-6 col-md-offset-3 nopad">
                                                  <input type="hidden" name="action" value="profilepwd" />
                 			 <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_SESSION['UserId']; ?> "  />
                              <input type="hidden" name="txtuser_email" id="txtuser_email" value="<?php echo $res_ed['user_email']; ?> "  />
                                <input type="hidden" name="franchiseeids" id="franchiseeids" value="<?php echo $res_ed['franchiseeid']; ?>"  />
												<!--	<div class="form-group">
														<label class="control-label">Current Password</label>
														<input type="password" class="form-control"/>
													</div>-->
													
													<div class="form-group">
														<label class="control-label">New Password</label>
													<input type="password" class="form-control " name="newpwd" id="newpwd" value=""/>
													</div>
													<div class="form-group">
														<label class="control-label">Re-type New Password</label>
														<input type="password" class="form-control " name="newcnfrmpwd" id="newcnfrmpwd" value=""/>
													</div>
													<div class="form-group">
													<div class="text-right  margin-top-10">
													<button type="button" class="btn green-haze" onclick="pwdchange();">Change Password</button>
										 
													</div>
													</div>
													</div>
												</form>
											</div>
											<!-- END CHANGE PASSWORD TAB -->
											<!-- PRIVACY SETTINGS TAB -->
											 
											<!-- END PRIVACY SETTINGS TAB -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END PROFILE CONTENT -->
				</div>
			</div>
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<?php include "includes/footer.php";?>


<script type="text/javascript"> 
 
function pwdchange(){	  
	if($('#newpwd').val() == '' || $('#newcnfrmpwd').val() == ''){
		 alert('Please Enter password and Confirm Password Details');
	}	
	else if($('#newpwd').val()!=$('#newcnfrmpwd').val()){
		 alert('Password not matches');
	}
	else{
	//alert($('#edit_id').val())
		var user_id = $('#edit_id').val(); 
		var user_email = $('#txtuser_email').val();
		var new_pwd = $('#newpwd').val();
		//var franchiseeid = $('#franchiseeids').val();
		$.ajax({
			url: 'userinfo_pwdchange.php',
			type: 'POST',
			data: 'user_id='+user_id+'&user_email='+user_email+'&new_pwd='+new_pwd,
			success: function(result) {	 														
					if(result =='Success'){	
					
							swal("Success!","Password has been changed successfully");	
							setTimeout(function() { location.reload();  }, 1200 );
							
					 }						
					else {
                      swal("error!","There is no change in your password");	
					}   
			}
		}); 				
	}
 }

</script> 
