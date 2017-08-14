<script src="<?php echo $this->config->item('admin_template');?>plugins/ckeditor/ckeditor.js"></script>
<?php $this->load->view('admin/sidebar');
?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage User</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add/Edit User</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/lists" class="pull-right">Back to list</a>
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
                	<div class=" col-md-12 col-xs-12 col-sm-12">
                      <form role="form" action="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/update/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                        <label for="name">Job Position<span class="red">*</span></label>
                                        <input type="text" required placeholder="Enter Job Position" id="jobs_position" name="jobs_position" class="form-control" value="<?php echo $job->jobs_position;?>">
                                    </div>
                                   
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                               	  <div class=" col-md-4 col-xs-4 col-sm-4">
                                  <label for="email">Reporting to<span class="red">*</span></label>
                                   <input type="text" required placeholder="Enter Reporting to" id="jobs_reportingto" name="jobs_reportingto" class="form-control" value="<?php echo $job->jobs_reportingto;?>">
                                  </div>
                                  <div class=" col-md-4 col-xs-4 col-sm-4">
                                  <label for="email">Department<span class="red">*</span></label>
                                   <input type="text" required placeholder="Enter Department" id="jobs_department" name="jobs_department" class="form-control" value="<?php echo $job->jobs_department;?>">
                                  </div>
                                  
                                  	<div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                  <div class=" col-md-4 col-xs-4 col-sm-4">
                                  <label for="email">Type<span class="red">*</span></label>
                                   <select name="jobs_type" id="jobs_type" class="form-control">                            
                                    <option value="1"<?php if($job->jobs_type == '1'):?> selected="selected"<?php endif; ?>>Permanent</option>
                                    <option value="2"<?php if($job->jobs_type == '2'):?> selected="selected"<?php endif; ?>>Contract</option>
                                   </select>
                                  </div>
                                  <div class=" col-md-4 col-xs-4 col-sm-4">
                                  <label for="email">Location<span class="red">*</span></label>
                                   <input type="text" required placeholder="Enter jobs location" id="jobs_location" name="jobs_location" class="form-control" value="<?php echo $job->jobs_location;?>">
                                  </div>
                                  	<div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                	<div class=" col-md-12 col-xs-12 col-sm-12">
                                  		<label for="jobs_purpose">Jobs Purpose</label>
                                  		<textarea id="jobs_purpose" name="jobs_purpose" class="form-control details_text" ><?php printR($job->jobs_purpose);?></textarea>
                                    </div>
                                    <div class="clearfix"> <br/><br/></div>
                                 </div>                                
                                <div class="form-group">
                                	<div class=" col-md-12 col-xs-12 col-sm-12">
                                  		<label for="jobs_responsibilities">Jobs Responsibilities</label>
                                  		<textarea id="jobs_responsibilities" name="jobs_responsibilities" class="form-control details_text" ><?php printR($job->jobs_responsibilities);?></textarea>
                                    </div>
                                    <div class="clearfix"> <br/><br/></div>
                                 </div>
                                <div class="form-group">
                                	<div class=" col-md-12 col-xs-12 col-sm-12">
                                  		<label for="jobs_requirements">Jobs Requirements</label>
                                  		<textarea id="jobs_requirements" name="jobs_requirements" class="form-control details_text" ><?php printR($job->jobs_requirements);?></textarea>
                                    </div>
                                    <div class="clearfix"> <br/><br/></div>
                                 </div>
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                    <input type="hidden" name="jobs_id" id="jobs_id" value="<?php echo $job->jobs_id;?>" />
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
$(document).ready(function() {
	$(function () {
    CKEDITOR.replace('jobs_purpose');
	CKEDITOR.replace('jobs_responsibilities');
	CKEDITOR.replace('jobs_requirements');
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
$('#country_id').change(function(){
	
	
		var cntr = $(this).val();
		var $this = $(this);
		if(cntr > 0 ){
			$.getJSON('<?php echo base_url();?>admin/landmark/cities/'+cntr,function(response){
				if(response.status == 'success'){
					$('#city_id').html(response.result);
				}
				else if(response.status == 'nocity'){
					alert(response.message);
					$this.val('');	
					
					return false;
				}
				else{
					$this.val('');	
					alert('Error : '+response.message);	
					return false;
				}
			}).fail(function(){
					alert('Error : Server error occured.!!');	
					return false;
			});
			
		}
	});
	
});

</script> 