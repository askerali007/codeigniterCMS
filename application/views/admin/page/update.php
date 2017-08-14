<script src="<?php echo $this->config->item('admin_template');?>plugins/ckeditor/ckeditor.js"></script>
<?php $this->load->view('admin/sidebar');
?>
<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1>Add/Edit Page</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add/Edit Page</li>
    </ol>
  </section>
<section class="content">
      <div class="row">
        
            <form role="form" id="pageFrm" action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="col-xs-9">
                <div class="box">
                	<div class="box-header"></div>
                    <div id="mesSages">
                        <?php if($this->session->flashdata('error') ) : ?>
                            <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo $this->session->flashdata('error');?></div>
                        <?php endif;?>
                        <?php if($this->session->flashdata('success') ) : ?>
                            <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo $this->session->flashdata('success');?></div>
                        <?php endif;?>
                        <?php foreach( $errors as $err ) : ?>
                        <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo $err;?></div>
                    <?php endforeach;?>
                    </div>         
                <div class="box-body">
                  <div class="form-group">
                    <div class="col-md-12 col-sm-12">
                      <label for="page_title">Page Headline</label>
                      <input type="text" placeholder="Page title" id="page_title" name="page_title_en" value="<?php purify($page->page_title_en);?>" class="form-control" autocomplete="off" required="required">
                      <span id="slug_area" class="<?php echo $page->page_id?'':'hide';?>"> <strong>Page Url :</strong> 
					  <?php echo base_url();?><span id="page_url"><?=$page->page_name?></span>
                      <input type="hidden"  name="page_name" value="<?=$page->page_name?>" id="page_name" style="width:200px;" >
                      <img src="<?php echo base_url();?>assets/img/loading.gif" alt="loading" class="hide" id="loader"/>
                      <button class="btn hide" type="button" id="save_pagename">Ok</button>
                      <button class="btn" type="button" id="edit_pagename">Edit</button>
                      </span> </div>
                      
                    <div class="cleafix"></div>
                  </div>
                  <div class="form-group">
                        <div class="col-md-12 col-sm-12">
                        <label for="detail">Page excerpt</label>
                        <textarea id="page_excerpt" name="page_excerpt_en" class="form-control details_text" ><?php printR($page->page_excerpt_en);?></textarea>
                        </div>
                        <div class="cleafix"></div>
                   </div>
                 
                   <?php if($page->parent_id > 0 || empty($page->page_id) ) : ?>
                  <div class="form-group">
                    <div class="col-md-12 col-sm-12">
                      <label for="detail">Page Content</label>
                      <textarea id="page_content" name="page_content_en" class="form-control details_text" ><?php printR($page->page_content_en);?></textarea>
                    </div>
                    <div class="cleafix"></div>
                  </div>
                  <?php endif;?>
                </div>
              
            </div>
                <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title">Metadata for SEO</h3>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                            <label for="detail">Page Title</label>
                            
                            <input type="text" placeholder="Page title" id="meta_title" name="meta_title" value="<?php purify($page->meta_title);?>" class="form-control" >
                            </div>
                            <div class="cleafix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                            <label for="detail">Meta keywords</label>
                            <textarea id="meta_key" name="meta_key" class="form-control details_text" ><?php printR($page->meta_key);?></textarea>
                            </div>
                            <div class="cleafix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                            <label for="detail">Meta Description</label>
                            <textarea id="meta_desc" name="meta_desc" class="form-control details_text" ><?php printR($page->meta_desc); ?></textarea>
                            </div>
                            <div class="cleafix"></div>
                        </div>
                      <!-- /.box-body -->
                      <div class="box-footer"> <button type="button" class="btn btn-primary pull-right <?php echo $page->page_id?'':'hide';?>" id="meta_dataBtn">Save change</button></div>
                      <!-- /.box-footer--> 
                    </div>
              </div>
           </div>
           <div class="col-xs-3">
           		<div class="box">
                		<div class="box-header">
                     		<a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/lists" class="pull-left">Back to list</a>
                    		<input type="hidden"  name="page_id" id="page_id" value="<?=$page->page_id?>" >
                          	<button type="submit" class="btn btn-primary pull-right">Save</button>	
                        	
                        </div>
                        <div class="box-footer">
                          	
                        
                        	<div class="form-group">
                              <div class="col-xs-12">
                              <label for="parent_id">Parent page</label>
                              <select class="form-control" id="parent_id" name="parent_id">
                                    <?php if($this->config->item('new_parent_page') == 'Yes' || ($page->page_id > 0 && $page->parent_id == 0) ):?>
                                    <option value="">-None-</option>
                                    <?php endif;?>
                                    <?php foreach($parent_pages as $parent_page) : ?>
                                    <option value="<?php echo $parent_page->page_id;?>"<?php if($page->parent_id == $parent_page->page_id) : ?> selected="selected"<?php endif;?>><?php printR($parent_page->page_title_en);?></option>
                                    <?php  endforeach;?>
                             </select>
                             <?php if($page->parent_id > 0 ) : ?>
                             <label for="exclude_menu" class="pull-right">Is it primary content?&nbsp;<input type="checkbox" name="is_primary" id="is_primary" value="Y"<?php if($page->is_primary == 'Y') : ?> checked="checked"<?php endif;?> /></label> <div class="cleafix"></div>			<?php endif; ?>
                              </div>
                              <div class="cleafix"></div>
                            </div>
                         	<div class="form-group">
                              <div class="col-md-12 col-sm-12">
                                <label for="thumb">Thumbnail</label>
                                     <input type="file" name="fl_thumb" id="fl_thumb" />
                                     <small class="red">*Types : .jpg, .png, .gif</small><br/>
                                     <small class="red">*Resolution 200 X 200</small><br/>
                                 
                                <?php if($page->thumb != '' && file_exists('assets/images/thumb/'.$page->thumb)):?>
                                    <div class="col-md-12 col-sm-12">
                                    <a href="javascript:" id="removeBanner" class="red"><i class="fa fa-trash"></i></a>
                                      <a href="<?php echo base_url().'assets/images/thumb/'.$page->thumb;?>" target="_blank" title="Click to view large">
                                      <img src="<?php echo base_url().'assets/images/thumb/'.$page->thumb;?>" alt="Old File" width="120"/>
                                      </a>
                                        <input type="hidden" value="<?php echo $page->thumb;?>" name="thumb" id="thumb">
                                    </div>
                                <?php endif;?>
                                
                                </div>
                                <div class="cleafix"></div>
                            </div>
                          	<div class="form-group">
                                <div class="col-xs-12">
                                <label for="featured_image">Featured Image</label>
                                <input type="file" name="fl_featured_image" id="fl_featured_image" />
                                <small class="red">*Types : .jpg, .png and .gif</small>
                                <div class="col-md-12 col-sm-12 pad_10">
                                    <?php if($page->featured_image != '' && file_exists('assets/images/featured/'.$page->featured_image)):?>
                                    <a href="<?php echo base_url().'assets/images/featured/'.$page->featured_image;?>" target="_blank" title="Click to view large">
                                        <img src="<?php echo base_url().'assets/images/featured/'.$page->featured_image;?>" alt="featured" width="120" /> </a>
                                    <input type="hidden" value="<?php echo $page->featured_image;?>" name="featured_image" id="featured_image">
                                    	
                                        
                                    <?php endif;?>
                                </div>
                                
                                </div>
                                <div class="cleafix"></div>
                            </div>
                      </div>
                   
                </div>
           </div>
            </form>
    	
     </div>
  </section>
