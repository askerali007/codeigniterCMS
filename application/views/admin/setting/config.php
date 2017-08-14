
<?php $this->load->view('admin/sidebar'); ?>
<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage Config Values </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>cc-admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Config Values</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
      <form role="form" action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
          <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                 
                </div>
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
                </div>
					<div class="box-body">
                <?php foreach($configs as $config) : ?>
                <div class="col-md-6 col-sm-6">
                	<div class="form-group">                    	
                        
                      		<label for="country_id"><?php echo $config->config_title;?></label>
                            <?php switch($config->type) { 
                            		
									case 'select' : ?>
                      		<select name="<?php echo $config->config_var;?>" id="<?php echo $config->config_var;?>" class="form-control" required>
                            	<?php $options = explode(',', $config->options);
                                 foreach($options as $option) :?>
                                <option value="<?=$option?>"<?php if($option == $config->config_value) : ?> selected="selected"<?php endif;?>><?=$option?></option>
                                <?php endforeach; ?>
                              </select>
                            <?php break; ?>
                            <?php case 'textarea' : 
								 default :	?>
                                 <textarea id="<?php echo $config->config_var;?>" name="<?php echo $config->config_var;?>" class="form-control details_text" ><?php printR( $config->config_value );?></textarea>
                            <?php break; ?>
                            <?php case 'text' : 
								 default :	?>
                                 <input type="text" placeholder="Config value" id="<?php echo $config->config_var;?>" name="<?php echo $config->config_var;?>" value="<?php printR( $config->config_value );?>" class="form-control" required="required"> 
                            <?php break; ?>
                            
                            <?php } ?>
                    </div>
                    <div class="cleafix"></div>
                 </div>
                 
                <?php endforeach;?>
              </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                      </div>
            </div>
         
        </div>
         </form>
    </div>
  </section>
</div>
<script>
$(document).ready(function(){
		

    });
</script>