
<?php $this->load->view('admin/sidebar');
?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Job Application</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Application</li>
    </ol>
  </section>
 <section class="content">
              <div class="row">
                <div class="col-xs-12">
                	<div id="mesSages">
							<?php if($error ) : ?>
                                <div class="alert alert-error">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <?php echo $error;?></div>
                            <?php endif;?>
                            
                            <?php if($success ) : ?>
                                <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <?php echo $success;?></div>
                            <?php endif;?>
                        </div>
                    <div class="box">
                    	
                        <div class="box-header">
                        <div class="row">
                        	<div class=" col-md-6 col-xs-6 col-sm-12">
                          		<h3 class="box-title"> Job ID : <?php echo $applic->applicants_jobs_id;?></h3>
                                <div class="small-font">Submitted on&nbsp;:<?php echo date("M d, Y", $applic->applicants_applied_time); ?></div>
                          	</div>
                            <div class=" col-md-3 col-xs-3 col-sm-6">
                            <form role="form" action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                            Status: <select class="small-list" id="applicants_status" name="applicants_status">
                                    <option value="1"<?php if($applic->applicants_status == '1') : ?> selected="selected"<?php endif;?>>New</option>
                                    <option value="2"<?php if($applic->applicants_status == '2') : ?> selected="selected"<?php endif;?>>Rejected</option>
                                    <option value="3"<?php if($applic->applicants_status == '3') : ?> selected="selected"<?php endif;?>>Selected</option>     
                                    
                             </select>&nbsp;<button type="submit" class="btn btn-primary">Update</button>
                             </form>
                            </div>
                            <div class=" col-md-3 col-xs-3 col-sm-6">
                          		<a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/applications" class="pull-right">Back to list</a><div class="clearfix"></div>
                          		<div class="small-font pull-right">IP : <?php echo $applic->applicants_ip;?></div>
                           	</div>
                       </div>
                    </div>
                 </div>
              </div>
      			<div class="row">
               		<div class=" col-md-12 col-xs-12 col-sm-12">
                       <div class="box box-solid">
                            <div class="box-header with-border">
                              <i class="fa fa-user"></i>
                              <h3 class="box-title">Personal Data</h3>
                              <span class="pull-right"><a target="_blank" href="<?php echo base_url();?>assets/uploads/cv/<?php printR( $applic->applicants_cv );?>">Download Resume</a></span>
                            </div>
                            <div class="box-body">
                            	<div class=" col-md-6 col-xs-6 col-sm-12">
                              		<dl class="dl-horizontal">
                                        <dt>First Name&nbsp;:</dt>
                                        <dd><?php printR( $applic->applicants_fname );?></dd>
                                        <dt>Last Name&nbsp;:</dt>
                                        <dd><?php printR( $applic->applicants_lname );?></dd>
                                        <dt>Phone</dt>
                                        <dd><?php printR( $applic->applicants_phone );?></dd>
                                        <dt>Email</dt>
                                        <dd><?php printR( $applic->applicants_email );?></dd>                                        
                                      </dl>
                            </div>
                                <div class=" col-md-6 col-xs-6 col-sm-12">
                                        <dl class="dl-horizontal">
                                            <dt>Date of Birth&nbsp;:</dt>
                                            <dd><?php printR($applic->applicants_dob); ?></dd>
                                            <dt>Nationality</dt>
                                       		<dd><?php printR( $applic->applicants_country );?></dd>
                                            
                                          </dl>
                                </div>
                            </div>
                        </div>
                     </div>
               	</div>
               
                <div class="row">
               		<div class=" col-md-12 col-xs-12 col-sm-12">
                       <div class="box box-solid">
                            <div class="box-header with-border">
                              <i class="fa fa-area-chart"></i>
                              <h3 class="box-title">Other Informations</h3>
                            </div>
                            <div class="box-body">
                            	<div class=" col-md-6 col-xs-6 col-sm-12">
                              		<dl class="dl-horizontal">
                                        <dt>Message&nbsp;:</dt>
                                        <dd><?php printR( $applic->applicants_address );?></dd>
                                      </dl>
                                   <dl class="dl-horizontal">
                                        <dt>Resume</dt>
                                        <dd><a target="_blank" href="<?php echo base_url();?>assets/uploads/cv/<?php printR( $applic->applicants_cv );?>">View Resume</a></dd>
                                      </dl>
                            </div>
                                
                            </div>
                        </div>
                     </div>
               	</div>
 </section>
</div>
