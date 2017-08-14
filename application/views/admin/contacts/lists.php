 <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>plugins/datatables/dataTables.bootstrap.css">
<?php $this->load->view('admin/sidebar');?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Contacts</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Contact</li>
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
                      <table id="propertyTable" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th width="5%" class="center">SL</th>
                            <th width="15%">Actions </th>
                            <th width="20%">Name</th>
                            <th width="20%">Phone/Email/country</th>
                            <th width="40%">Comments</th>
                          </tr>
                        </thead>
                         <tbody>
                        <?php foreach($contacts as $contact) : $i++;?>
                        <tr id="tr_<?php echo  $contact->contactus_id;?>">
                          <td><?php echo  $i;?></td>
                          <td>
						  	  <a href="javascript:" class="mg0_10 delete icon-font gray" data-id="<?php echo  $contact->contactus_id;?>"  title="Click to delete"><i class="fa fa-trash"></i></a>
                          </td>
                          <td><?php printr($contact->fname.' '.$contact->lname);?></td>
                          <td>	<?php printr($contact->phone);?><br/>
						  		<?php printr($contact->email);?><br/>
								<?php printr($contact->country);?></td>
                           <td><?php printr($contact->comments);?></td>
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
	
	 $('.delete').click(function(){
		 if(confirm("Are you sure to remove this contact?")){
			var id		= $(this).data('id');	 
			var $this 	= $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/contacts/remove",
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