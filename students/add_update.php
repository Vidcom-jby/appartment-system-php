<?php
session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtolower($_SESSION['user']['user_group']) !=="student") {
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
    <title>Online Appartment Management System | <?php echo !empty($id)?' Update':' Add '; ?> Account</title>
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
                                                <h1><b><?php echo !empty($id)?' Update Account':' Register'; ?></b></h1>
                                                <p>Complete the form below to <?php echo !empty($id)?' Update':' Regster'; ?></p>
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
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label class="field_label" for="department">Department (Programme) <span style="color:red">*</span><span class=" "> </span></label>
                                                <div class="<?php echo !empty($errors['department'])?'error':'' ?>">
                                                    <select class="form-control custom-select " name="department" id="department">
                                                        <option value="">Select Department</option>
                                                        <?php if(!empty($dept_list)): foreach ($dept_list as $dept): ?>
                                                            <option value="<?php echo $dept['name']; ?>" <?php echo ( !empty($department) && $department===$dept['name'])?'selected=selected':''?>><?php echo ucwords(strtolower($dept['name'])) ?></option>
                                                        <?php endforeach; endif; ?>
                                                    </select>
                                                </div>
                                                <?php if(!empty($errors['department'])){echo '<p class="help-block">'.$errors['department'].'</p>'; } ?>
                                                <small>e.g Computer Science, Business Administration, etc.</small>
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="field_label" for="title">Matric Number <span style="color:red">*</span><span class=" "> </span></label>
                                                <input id="matric_number" name="matric_number" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['matric_number'])?'error':'' ?>" value="<?php echo !empty($matric_number)?strtoupper($matric_number):'' ?>" >
                                                <?php if(!empty($errors['matric_number'])){echo '<p class="help-block">'.$errors['matric_number'].'</p>'; } ?>
                                                <small>e.g NOU123456789, Nou123456789, etc.</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xs-12">
                                            <div class="form-group ">
                                                <label class="field_label" for="level">Level<span style="color:red">*</span><span class=" "> </span></label>
                                                <div class="<?php echo !empty($errors['level'])?'error':'' ?>">
                                                    <select class="form-control custom-select " name="level" id="level">
                                                        <option value="">Select Level</option>
                                                        <?php $level_list=array('ND 1','ND 2','HND 1','HND 2'); foreach($level_list as $level_val): ?>
                                                            <option value="<?php echo $level_val;?>" <?php echo ( !empty($level) && ($level)===$level_val)?'selected=selected':''?>><?php echo $level_val; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <?php if(!empty($errors['level'])){echo '<p class="help-block">'.$errors['level'].'</p>'; } ?>
                                            </div>
                                        </div>
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
                                        <div class=" col-sm-6 col-xs-12">
                                            <div class="form-group ">
                                                <label class="field_label" for="state">State of Origin <span style="color:red">*</span><span class=" "> </span></label>
                                                <div class="<?php echo !empty($errors['state'])?'error':'' ?>">
                                                    <select class="form-control custom-select state_lists" name="state" id="state">
                                                        <option value="">Select State</option>
                                                        <?php if(!empty($states)):foreach($states as $key=>$value): ?>
                                                            <option value="<?php echo $value;?>" <?php echo ( !empty($state) && $state===$value)?'selected=selected':''?>><?php echo $value ?></option>
                                                        <?php endforeach; endif; ?>
                                                    </select>
                                                </div>
                                                <?php if(!empty($errors['state'])){echo '<p class="help-block">'.$errors['state'].'</p>'; } ?>
                                                <small>e.g Rivers, etc.</small>
                                            </div>
                                        </div>
                                        <div class=" col-sm-6 col-xs-12">
                                            <div class="form-group ">
                                                <label class="field_label" for="lga">LGA of Origin <span style="color:red">*</span><span class=" "> </span></label>
                                                <div class="<?php echo !empty($errors['lga'])?'error':'' ?>">
                                                    <select class="form-control custom-select lga_list" name="lga" id="lga">
                                                        <option value="">Select LGA</option>
                                                        <?php if(!empty($state) && !empty($lgas[$state])): foreach($lgas[$state] as $lga_name): ?>
                                                            <option value="<?php echo $lga_name ?>" <?php echo (!empty($lga) && ($lga_name === $lga))?"selected='selected'":""; ?>><?php echo $lga_name ?></option>
                                                        <?php endforeach; endif; ?>
                                                    </select>
                                                </div>
                                                <?php if(!empty($errors['lga'])){echo '<p class="help-block">'.$errors['lga'].'</p>'; } ?>
                                                <small>e.g Port Harcourt, etc.</small>
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                       <div class="col-sm-12 col-xs-12">
                                            <div class="form-group ">
                                                <label class="field_label" for="level">Gender<span style="color:red">*</span><span class=" "> </span></label>
                                                <div class="<?php echo !empty($errors['gender'])?'error':'' ?>">
                                                    <select class="form-control custom-select " name="gender" id="gender">
                                                        <option value="">Select Gender</option>
                                                        <?php $gender_list=array('Male','Female'); foreach($gender_list as $gender_val): ?>
                                                            <option value="<?php echo $gender_val;?>" <?php echo ( !empty($gender) && ($gender)===$gender_val)?'selected=selected':''?>><?php echo $gender_val; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <?php if(!empty($errors['gender'])){echo '<p class="help-block">'.$errors['gender'].'</p>'; } ?>
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
                                        <div style="clear: both"></div>
	
							<?php
	
							/***
							 *Code segment to wrap Car Image
							 * photo to image base64
							 *
							 ***/
							if(!empty($image)) {
		
								$http_photo = (strpos($image, "http") === false) ? "http://" . $_SERVER['HTTP_HOST'] . $image : $image;
							}
							else {
								$http_photo = "";
							}
							$post_http = !empty($image_http)?$image_http:"";
							if(!empty($http_photo) && empty($post_http)) {
								$ext = pathinfo($http_photo, PATHINFO_EXTENSION);
								try {
								}
								catch (\Exception $e) {
									$http_photo = "";
								}
							}
                                          elseif(!empty($post_http)) {
								$http_photo = $post_http;
							}
	
							$uploaded_photo = !empty($image_uploaded)?$image_uploaded:"";
							/*** End of code segment for wrapping Car Image   ***/
			
							?>
                                          <div class="col-xs-12 text-left">
                                                <div class="form-group">
                                                      <div class=" show_padding <?php echo ( !empty($errors['image_uploaded'])?'error':''); ?>">
                                                            <label for="image" class="field_label">Passport Photo<span style="color:red">*</span></label>
                                                            <div class="thumbnail" id="thumbnail">
                                                                  <img src="images/photohold.png" alt="" />
                                                            </div>
                                                            <button class="btn site_default_btn_small" type="button" id="upload_photo">Click to Upload Image</button>
                                                      </div>
                                                      <input type="hidden" name="image" value="<?php echo !empty($image)?$image:"" ?>"/>
                                                      <input type="hidden" id="image_http" name="image_http" value="<?php echo !empty($http_photo)?$http_photo:'' ?>"/>
                                                      <input type="hidden" id="image_uploaded" name="image_uploaded" value="<?php echo !empty($uploaded_photo)?$uploaded_photo:'' ?>"/>
                                                      
                                                      <p class="help-block"><?php if(!empty($errors['image_uploaded'])){echo $errors['image_uploaded']; } ?></p>
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
<div class="modal fade" id="upload_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow-x:auto;padding:5px">
      <div class="modal-dialog" style="width:100%;max-width:600px;margin:10px auto;">
            <div class="modal-content">
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title" id="myModalLabel">UPLOAD IMAGE</h5>
                  </div>
                  <div class="modal-body">
                        <p class="help-block"></p>
                        <div id="image_editor" class="image-editor">
                              <input type="file" class="cropit-image-input" />
                              <div class="cropit-preview " style="<?php if(!empty($http_photo) || !empty($uploaded_photo)): ?>display:block<?php endif; ?>"></div>
                              <div class="image-size-label" style="<?php if(!empty($http_photo) || !empty($uploaded_photo)): ?>display:block<?php endif; ?>">
                                    <small>Drag image to desired position and/or use slider to resize</small><br/>
                              </div>
                              <div class="controls-wrapper" style="<?php if(!empty($http_photo) || !empty($uploaded_photo)): ?>display:block<?php else: ?>display:none<?php endif; ?>">
                                    <div>
                                          <span class="icone icone-rotate-left rotate-ccw-btn"></span>
                                          <span class="icone icone-rotate-right rotate-cw-btn"></span>
                                    </div>
                                    <input type="range" class="cropit-image-zoom-input" style="<?php if(!empty($http_photo) || !empty($uploaded_photo)): ?>display:block<?php endif; ?>">
                              </div>
                        </div>

                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="continue_upload">UPLOAD</button>
                  </div>
            </div>
      </div>
</div>
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
