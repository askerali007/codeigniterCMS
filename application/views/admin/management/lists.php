 <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>plugins/datatables/dataTables.bootstrap.css">
<?php $this->load->view('admin/sidebar');?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage Managements</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Managements</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-xs-9">
                          </div>
                          <div class="col-xs-3">
                            <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/update" id="addManagement" class="btn btn-primary pull-right">Add Management</a>
                         </div>
                       </div>                  
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
                            <th width="20%">Actions </th>
                            <th width="30%">Name</th>
                            <th width="20%">Positions</th>
                            <th width="15%">Profile pic</th>
                            
                          </tr>
                        </thead>
                         <tbody>
                        <?php foreach($managements as $management) : $i++;?>
                        <tr id="tr_<?php echo  $management->team_id;?>">
                          <td><?php echo  $i;?></td>
                          <td>
						  	  <a href="javascript:" class="mg0_10 delete icon-font gray" data-id="<?php echo  $management->team_id;?>"  title="Click to delete"><i class="fa fa-trash"></i></a>
                               <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/update/<?php echo  $management->team_id;?>"  class="mg0_10 icon-font red editManagement" data-id="<?php echo  $management->team_id;?>"  title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                               
                                
                              <?php if($management->sort_order < count($managements)) :?>
                               <a href="javascript:" class="mg0_10 sort icon-font2 blue"  data-prev_ord="<?php echo  $management->sort_order;?>" data-order="up" data-id="<?php echo  $management->team_id;?>" title="Click to down-<?php echo  $management->sort_order;?>"><i class="fa fa-arrow-circle-down"></i></a><?php else: ?><i class="mg0_10 icon-font2 gray fa fa-arrow-circle-down"></i> <?php endif; ?>
                               &nbsp;
                               <?php if($management->sort_order > 1) :?>
                               <a href="javascript:" class="sort icon-font2 blue" data-prev_ord="<?php echo  $management->sort_order;?>" data-order="down" data-id="<?php echo  $management->team_id;?>" title="Click to up-<?php echo  $management->sort_order;?>"><i class="fa fa-arrow-circle-up"></i></a>  <?php else: ?><i class="icon-font2 gray fa fa-arrow-circle-up"></i> <?php endif; ?>
                               
                               </td>
                          
                          <td><?php printr($management->name);?></td>
                          <td><?php printr($management->position);?></td>
                          <td>
                          <a href="<?php echo base_url();?>assets/uploads/managements/<?php echo $management->copy;?>" target="_blank"><img src="<?php echo base_url();?>assets/images/team/<?php echo $management->profile_pic;?>" alt="<?php echo  $management->team_id;?>" width="50" /></a></td>
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
		if(confirm("Are you sure to change status of this management?")){
			var id		= $(this).data('id');	
			var status 	= $(this).data('status');	
			
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/status",
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
		 if(confirm("Are you sure to remove this management?")){
			var id		= $(this).data('id');	 
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/remove",
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
	 
	 $('.sort_order').blur(function(){
		 var id = $(this).attr('id');
		 var order = $(this).val();
		 var $this 	= $(this);
			
			$('#ld_'+id).css('visibility','visible');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/sort_order",
					 data:{id:id, order:order},
					 type:"POST",
					 dataType:"json",
					 error: function(){
						alert('Internal server error.!!');
						location.reload(); 
					 },
					 success: function(data){
							$('#ld_'+id).css('visibility','hidden');
					 }
					 
			});
	 });
	 $('.filter').change(function(){ 
	 	var id = $('#filter1').val();
		window.location = '<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/lists/'+id
	 });
	 
	 $('.sort').click(function(){
		var id		= $(this).data('id');	
		var order 	= $(this).data('order');
		var prev_ord= $(this).data('prev_ord');
		var $this 	= $(this);	
		$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
		$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/management/change_order",
					 data:{id:id, order:order, prev_ord:prev_ord, ajax:true},
					 type:"POST",
					 dataType:"json",
					 error: function(){
						alert('Internal server error.!!');
						location.reload(); 
					 },
					 success: function(data){
							location.reload();
					 }
					 
			});
			
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