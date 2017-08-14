<script src="<?php echo $this->config->item('admin_template');?>plugins/ckeditor/ckeditor.js"></script>
<?php $this->load->view('admin/sidebar');
?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage History</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add/Edit History</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/history/lists" class="pull-right">Back to list</a>
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
                                    <div class=" col-md-3 col-xs-3 col-sm-6">
                                        <label for="name">Year<span class="red">*</span></label>
                                        <select class="form-control" name="history_year" id="history_year" required>
                                        <option value="">Select year</option>
                                       	<?php for($i=date("Y"); $i >=1970; $i--) :?>
                                        <option <?php if($history->history_year == $i):?> selected="selected"<?php endif;?>
                                        	 value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php endfor; ?>
                                        </select>
                                        
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                        <label for="details">History Content</label>
                                        <textarea class="form-control" name="history_content" id="history_content"><?php printR( $history->history_content) ;?></textarea>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                	
                                <div class="form-group">
                                	<div class="col-md-8 col-sm-6">	
                                        <label for="file_name">Image</label>
                                        <input type="file" name="userfile" id="userfile" <?php if(!$history->history_id):?> required="required"<?php endif; ?> />
                                        <small class="red">*Allowed types are .jpg, .png, .gif</small><br/>
                                        <small class="red">*Minimum resolution 300X120</small><br/> 
                                    	<small class="red">*Maximum size 2MB</small><br/> 
                                         <?php if($history->history_image != '' && file_exists('assets/images/history/'.$history->history_image)):?>
                                         <a href="<?php echo base_url().'assets/images/history/'.$history->history_image;?>" target="_blank" title="Click here to view"><img src="<?php echo base_url().'assets/images/history/'.$history->history_image;?>" alt="Old File" width="150" style="border:1px solid #999;" /></a>
                                         <?php endif;?>
                                        <input type="hidden" value="<?php echo $history->history_image;?>" name="history_image" id="history_image">
                                    </div>
                                    <div class="clearfix"></div>
                                 </div>
                                
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                    <input type="hidden" name="id" id="id" value="<?php echo $history->history_id;?>" />
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