</div>
<script>

$(function () {
    var editor = CKEDITOR.replace('page_content');
	var editor2 = CKEDITOR.replace('page_excerpt');
	CKEDITOR.config.extraAllowedContent = 'div(*)';
	CKEDITOR.config.allowedContent = true;
	CKEDITOR.config.height = '200px';
	CKEDITOR.config.toolbar= [
             	[ 'Font', 'FontSize', 'TextColor' ],
                [ 'Bold', 'Italic', 'Underline', 'Strike' ],
                [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ],
                [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent' ],
                [ 'PasteText', 'PasteFromWord' ],
                [ 'Table', 'HorizontalRule', 'Templates', 'Source' ]
        ];
		
	editor.on('key', function () {
		window.onbeforeunload = function(){
			return "Do you want to leave?"
		}
	} );
});

$(document).ready(function(e) {
	$('#page_title').keyup(function(e) {
		if($(this).val() != '' ){
		 $('#slug_area').removeClass('hide');	
		}
		if($('#page_id').val() == '' ){
			 var Text  = $('#page_title').val();
			 var name  =  Text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
			 $('#page_url').html(name);
			 $('#page_name').val(name);
			 return ;
		}
	});
	
    $('#edit_pagename').click(function(e) {
		$('#page_url').addClass('hide');
	    $('#page_name').attr('type','text');
	    $(this).addClass('hide');
        $('#save_pagename').removeClass('hide');
    });
	$('#save_pagename').click(function(e) {
		var $this = $(this);
		$('#loader').removeClass('hide');
		$.getJSON('<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/check_name',{name:$('#page_name').val(),page_id : '<?=$page->page_id?>'},function(data){
			$('#loader').addClass('hide');
			$('#page_name').val(data.value).attr('type','hidden');
			$('#page_url').removeClass('hide').html($('#page_name').val());
        	$('#edit_pagename').removeClass('hide');
			$this.addClass('hide');			
			
		});
	    
    });
	
	$('#meta_dataBtn').click(function(e) {
		$(this).html('Please wait..');
		$(this).attr('disabled',true);
		var $this  = $(this);
		$.ajax({
			url :'<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/meta',
			type:'POST',
			dataType:"json",
			data : {meta_title:$('#meta_title').val(), meta_key:$('#meta_key').val(), meta_desc:$('#meta_desc').val(),page_id : '<?=$page->page_id?>'},
			success: function(data){
				$this.removeAttr('disabled');	
				$this.html('Save change');
			},
			error: function(){
				alert("Server not responding!!.");
				$this.removeAttr('disabled');	
				$this.html('Save change');
			}
			
		});
	});
	
	
	$('#page_title').keypress(function(e) {
		window.onbeforeunload = function(){
			return "Do you want to leave?"
		}
	});
	
	$('#pageFrm').submit(function(e) {
		window.onbeforeunload = null;
	});
	
});
</script>