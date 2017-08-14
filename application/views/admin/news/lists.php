 <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>plugins/datatables/dataTables.bootstrap.css">
<?php $this->load->view('admin/sidebar');?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage News</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">News</li>
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
                            <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/news/update" id="addNews" class="btn btn-primary pull-right">Add News</a>
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
                            <th width="20%">URL</th>
                            <th width="15%">Thumb</th>
                            
                          </tr>
                        </thead>
                         <tbody>
                        <?php foreach($newses as $news) : $i++;?>
                        <tr id="tr_<?php echo  $news->breakingnews_id;?>">
                          <td><?php echo  $i;?></td>
                          <td>
						  	  <a href="javascript:" class="mg0_10 delete icon-font gray" data-id="<?php echo  $news->breakingnews_id;?>"  title="Click to delete"><i class="fa fa-trash"></i></a>
                               <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/news/update/<?php echo  $news->breakingnews_id;?>"  class="mg0_10 icon-font red editNews" data-id="<?php echo  $news->breakingnews_id;?>"  title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                 <?php if($news->breakingnews_status == '1' ):?>
                                <a href="javascript:" class="mg0_10 status icon-font green" data-id="<?php echo  $news->breakingnews_id;?>" data-status="<?php echo  $news->breakingnews_status;?>" title="Click to disable"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php else :?>
                          		
                                <a href="javascript:" class="mg0_10 status icon-font hash" data-id="<?php echo  $news->breakingnews_id;?>" data-status="<?php echo  $news->breakingnews_status;?>" title="Click to Enable"  ><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php endif ; ?>
                              
                          </td>
                          <td><?php printr($news->breakingnews_title);?></td>
                          <td><?php if($news->breakingnews_link != '' ) : ?>
						  <a href="<?php printr($news->breakingnews_link);?>" target="_blank" ><?php printr($news->breakingnews_link);?></a>
						  <?php endif;?></td>
                          <td>
                          <a href="<?php echo base_url();?>assets/images/latestnews/<?php echo $news->breakingnews_image;?>" target="_blank"><img src="<?php echo base_url();?>assets/images/latestnews/<?php echo $news->breakingnews_image;?>" alt="<?php echo  $news->breakingnews_id;?>" width="50" /></a></td>
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
		if(confirm("Are you sure to change status of this news?")){
			var id		= $(this).data('id');	
			var status 	= $(this).data('status');	
			
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/news/status",
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
								$this.removeClass((status=='1')?'green':'hash');
								$this.addClass((status=='1')?'hash':'green');
								$this.data('status',(status=='1')?'0':'1');
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
		 if(confirm("Are you sure to remove this news?")){
			var id		= $(this).data('id');	 
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/news/remove",
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