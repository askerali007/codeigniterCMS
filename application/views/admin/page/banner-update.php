<?php $this->load->view('admin/sidebar');
//echo "<pre>";
//print_r($menu); exit;
?>
<style>
.btn-file > input {
    border: 0 solid transparent;
    cursor: pointer;
    direction: ltr;
    height: 34px;
    margin: 0;
    opacity: 0;
    position: relative;
    right: 0;
    top: 0;
    transform: translate(25px, -62px) scale(3);
    width: 47px;
}
.selectExist{ margin-top:-30px; display:block; border-top:1px solid #CCC; cursor:pointer;}
</style>
<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Add/Edit Banner images </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add/Edit Banner</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                <div id="PasswordError"></div>
                <!-- form start -->
                <form class="uploadform" role="form" action="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/upload/banner" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  <div class="box-body">
                     <div class="form-group">
                    	<div class="col-md-12 col-sm-12">	
                      		<label for="menus_id">Menu</label>
                      		<select name="menus_id" id="menus_id" class="form-control">
                                <option value="x">-SELECT MENU-</option>
                                <?php foreach($menus as $menu) :?>
                                <option value="<?=$menu->menu_id?>" <?php if($this->uri->segment(4) == $menu->menu_id ):?> selected="selected"<?php endif;?>><?=$menu->menu_title_en?></option>
                                <?php if($menu->child) :?>
                        		<?php foreach($menu->child as $child) : $i++;?>
                              	<option value="<?=$child->menu_id?>" <?php if($this->uri->segment(4) == $child->menu_id ):?> selected="selected"<?php endif;?>>&nbsp;&nbsp;--&nbsp;<?=$child->menu_title_en?></option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                <?php endforeach; ?>
                              </select>
                        </div>
                        <div class="cleafix"></div>
                    </div>
                    
                 	 <div class="form-group">
                    	<div class="col-md-12 col-sm-12">	
                      		<ul class="images-list">
                           <?php
                             ?>
                         <?php $i=0; 
						
						 foreach($banners as $banner ) : 
						  $i++; ?>
                         
                         <?php if($banner->banners_image != '' ) : ?>
                                <li class="banner-thumb item_<?=$banner->banners_id?>">
                                <a href="javascript:void(0);" onClick="removeBannerImg(<?=$banner->banners_id?>);" class="remove-banner">
                                <img class="" src="<?php echo $this->config->item('admin_template');?>images/remove-icon.png" alt="remove" title="Remove PDF" /></a>
                                <a title="<?=$banner->banners_image?>" href="<?php echo base_url();?>assets/images/banner/<?=$banner->banners_image?>" target="_blank" >
                                	<img src="<?php echo base_url();?>assets/images/banner/<?=$banner->banners_image?>">
                                    </a>
                                    
                                </li>
                                <?php endif;?>
                        <?php endforeach; ?>
                                <li class="banner-addimg ">
                                  			<span class="btn-file">
                                  		<img src="<?php echo $this->config->item('admin_template');?>images/plus-icon.png" alt="add-image" width="32" />
                                                    <br/><span class="fileupload-new">New image</span>
                                       				<input id="uploadImage" name="imagefile" type="file" class="upload"/>
                                       <div class="clearall"></div>
                                           </span>
                                            <!--<span class="selectExist">Select from existing</span>-->
                                           <div class="clearall"></div>
                                          
                                          
                                </li>	
                            
                                </ul>
                        </div>
                         <div class="cleafix"></div>
                    </div>
                 
                 	</div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">  
                    <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/banners" class="btn btn-primary pull-right">Back to list</a>
                  </div>
                </form>
              </div>
          	</div>
      </div>
 </section>
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Image croping area</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        	  <input type="hidden" id="x" name="x" />
              <input type="hidden" id="y" name="y" />
              <input type="hidden" id="w" name="w" />
              <input type="hidden" id="h" name="h" />
              <input type="hidden" id="rw" name="rw" />
              <input type="hidden" id="rh" name="rh" />
              <input type="hidden" id="image_name" name="image_name" />
              <input type="hidden" id="image" name="image" value="" />
              <button type="button" class="btn btn-icon btn-success glyphicons circle_ok pull-right" id="cropImage"><i></i>UPLOAD BANNER IMAGE</button>
      </div>
    </div>

  </div>
</div>
</div>

<script type="text/javascript">

function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };
function removeBannerImg(id){
	if(confirm('Are you sure to remove this image?')){
		$(".loadings").fadeIn('slow');
		$.getJSON('<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/removebanner/',{id : id},function(data){
				if(data.status == 'success'){
					$(".loadings").fadeOut('slow');
					$('li.item_'+id).remove();
				}
		});
	}
	else{
		return false;
	}
}

$(document).ready(function() {

	
	//***********UPLOAD IMAGE *********************//
	$('.upload').change(function(e) {
		if($('#property_id').val() == 'x' ){
			$("#PasswordError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Please specify the property!</div>');
			$(this).val('')
			return false;
		}
		var id = $(this).attr('rel');
		var uploaded_file = $(this).val();
		var extension = uploaded_file.split('.').pop(); 
		$(".loadings").fadeIn('slow');
		$(".uploadform").ajaxForm({ 
					 complete: function(response) { 
						console.log(response.responseText);
						var result = $.parseJSON(response.responseText);
						
						if(result.status == 'success') {
							$(".loadings").fadeOut('slow');
							var html = '<li class="banner-thumb item_'+result.banner_id+'"><a href="javascript:void(0);" onClick="removeBannerImg('+result.banner_id+');" class="remove-banner"><img class="" src="<?php echo $this->config->item('admin_template');?>images/remove-icon.png" alt="remove" title="Remove Image" /></a><a href="'+result.file_url+'" target="_blank"><img src="'+result.file_url+'"></a></li>';
							$(".images-list > li:last").before(html);
							$(".loadings").fadeOut('slow');
									
							
						}
						else{
							$(".loadings").fadeOut('slow');
							$("#PasswordError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>'+result.message+'</div>');	
							
							return false;	
						}
							
       				},
					error : function() { 
							$(".loadings").fadeOut('slow');
							$("#PasswordError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong> Server not responding..!</div>');
					}
				}).submit();
		
	
	});
	//***********END : UPLOAD IMAGE *********************//
	//********* SELECT FROM EXISTING ***********/
	$('.selectExist').click(function(e) {
        $('#myModal').modal('show');
		$('.modal-body').html('');
		$('.modal-body').load('<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/images');
    });
	
	
	$('#menus_id').change(function(){
		var id = $(this).val();
		if(id > 0 ){
			window.location='<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/banner/'+id;
		}
	});
});
</script> 
<script type="text/javascript" src="<?php echo $this->config->item('admin_template');?>js/jquery.form.js"></script>