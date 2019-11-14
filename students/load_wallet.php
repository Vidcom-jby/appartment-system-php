<?php
session_start();
if(empty($_SESSION['user']) || (!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtolower($_SESSION['user']['user_group']) !=="student")) {
	header('Location:index.php');
	exit();
}
require_once "load_wallet_process.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Student Registration System |  Load Wallet</title>
	<?php require_once '../css_imports.php'?>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
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
					<div class="form-group top_right_btn">
						<div class="col-xs-12 text-right">
							<a href="students/view_payments.php" class="site_default_btn_small">View Payments</a>
						</div>
					</div>
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
								<form class="teller_form" id="teller_form" method="post" action="" >
									<div class="" style="width: 100%;max-width: 85%;display: block;margin: 0 auto">
										<div class="col-md-offset-2 col-md-9 col-sm-12 col-xs-12">
											<div class="mb60  section-title text-center  ">
												<!-- section title start-->
												<h1><b>Fund Wallet</b></h1>
												
												<p>To fund your e-wallet, kindly visit any nearest bank branch and make deposit into the school account using your correct Name, Matric Number, etc. Return to this page to upload your bank teller. Your payment will reflect on your wallet when it's verified and approved by the school cashier as soon as possible. </p>
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
										<input id="user_group" name="user_group" type="hidden" value="STUDENT" >
										<input id="id" name="id" type="hidden" value="<?php echo !empty($id)?$id:'' ?>" />
										<!-- Text input-->
										<div class="col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="field_label" for="department">Payment Date<span style="color:red">*</span><span class=" "> </span></label>
												<div >
													<input id="date" name="date" type="text" placeholder="" class="form-control input-md date_pop <?php echo !empty($errors['date'])?'error':'' ?>" value="<?php echo !empty($date)?($date):'' ?>" >
												</div>
												<?php if(!empty($errors['date'])){echo '<p class="help-block">'.$errors['date'].'</p>'; } ?>
												<small>e.g 23/11/2018, etc.</small>
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="field_label" for="title">Amount Paid<span style="color:red">*</span><span class=" "> </span></label>
												<input id="amount" name="amount" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['amount'])?'error':'' ?>" value="<?php echo !empty($amount)?strtoupper($amount):'' ?>" >
												<?php if(!empty($errors['amount'])){echo '<p class="help-block">'.$errors['amount'].'</p>'; } ?>
												<small>e.g #5000, 5000, #23000, etc. (with or without "#")</small>
											</div>
										</div>
										<div style="clear: both"></div>
										<div class="col-sm-6 col-xs-12">
											<div class="form-group ">
												<label class="field_label" for="level">Bank Name<span style="color:red">*</span><span class=" "> </span></label>
												<div class="">
													<input id="bank_name" name="bank_name" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['bank_name'])?'error':'' ?>" value="<?php echo !empty($bank_name)?($bank_name):'' ?>" >
												</div>
												<?php if(!empty($errors['bank_name'])){echo '<p class="help-block">'.$errors['bank_name'].'</p>'; } ?>
												<small>e.g Fidelity Bank, GTBank, etc.</small>
											</div>
										</div>
										<div class="col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="field_label" for="title">Bank Branch<span style="color:red">*</span><span class=" "> </span></label>
												<input id="bank_branch" name="bank_branch" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['bank_branch'])?'error':'' ?>" value="<?php echo !empty($bank_branch)?$bank_branch:'' ?>" >
												<?php if(!empty($errors['bank_branch'])){echo '<p class="help-block">'.$errors['bank_branch'].'</p>'; } ?>
												<small>e.g Rumuola Branch, Wuse II Branch, etc.</small>
											</div>
										</div>
										
										<div style="clear: both"></div>
										
										<?php
										
										/***
										 *Code segment to wrap Car Image
										 * photo to image base64
										 *
										 ***/
										if(!empty($teller_image)) {
											
											$teller_http_photo = (strpos($teller_image, "http") === false) ? "http://" . $_SERVER['HTTP_HOST'] . $teller_image : $teller_image;
										}
										else {
											$teller_http_photo = "";
										}
										$teller_post_http = !empty($teller_image_http)?$teller_image_http:"";
										if(!empty($teller_http_photo) && empty($teller_post_http)) {
											$ext = pathinfo($teller_http_photo, PATHINFO_EXTENSION);
											try {
											}
											catch (\Exception $e) {
												$teller_http_photo = "";
											}
										}
										elseif(!empty($teller_post_http)) {
											$teller_http_photo = $teller_post_http;
										}
										
										$uploaded_teller_photo = !empty($teller_image_uploaded)?$teller_image_uploaded:"";
										/*** End of code segment for wrapping Car Image   ***/
										?>
										<div class="col-xs-12 text-left">
											<div class="form-group">
												<div class=" show_padding <?php echo ( !empty($errors['teller_image_uploaded'])?'error':''); ?>">
												<label for="teller_image" class="field_label">Bank Teller<span style="color:red">*</span></label>
												<button class="btn site_default_btn_small" type="button" id="upload_teller_photo">View/Upload Teller</button>
												</div>
												<input type="hidden" name="teller_image" value="<?php echo !empty($teller_image)?$teller_image:"" ?>"/>
												<input type="hidden" id="teller_image_http" name="teller_image_http" value="<?php echo !empty($teller_http_photo)?$teller_http_photo:'' ?>"/>
												<input type="hidden" id="teller_image_uploaded" name="teller_image_uploaded" value="<?php echo !empty($uploaded_teller_photo)?$uploaded_teller_photo:'' ?>"/>
												
												<p class="help-block"><?php if(!empty($errors['teller_image_uploaded'])){echo $errors['teller_image_uploaded']; } ?></p>
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

<div class="modal fade" id="teller_upload_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-x:auto;padding:5px">
	<div class="modal-dialog" style="width:100%;max-width:600px;margin:10px auto;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h5 class="modal-title" id="myModalLabel">UPLOAD TELLER IMAGE</h5>
			</div>
			<div class="modal-body">
				<p class="help-block"></p>
				<div id="teller_image_editor" class="image-editor">
					<input type="file" class="cropit-image-input" />
					<div class="cropit-preview " style="<?php if(!empty($teller_http_photo) || !empty($uploaded_teller_photo)): ?>display:block<?php endif; ?>"></div>
					<div class="image-size-label" style="<?php if(!empty($teller_http_photo) || !empty($uploaded_teller_photo)): ?>display:block<?php endif; ?>">
						<small>Drag image to desired position and/or use slider to resize</small><br/>
					</div>
					<div class="controls-wrapper" style="<?php if(!empty($teller_http_photo) || !empty($uploaded_teller_photo)): ?>display:block<?php else: ?>display:none<?php endif; ?>">
						<div>
							<span class="icone icone-rotate-left rotate-ccw-btn"></span>
							<span class="icone icone-rotate-right rotate-cw-btn"></span>
						</div>
						<input type="range" class="cropit-image-zoom-input" style="<?php if(!empty($teller_http_photo) || !empty($uploaded_teller_photo)): ?>display:block<?php endif; ?>">
					</div>
				</div>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="teller_continue_upload">UPLOAD</button>
			</div>
		</div>
	</div>
</div>
<!-- Footer Section -->
<?php require_once "../footer.php"; ?>

<script src="js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script >
      $(document).ready(function(){
            $('.date_pop').datetimepicker({format: 'd/m/Y h:i:s', timepicker: true});
      });
</script>

</body>

</html>
