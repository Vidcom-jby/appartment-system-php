<?php
session_start();
if(empty($_SESSION['user']) || (!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtolower($_SESSION['user']['user_group']) !=="administrator")) {
	header('Location:index.php');
	exit();
}
require_once "profile_process.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Student Registration System |  Update Profile</title>
	<?php require_once '../css_imports.php'?>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
            window.lgas = <?php echo json_encode($lgas); ?>;
	</script>
</head>

<body class="animsition">
<section id="home"></section>
<!-- /.top-bar -->
<?php require_once "../header.php"; ?>
<?php //require_once "slide.php"; ?>

<div style="clear: both;padding-bottom: 10pt"></div>


<!--  Login Section  -->
<section id="contact_section" class="section-space120 ">
	<div style="clear: both"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="wrapper-content bg-white pinside40">
					<?php if(!empty($_SESSION['failure'])): ?>
						<div class="form-group ">
							<div class="col-xs-12">
								<div class="alert alert-danger text-center ">
									<p><strong><?php echo $_SESSION['failure']; ?></strong></p>
								</div>
							</div>
						</div>
						<?php unset($_SESSION['recover_email_failure']); ?>
					<?php elseif(!empty($_SESSION['success'])): ?>
						<div class="form-group ">
							<div class="col-xs-12">
								<div class="alert alert-success  text-center">
									<p><strong><?php echo $_SESSION['success']; ?></strong></p>
								</div>
							</div>
						</div>
						<?php unset($_SESSION['success']);?>
					<?php endif; ?>
					<div class="contact-form mb60">
						<div class=" ">
							<div class="row">
								<form class="reg_form" id="reg_form" method="post" action="" >
									<div class="" style="width: 100%;max-width: 85%;display: block;margin: 0 auto">
										<div class="col-md-offset-2 col-md-9 col-sm-12 col-xs-12">
											<div class="mb60  section-title text-center  ">
												<!-- section title start-->
												<h1><b> Update Account</b></h1>
												<p>Complete the form below to Update</p>
											</div>
											<?php if (!empty($errors)): ?>
												<?php if (empty($errors['failure'])): ?>
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>Error(s) Occurred while processing you request. please fix the error(s) below to continue</p>
													</div><br/>
												<?php else: ?>
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>An error occurred while processing your request, please refresh the page and try again!</p>
													</div><br/>
												<?php endif;elseif(!empty($success)): ?>
												<div class="text-center alert alert-success" style="width: 100%">
													<?php echo $success['data'] ?>
												</div><br/>
											<?php endif; ?>
										</div>
										<input id="user_group" name="user_group" type="hidden" value="ADMINISTRATOR" >
										<input id="id" name="id" type="hidden" value="<?php echo !empty($id)?$id:'' ?>" />
										<!-- Text input-->
										<div style="clear: both"></div>
										<div class="col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="field_label" for="title">Surname<span style="color:red">*</span><span class=" "> </span></label>
												<input id="surname" name="surname" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['surname'])?'error':'' ?>" value="<?php echo !empty($surname)?$surname:'' ?>" >
												<?php if(!empty($errors['surname'])){echo '<p class="help-block">'.$errors['surname'].'</p>'; } ?>
												<small>e.g Michael, James, etc.</small>
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="field_label" for="title">Other Names<span style="color:red">*</span><span class=" "> </span></label>
												<input id="other_name" name="other_name" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['other_name'])?'error':'' ?>" value="<?php echo !empty($other_name)?$other_name:'' ?>" >
												<?php if(!empty($errors['other_name'])){echo '<p class="help-block">'.$errors['other_name'].'</p>'; } ?>
												<small>e.g Michael Kenneth, James Okon, etc.</small>
											</div>
										</div>
										<div style="clear: both"></div>
										<div class=" col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="field_label" for="title">Email <span style="color:red">*</span><span class=" "> </span></label>
												<input id="email" name="email" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['email'])?'error':'' ?>" value="<?php echo !empty($email)?($email):'' ?>" >
												<?php if(!empty($errors['email'])){echo '<p class="help-block">'.$errors['email'].'</p>'; } ?>
												<small>e.g me@example.com, test@example.co.ng,  etc.</small>
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="field_label" for="title">Phone Number<span style="color:red">*</span><span class=" "> </span></label>
												<input id="phone_number" name="phone_number" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['phone_number'])?'error':'' ?>" value="<?php echo !empty($phone_number)?$phone_number:'' ?>" >
												<?php if(!empty($errors['phone_number'])){echo '<p class="help-block">'.$errors['phone_number'].'</p>'; } ?>
												<small>e.g 08012345678, +2348012345678, etc.</small>
											</div>
										</div>
										<div style="clear: both"></div>
										<div class="col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="field_label" for="password">Password <span style="color:red">*</span><span class=" "> </span></label>
												<input id="password" name="password" type="password" placeholder="" class="form-control input-md <?php echo !empty($errors['password'])?'error':'' ?>" value="" >
												<?php if(!empty($errors['password'])){echo '<p class="help-block">'.$errors['password'].'</p>'; } ?>
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="field_label" for="title">Confirm Password<span style="color:red">*</span><span class=" "> </span></label>
												<input id="confirm_password" name="confirm_password" type="password" placeholder="" class="form-control input-md <?php echo !empty($errors['confirm_password'])?'error':'' ?>" value="" >
												<?php if(!empty($errors['confirm_password'])){echo '<p class="help-block">'.$errors['confirm_password'].'</p>'; } ?>
											</div>
										</div>
										<div style="clear: both"></div><br/>
										<!-- Button -->
										<div class="col-md-12 col-xs-12 text-center submit_btn_holder">
											<button type="submit" id="submit_reg_form" class="btn btn-default site_default_btn"  style=""><b>SUBMIT</b></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- /.section title start-->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Footer Section -->
<?php require_once "../footer.php"; ?>

<script src="js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script >
      $(document).ready(function(){
            $('.dob').datetimepicker({format: 'd/m/Y', timepicker: false});
      });
</script>

</body>

</html>
