<?php $this->load->view('admin/sidebar');?>
<link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>plugins/toggle-switch/toggle-switch.css" />
<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1>Job Applications</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Job Applications</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <span class="pull-right">
                  		Filter :                         
                        <select name="filter1" id="filter1" class="medium-list filter">
                        	<option value="all">All Jobs</option>
                            <?php foreach($filterjobs as $filterjob ) : ?> 
                            	<option<?php if($this->uri->segment(4) ==  $filterjob->jobs_id) : ?> selected="selected"<?php endif;?>
                            		value="<?php echo $filterjob->jobs_id;?>"><?php echo $filterjob->jobs_position;?></option>
                            <?php endforeach;?>
                        </select>
                        <select class="small-list filter" id="filter2" name="filter2">
                        	<option value="all">All Status</option>
                            <option value="1"<?php if($this->uri->segment(5) == '1') : ?> selected="selected"<?php endif;?>>New</option>
                             <option value="2"<?php if($this->uri->segment(5) == '2') : ?> selected="selected"<?php endif;?>>Rejected</option>
                            <option value="3"<?php if($this->uri->segment(5) == '3'):?> selected="selected"<?php endif;?>>Selected</option>
                           
                        </select>&nbsp;&nbsp;&nbsp;
                        <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/lists">&laquo;&nbsp;Back to jobs</a>
                 </span>
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
                    <!-- /.box-header -->
                    <div class="box-body">
                    	
                      <table id="propertyTable" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th width="5%" class="center">SL</th>
                            <th width="10%">Actions </th>
                            <th width="23%">Job</th>
                            <th width="18%">Name</th>
                            <th width="15%">Submitted Time</th>
                            <th width="10%">Resume</th>
                            <th width="19%">Status</th>
                          </tr>
                        </thead>
                         <tbody>
                        <?php foreach($applications as $applic) : $i++;?>
                        <tr id="tr_<?php echo  $applic->applicants_id;?>">
                          <td><?php echo  $i;?></td>
                          <td>
						  	  <a href="javascript:" class="mg0_10 delete icon-font gray" data-id="<?php echo  $applic->applicants_id;?>"  title="Click to delete"><i class="fa fa-trash"></i></a>
                               <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/application/<?php echo  $applic->applicants_id;?>"  class="mg0_10 icon-font red editJob" data-id="<?php echo  $applic->applicants_id;?>"  title="Click to view"><i class="fa fa-eye" aria-hidden="true"></i></a>                          
                                </td>
                          <td><?php printr($applic->job." - ".$applic->applicants_jobs_id);?></td>
                          <td><?php printr($applic->applicants_fname.' '.$applic->applicants_lname);?></td>
                          <td><?php echo date("M d, Y", $applic->applicants_applied_time); ?></td>
                          <td><a <?php if($applic->applicants_cv):?>target="_blank"<?php endif;?> href="<?php echo $applic->applicants_cv? base_url().'assets/uploads/cv/'. $applic->applicants_cv:'javascript:alert(\'There is no resumes..\')' ;?>">Download</a></td>
                          <td>
                          <?php if($applic->applicants_status == 1 ) $st = 'New';
						  			elseif($applic->applicants_status == 2 ) $st = 'Rejected';
									elseif($applic->applicants_status == 3 ) $st = 'Selected'; ?>
						  <div class="switch-toggle switch-3 switch-candy" title="current status:<?php echo $st;?>">
                          		<input class="statusChange" id="new<?php echo  $applic->applicants_id;?>" name="applicants_status[<?php echo  $applic->applicants_id;?>]" type="radio" <?php if($applic->applicants_status == 1 ) echo 'checked="checked"';?>  data-id="<?php echo  $applic->applicants_id;?>" value="1" />
                                <label class="disabled" for="new<?php echo  $applic->applicants_id;?>" onclick="">New</label>
                                <input class="statusChange" id="shorted<?php echo  $applic->applicants_id;?>" name="applicants_status[<?php echo  $applic->applicants_id;?>]" type="radio"  <?php if($applic->applicants_status == 3 ) echo 'checked="checked"';?> data-id="<?php echo  $applic->applicants_id;?>" value="3" />
                                <label for="shorted<?php echo  $applic->applicants_id;?>" onclick="">Selected</label>
                                <input class="statusChange" id="rejected<?php echo  $applic->applicants_id;?>" name="applicants_status[<?php echo  $applic->applicants_id;?>]" type="radio" <?php if($applic->applicants_status == 2 ) echo 'checked="checked"';?> data-id="<?php echo  $applic->applicants_id;?>" value="2" />
                                <label for="rejected<?php echo  $applic->applicants_id;?>" onclick="">Rejected</label>
                            
                                <a></a>
                            </div>
						  </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                        <tr><td colspan="8"><?php echo $this->pagination->create_links();?></td></tr>
                        
                      </table>
                    </div>
                    <!-- /.box-body -->
          	</div>
         </div>
    </div>
 </section>
 
</div>
<script type="application/javascript">
$(document).ready(function(e) {
   
     $('.statusChange').click(function(){ 
		 //if(confirm("Are you sure to change status of this job application?")){
			var id		= $(this).data('id');	
			var status	= $(this).val();	
			var $this 	= $(this);
			
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/ap_status",
					 data:{id:id, status:status, ajax:true},
					 type:"POST",
					 dataType:"json",
					 error: function(){
						alert('Internal server error.!!');
						location.reload(); 
					 },
					 success: function(data){
							if(data.status == 'success'){
								$('#new'+id).removeAttr('checked');
								$('#shorted'+id).removeAttr('checked');
								$('#rejected'+id).removeAttr('checked');
								$this.attr('checked',true);
								return true;
								
							}
							else{
								alert(data.message);
								location.reload();
							}	
					 }
					 
			});
		// }
		 return false;
	 });
	 $('.delete').click(function(){
		 if(confirm("Are you sure to remove this job application?")){
			var id		= $(this).data('id');	 
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/ap_remove",
					 data:{id:id, status:status, ajax:true},
					 type:"POST",
					 dataType:"json",
					 error: function(){
						alert('Internal server error.!!');
						location.reload(); 
					 },
					 success: function(data){
							$this.html('<i class="fa fa-trash"></i>');
							if(data.status == 'success'){
								$('#tr_'+id).css("background-color","#E5E5E5").fadeOut(500, function(){ 
									$(this).remove();
									$("#propertyTable").dataTable();
								});
								
							}
							else{
								alert(data.message);
								location.reload();
							}	
					 }
					 
			});
		 }
		 return false;
	 });
	 $('.filter').change(function(){ 
	 	var id = $('#filter1').val();
		var status = $('#filter2').val();
		window.location = '<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/job/applications/'+id+'/'+status
	 });
});
</script>