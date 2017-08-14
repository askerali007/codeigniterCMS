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
      
      <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>css/skins/skin-blue-light.min.css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <script src="<?php echo $this->config->item('admin_template');?>js/jQuery-2.2.0.min.js"></script>
    <script src="<?php echo $this->config->item('admin_template');?>js/jquery-migrate-1.4.1.js"></script>
    <script type="text/javascript" src="<?php echo $this->config->item('admin_template');?>plugins/ajaxform/jquery.form.js"></script>
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
<div class="loadings" style="display:none;">
<img src="<?php echo $this->config->item('admin_template');?>images/loading.gif">
<h4>Processing...Please wait.</h4>
</div>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home" class="logo" style="background:#FFF;">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
		  <?php if(file_exists('assets/images/admin-logo-sm.png')) :?>
            <img src="<?php echo base_url();?>assets/images/admin-logo-sm.png" alt="logo" />
          <?php else : ?>
          <span class""><?php echo strtoupper(substr($this->config->item('site_name'),0, 1));?></span>
          <?php endif;?>
      </span>
        
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
      	<?php if(file_exists('assets/images/admin-logo-lg.png')) :?>
      		<img src="<?php echo base_url();?>assets/images/admin-logo-lg.png" alt="logo" width="110" />
        <?php else : ?>
      		<span class="logo-lg"><strong><?php echo $this->config->item('site_name');?></strong></span>
        <?php endif;?>
      </span>
    </a>
    <div class="view-site"><a href="<?php echo base_url();?>" target="_blank" >View Website</a></div>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $this->session->userdata('profile_pic')?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('name')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $this->session->userdata('profile_pic')?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('name')?> - <?php echo strtolower($this->session->userdata('role'))?>
                </p>
              </li>
             
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/home/profile" class="btn btn-primary btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/login/logout" class="btn btn-primary btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>