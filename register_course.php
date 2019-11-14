<?php
session_start();
if(empty($_SESSION['user'])){
	return header('Location:index.php');
}else{
	$user_group=$_SESSION['user']['user_group'];
	$level=$_SESSION['user']['level'];
	$matric_number=$_SESSION['user']['matric_number'];
	$department=$_SESSION['user']['department'];
	
}
require_once "register_course_process.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Student Registration System | Course Registration for Test</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/fontello.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/animsition.min.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Merriweather:300,300i,400,400i,700,700i" rel="stylesheet">
	<!-- owl Carousel Css -->
	<link href="css/owl.carousel.css" rel="stylesheet">
	<link href="css/owl.theme.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="shortcut icon" href="images/site_favicon.png?v=2">
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
<?php require_once "header.php"; ?>
<?php //require_once "slide.php"; ?>

<div style="clear: both;padding-bottom: 10pt"></div>


<!--  Login Section  -->
<section id="contact_section" class="section-space120 ">
	<div style="clear: both"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="wrapper-content bg-white pinside40">
					<div class="contact-form mb60">
						<div class=" ">
							<div class="row">
								<form class="reg_form" id="reg_form" method="post" action="" >
									<div class="text-center" style="width: 100%;max-width: 85%;display: block;margin: 0 auto">
										<div class="col-md-offset-2 col-md-9 col-sm-12 col-xs-12">
											<div class="mb60  section-title text-center  ">
												<!-- section title start-->
												<h1><b>Course Registration for Test</b></h1>
												<?php  if(!empty($course_details)): ?>
												<p>Kindly select the course(s) to register below</p>
											</div>
											<?php if (!empty($errors)): ?>
												<?php if (empty($errors['failure'])): ?>
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>Error(s) Occurred while processing you request. please fix the error(s) below to continue</p>
													</div><br/>
												<?php else: ?>
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>Sorry, Your Registration could not be completed. please try again later!</p>
													</div><br/>
												<?php endif;elseif(!empty($success)): ?>
												<div class="text-center alert alert-success" style="width: 100%">
													<?php echo $success['data'] ?>
												</div><br/>
											<?php endif; ?>
										</div>
										<input id="user_group" name="user_group" type="hidden" value="CLIENT" >
										<!-- Text input-->
										<div class="row">
<!--										<div class=" col-sm-1 col-xs-12"></div>-->
										<div class=" col-sm-12 col-xs-12 text-left">
											<div class="form-group">
													<div class="row" style="padding-left: 36px">
														<input type="checkbox" name="check_all"  data-checked="false" value="ALL" <?php echo  (!empty($check_all) && $check_all==="ALL")?"checked='checked'":""?> class="check_all" id="check_all">
														<label for="check_all" class="check_all_label"> Select All</label>
														</div>
														<div style="clear: both;margin-bottom: 25px" ></div>
													<div class="row">
														<div class="col-sm-1 col-xs-12 text-center title">
														
														</div>
														<div class="col-sm-2 col-xs-12 text-center title">
															Course Code
														</div>
														<div class="col-sm-7 col-xs-12 text-center title">
															Course Title
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center title">
															Course Unit
														</div>
													</div>
													<div style="clear: both"></div><br/>
													<?php $index=0; foreach($course_details as $course_detail): ?>
														<div class="row">
														<div class="col-sm-1 col-xs-12 text-center">
															<input type="checkbox" name="test_course[<?php echo $index;  ?>][course_title]" id="test_course[<?php echo $index;  ?>][course_title]" value="<?php echo  !empty($course_detail['course_title'])?$course_detail['course_title']:''?>" <?php echo (!empty($test_course[$index]['course_title']) )?"checked='checked'":'' ?>   class="test_course">
															<input type="hidden" name="test_course[<?php echo $index;  ?>][course_code]" id="test_course[<?php echo $index;  ?>][course_code]" value="<?php echo  !empty($course_detail['course_code'])?$course_detail['course_code']:''?>" >
															<input type="hidden" name="test_course[<?php echo $index;  ?>][course_unit]" id="test_course[<?php echo $index;  ?>][course_unit]" value="<?php echo  !empty($course_detail['course_unit'])?$course_detail['course_unit']:''?>">
														</div>
														<div class="col-sm-2 col-xs-12 text-center">
															<label for="test_course[<?php echo $index;  ?>][course_title]" class="test_course_label"><?php echo  !empty($course_detail['course_code'])?(strtoupper($course_detail['course_code']).''):''?> </label>
														</div>
														<div class="col-sm-7 col-xs-12 text-left">
															<label for="test_course[<?php echo $index;  ?>][course_title]" class="test_course_label"> <?php echo  !empty($course_detail['course_title'])?$course_detail['course_title'].' ':''?></label>
														
														</div>
														<div class="col-sm-2 col-xs-12 hidden-xs text-center">
															<label for="test_course[<?php echo $index;  ?>][course_title]" class="test_course_label"><?php echo  !empty($course_detail['course_unit'])?(intval($course_detail['course_unit'])):''?></label>
														</div>
														</div>
													
														<?php $index++;endforeach; ?>
													<div style="clear: both;margin-bottom: 100px"></div><br/>
													
													<div class="col-md-12 col-xs-12 text-center">
														<button type="submit" id="submit_reg_form" class="btn btn-default"  style="width: 60%;border-radius: 10px;font-size: 16pt;text-transform: none"><b>SUBMIT</b></button>
													</div>
												<?php else:  ?>
													<br/><br/>
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>You have already Registered all Available Test Courses for your Department...</p>
													</div><br/>
												<?php  endif; ?>
											</div>
										</div>
										</div>
											<p><?php if(!empty($errors['test_course'])){echo $errors['test_course']; } ?></p>
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
<?php require_once "footer.php"; ?>

<script src="js/datetimepicker/jquery.datetimepicker.full.js" type="text/javascript"></script>
<script >
      $(document).ready(function(){
             $('.check_all').off('click').on('click',function () {
                   var checked = !$(this).data('checked');
			 $('.test_course').prop('checked',checked);
                   $(this).data('checked', checked);
             })
      });
</script>

</body>

</html>
