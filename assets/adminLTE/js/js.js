// JavaScript Document
	$("#LogoutButton").click(function(){
		$.post("index.php",{logout:''},function(data){
			if(data=='ok'){
				window.location='login.php';
			}
		});	
	});
	
	$("#changePassButton").click(function(){
		$("#PasswordError").fadeIn();
		$("#PasswordErrorSuccess").hide();
		var currentpassword = $("#currentpassword").val();
		var password = $("#password").val();
		var cpassword = $("#cpassword").val();
		if(currentpassword=='' || currentpassword==null){
			$("#PasswordError").html("Please Enter the Current Password");	
			return false;
		}
		
		if(password=='' || password==null){
			$("#PasswordError").html("Please Enter the Password");	
			return false;
		}
		if(cpassword=='' || cpassword==null){
			$("#PasswordError").html("Please Enter the Confirm Password");	
			return false;
		}
		if(password!=cpassword){
			$("#PasswordError").html("The passwords you typed do not match");	
			return false;
		}
		 $("#PasswordError").html("Processing...Please Wait...");
		$.post("index.php",{currentpassword:currentpassword},function(data){
			if(data=='ok'){
				$.post("index.php",{password:password,cpassword:cpassword},function(data){
					if(data=='ok'){
						$("#PasswordError").hide();
						$("#PasswordErrorSuccess").fadeIn();
						document.getElementById('changePasswordForm').reset();
						 $("#currentpassword").focus();
						  $("#password").focus();
						   $("#cpassword").focus();
						   $("#cpassword").focusout();
						 $("#PasswordErrorSuccess").html("Successfully Changed Your Password");
					}
					else{
						$("#PasswordError").html("Failed to change the password. Please try again.");
						
					}
				});	
			}
			else{
				$("#PasswordError").html("Current Password you typed is not correct");
				 
			}
		});	
	});
	
	function errormsg(div,msg,type){
			
			if(type=='error'){
				var classs = 'alert-error';	
			}
			if(type=='info'){
				var classs = 'alert-info';
			}
			if(type=='success'){
				var classs = 'alert-success';
			}
			$("#"+div).html('<div class="alert '+classs+'"><button type="button" class="close" data-dismiss="alert">×</button>'+msg+'</div>');
		}
		
		