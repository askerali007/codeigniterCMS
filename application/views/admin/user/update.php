<?php $this->load->view('admin/sidebar');
?>

<div class="content-wrapper" style="min-height:646px;">
<section class="content-header">
    <h1> Manage User</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Add/Edit User</li>
    </ol>
  </section>
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
			<div class="box">
                <div class="box-header">
                  <a href="<?php echo base_url();?>admin/user/lists" class="pull-right">Back to list</a>
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
                	<div class=" col-md-8 col-xs-8 col-sm-12">
                      <form role="form" action="<?php echo base_url();?>admin/user/update/" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                        <label for="name">Full Name<span class="red">*</span></label>
                                        <input type="text" required placeholder="Enter full name" id="fullname" name="fullname" class="form-control" value="<?php echo $user->fullname;?>">
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                               	 	<div class=" col-md-12 col-xs-12 col-sm-12">
                                  <label for="email">Hotel Name</label>
                                  <input type="text" placeholder="Enter hotel name" id="hotel_name" name="hotel_name" class="form-control" value="<?php echo $user->hotel_name;?>"><span id="email_not_avail" class="red"></span>
                                  </div>
                                  	<div class="clearfix"></div>
                                </div>
                                <!--<div class="form-group">
                                	<div class=" col-md-12 col-xs-12 col-sm-12">
                                  		<label for="phone">Phone</label>
                                  		<input type="text" placeholder="Enter phone" id="phone" name="phone" class="form-control" value="<?php echo $user->phone;?>">
                                    </div>
                                    <div class="clearfix"> <br/><br/></div>
                                 </div>-->
                               
                                <div class="form-group">
                                	<div class=" col-md-12 col-xs-12 col-sm-12">
                                  		<label for="phone">Username<span class="red">*</span></label>
                                  		<input type="text" placeholder="Enter Username" id="username" name="username" class="form-control" value="<?php echo $user->username;?>" required="required" <?php if($user->user_id):?> disabled="disabled"<?php endif;?>>
                                        <span id="user_not_avail" class="red"></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                	<div class=" col-md-12 col-xs-12 col-sm-12">
                                  		<label for="pass">Password<span class="red">*</span></label>
                                  		<input type="password" placeholder="Password" id="pass" name="pass" class="form-control" <?php if(!$user->user_id):?> required="required"<?php endif;?>>
                                	</div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                	<div class=" col-md-12 col-xs-12 col-sm-12">
                                  		<label for="conf_pass">Confirm Password<span class="red">*</span></label>
                                  		<input type="password" placeholder="Confirm Password" id="conf_pass" name="conf_pass" class="form-control"  <?php if(!$user->user_id):?> required="required"<?php endif;?>>
                                	</div>
                                    <div class="clearfix"></div>
                                 </div>
                                
                                <div class="form-group">
                                    <div class=" col-md-12 col-xs-12 col-sm-12">
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id;?>" />
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

<script type="application/javascript">
$(document).ready(function(e) {
    $('#email').blur(function(){
			var user_id		= $('#user_id').val();	
			var email 	= $(this).val();	
			
			var $this 	= $(this);
			$('#email_not_avail').html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?>admin/user/check",
					 data:{user_id:user_id, field:email,type:'email'},
					 type:"POST",
					 dataType:"json",
					 error: function(){
						alert('Internal server error.!!');
						location.reload(); 
					 },
					 success: function(data){
						 	$this.html('<i class="fa fa-check-square"></i>');
							if(data.status == 'error'){
								$('#email_not_avail').html(data.message);
							}
							else{
								$('#email_not_avail').html('');	
							}
								
					 }
					 
			});
		return false;
	});
	$('#username').blur(function(){
			var user_id		= $('#user_id').val();	
			var user 	= $(this).val();	
			
			var $this 	= $(this);
			$('#user_not_avail').html('<i class="fa fa-spinner fa-pulse"></i>');
			$.ajax({ url:"<?php echo base_url();?>admin/user/check",
					 data:{user_id:user_id, field:user,type:'username'},
					 type:"POST",
					 dataType:"json",
					 error: function(){
						alert('Internal server error.!!');
						location.reload(); 
					 },
					 success: function(data){
						 	$this.html('<i class="fa fa-check-square"></i>');
							if(data.status == 'error'){
								$('#user_not_avail').html(data.message);
							}
							else{
								$('#user_not_avail').html('');	
							}
								
					 }
					 
			});
		return false;
	});
});
</script>