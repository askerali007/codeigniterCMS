<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->config->item('site_name');?> - Administration</title>
    <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>css/AdminLTE.min.css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <script src="<?php echo $this->config->item('admin_template');?>js/jQuery-2.2.0.min.js"></script>
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo-admin.png" alt="logo" /></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Reset my password</p>
    <div id="LoginError">
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
    <form action="" method="post" id="loginFrm" accept-charset="utf-8">
      <div class="form-group has-feedback">
        <input type="text" id="userEmail" name="useremail" class="form-control" placeholder="Email Address" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      
      <div class="row">
        <div class="col-xs-8">
          	<a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/login">Go to login</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col -->
        
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>

<script src="<?php echo $this->config->item('admin_template');?>bootstrap/js/bootstrap.min.js"></script>
</body>
</html>