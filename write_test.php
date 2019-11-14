<?php
session_start();
if(empty($_SESSION['user'])){
	return header('Location:index.php');
}else{
	$test_course=$_GET['course_code'];
	if(empty($test_course)){
		header("Location: index.php");
	}else {
		$user_group = $_SESSION['user']['user_group'];
		$level = $_SESSION['user']['level'];
		$matric_number = $_SESSION['user']['matric_number'];
		$department = $_SESSION['user']['department'];
	}
}
require_once "write_test_process.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Student Registration System | Write Test</title>
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
									<div class="text-center" style="width: 100%;max-width: 95%;display: block;margin: 0 auto">
										<div class="col-md-offset-2 col-md-9 col-sm-12 col-xs-12">
											<div class="mb60  section-title text-center  ">
												<!-- section title start-->
												<?php  if(!empty($question_details)): ?>
												<h1><b>CBT Test </b></h1>
                                                                        <h2><b>Course: </b><?php echo  (!empty($course_code) ?$course_code:'').(!empty($course_title) ?' - '.$course_title:'').(!empty($course_unit) ?' ('.$course_unit.')':'');?></h2>
												
                                                                        <p><b>Instruction:</b> Answer all the questions. (Each question carries 10 marks)</p>
											</div>
											<?php if (!empty($error)): ?>
												<?php if (empty($errors['failure'])): ?>
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>Error(s) Occurred while processing you request. please fix the error(s) below to continue</p>
													</div><br/>
												<?php else: ?>
													<div class="text-center alert alert-danger" style="width: 100%">
														<p>Sorry, Your Submission could not be completed. please try again later!</p>
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
													<div style="clear: both"></div><br/>
													<?php $index=0; foreach($question_details as $question_detail): ?>
                                                                                    <?php if( !empty($question_detail) && !empty($question_detail['question_title'])): ?>
                                                                                          <div class="row test_row">
                                                                                                <div class="col-sm-12 col-xs-12">
                                                                                                      <p><b><?php echo ($index+1).'. ' ?><span class="question_title"><?php echo !empty($question_detail['question_title'])?$question_detail['question_title']:'' ?></span></b></p>
                                                                                                      <input type="hidden" name="test_question[<?php echo $index ?>][question_answer]" id="test_question[<?php echo $index ?>][question_answer]" value="<?php echo  !empty($question_detail['question_answer'])?trim($question_detail['question_answer']):'' ?>">
                                                                                                      <?php  if(!empty($question_detail['question_options'])): ?>
                                                                                                            <?php $inner_index=0;foreach ($question_detail['question_options'] as $value):  ?>
                                                                                                                  <?php if(!empty(trim($value))): ?>
                                                                                                                  <span class="question_option">
                                                                                                                        <input type="radio" name="test_question[<?php echo $index ?>][question_option]" id="test_question[<?php echo $index ?>][question_option][<?php echo $inner_index ?>]" class="radio" value="<?php echo  !empty($value)?trim($value):'' ?> " <?php echo  (!empty($test_question[$index]['question_option']) && trim($test_question[$index]['question_option']) ===trim($value))?"checked=checked":'' ?>>
                                                                                                                        <label for="test_question[<?php echo $index ?>][question_option][<?php echo $inner_index ?>]" class="radio_label"><?php echo  !empty($value)?$value:'' ?></label><br/>
                                                                                                                  </span>
                                                                                                                  <?php endif; ?>
                                                                                                            <?php  $inner_index++;endforeach; ?>
                                                                                                      <?php  endif;  ?>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div style="clear: both;margin-bottom: 30px"></div>
                                                                                    <?php endif;  ?>
													<?php $index++;endforeach; ?>
													<div style="clear: both;margin-bottom: 100px"></div><br/>
             
													<div class="col-md-12 col-xs-12 text-center">
														<button type="submit" id="submit_reg_form" class="btn btn-default"  style="width: 60%;border-radius: 10px;font-size: 16pt;text-transform: none"><b>SUBMIT</b></button>
													</div>
													<?php elseif(!empty($success)): ?>
                                                                                    <br/><br/>
                                                                              <div class="text-center alert alert-success" style="width: 100%">
														<?php echo $success['data'] ?>
                                                                              </div><br/>
													<?php elseif(!empty($errors['user_data'])): ?>
														<br/><br/>
														<div class="text-center alert alert-danger" style="width: 100%">
															<?php echo $errors['user_data'] ?>
														</div><br/>
                                                                              <?php else:  ?>
														<br/><br/>
														<div class="text-center alert alert-danger" style="width: 100%">
															<p>Sorry, CBT Test is not  available for your course... Please try again!</p>
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
