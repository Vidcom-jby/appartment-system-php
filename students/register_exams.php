<?php
session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtolower($_SESSION['user']['user_group']) !=="student") {
	header('Location:index.php');
	exit();
}

require_once "register_exams_process.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Student Registration System | Register Exam Courses</title>
	<?php require_once '../css_imports.php'?>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
	
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
					<div class="form-group top_right_btn">
						<div class="col-xs-12 text-right">
							<a href="students/registered_courses.php" class="site_default_btn_small">View Registered Courses</a>
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
						<?php unset($_SESSION['failure']); ?>
					<?php elseif(!empty($_SESSION['success'])): ?>
						<div class="form-group ">
							<div class="col-xs-12">
								<div class="alert alert-success  text-center">
									<p><strong><?php echo $_SESSION['success']; unset($_SESSION['success'])?></strong></p>
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
											<?php if(!empty($errors['no_course_available'])): ?>
												<div class="form-group ">
													<div class="col-xs-12">
														<div class="alert alert-danger text-center ">
															<p><strong><?php echo $errors['no_course_available']; ?></strong></p>
														</div>
													</div>
												</div>
											<?php else:  ?>
											<div class="mb60  section-title text-center  ">
												<!-- section title start-->
												<h1><b>Register Exam Courses</b></h1>
												<p>Select your Courses below to Register </p>
											</div>
											<?php if (!empty($errors)): ?>
												<?php if (empty($errors['failure'])): ?>
													<div class="text-center alert alert-danger" style="width: 100%">
														<?php if(!empty($errors['test_course'])):?>
															<p><?php if(!empty($errors['test_course'])){echo $errors['test_course']; } ?></p>
														<?php else: ?>
															<p>Error(s) Occurred while processing you request. please fix the error(s) below to continue</p>
														<?php endif; ?>
													</div><br/>
												<?php else: ?>
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>An error occurred while processing your request, please refresh the page and try again!</p>
													</div><br/>
												<?php endif; ?>
											<?php endif; ?>
										</div>
										<input id="user_group" name="user_group" type="hidden" value="STUDENT" >
										<input id="id" name="id" type="hidden" value="<?php echo !empty($id)?$id:'' ?>" />
										<!-- Text input-->
										<?php if(empty($course_details)): ?>
											<div class="col-xs-12">
												<div class="form-group">
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>You have already Registered all Available  Courses for Exam.</p>
													</div><br/>
												</div>
											</div>
										<?php else: ?>
											<div class=" col-xs-12">
												<div class="form-group">
													<div class="row" style="padding-left: 25px">
														<input type="checkbox" name="check_all"  data-checked="false" value="ALL" <?php echo  (!empty($check_all) && $check_all==="ALL")?"checked='checked'":""?> class="check_all form-check-input" id="check_all">
														<label for="check_all" class="check_all_label"> Select All</label>
													</div>
													<div style="clear: both;margin-bottom: 25px" ></div>
													<div class="row">
														<div class="col-sm-1 col-xs-12 text-center title">
														
														</div>
														<div class="col-sm-2 col-xs-12 text-center title">
															Course Code
														</div>
														<div class="col-sm-5 col-xs-12 text-center title">
															Course Title
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center title">
															Course Unit
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center title">
															Price
														</div>
													</div>
													<div style="clear: both"></div><br/>
													<?php if(!empty($course_details)): $index=0; foreach($course_details as $course_detail): ?>
														<div class="row course_row">
															<div class="col-sm-1 col-xs-12 text-center">
																<input type="checkbox" name="courses[<?php echo $index;  ?>][title]" id="courses[<?php echo $index;  ?>][title]" value="<?php echo  !empty($course_detail['title'])?$course_detail['title']:''?>" <?php echo (!empty($courses[$index]['title']) )?"checked='checked'":'' ?>   class="test_course courses form-check-input">
																<input type="hidden" name="courses[<?php echo $index;  ?>][code]" id="courses[<?php echo $index;  ?>][code]" value="<?php echo  !empty($course_detail['code'])?$course_detail['code']:''?>" >
																<input type="hidden" name="courses[<?php echo $index;  ?>][unit]" id="courses[<?php echo $index;  ?>][unit]" value="<?php echo  !empty($course_detail['unit'])?$course_detail['unit']:''?>">
																<input type="hidden" name="courses[<?php echo $index;  ?>][cost]" id="courses[<?php echo $index;  ?>][cost]" value="<?php echo  !empty($course_detail['cost'])?$course_detail['cost']:''?>">
															</div>
															<div class="col-sm-2 col-xs-12 text-center">
																<label for="courses[<?php echo $index;  ?>][title]" class="test_course_label"><?php echo  !empty($course_detail['code'])?(strtoupper($course_detail['code']).''):''?> </label>
															</div>
															<div class="col-sm-5 col-xs-12 text-left">
																<label for="courses[<?php echo $index;  ?>][title]" class="test_course_label"> <?php echo  !empty($course_detail['title'])?strtoupper($course_detail['title']).' ':''?></label>
															
															</div>
															<div class="col-sm-2 col-xs-12 hidden-xs text-center">
																<label for="courses[<?php echo $index;  ?>][title]" class="test_course_label"><?php echo  !empty($course_detail['unit'])?(intval($course_detail['unit'])):''?></label>
															</div>
															<div class="col-sm-2 col-xs-12 hidden-xs text-center">
																<label for="courses[<?php echo $index;  ?>][title]" class="test_course_label">#<?php echo  !empty($course_detail['cost'])?(number_format(floatval($course_detail['cost']),2,'.',',')):0.00?></label>
															</div>
														</div>
														
														<?php $index++;endforeach; endif; ?>
													<div style="clear: both;margin-bottom: 20px"></div><br/>
												</div>
											</div>
											
											<div style="clear: both"></div><br/>
											<!-- Button -->
											<div class="col-md-12 col-xs-12 text-center submit_btn_holder">
												<button type="submit" id="submit_reg_form" class="btn btn-default site_default_btn"  style=""><b>SUBMIT</b></button>
											</div>
										<?php endif; ?>
										<?php endif; ?>
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
