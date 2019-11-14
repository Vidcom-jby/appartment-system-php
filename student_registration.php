<?php
session_start();
if(!empty($_SESSION['user'])) {
    header('Location:index.php');
    exit();
}
require_once "registration_process.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <title>Online Student Registration System | Student Registration</title>
	<?php require_once 'css_imports.php'?>
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
                                                <h1><b>Student Registration</b></h1>
                                                <p>Kindly fill out the form below to Register</p>
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
                                          <div class=" col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <label class="field_label" for="matric_number">Matric Number *<span class=" "> </span></label>
                                                      <input id="matric_number" name="matric_number" type="text" placeholder="" class=" form-control input-md <?php echo !empty($errors['matric_number'])?'error':'' ?>" value="<?php echo !empty($matric_number)?$matric_number:'' ?>">
                                                      <p><?php if(!empty($errors['matric_number'])){echo $errors['matric_number']; } ?></p>
                                                </div>
                                          </div>
                                        <div class=" col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                  <label class="field_label" for="last_name">Last Name *<span class=" "> </span></label>
                                                <input id="last_name" name="last_name" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['last_name'])?'error':'' ?>" value="<?php echo !empty($last_name)?$last_name:'' ?>" >
                                            <p><?php if(!empty($errors['last_name'])){echo $errors['last_name']; } ?></p>
                                            </div>
                                        </div>
                                          <div class=" col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                  <label class="field_label" for="other_name">Other Names *<span class=" "> </span></label>
                                                <input id="other_name" name="other_name" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['other_name'])?'error':'' ?>" value="<?php echo !empty($other_name)?$other_name:'' ?>" >
                                            <p><?php if(!empty($errors['other_name'])){echo $errors['other_name']; } ?></p>
                                            </div>
                                        </div>
                                          <div style="clear: both"></div><br/>
                                        <div class=" col-sm-6 col-xs-12">
                                           <div class="form-group">
                                                 <label class="field_label" for="phone">Phone Number *<span class=" "> </span></label>
                                               <input id="phone" name="phone" type="text" placeholder="" class="form-control input-md <?php echo !empty($errors['phone'])?'error':'' ?>" value="<?php echo !empty($phone)?$phone:'' ?>">
                                               <p><?php if(!empty($errors['phone'])){echo $errors['phone']; } ?></p>
                                           </div>
                                        </div>
                                        <div class=" col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                  <label class="field_label" for="email">Email Address *<span class=" "> </span></label>
                                                <input id="email" name="email" type="text" placeholder="Email Address *" class="form-control input-md <?php echo !empty($errors['email'])?'error':'' ?>" value="<?php echo !empty($email)?$email:'' ?>">
                                                <p><?php if(!empty($errors['email'])){echo $errors['email']; } ?></p>
                                            </div>
                                        </div>
                                          <div style="clear: both"></div><br/>
                                         
                                          <div class=" col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <label class="field_label" for="department">Course of Study *<span class=" "> </span></label>
                                                      <select class="form-control <?php echo !empty($errors['department'])?'error':'' ?>" name="department" id="department">
                                                            <option value="">Select Department</option>
                                                            <option value="Animal Science" <?php echo ( !empty($department) && $department==='Animal Science')?'selected=selected':''?>>Animal Science</option>
                                                            <option value="Biochemistry" <?php echo ( !empty($department) && $department==='Biochemistry')?'selected=selected':''?>>Biochemistry</option>
                                                            <option value="Chemical Engineering" <?php echo ( !empty($department) && $department==='Chemical Engineering')?'selected=selected':''?>>Chemical Engineering</option>
                                                            <option value="Civil Engineering" <?php echo ( !empty($department) && $department==='Civil Engineering')?'selected=selected':''?>>Civil Engineering</option>
                                                            <option value="Computer Science" <?php echo ( !empty($department) && $department==='Computer Science')?'selected=selected':''?>>Computer Science</option>
                                                            <option value="Crop & Soil Science" <?php echo ( !empty($department) && $department==='Crop & Soil Science')?'selected=selected':''?>>Crop & Soil Science</option>
                                                            <option value="Adult and Non-Formal Education" <?php echo ( !empty($department) && $department==='Adult and Non-Formal Education')?'selected=selected':''?>>Adult and Non-Formal Education</option>
                                                            <option value="Educational Foundation (English)" <?php echo ( !empty($department) && $department==='Educational Foundation (English)')?'selected=selected':''?>>Educational Foundation (English)</option>
                                                            <option value="Educational Foundation (French)" <?php echo ( !empty($department) && $department==='Educational Foundation (French)')?'selected=selected':''?>>Educational Foundation (French)</option>
                                                            <option value="Electrical & Electronics Engineering" <?php echo ( !empty($department) && $department==='Electrical & Electronics Engineering')?'selected=selected':''?>>Electrical & Electronics Engineering</option>
                                                            <option value="English Studies" <?php echo ( !empty($department) && $department==='English Studies')?'selected=selected':''?>>English Studies</option>
                                                            <option value="Fine Arts & Designs" <?php echo ( !empty($department) && $department==='Fine Arts & Designs')?'selected=selected':''?>>Fine Arts & Designs</option>
                                                            <option value="Geology" <?php echo ( !empty($department) && $department==='Geology')?'selected=selected':''?>>Geology</option>
                                                            <option value="History & Diplomatic Studies" <?php echo ( !empty($department) && $department==='History & Diplomatic Studies')?'selected=selected':''?>>History & Diplomatic Studies</option>
                                                            <option value="Human Kinetics & Health Education" <?php echo ( !empty($department) && $department==='Human Kinetics & Health Education')?'selected=selected':''?>>Human Kinetics & Health Education</option>
                                                            <option value="Hospitality Management & Tourism" <?php echo ( !empty($department) && $department==='Hospitality Management & Tourism')?'selected=selected':''?>>Hospitality Management & Tourism</option>
                                                            <option value="Linguistics & Communication Studies" <?php echo ( !empty($department) && $department==='Linguistics & Communication Studies')?'selected=selected':''?>>Linguistics & Communication Studies</option>
                                                            <option value="Mathematics & Statistics" <?php echo ( !empty($department) && $department==='Mathematics & Statistics')?'selected=selected':''?>>Mathematics & Statistics</option>
                                                            <option value="Mechanical Engineering" <?php echo ( !empty($department) && $department==='Mechanical Engineering')?'selected=selected':''?>>Mechanical Engineering</option>
                                                            <option value="Management" <?php echo ( !empty($department) && $department==='Management')?'selected=selected':''?>>Management</option>
                                                            <option value="Marketing" <?php echo ( !empty($department) && $department==='Marketing')?'selected=selected':''?>>Marketing</option>
                                                            <option value="Music" <?php echo ( !empty($department) && $department==='Music')?'selected=selected':''?>>Music</option>
                                                            <option value="Paediatrics & Child Health" <?php echo ( !empty($department) && $department==='Paediatrics & Child Health')?'selected=selected':''?>>Paediatrics & Child Health</option>
                                                            <option value="Petroleum Engineering" <?php echo ( !empty($department) && $department==='Petroleum Engineering')?'selected=selected':''?>>Petroleum Engineering</option>
                                                            <option value="Philosophy" <?php echo ( !empty($department) && $department==='Philosophy')?'selected=selected':''?>>Philosophy</option>
                                                            <option value="Pure & Industrial Chemistry" <?php echo ( !empty($department) && $department==='Pure & Industrial Chemistry')?'selected=selected':''?>>Pure & Industrial Chemistry</option>
                                                            <option value="Religious & Cultural Studies" <?php echo ( !empty($department) && $department==='Religious & Cultural Studies')?'selected=selected':''?>>Religious & Cultural Studies</option>
                                                            <option value="Science Laboratory Technology" <?php echo ( !empty($department) && $department==='Science Laboratory Technology')?'selected=selected':''?>>Science Laboratory Technology</option>
                                                            <option value="Theatre Arts" <?php echo ( !empty($department) && $department==='Theatre Arts')?'selected=selected':''?>>Theatre Arts</option>
                                                      </select>
                                                      <p><?php if(!empty($errors['department'])){echo $errors['department']; } ?></p>
                                                </div>
                                          </div>
                                        <div style="clear: both"></div><br/>
                                          <div class=" col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <label class="field_label" for="level">Level *<span class=" "> </span></label>
                                                      <select class="form-control <?php echo !empty($errors['level'])?'error':'' ?>" name="level" id="level">
                                                            <option value="">Select your Level</option>
                                                            <option value="100" <?php echo ( !empty($level) && $level==='100')?'selected=selected':''?>>100L</option>
                                                            <option value="200" <?php echo ( !empty($level) && $level==='200')?'selected=selected':''?>>200L</option>
                                                            <option value="300" <?php echo ( !empty($level) && $level==='300')?'selected=selected':''?>>300L</option>
                                                            <option value="400" <?php echo ( !empty($level) && $level==='400')?'selected=selected':''?>>400L</option>
                                                            <option value="500" <?php echo ( !empty($level) && $level==='500')?'selected=selected':''?>>500L</option>
                                                      </select>
                                                      <p><?php if(!empty($errors['level'])){echo $errors['level']; } ?></p>
                                                </div>
                                          </div>
                                          <div style="clear: both"></div><br/>
                                          
                                          <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <label class="field_label" for="email">Password<span class=" "> </span></label>
                                                      <input id="password" name="password" type="password" placeholder="" class="form-control input-md <?php echo !empty($errors['password'])?'error':'' ?>" >
                                                      <p><?php if(!empty($errors['password'])){echo $errors['password']; } ?></p>
                                                </div>
                                          </div>
                                          <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <label class="field_label" for="email">Confirm Password *<span class=" "> </span></label>
                                                      <input id="cpassword" name="cpassword" type="password" placeholder="" class="form-control input-md <?php echo !empty($errors['cpassword'])?'error':'' ?>" >
                                                      <p><?php if(!empty($errors['cpassword'])){echo $errors['cpassword']; } ?></p>
                                                </div>
                                          </div>
                                        <div style="clear: both"></div><br/>
                                        <!-- Button -->
                                        <div class="col-md-12 col-xs-12 text-center">
                                            <button type="submit" id="submit_reg_form" class="btn btn-default"  style="width: 60%;border-radius: 10px;font-size: 16pt;text-transform: none"><b>SUBMIT</b></button>
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
        $('.dob').datetimepicker({format: 'd/m/Y', timepicker: false});
    });
</script>

</body>

</html>
