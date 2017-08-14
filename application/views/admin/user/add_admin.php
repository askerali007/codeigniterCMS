<?php $this->load->view('admin/sidebar');
?>
<div class="content-wrapper" style="min-height:646px;">
 <section class="content">
      <div class="row">
          <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Add/Edit Admin User</h3>
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/user/admins" class="pull-right">Back to list</a>
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
					<div class="box-body">
          <form role="form" action="" method="post" enctype="multipart/form-data">
          			<div class="form-group">
                    <div class="col-md-8 col-sm-12">	
                      <label for="name">Username</label>
                      <input type="text"  placeholder="Username" id="user_name" name="user_name" class="form-control" value="<?php echo $user->user_name;?>" <?php if($user->id) :?> disabled="disabled"<?php else : ?>required <?php endif; ?>>
                      </div>
                      <div class="cleafix"></div>
                    </div>
                	<div class="form-group">
                    <div class="col-md-8 col-sm-12">	
                      <label for="name">Name</label>
                      <input type="text" required placeholder="Enter name" id="name" name="name" class="form-control" value="<?php echo $user->name;?>">
                      </div>
                      <div class="cleafix"></div>
                    </div>
                	<div class="form-group">
                    <div class="col-md-8 col-sm-12">	
                      <label for="email">Email address</label>
                      <input type="email" required placeholder="Enter email" id="email" name="email" class="form-control" value="<?php echo $user->email;?>">
                      </div>
                      <div class="cleafix"></div>
                    </div>
              		<div class="form-group">
                    <div class="col-md-8 col-sm-12">	
                      <label for="phone">Phone</label>
                      <input type="text" placeholder="Enter phone" id="phone" name="phone" class="form-control" value="<?php echo $user->phone;?>">
                      </div>
                      <div class="cleafix"></div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-8 col-sm-12">	
                      <label for="pass">Password</label>
                      <input type="password" placeholder="Password" id="pass" name="pass" class="form-control" <?php if(!$user->id) :?> required <?php endif; ?>>
                      </div>
                      <div class="cleafix"></div>
                    </div>
                    <div class="form-group">
                    	<div class="col-md-8 col-sm-12">	
                      <label for="conf_pass">Confirm Password</label>
                      <input type="password" placeholder="Confirm Password" id="conf_pass" name="conf_pass" class="form-control" <?php if(!$user->id) :?> required <?php endif; ?> >
                      </div>
                      <div class="cleafix"></div>
                    </div>
                    <?php if( $this->session->userdata('role') == 'SUPER ADMIN' && $user->role != 'SUPER ADMIN'): ?>
                    <div class="form-group">
                    	<div class="col-md-3 col-sm-12">	
                      <label for="conf_pass">Role</label>
                      <select name="role" id="role" class="form-control">
                      		<option value="ADMIN"<?php if($user->role == 'ADMIN'):?> selected="selected"<?php endif;?>>ADMIN</option>
                            <option value="HR"<?php if($user->role == 'HR'):?> selected="selected"<?php endif;?>>HR</option>
                      </select>
                      </div>
                      <div class="cleafix"></div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                    	<div class="col-md-8 col-sm-12">
                        <input type="hidden"  id="admin_id" name="admin_id" value="<?php echo $user->id;?>">	
                    	<button type="submit" class="btn btn-icon btn-primary pull-right" id="">Submit</button>
                        </div>
                    	<div class="cleafix"></div>
                    </div>
          </form>
                  </div>
            </div>
         </div>
      </div>
 </section>
</div>
