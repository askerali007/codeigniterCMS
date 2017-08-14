 <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>plugins/datatables/dataTables.bootstrap.css">
<?php $this->load->view('admin/sidebar');?>
                
<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage pages</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Manage pages</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/update" class="btn btn-primary pull-right">Add Page</a>
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
                    <?php foreach( $errors as $err ) : ?>
                        <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo $err;?></div>
                    <?php endforeach;?>
                    
                </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="pageTable" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th width="5%" class="center">SL</th>
                            <th width="10%">Actions </th>
                            <th width="35%">Page Name</th>
                            <th width="30%">Parent</th>
                            <th width="20%">SEO URL</th>
                          </tr>
                        </thead>
                         <tbody>
                        <?php foreach($pages as $page) : $i++;?>
                        <tr id="tr_<?php echo  $page->page_id;?>">
                          <td><?php echo  $i;?></td>
                          <td>
						  	  <a href="javascript:" class="mg0_10 delete icon-font gray" data-id="<?php echo  $page->page_id;?>" data-status="<?php echo  $page->status;?>" title="Click to delete"><i class="fa fa-trash"></i></a>
                               <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/update/<?php echo  $page->page_id;?>" class="mg0_10 icon-font red" data-id="<?php echo  $page->page_id;?>"  title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                               
                               <?php /*if($page->status == 'Y' ):?>
                                <a href="javascript:" class="mg0_10 status icon-font green" data-id="<?php echo  $page->page_id;?>" data-status="<?php echo  $page->status;?>" title="Click to disable"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php else :?>
                          		
                                <a href="javascript:" class="mg0_10 status icon-font hash" data-id="<?php echo  $page->page_id;?>" data-status="<?php echo  $page->status;?>" title="Click to Enable"  ><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php endif ;*/ ?>
                              <?php /*if($page->sort_order < count($pages)) :?>
                               <a href="javascript:" class="mg0_10 sort icon-font2 blue"  data-prev_ord="<?php echo  $page->sort_order;?>" data-parent="<?php echo  $page->parent_id;?>" data-order="up" data-id="<?php echo  $page->page_id;?>" title="Click to down-<?php echo  $page->sort_order;?>"><i class="fa fa-arrow-circle-down"></i></a><?php else: ?><i class="mg0_10 icon-font2 gray fa fa-arrow-circle-down"></i> <?php endif; ?>
                               &nbsp;
                               <?php if($page->sort_order > 1) :?>
                               <a href="javascript:" class="sort icon-font2 blue" data-prev_ord="<?php echo  $page->sort_order;?>"  data-parent="<?php echo  $page->parent_id;?>" data-order="down" data-id="<?php echo  $page->page_id;?>" title="Click to up-<?php echo  $page->sort_order;?>"><i class="fa fa-arrow-circle-up"></i></a>  <?php else: ?><i class="icon-font2 gray fa fa-arrow-circle-up"></i> <?php endif;*/ ?>
                          		<!--<input type="text" class="small-textbox sort_order" id="<?php echo  $page->page_id;?>" name="order[<?php echo  $page->page_id;?>]" value="<?php echo  $page->sort_order;?>" /><span class="HIDE" id="ld_<?php echo  $page->page_id;?>"><i class="fa fa-spinner fa-pulse"></i></span>-->
                                </td>
                          <td><?php printr($page->page_title_en);?></td>
                          <td><?php printr($page->parent_name);?></td>
                          <td><?php printr($page->page_name);?></td>
                          
                        </tr>
                        <?php if($page->child) :?>
                        <?php foreach($page->child as $child) : $i++;?>
                        <tr id="tr_<?php echo  $child->page_id;?>">
                          <td><?php echo  $i;?></td>
                          <td>
						  	  <a href="javascript:" class="mg0_10 delete icon-font gray" data-id="<?php echo  $child->page_id;?>" data-status="<?php echo  $child->status;?>" title="Click to delete"><i class="fa fa-trash"></i></a>
                               <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/update/<?php echo  $child->page_id;?>" class="mg0_10 icon-font red" data-id="<?php echo  $child->page_id;?>"  title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                               
                               <?php /*if($child->status == 'Y' ):?>
                                <a href="javascript:" class="mg0_10 status icon-font green" data-id="<?php echo  $child->page_id;?>" data-status="<?php echo  $child->status;?>" title="Click to disable"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php else :?>
                          		
                                <a href="javascript:" class="mg0_10 status icon-font hash" data-id="<?php echo  $child->page_id;?>" data-status="<?php echo  $child->status;?>" title="Click to Enable"  ><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              <?php endif ;*/ ?>
                              <?php /*if($child->sort_order < count($page->child)) :?>
                               <a href="javascript:" class="mg0_10 sort icon-font2 blue"  data-prev_ord="<?php echo  $child->sort_order;?>" data-parent="<?php echo  $child->parent_id;?>" data-order="up" data-id="<?php echo  $child->page_id;?>" title="Click to down-<?php echo  $child->sort_order;?>"><i class="fa fa-arrow-circle-down"></i></a><?php else: ?><i class="mg0_10 icon-font2 gray fa fa-arrow-circle-down"></i> <?php endif; ?>
                               &nbsp;
                               <?php if($child->sort_order > 1) :?>
                               <a href="javascript:" class="sort icon-font2 blue" data-prev_ord="<?php echo  $child->sort_order;?>"  data-parent="<?php echo  $child->parent_id;?>" data-order="down" data-id="<?php echo  $child->page_id;?>" title="Click to up-<?php echo  $child->sort_order;?>"><i class="fa fa-arrow-circle-up"></i></a>  <?php else: ?><i class="icon-font2 gray fa fa-arrow-circle-up"></i> <?php endif;*/ ?>
                          		<!--<input type="text" class="small-textbox sort_order" id="<?php echo  $child->page_id;?>" name="order[<?php echo  $child->page_id;?>]" value="<?php echo  $child->sort_order;?>" /><span class="HIDE" id="ld_<?php echo  $child->page_id;?>"><i class="fa fa-spinner fa-pulse"></i></span>-->
                                </td>
                          <td>&nbsp;--&nbsp;<?php printr($child->page_title_en);?></td>
                          <td><?php printr($child->parent_name);?></td>
                          <td><?php printr($child->page_name);?></td>
                         
                        </tr>
                        <?php endforeach;?>
                        <?php endif;?>
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
		if(confirm("Are you sure to change status of this page?")){
			var id		= $(this).data('id');	
			var status 	= $(this).data('status');	
			
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/status",
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
		 if(confirm("Are you sure to remove this page?")){
			var id		= $(this).data('id');	 
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/remove",
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
									
									//$("#pageTable").dataTable();
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
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/sort_order",
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
	 
	 $('.sort').click(function(){
		var id		= $(this).data('id');	
		var order 	= $(this).data('order');
		var parent 	= $(this).data('parent');
		var prev_ord= $(this).data('prev_ord');
		var $this 	= $(this);	
		$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/page/change_order",
					 data:{id:id, order:order, parent:parent, prev_ord:prev_ord, ajax:true},
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
    $("#pageTable").dataTable({
		aLengthMenu: [
			[25, 50, 100, -1],
			[25, 50, 100, "All"]
		],
		iDisplayLength: 25
	});
   
  });
</script>