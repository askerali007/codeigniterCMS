 <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>plugins/datatables/dataTables.bootstrap.css">
<?php $this->load->view('admin/sidebar');?>
<div class="content-wrapper" style="min-height:646px;">
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Manage Landmarks</h3>
                   <?php if($this->session->userdata('role') == 'SUPER ADMIN' ) : ?>
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/user/add_admin" id="addAdmin" class="btn btn-primary pull-right">Add Admin</a>
                  <?php endif;?>
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
                            <?php if($this->session->userdata('role') == 'SUPER ADMIN' ) : ?>
                            <th width="16%">Actions </th>
                            <?php endif;?>
                            <th width="18%">Full name</th>
                            <th width="12%">User name</th>
                            <th width="14%">Created on</th>
                            <th width="22%">Last visited</th>
                            <th width="13%">Role</th>
                            
                          </tr>
                        </thead>
                         <tbody>
                        <?php foreach($admins as $admin) : $i++;?>
                        <tr id="tr_<?php echo $admin->id;?>">
                          <td><?php echo  $i;?></td>
                          <?php if($this->session->userdata('role') == 'SUPER ADMIN' ) : ?>
                          <td>
                          <?php if($admin->role != 'SUPER ADMIN' ) :?>
						  	  <a href="javascript:" class="mg0_10 delete icon-font gray" data-id="<?php echo $admin->id;?>" data-status="<?php echo $admin->status;?>" title="Click to disable"><i class="fa fa-trash"></i></a>
                          <?php else: ?>
                          <a href="javascript:" class="mg0_10 not-active icon-font gray" data-id="<?php echo $admin->id;?>" data-status="<?php echo $admin->status;?>" title="Click to disable"><i class="fa fa-trash"></i></a>
                           <?php endif;?>
                               <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/user/add_admin/<?php echo $admin->id;?>"  class="mg0_10 icon-font red" data-id="<?php echo $admin->id;?>"  title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                             <?php if($admin->role != 'SUPER ADMIN' ) :?> 
                               <?php if($admin->status == 'Y' ):?>
                                <a href="javascript:" class="mg0_10 status icon-font green" data-id="<?php echo $admin->id;?>" data-status="<?php echo $admin->status;?>" title="Click to disable"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php else :?>
                          		
                                <a href="javascript:" class="mg0_10 status icon-font hash" data-id="<?php echo $admin->id;?>" data-status="<?php echo $admin->status;?>" title="Click to Enable"  ><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php endif ;?>
                             <?php else: ?>
                         <a href="javascript:" class="mg0_10 not-active icon-font green" data-id="<?php echo $admin->id;?>" data-status="<?php echo $admin->status;?>" title="Click to disable"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                           <?php endif;?>
                          
                                </td>
                          <?php endif;?>
                          
                          <td><?php printr($admin->name);?></td>
                          <td><?php printr($admin->user_name);?></td>
                          <td><?php printDate($admin->created_time);?></td>
                          <td><?php printDateTime($admin->last_visit);?></td>
                         <td><?php echo $admin->role ;?></td>
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
		if(confirm("Are you sure to change status of this landmark?")){
			var id		= $(this).data('id');	
			var status 	= $(this).data('status');	
			
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/user/stadmin",
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
								$this.removeClass(status?'green':'hash');
								$this.addClass(status?'hash':'green');
								$this.data('status',status?0:1);
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
		 if(confirm("Are you sure to remove this Admin?")){
			var id		= $(this).data('id');	 
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/user/rmadmin",
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
									
									//$("#propertyTable").dataTable();
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
<script src="<?php echo $this->config->item('admin_template');?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $this->config->item('admin_template');?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#propertyTable").dataTable({
		aLengthMenu: [
			[25, 50, 100, -1],
			[25, 50, 100, "All"]
		],
		iDisplayLength: 25
	});
   
  });
</script>