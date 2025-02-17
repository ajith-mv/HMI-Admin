<?php 
$menudisp = "gallery";
$view = $_REQUEST['id'];


$baseFilename = basename($_SERVER['PHP_SELF']);
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
else if(trim($res_modm_prm['ViewPrm'])=="0") {
	header("Location:".admin_public_url."error.php");
}

//check permission - END
$module_title = getModuleTitle($db, $baseFilename);

//$view = $_REQUEST['id'];

$countgetimages = $db->get_rsltset("select count(*) from  ".tbl_gallery_moreimg." where glyid='".$view."'");

?>  

      <!-- Content Wrapper. Contains page content -->
      <div class="container">
      
        <!-- Content Header (Page header) -->
        <section class="content-header">
		<div class="box-body">	
          <h1>
          Upload Image    
          </h1>
		  <span class="bg-title"></span>
          <ol class="breadcrumb">
           
          </ol>
		</div>  
        </section>

        <!-- Main content -->
        <section class="content">  
        
        <?php include "common/dpselect-functions.php"; ?>
        
         <div class="box-body">
         
				  <form id="jvalidate" name="frmGallery" role="form" class="form-horizontal" action="#" method="post" enctype='multipart/form-data' >
				   <input type="hidden" name="action" value="moreimage" />
                   <input type="hidden" name="edit_id" value="<?php echo $view; ?> "  />
                   
                 <!--  <div class="form-group" id="photos">
                      <label class="col-sm-2 control-label">Photo</label>
                      <div class="col-sm-4 user_info_photo">					    
                            <input class="product_images jsrequired " multiple="multiple" id="newsimage" data-jfiler-limit="3" name="newsimage[]" type="file" fi-type="" >
							Allowed Extension ( jpg, png, gif )
                      </div>
                    </div>-->
                    
                    <div class="form-group">	
                     
                      <div class="col-md-12  col-sm-12 col-xs-12">
					    <div class="form-upload form-group text-center ">	
                            Allowed Extension ( jpg, png, gif, webp)				
                          </div>
							<div class="form-upload product_img">					  
								<input class="product_images <?php if($act != 'update'){?>required<?php }?>" id="gallerymoreimage"  fi-limit="5" name="gallerymoreimage[]"  type="file" fi-type="" multiple="multiple" >					
							</div>
							
							<div class="form-upload" id="uploadedProducts" style="width: 800px;">							
							</div>
                      </div>
                    </div>
                    
                    <div class="form-group">	
                  
                      </div>
                    
                  <div class="box-footer text-right">
 
                    <button class="btn btn-default waves-effect " type="reset" onClick="javascript:funCancel('frmGallery','jvalidate','gallerymoretimage','gallery_mng.php');" >Cancel</button>
					<button class="btn btn-primary waves-effect waves-light m-l-5" id="submit-form"   type="button" onClick="javascript:funSubmtWithImg('frmGallery','gallery_actions.php','jvalidate','gallerymoretimage','gallery_moreimage.php?id=<?php echo $view;?>');" ><span id="spSubmit"><i class="fa fa-save"></i>  save <?php echo $btn; ?></span></button>
                 </div><!-- /.box-footer -->
                   </form>
        
        
    	        <legend></legend>    
                <form class="form-horizontal" action="gallery_actions.php" id="jvalidate1" name="noimg" method="post" >
	      <input type="hidden" value="moreimageupdate" name="action" id="action">
    	  <input type="hidden" value="<?php echo $view; ?>" name="edit_id" id="edit_id">             
            
