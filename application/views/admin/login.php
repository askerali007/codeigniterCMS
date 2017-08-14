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
      <!-- iCheck -->
 	  <link rel="stylesheet" href="<?php echo $this->config->item('admin_template');?>plugins/iCheck/square/blue.css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <script src="<?php echo $this->config->item('admin_template');?>js/jQuery-2.2.0.min.js"></script>
</head>

<body class="hold-transition login-page skin-blue">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/images/logo-admin.png" alt="logo" /></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <div id="LoginError">
    	<?php if($this->session->flashdata('error') ) : ?>
        	<div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo $this->session->flashdata('error');?></div>
       	<?php endif;?>
    </div>
    <form action="login/auth" method="post" id="loginFrm" accept-charset="utf-8">
      <div class="form-group has-feedback">
        <input type="text" id="userName" name="username" class="form-control" placeholder="Username" value="<?php echo $_COOKIE['remember_me']; ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="userPassword" name="password" class="form-control" placeholder="Password"  value="<?php echo base64_decode($_COOKIE['remember_pwd'])?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input value="1" type="checkbox" name="remember" id="remember"<?php if(isset($_COOKIE['remember_me'])) : ?> checked<?php endif;?>> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
        	<input type="hidden" id="loginUser" name="loginUser" value="">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    
    <!-- /.social-auth-links -->

    <a href="<?php echo base_url();?><?php echo $this->config->item('admin_prifix')?$this->config->item('admin_prifix').'admin':'admin';?>/login/reset">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>

<script src="<?php echo $this->config->item('admin_template');?>bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $this->config->item('admin_template');?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<!--<script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/aes.js"></script>-->

<script type="text/javascript">
/*function encrypPass(val){
	var pass = CryptoJS.MD5(document.getElementById('userPassword').value);
	document.getElementById('userPassword').value = pass+'01';
}*/

$(document).ready(function(){
		
	$("#loginFrm").submit(function(e){
		//encrypPass($("#userPassword").val());
		<?php if($this->config->item('ajax_login') == 'No'):?>
		return true;
		<?php endif;?>
		e.preventDefault();
		
		
		var username = $("#userName").val();
		var loginUser = password = $("#userPassword").val();		
		var remember = ($('#remember').is(":checked")==true)?1:false;
		
	   
		if(username=='' || username==null){
			$("#LoginError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Please Enter Your Username.</div>');
			return false;
		}
		if(password=='' || password==null){
			$("#LoginError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error! </strong>Please Enter Your Password.</div>');
			return false;
		}
		$("#LoginError").html('<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button><strong>Please Wait! </strong>Checking....</div>');
		
		$.post("<?php echo base_url().$prfx_admin.'admin';?>/login/ajax",
			{	username:username,	
				password:'',	
				remember:remember,	
				loginUser:loginUser,
				remember : remember
			}, function(data){
			
				if(data == 'success'){
					$("#LoginError").html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Success! </strong>Redirecting..</div>');
					window.location='<?php echo base_url().$prfx_admin.'admin';?>/home';
				}
				else{
					$("#LoginError").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>'+data+'</div>');
					return false;
				}
		});	
	});	
});
</script>
</body>
</html>