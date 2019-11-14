<?php
session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtolower($_SESSION['user']['user_group']) !=="student") {
	header('Location:index.php');
	exit();
}

require_once "registered_courses_process.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Student Registration System | List of Registered Courses</title>
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
	<div class="container registered_courses_page">
		<div class="row">
			<div class="col-md-12">
				<div class="wrapper-content bg-white pinside40">
					<div class="form-group top_right_btn">
						<div class="col-xs-12 text-right">
							<a href="students/register_courses.php" class="site_default_btn_small">Register Courses</a>
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
					<div class="form-group registered_detail">
						<div class="col-xs-12">
							<div class="  text-center">
								<p class="s_logo"><img src="images/site_logo.png"/> </p>
								<b>National Open University of Nigeria, </b><br />
								<p><b>Port Harcourt Study Centre, River, Nigeria.</b><br/>
							</div>
						</div>
					</div>
					<div style="clear: both;margin-top:20px" class="col-xs-12"></div>
					<div class="form-group registered_detail">
						<div class="col-xs-12">
							<div class="  text-center">
								<p class="s_logo2"><img src="<?php echo (!empty($_SESSION['user']) && !empty($_SESSION['user']['image']))?$_SESSION['user']['image']:'' ?>"/> </p><br/>
								<b><?php echo (!empty($_SESSION['user']) && !empty($_SESSION['user']['surname']))?ucwords($_SESSION['user']['surname']):'' ?></b>
								<b><?php echo (!empty($_SESSION['user']) && !empty($_SESSION['user']['other_name']))?ucwords($_SESSION['user']['other_name']):'' ?></b><br/>
								<b><?php echo (!empty($_SESSION['user']) && !empty($_SESSION['user']['matric_number']))?strtoupper($_SESSION['user']['matric_number']):'' ?></b><br />
								
							</div>
						</div>
					</div>
					<div class="contact-form mb60">
						<div class=" ">
							<div class="row">
								<form class="reg_form" id="reg_form" method="post" action="" >
									<div class="" style="width: 100%;max-width: 85%;display: block;margin: 0 auto">
										<!-- Text input-->
										<div style="clear: both;margin-top:50px" ></div>
										<div style="border: 1px solid rgba(0,0,0,0.2);width: 100%;margin-bottom: 40px" class="col-xs-12"></div>
										<div class=" col-md-12 col-sm-12 col-xs-12">
											<div class="mb40  section-title text-center  ">
												<!-- section title start-->
												<h1><b>Registered Courses</b></h1>
												<p>The Following are list of registered courses</p>
											</div>
										</div>
										<?php if(empty($course_details)): ?>
											<div class="col-xs-12">
												<div class="form-group">
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>You have no Registered Courses Available.</p>
													</div><br/>
												</div>
											</div>
										<?php else: ?>
											<div class="col-xs-12">
												<div class="form-group">
													<div style="clear: both;margin-bottom: 25px" ></div>
													<div class="row">
														
														<div class="col-sm-2 col-xs-12 text-center title">
															Course Code
														</div>
														<div class="col-sm-5 col-xs-12 text-center title">
															Course Title
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center title">
															Course Unit
														</div>
														<div class="col-sm-1 col-xs-12 hidden-xs text-center title">
															Status
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center title">
															Cost
														</div>
													</div>
													<div style="clear: both"></div><br/>
													<?php if(!empty($course_details)): $index=0; $total_amt=0;$total_unit=0;foreach($course_details as $course_detail):
														if(!empty($course_detail['cost'])){
														$total_amt +=floatval($course_detail['cost']);
														$total_unit +=intval($course_detail['unit']);
														}
														?>
														<div class="row course_row">
															<div class="col-sm-2 col-xs-12 text-center">
																<label  class="test_course_label"><?php echo  !empty($course_detail['code'])?(strtoupper($course_detail['code']).''):''?> </label>
															</div>
															<div class="col-sm-5 col-xs-12 text-left">
																<label class="test_course_label title"> <?php echo  !empty($course_detail['title'])?strtoupper($course_detail['title']).' ':''?></label>
															
															</div>
															<div class="col-sm-2 col-xs-12 hidden-xs text-center">
																<label  class="test_course_label"><?php echo  !empty($course_detail['unit'])?(intval($course_detail['unit'])):''?></label>
															</div>
															<div class="col-sm-1 col-xs-12 hidden-xs text-center">
																<label  class="test_course_label"><?php echo  !empty($course_detail['status'])?(($course_detail['status'])):''?></label>
															</div>
															<div class="col-sm-2 col-xs-12 hidden-xs text-center">
																<label  class="test_course_label">#<?php echo  !empty($course_detail['cost'])?(number_format(floatval($course_detail['cost']),2,'.',',')):0.00?></label>
															</div>
														</div>
														<?php $index++;endforeach; ?>
													<div class="row course_row">
														<div class="col-sm-2 col-xs-12 text-center">
														</div>
														<div class="col-sm-5 col-xs-12 text-left">
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center" style="padding: 8px 30px">
															<div style="display:block;width:100%;border-top: 2px solid rgba(0,0,0,0.3);padding: 5px 0px"></div>
															<label  class="test_course_label"><?php echo  $total_unit ?></label>
														</div>
														<div class="col-sm-1 col-xs-12 hidden-xs text-center">
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center" style="padding: 8px 30px">
															<div style="display:block;width:100%;border-top: 2px solid rgba(0,0,0,0.3);padding: 5px 0px"></div>
															<label  class="test_course_label" style="font-weight: 900">#<?php echo  number_format(floatval($total_amt),2,'.',',')?></label>
														</div>
													</div>
													<?php endif; ?>
													<div style="clear: both;margin-bottom: 20px"></div><br/>
												</div>
											</div>
										<?php endif; ?>
										<div class="" style="margin-top: 80px"></div>
										<div style="border: 1px solid rgba(0,0,0,0.2);width: 100%;margin-bottom: 40px" class="col-xs-12"></div>
										<div class=" col-md-12 col-sm-12 col-xs-12">
											<div class="mb40  section-title text-center  ">
												<!-- section title start-->
												<h1><b>Registered Exam Courses</b></h1>
												<p>The Following are the list of courses registered for exam</p>
											</div>
										</div>
										<?php if(empty($exam_details)): ?>
											<div class="col-xs-12">
												<div class="form-group">
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>You have no Registered Exams Courses Available.</p>
													</div><br/>
												</div>
											</div>
										<?php else: ?>
											<div class="col-xs-12">
												<div class="form-group">
													<div style="clear: both;margin-bottom: 25px" ></div>
													<div class="row">
														
														<div class="col-sm-2 col-xs-12 text-center title">
															Course Code
														</div>
														<div class="col-sm-5 col-xs-12 text-center title">
															Course Title
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center title">
															Course Unit
														</div>
														<div class="col-sm-1 col-xs-12 hidden-xs text-center title">
															Status
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center title">
															Cost
														</div>
													</div>
													<div style="clear: both"></div><br/>
													<?php if(!empty($exam_details)): $index=0; $total_amt=0;$total_unit=0;foreach($exam_details as $course_detail):
														if(!empty($course_detail['cost'])){
															$total_amt +=floatval($course_detail['cost']);
															$total_unit +=intval($course_detail['unit']);
														}?>
														<div class="row course_row">
															<div class="col-sm-2 col-xs-12 text-center">
																<label class="test_course_label"><?php echo  !empty($course_detail['code'])?(strtoupper($course_detail['code']).''):''?> </label>
															</div>
															<div class="col-sm-5 col-xs-12 text-left">
																<label class="test_course_label title"> <?php echo  !empty($course_detail['title'])?strtoupper($course_detail['title']).' ':''?></label>
															</div>
															<div class="col-sm-2 col-xs-12 hidden-xs text-center">
																<label class="test_course_label"><?php echo  !empty($course_detail['unit'])?(intval($course_detail['unit'])):''?></label>
															</div>
															<div class="col-sm-1 col-xs-12 hidden-xs text-center">
																<label class="test_course_label"><?php echo  !empty($course_detail['status'])?(($course_detail['status'])):''?></label>
															</div>
															<div class="col-sm-2 col-xs-12 hidden-xs text-center">
																<label class="test_course_label">#<?php echo  !empty($course_detail['cost'])?(number_format(floatval($course_detail['cost']),2,'.',',')):0.00?></label>
															</div>
														</div>
														<?php $index++;endforeach; ?>
													<div class="row course_row">
														<div class="col-sm-2 col-xs-12 text-center">
														</div>
														<div class="col-sm-5 col-xs-12 text-left">
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center" style="padding: 8px 30px">
															<div style="display:block;width:100%;border-top: 2px solid rgba(0,0,0,0.3);padding: 5px 0px"></div>
															<label  class="test_course_label"><?php echo  $total_unit ?></label>
														</div>
														<div class="col-sm-1 col-xs-12 hidden-xs text-center">
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center" style="padding: 8px 30px">
															<div style="display:block;width:100%;border-top: 2px solid rgba(0,0,0,0.3);padding: 5px 0px"></div>
															<label  class="test_course_label" style="font-weight: 900">#<?php echo  number_format(floatval($total_amt),2,'.',',')?></label>
														</div>
													</div>
													<?php endif; ?>
													<div style="clear: both;margin-bottom: 20px"></div><br/>
												</div>
											</div>
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