<!--	            <div align="right">&nbsp;(To delete image uncheck the Delete check box)&nbsp;</div>
-->   				<div class="box">
                  <div class="box-body">
                  <table id="tblresult" class="table  table-striped">
                        <thead>
                            <tr>
                                 <th>Sno</th>
                                 <th>Image</th>
                                <th>Image Title</th>
                                 <th>Sort</th>
                                 <th align="center">Status</th>
                                  <th>
                                 <!-- <input type="checkbox" id="papproveal2">-->
                                 Delete</th>
                                 
                            </tr>
                        </thead>
                    <tbody>
                    <?php 
					if($countgetimages > 0){
					
                    $j = 1;
                    $check = '';
					 
	
					$getallimg = $db->get_rsltset("select * from  ".tbl_gallery_moreimg." where glyid='$view' order by glyimgid asc");
					
					$getimg1 = $db->get_a_line("select group_concat(glyimgid) as glyimgid from  ".tbl_gallery_moreimg." where glyid='$view' order by glyimgid asc");
					 
					foreach($getallimg as $getimg){
                 		 $i = $getimg['glyimgid'];
   						?>
                    <tr class="odd gradeX">
                            <td><?php echo $j;?></td>
                             <td>
							 	<?php if($getimg['imgname']!=""){ ?>
			                            <img id="blah" width="50" src="../uploads/gallery/<?php echo $getimg['imgname']; ?>" alt="" />
            	                <?php }?>
                             </td>
                             
                             <td> 
                           		<input type="hidden" name="productimgid" id="productimgid<?php echo $getimg['glyimgid'];?>" value="<?php echo $getimg1['glyimgid'];?>" />
                                <input type="text"   name="image1title<?php echo $getimg['glyimgid'];?>" id="image1title<?php echo $getimg['glyimgid'];?>" placeholder="Image Sort order" class="form-control" value="<?=$getimg['imgtitle']?>"  />
                             </td>  
                             
                             
                             <td> 
                           		<input type="hidden" name="productimgid" id="productimgid<?php echo $getimg['glyimgid'];?>" value="<?php echo $getimg1['glyimgid'];?>" />
                               <input type="text"   maxlength="3" onkeypress="return CheckNumericKeyInfowithoutDot(event.keyCode, event.which);" name="image1order<?php echo $getimg['glyimgid'];?>" id="image1order<?php echo $getimg['glyimgid'];?>" placeholder="Image Sort order" class="form-control" value="<?=$getimg['imgorder']?>"  />
                             </td>                                            
                            
                            <td align="center">
                              <input name="status<?php echo $getimg['glyimgid'];?>" <?php if($getimg['isactive']==1){echo $check="checked";} ?> id="modules-<?php echo $getimg['glyimgid'];?>" value="1" type="checkbox">
                              <input type="hidden" name="image<?php echo $getimg['glyimgid'];?>id" id="image<?php echo $getimg['glyimgid'];?>id" placeholder="Image Sort order" class="form-control" value="<?=$getimg['glyimgid']?>" />
                            </td>
                            
                            
                          <td class="center">   
                             <input  class='product_image_del'  name="imagestatus<?php echo $getimg['glyimgid'];?>" <?php echo $imgcheck; ?> id="modules-<?php echo $getimg['glyimgid'];?>" value="1" type="checkbox">
                             <input type="hidden" name="productim<?php echo $getimg['glyimgid'];?>" value="<?php echo $getimg['imgname']; ?>" />
                             <input name="imgname<?php echo $getimg['glyimgid'];?>" value="<?php echo root; ?>uploads/gallery/<?php echo $getimg['imgname']; ?>" type="hidden">                    
                          </td>
                       </tr>                    
                    <?php $j++;}?>                                           
                    <?php
					}
					else
					{?>
                    <td colspan="6" align="center">No News Image Found</td>
                    <?php }?>
                     </tbody>                                        
                </table>
              </div>                        
          </div>
             
          
                
            <!-- Button (Double) -->
          <?php if($countgetimages > 0){?>
            <div class="form-group ">
            <div class="col-md-12 text-right">
              
                   <button class="btn bg-grey margin" type="reset" onClick="javascript:funCancel('noimg','jvalidate1','moreimageupdate','gallery_mng.php');" >Cancel</button>
       <!-- <input type="submit" class="btn bg-maroon margin pull-right" value="Update" />-->
                <button class="btn btn-success waves-effect waves-light " type="button" onClick="javascript:funSubmt('noimg','gallery_actions.php','jvalidate1','moreimageupdate','gallery_moreimage.php?id=<?php echo $view;?>');" >

   <span id="spSubmit"><i class="fa fa-save"></i> Update</span></button>

                        
              </div>
              </div>
          <?php }?>
          </form>
     </div>
</section>

</div>
 
		  
          <!-- Main row -->
          
<?php include "includes/footer.php"; ?>  	


<script type="text/javascript" src="assets/js/jquery.filer.min.js"></script>
<script type="text/javascript" src="assets/js/multiple-select.js"></script>
<script>
jQuery(document).ready(function(){	
 
 	$("#gallerymoreimage").filer({	
    limit: 6,
    maxSize: 5,
		showThumbs: true,		
		extensions: ['jpg', 'jpeg', 'png', 'gif', 'webp','jfif'],
		
		changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-folder"></i></div><div class="jFiler-input-text"><h3>Click on this box</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
		
		theme: "dragdropbox",
		dragDrop : true,
		templates: {
				box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
				item: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-info">\
											<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 5}}</b></span>\
											<span class="jFiler-item-others">{{fi-size2}}</span>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left"></ul>\
										<ul class="list-inline pull-right">\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
				itemAppend: '<li class="jFiler-item">\
								<div class="jFiler-item-container">\
									<div class="jFiler-item-inner">\
										<div class="jFiler-item-thumb">\
											<div class="jFiler-item-status"></div>\
											<div class="jFiler-item-info">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
											{{fi-image}}\
										</div>\
										<div class="jFiler-item-assets jFiler-row">\
											<ul class="list-inline pull-left">\
												<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
											</ul>\
											<ul class="list-inline pull-right">\
												<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
											</ul>\
										</div>\
									</div>\
								</div>\
							</li>',
				itemAppendToEnd: false,
				removeConfirmation: true,
				_selectors: {
					list: '.jFiler-items-list',
					item: '.jFiler-item',
					remove: '.jFiler-item-trash-action'
				},
        onSelect: function(files) {
            if ($("#gallerymoreimage")[0].files.length > 6) {
                alert("You can only upload up to 6 files!");
                $("#gallerymoreimage").val(""); 
            }
        }
		}
	});
});
</script>