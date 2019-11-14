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
	<title>Online Student Registration System | <?php echo !empty($id)?' Update':' Add New'; ?> Course</title>
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
					<div class="contact-form mb60">
						<div class=" ">
							<div class="row">
								<form class="reg_form" id="reg_form" method="post" action="" >
									<div class="" style="width: 100%;max-width: 85%;display: block;margin: 0 auto">
										<div class="col-md-offset-2 col-md-9 col-sm-12 col-xs-12">
											<div class="mb60  section-title text-center  ">
												<!-- section title start-->
												<h1><b>Add New Course</b></h1>
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
										<div class=" col-xs-12">
											<div class="form-group">
												<label class="field_label" for="code">Course Code <span style="color:red">*</span><span class=" "> </span></label>
												<input id="code" name="code" type="text" placeholder="" class=" form-control input-md <?php echo !empty($errors['code'])?'error':'' ?>" value="<?php echo !empty($code)?$code:'' ?>">
												<?php if(!empty($errors['code'])){echo '<p class="help-block">'.$errors['code'].'</p>'; } ?>
												<small>e.g GST301, CIT412, etc.</small>
											</div>
										</div>
										<div style="clear: both"></div>
										<div class="col-xs-12">
											<div class="form-group">
												<label class="field_label" for="title">Course Title <span style="color:red">*</span><span class=" "> </span></label>
												<input id="title" name="title" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['title'])?'error':'' ?>" value="<?php echo !empty($title)?$title:'' ?>" >
												<?php if(!empty($errors['title'])){echo '<p class="help-block">'.$errors['title'].'</p>'; } ?>
												<small>e.g Expert Systems, Introduction to Linear Algebra</small>
											</div>
										</div>
                                                            <div style="clear: both"></div>
                                                            <div class=" col-sm-6 col-xs-12">
                                                                  <div class="form-group ">
                                                                        <label class="field_label" for="unit">Credit Unit  <span style="color:red">*</span><span class=" "> </span></label>
                                                                        <div class="<?php echo !empty($errors['unit'])?'error':'' ?>">
                                                                              <select class="form-control custom-select " name="unit" id="unit">
                                                                                    <option value="">Select Unit</option>
                                                                                    <?php for($i=1;$i<=20;$i++): ?>
                                                                                          <option value="<?php echo $i;?>" <?php echo ( !empty($unit) && intval($unit)===$i)?'selected=selected':''?>><?php echo $i ?></option>
														<?php endfor; ?>
                                                                              </select>
                                                                        </div>
												<?php if(!empty($errors['unit'])){echo '<p class="help-block">'.$errors['unit'].'</p>'; } ?>
                                                                        <small>e.g 1, 2, 5, 8,3, etc.</small>
                                                                  </div>
                                                            </div>
                                                            <div class=" col-sm-6  col-xs-12">
                                                                  <div class="form-group ">
                                                                        <label class="field_label" for="status">Course Status <span style="color:red">*</span><span class=" "> </span></label>
                                                                        <div class="<?php echo !empty($errors['status'])?'error':'' ?>">
                                                                              <select class="form-control custom-select " name="status" id="status">
                                                                                    <option value="">Select Status</option>
                                                                                    <option value="Core" <?php echo ( !empty($status) && $status==='Core')?'selected=selected':''?>>Core (C)</option>
                                                                                    <option value="Elective" <?php echo ( !empty($status) && $status==='Elective')?'selected=selected':''?>>Elective (E)</option>
                                                                              </select>
                                                                        </div>
												<?php if(!empty($errors['status'])){echo '<p class="help-block">'.$errors['status'].'</p>'; } ?>
                                                                  </div>
                                                            </div>
                                                            <div style="clear: both"></div>
                                                            <div class=" col-sm-6 col-xs-12">
                                                                  <div class="form-group ">
                                                                        <label class="field_label" for="semester">Course Semester  <span style="color:red">*</span><span class=" "> </span></label>
                                                                        <div class="<?php echo !empty($errors['semester'])?'error':'' ?>">
                                                                              <select class="form-control custom-select " name="semester" id="semester">
                                                                                    <option value="">Select Semester</option>
														<?php for($i=1;$i<=2;$i++): ?>
                                                                                          <option value="<?php echo $i;?>" <?php echo ( !empty($semester) && intval($semester)===$i)?'selected=selected':''?>><?php echo $i.(($i===1)?' (1st Semester)':' (2nd Semester)') ?></option>
														<?php endfor; ?>
                                                                              </select>
                                                                        </div>
												<?php if(!empty($errors['semester'])){echo '<p class="help-block">'.$errors['semester'].'</p>'; } ?>
                                                                  </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xs-12">
                                                                  <div class="form-group ">
                                                                        <label class="field_label" for="level">Course Level<span style="color:red">*</span><span class=" "> </span></label>
                                                                        <div class="<?php echo !empty($errors['level'])?'error':'' ?>">
                                                                              <select class="form-control custom-select " name="level" id="level">
                                                                                    <option value="">Select Level</option>
														<?php $level_list=array(100,200,300,400,500,600,700,800); foreach($level_list as $level_val): ?>
                                                                                          <option value="<?php echo $level_val;?>" <?php echo ( !empty($level) && intval($level)===$level_val)?'selected=selected':''?>><?php echo $level_val.'L'; ?></option>
														<?php endforeach; ?>
                                                                              </select>
                                                                        </div>
												<?php if(!empty($errors['level'])){echo '<p class="help-block">'.$errors['level'].'</p>'; } ?>
                                                                  </div>
                                                            </div>
                                                            <div style="clear: both"></div>
                                                            <div class="col-sm-12  col-xs-12">
                                                                  <div class="form-group ">
                                                                        <label class="field_label" for="department">Department <span style="color:red">*</span><span class=" "> </span></label>
                                                                        <div class="<?php echo !empty($errors['department'])?'error':'' ?>">
                                                                              <select class="form-control custom-select " name="department" id="department">
                                                                                    <option value="">Select Department</option>
														<?php if(!empty($dept_list)): foreach ($dept_list as $dept): ?>
                                                                                          <option value="<?php echo $dept['name']; ?>" <?php echo ( !empty($department) && $department===$dept['name'])?'selected=selected':''?>><?php echo ucwords(strtolower($dept['name'])) ?></option>
														<?php endforeach; endif; ?>
                                                                              </select>
                                                                        </div>
												<?php if(!empty($errors['department'])){echo '<p class="help-block">'.$errors['department'].'</p>'; } ?>
                                                                  </div>
                                                            </div>
                                                            <div style="clear: both"></div>
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
