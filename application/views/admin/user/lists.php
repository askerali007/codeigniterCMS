 <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>plugins/datatables/dataTables.bootstrap.css">
<?php $this->load->view('admin/sidebar');?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage User</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manage Users</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <a href="<?php echo base_url();?>admin/user/update" id="addUser" class="btn btn-primary pull-right">Add User</a>
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
                            <th width="15%">Actions </th>
                            <th width="30%">Name</th>
                            <th width="18%">Hotel</th>
                            <th width="12%">Username</th>
                            <th width="20%">Last Visit</th>
                            
                          </tr>
                        </thead>
                         <tbody>
                        <?php foreach($users as $user) : $i++;?>
                        <tr id="tr_<?php echo  $user->user_id;?>">
                          <td><?php echo  $i;?></td>
                          <td>
						  	  <a href="javascript:" class="mg0_10 delete icon-font gray" data-id="<?php echo  $user->user_id;?>"  title="Click to delete"><i class="fa fa-trash"></i></a>
                               <a href="<?php echo base_url();?>admin/user/update/<?php echo  $user->user_id;?>"  class="mg0_10 icon-font red editUser" data-id="<?php echo  $user->user_id;?>"  title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                               
                               <?php if($user->status == 'Y' ):?>
                                <a href="javascript:" class="mg0_10 status icon-font green" data-id="<?php echo  $user->user_id;?>" data-status="<?php echo  $user->status;?>" title="Click to disable"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php else :?>
                          		
                                <a href="javascript:" class="mg0_10 status icon-font hash" data-id="<?php echo  $user->user_id;?>" data-status="<?php echo  $user->status;?>" title="Click to Enable"  ><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php endif ;?>
                          
                                </td>
                          <td><?php printr($user->fullname);?></td>
                          <td><?php printr($user->hotel_name);?></td>
                          <td><?php printr($user->username);?></td>
                          <td><?php printDateTime($user->last_visit);?></td>
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
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    <form role="form" action="" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Files</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
             
              <!--<button type="submit" class="btn btn-icon btn-primary pull-right" id="uploadImage">Submit</button>-->
      </div>
      </form>
    </div>

  </div>
</div>
</div>
<script type="application/javascript">
$(document).ready(function(e) {
    $('.status').click(function(){
		if(confirm("Are you sure to change status of this user?")){
			var id		= $(this).data('id');	
			var status 	= $(this).data('status');	
			
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"../user/status",
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
		 if(confirm("Are you sure to remove this user?")){
			var id		= $(this).data('id');	 
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"../user/remove",
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
	 
	 $('.fileList').click(function(){
		 $('#myModal').modal('show');
		 var id = $(this).attr('rel');
		 $.getJSON('<?php echo base_url();?>admin/file/assigned_files/'+id,function(data){
			$('.modal-body').html(data.result);
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