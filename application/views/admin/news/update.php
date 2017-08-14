<script src="<?php echo $this->config->item('admin_template');?>plugins/ckeditor/ckeditor.js"></script>
<?php $this->load->view('admin/sidebar');
?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage News</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add/Edit News</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/news/lists" class="pull-right">Back to list</a>
                </div>
                <div id="mesSages">
                
                	<?php if($error ) : ?>
                        <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo $error;?></div>
                    <?php endif;?>
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
                </div>
				<div class="box-body">
                	<div class=" col-md-9 col-xs-9 col-sm-12">
                      <form role="form" action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                        <label for="name">News Title<span class="red">*</span></label>
                                        <input type="text" required placeholder="Enter title" id="breakingnews_title" name="breakingnews_title" class="form-control" value="<?php echo $news->breakingnews_title;?>">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                        <label for="position">News URL</label>
                                        <input type="text" placeholder="Enter URL" id="breakingnews_link" name="breakingnews_link" class="form-control" value="<?php echo $news->breakingnews_link;?>">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                        <label for="details">Details</label>
                                        <textarea class="form-control" name="breakingnews_news" id="breakingnews_news"><?php printR( $news->breakingnews_news) ;?></textarea>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                	
                                <div class="form-group">
                                	<div class="col-md-8 col-sm-6">	
                                        <label for="file_name">Image</label>
                                        <input type="file" name="userfile" id="userfile" />
                                        <small class="red">*Allowed types are .jpg, .png, .gif</small><br/>
                                        <small class="red">*Minimum resolution 100X100</small><br/> 
                                    	<small class="red">*Maximum size 2MB</small><br/> 
                                         <?php if($news->breakingnews_image != '' && file_exists('assets/images/latestnews/'.$news->breakingnews_image)):?>
                                         <a href="<?php echo base_url().'assets/images/latestnews/'.$news->breakingnews_image;?>" target="_blank" title="Click here to view"><img src="<?php echo base_url().'assets/images/latestnews/'.$news->breakingnews_image;?>" alt="Old File" width="150" style="border:1px solid #999;" /></a>
                                         <?php endif;?>
                                        <input type="hidden" value="<?php echo $news->breakingnews_image;?>" name="breakingnews_image" id="breakingnews_image">
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                    <input type="hidden" name="id" id="id" value="<?php echo $news->breakingnews_id;?>" />
                                    <button type="submit" class="btn btn-icon btn-primary pull-right" id="">Submit</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                      </form>
                    </div>
                  </div>
            </div>
         </div>
      </div>
 </section>
</div>
<script type="text/javascript">
$(function () {
    var editor = CKEDITOR.replace('breakingnews_news');
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
	
});

</script>