
<?php $this->load->view('admin/sidebar');?>
<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Email templates </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Email templates</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
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
                      <table id="emailTable" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th width="5%" class="center">SL</th>
                            <th width="15%">Actions </th>
                            <th width="45%">Email title</th>
                            <th width="30%">Subject</th>
                            <th width="5%">ID</th>
                          </tr>
                        </thead>
                         <tbody>
                        <?php foreach($emails as $email) : $i++;?>
                        <tr id="tr_<?php echo  $email->email_id;?>">
                          <td><?php echo  $i;?></td>
                          <td>
						  	  
                               <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/setting/email_edit/<?php echo  $email->email_id;?>" class="mg0_10 icon-font red" data-id="<?php echo  $email->email_id;?>"  title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                               
                               <?php if($email->status == 'Y' ):?>
                                <a href="javascript:" class="mg0_10 status icon-font green" data-id="<?php echo  $email->email_id;?>" data-status="<?php echo  $email->status;?>" title="Click to disable"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php else :?>
                          		
                                <a href="javascript:" class="mg0_10 status icon-font hash" data-id="<?php echo  $email->email_id;?>" data-status="<?php echo  $email->status;?>" title="Click to Enable"  ><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php endif ;?>
                          
                                </td>
                          <td><?php printr($email->email_title);?></td>
                          <td><?php printr($email->email_subject);?></td>
                          <td><?php echo  $email->email_id;?></td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                        
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
    $('.status').click(function(){
		if(confirm("Are you sure to change status of this email?")){
			var id		= $(this).data('id');	
			var status 	= $(this).data('status');	
			
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"../setting/email_status",
					 data:{id:id, status:status},
					 type:"POST",
					 dataType:"json",
					 error: function(){
						alert('Internal server error.!!');
						location.reload(); 
					 },
					 success: function(data){
						 	$this.html('<i class="fa fa-check-square"></i>');
							if(data.status == 'success'){
								$this.removeClass((status=='Y')?'green':'hash');
								$this.addClass((status=='Y')?'hash':'green');
								$this.data('status',(status=='Y')?'N':'Y');
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
	
	 $('.delete').click(function(){
		 if(confirm("Are you sure to remove this email?")){
			var id		= $(this).data('id');	 
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"../setting/email_remove",
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
									
									//$("#emailTable").dataTable();
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
});
</script>
