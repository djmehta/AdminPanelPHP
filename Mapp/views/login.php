<!DOCTYPE html>
<?php 
//echo "123 - ".base_url();exit;
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
		
		function forgot_pwd()
		{
			var email = $("#emailId").val();
			$.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "users/forgot_password",
			  data: 'email='+email,
			  success: function(data) {
					if(data == 'error'){
					    $("#fail").show();
						$("#fail").html("Email not register with us.");
					}
					if(data == 'inactive'){
					    $("#fail").show();
						$("#fail").html("You tried to send to a recipient that has been marked as inactive.");
					}
					if(data == 'success'){
						$("#suss").show();
						$("#suss").html("password link send to your register Email Id.");	
					}
					/*$("#perr").show();
					$("#perr").html("password link send to your email!!");*/
			  }
			});
			
		}
		
		function user_login()
		{
			var email = $("#email").val();
			var passwd = $("#passwd").val();
			$.ajax({
			  type: "POST",
			  dataType: "text",
			  url: "login/auth/",
			  data: 'email='+email+'&passwd='+passwd,
			  success: function(data) {
					if(data == 'fail'){
					    $("#login_fail").show();
						$("#login_fail").html("wrong email / password");
					}
					if(data == 'suss'){
					    window.location.replace("http://localhost/M_CMS/merchant_home");
					}
			  }
			});
			
		}

</script>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8"/>
<title>Merchant</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>-->
<link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/plugins/uniform/css/uniform.default.css') ?>" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/select2/select2.css') ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/select2/select2-metronic.css') ?>"/>
<link href="<?php echo base_url('assets/css/style-metronic.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/style-responsive.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/plugins.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/themes/default.css') ?>" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url('assets/css/pages/login-soft.css') ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url('assets/plugins/jquery-1.10.2.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/common.js') ?>" type="text/javascript"></script>
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="login">
<!--<div class="unilogo">
		<img src="<?php echo base_url('assets/img/logo/weschool.jpg') ?>" alt="" class="img-responsive"/>
</div>-->
<div class="logo">
		<!--<img src="<?php echo base_url('assets/img/logo/TTDLogo2.png') ?>" alt="" class="img-responsive" />-->
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM --> 
	<form class="login-form"  method="post" id="login-form" onclick="user_login();" action="javascript:void(0);">		
	<h3 class="form-title">Login to your account</h3>
		
		<div id='login_fail' style='display:none'  class='alert alert-danger'></div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="email" id="email"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="passwd" id="passwd" />
			</div>
		</div>
		<div class="form-actions" style="text-align:center">
			<!--<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> Remember me </label>-->
			<button type="submit" class="btn blue" >
			Sign In <i class="m-icon-swapright m-icon-white" ></i>
			</button>
		</div>
		<div class="forget-password" style="margin-top:0px;">
			<p style="text-align:center">
				<a href="javascript:;" id="forget-password">
					 Forgot password
				</a>
			</p>
		</div>
		<!--<div class="create-account">
			<p>
				 Don't have an account yet ?&nbsp;
				<a href="javascript:;" id="register-btn">
					 Create an account
				</a>
			</p>
		</div>-->
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" id="forgot" onclick="forgot_pwd();" action="javascript:void(0);">
	<!--form class="forget-form" action="<?php echo base_url()?>users/forgot_password/" method="post"-->
		<h3>Forget Password ?</h3>
		<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<div id='fail' style='display:none'  class='alert alert-danger'></div>
		<div id='suss' style='display:none' class='alert alert-success'></div>
		<div class="form-group">
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" id="emailId" />
			</div>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" class="btn blue pull-right" >
			Submit <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
	<!-- BEGIN REGISTRATION FORM -->
	<form class="register-form" action="<?php echo base_url()?>login/register/" method="post">
		<h3>Sign Up</h3>
		<p>
			 Enter your account details below:
		</p>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="name"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
			<div class="controls">
				<div class="input-icon">
					<i class="fa fa-check"></i>
					<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
				</div>
			</div>
		</div>
		<p>
			 Enter your personal details below:
		</p>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Email</label>
			<div class="input-icon">
				<i class="fa fa-envelope"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Phone</label>
			<div class="input-icon">
				<i class="fa fa-phone"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Phone" name="telephone"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Company URL</label>
			<div class="input-icon">
				<i class="fa fa-check"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Company url" name="company_url"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Description</label>
			<div class="input-icon">
				<i class="fa fa-check"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Description" name="description"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Address</label>
			<div class="input-icon">
				<i class="fa fa-check"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="Address" name="address"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">City/Town</label>
			<div class="input-icon">
				<i class="fa fa-location-arrow"></i>
				<input class="form-control placeholder-no-fix" type="text" placeholder="City/Town" name="cities"/>
			</div>
		</div>
		
		<div class="form-group">
			<label>
			<input type="checkbox" name="tnc"/> I agree to the
			<a href="#">
				 Terms of Service
			</a>
			 and
			<a href="#">
				 Privacy Policy
			</a>
			</label>
			<div id="register_tnc_error">
			</div>
		</div>
		<!--<div class="form-actions">
			<button id="register-back-btn" type="button" class="btn">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" id="register-submit-btn" class="btn blue pull-right">
			Sign Up <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>-->
	</form>
	<!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<script src="<?php echo base_url('assets/plugins/jquery-migrate-1.2.1.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.blockui.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.cokie.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/uniform/jquery.uniform.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-validation/dist/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/backstretch/jquery.backstretch.min.js') ?>" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/select2/select2.min.js') ?>"></script>

<script src="<?php echo base_url('assets/scripts/core/app.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/scripts/custom/login-soft.js') ?>" type="text/javascript"></script>
<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});
</script>

</body>
</html>	
