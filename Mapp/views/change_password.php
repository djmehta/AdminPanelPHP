<style>
.entry:not(:first-of-type)
{
    margin-top: 10px;
}

.glyphicon
{
    font-size: 12px;
}
</style>
<script src="<?php echo base_url('assets/plugins/jquery-1.10.2.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
/**
  * Basic jQuery Validation Form Demo Code
  * Copyright Sam Deering 2012
  * Licence: http://www.jquery4u.com/license/
  */
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#changepassword-form").validate({
                rules: {
                    email: {
					required: true,
					email: true //email is required AND must be in the form of a valid email address
					},
                    old_password: {
                        required: true,
						minlength: 8
                    },
					new_password: {
                        required: true,
						minlength: 8
                    },
					re_password: {
                        equalTo: "#new_password",
                        minlength: 8
                    }
                },
                messages: {
					email: "Please enter email",
					old_password: {
                        required: "Please provide a old password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    new_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
					re_password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long",
						passwordMatch: "Your Passwords Must Match" // custom message for mismatched passwords
                    }                   
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<h3 class="page-title">
			Change <small>Password</small>
			</h3>
			<div class="page-bar">
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 ">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-plus-square"></i> Change password?
							</div>
							<div class="tools">
								<a href="" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="" class="reload">
								</a>
							</div>
						</div>
						<div class="portlet-body form">
							<form role="form" action="<?php echo base_url()?>users/change_user_pwd/" method="post" id='changepassword-form'>
								<?php if($message == 'wrong_old_password'){ ?>
								<div class="alert alert-danger">Please enter existing password.</div>
								<?php } ?>
								<?php if($message == 'suss'){ ?>
								<div class="alert alert-success">Login password has been updated successfully.</div>
								<?php } ?>
								<?php if($message == 'wrong_email_old_password'){ ?>
								<div class="alert alert-danger"> Email / password is not correct.</div>
								<?php } ?>
								<div class="form-body">
									<div class="form-group">
										<label>Email</label>
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-pencil"></i>
											</span>
											<input type="email" class="form-control" placeholder="Enter email" name="email" value="<?php echo $this->session->userdata('user_email'); ?>">
										</div>
									</div>
									<div class="form-group">
										<label>Old Password</label>
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-pencil"></i>
											</span>
											<input type="password" class="form-control" placeholder="Enter old Password" name="old_password" id="old_password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
										</div>
									</div>
									<div class="form-group">
										<label>New Password</label>
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-pencil"></i>
											</span>
											<input type="password" class="form-control" placeholder="Enter New Password" name="new_password" id="new_password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
										</div>
									</div>
									<div class="form-group">
										<label>Re-enter Password</label>
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-pencil"></i>
											</span>
											<input type="password" class="form-control" placeholder="Re-Enter New Password" name="re_password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="re_password">
										</div>
									</div>								
								
								</div>
								<div class="form-actions">
									<button type="submit" class="btn blue">Submit</button>
									<button type="button" class="btn default">Cancel</button>
								</div>
							</form>
						</div>
					</div>
					
				</div>
					
			</div>
			
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	