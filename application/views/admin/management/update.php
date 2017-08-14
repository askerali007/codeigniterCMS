<script src="<?php echo $this->config->item('admin_template');?>plugins/ckeditor/ckeditor.js"></script>
<?php $this->load->view('admin/sidebar');
?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage Managements</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add/Edit Management</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/lists" class="pull-right">Back to list</a>
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
                	<div class=" col-md-8 col-xs-8 col-sm-12">
                      <form role="form" action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                        <label for="name">Title<span class="red">*</span></label>
                                        <input type="text" required placeholder="Enter management name" id="name" name="name" class="form-control" value="<?php echo $management->name;?>">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                        <label for="position">Position</label>
                                        <input type="text" placeholder="Enter position" id="position" name="position" class="form-control" value="<?php echo $management->position;?>">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                        <label for="details">Profile details</label>
                                        <textarea class="form-control" name="details" id="details"><?php printR( $management->details) ;?></textarea>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                	
                                <div class="form-group">
                                	<div class="col-md-8 col-sm-6">	
                                        <label for="file_name">Profile Pic</label>
                                        <input type="file" name="userfile" id="userfile" <?php if(!$management->team_id):?>required="required"<?php endif;?>>
                                        <small class="red">*Allowed types are .jpg, .png, .gif</small><br/>
                                        <small class="red">*Minimum resolution 100X100</small><br/> 
                                    	<small class="red">*Maximum size 2MB</small><br/> 
                                         <?php if($management->profile_pic != '' && file_exists('assets/images/team/'.$management->profile_pic)):?>
                                         <a href="<?php echo base_url().'assets/images/team/'.$management->profile_pic;?>" target="_blank" title="Click here to view"><img src="<?php echo base_url().'assets/images/team/'.$management->profile_pic;?>" alt="Old File" width="150" style="border:1px solid #999;" /></a>
                                         <?php endif;?>
                                        <input type="hidden" value="<?php echo $management->profile_pic;?>" name="profile_pic" id="profile_pic">
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                    <input type="hidden" name="id" id="id" value="<?php echo $management->team_id;?>" />
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
    var editor = CKEDITOR.replace('details');
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