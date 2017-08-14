<?php $this->load->view('admin/sidebar');?>
<div class="content-wrapper" style="min-height:646px;">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Personal Details</h3>
            </div>
            <!-- /.box-header -->
           
            <div id="profileError">
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
            
            <!-- form start -->
             <form role="form" action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" required placeholder="Enter name" id="name" name="name" class="form-control" value="<?php echo $user->name;?>">
                </div>
                <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" required placeholder="Enter email" id="email" name="email" class="form-control" value="<?php echo $user->email;?>">
                    </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone</label>
                  <input type="text" placeholder="Enter phone" id="phone" name="phone" class="form-control" value="<?php echo $user->phone;?>">
                </div>
               
                <div class="form-group">
                  <label for="exampleInputFile">Profile Pic</label>
                  <input type="file" name="userfile">
                  <input type="hidden" name="profile_pic" id="profile_pic" value="<?php echo $user->profile_pic;?>">
                  <?php if($user->profile_pic != '' && file_exists('assets/uploads/profile/admin/'.$user->profile_pic)):?>
                  <img src="<?php echo base_url().'assets/uploads/profile/admin/'.$user->profile_pic;?>" alt="profile" width="60"/>
                  <?php endif; ?>
                  <p class="help-block">Select your profile picture.</p>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
             	 <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
                <button class="btn btn-primary" type="submit">Update</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password</h3>
            </div>
            <!-- /.box-header -->
            <div id="LoginError">
            <?php if($this->session->flashdata('l_error') ) : ?>
                    <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo $this->session->flashdata('l_error');?></div>
                <?php endif;?>
                <?php if($this->session->flashdata('l_success') ) : ?>
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo $this->session->flashdata('l_success');?></div>
                <?php endif;?>
            </div>
            <!-- form start -->
            <form role="form" id="resetForm" action="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/login/changepass" method="post" enctype="multipart/form-data" accept-charset="utf-8">
              <div class="box-body">
                	
                     <div class="form-group">
                      <label for="exampleInputPassword1">Old Password</label>
                      <input type="password" placeholder="Old Password" id="old_pass" name="old_pass" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">New Password</label>
                      <input type="password" placeholder="New Password" id="new_pass" name="new_pass" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <input type="password" placeholder="Confirm Password" id="conf_pass" name="conf_pass" class="form-control" required="required">
                    </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-info pull-right" id="resetpass" type="submit">Update</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
  </div>
  <script type="text/javascript">


$(document).ready(function(){
		
	$("#resetForm").submit(function(e){
		return true;
		e.preventDefault();
		var old_password 	= $("#old_pass").val();
		var new_password 	= $("#new_pass").val();
		var conf_password 	= $("#conf_pass").val();
		
	    
		if(old_password=='' || old_password==null){
			$("#LoginError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Please enter your old password.</div>');
			return false;
		}
		if(new_password=='' || new_password==null){
			$("#LoginError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Please enter your new password.</div>');
			return false;
		}
		if(conf_password=='' || conf_password==null){
			$("#LoginError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Please enter confirm password.</div>');
			return false;
		}
		if(new_password != conf_password ){
			$("#LoginError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Passwords are not matching!.</div>');
			return false;
		}
		$("#LoginError").html('<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button><strong>Please Wait! </strong>Submitting....</div>');
		
		$.post("<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/login/changepass",
			{	old_pass:old_password,	
				new_pass:new_password,	
				conf_pass:conf_password,
				ajax : true
			}, function(data){
				//location.reload();
			}).done(function(){
				//location.reload();
			});	
	});	
});
</script>