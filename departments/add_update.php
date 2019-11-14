<?php
session_start();
if(empty($_SESSION['user']) || (!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtolower($_SESSION['user']['user_group']) !=="administrator")) {
	header('Location:index.php');
	exit();
}
require_once "add_update_process.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Student Registration System | <?php echo !empty($id)?' Update':' Add New'; ?> Department</title>
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
                              <div class="form-group top_right_btn ">
                                    <div class="col-xs-12 text-right">
                                          <a href="departments/" class="site_default_btn_small">Manage Departments</a>
                                    </div>
                              </div>
					<div class="contact-form mb60">
						<div class=" ">
							<div class="row">
								<form class="reg_form" id="reg_form" method="post" action="" >
									<div class="" style="width: 100%;max-width: 85%;display: block;margin: 0 auto">
										<div class="col-md-offset-2 col-md-9 col-sm-12 col-xs-12">
											<div class="mb60  section-title text-center  ">
												<!-- section title start-->
												<h1><b>Add New Department</b></h1>
                                                                        <p>Complete the form below to <?php echo !empty($id)?' Update':' Add'; ?></p>
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
										<input id="user_group" name="user_group" type="hidden" value="CLIENT" >
										<input id="id" name="id" type="hidden" value="<?php echo !empty($id)?$id:'' ?>" />
										<!-- Text input-->
                                                            <div class="col-xs-12">
                                                                  <div class="form-group">
                                                                        <label class="field_label" for="code">Department Code <span style="color:red">*</span><span class=" "> </span></label>
                                                                        <input id="code" name="code" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['code'])?'error':'' ?>" value="<?php echo !empty($code)?$code:'' ?>" >
												<?php if(!empty($errors['code'])){echo '<p class="help-block">'.$errors['code'].'</p>'; } ?>
                                                                        <small>e.g CSC, ICT, BAM, ACC, CENGR, etc.</small>
                                                                  </div>
                                                            </div>
                                                            <div style="clear: both"></div>
										<div class=" col-xs-12">
											<div class="form-group">
                                                                        <label class="field_label" for="name">Department Name <span style="color:red">*</span><span class=" "> </span></label>
												<input id="name" name="name" type="text" placeholder="" class=" form-control input-md <?php echo !empty($errors['name'])?'error':'' ?>" value="<?php echo !empty($name)?$name:'' ?>">
												<?php if(!empty($errors['name'])){echo '<p class="help-block">'.$errors['name'].'</p>'; } ?>
												<small>e.g B.Sc. Computer Science, B.A. English, etc.</small>
											</div>
										</div>
										<div style="clear: both"></div>
										
										<div class=" col-xs-12">
											<div class="form-group ">
												<label class="field_label" for="faculty">Faculty <span style="color:red">*</span><span class=" "> </span></label>
                                                                        <div class="<?php echo !empty($errors['faculty'])?'error':'' ?>">
                                                                              <select class="form-control custom-select " name="faculty" id="faculty">
                                                                                    <option value="">Select Faculty</option>
                                                                                    <option value="Agriculture" <?php echo ( !empty($faculty) && $faculty==='Agriculture')?'selected=selected':''?>>Faculty of Agriculture</option>
                                                                                    <option value="Arts" <?php echo ( !empty($faculty) && $faculty==='Arts')?'selected=selected':''?>>Faculty of Arts</option>
                                                                                    <option value="Education" <?php echo ( !empty($faculty) && $faculty==='Education')?'selected=selected':''?>>Faculty of Education</option>
                                                                                    <option value="Health Sciences" <?php echo ( !empty($faculty) && $faculty==='Health Sciences')?'selected=selected':''?>>Faculty of Health Sciences</option>
                                                                                    <option value="Law" <?php echo ( !empty($faculty) && $faculty==='Law')?'selected=selected':''?>>Faculty of Law</option>
                                                                                    <option value="Management Sciences" <?php echo ( !empty($faculty) && $faculty==='Management Sciences')?'selected=selected':''?>>Faculty of Management Sciences</option>
                                                                                    <option value="Sciences" <?php echo ( !empty($faculty) && $faculty==='Sciences')?'selected=selected':''?>>Faculty of Sciences</option>
                                                                                    <option value="Social Sciences" <?php echo ( !empty($faculty) && $faculty==='Social Sciences')?'selected=selected':''?>>Faculty of Social Sciences</option>
                                                                              </select>
                                                                        </div>
												<?php if(!empty($errors['faculty'])){echo '<p class="help-block">'.$errors['faculty'].'</p>'; } ?>
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
