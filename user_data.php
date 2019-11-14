<?php
session_start();
if(empty($_SESSION['user'])){
    return header('Location:index.php');
}else{
    $user_group=$_SESSION['user']['user_group'];
}

require_once "student_data_process.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <title>Online Student Registration System | Student Personal Data</title>
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
                                <form class="fish_data_form" id="fish_data_form" method="post" action="" >
                                    <?php if(!empty($errors['user_data'])): ?>
                                        <div class="text-center" style="width: 100%;max-width: 85%;display: block;margin: 0 auto">
                                            <div class="col-md-offset-2 col-md-9 col-sm-12 col-xs-12">
                                                <div class="text-center alert alert-danger" style="width: 100%">
                                                    <?php echo $errors['user_data'] ?>
                                                </div><br/>
                                            </div>
                                        </div>
                                    <?php else: ?>

                                        <div class="text-center" style="width: 100%;max-width: 85%;display: block;margin: 0 auto">
                                            <div class="col-md-offset-2 col-md-9 col-sm-12 col-xs-12">
                                                <div class="mb60  section-title text-center  ">
                                                    <!-- section title start-->
                                                    <h1><b>Student  Data</b></h1>
                                                </div>
                                            </div>
                                            <input id="user_group" name="user_group" type="hidden" value="CLIENT" >
                                            <!-- Text input-->
                                              <div class=" col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                          <label class=" control-label" for="name">Last Name<span class=" "> </span></label>
                                                          <input id="last_name" name="last_name" type="text" placeholder="Lat Name " class="form-control input-md <?php echo !empty($errors['last_name'])?'error':'' ?>" value="<?php echo !empty($last_name)?$last_name:'' ?>" >
                                                    </div>
                                              </div>
                                              <div class=" col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                          <label class=" control-label" for="other_name">Other Names<span class=" "> </span></label>
                                                          <input id="other_name" name="other_name" type="text" placeholder="Other Name " class="form-control input-md <?php echo !empty($errors['other_name'])?'error':'' ?>" value="<?php echo !empty($other_name)?$other_name:'' ?>" >
                                                    </div>
                                              </div>
                                              <div style="clear: both"></div><br/>
                                              <div class=" col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                          <label class=" control-label" for="name">Phone Number <span class=" "> </span></label>
                                                          <input id="phone" name="phone" type="text" placeholder="Phone Number " class="form-control input-md <?php echo !empty($errors['phone'])?'error':'' ?>" value="<?php echo !empty($phone)?$phone:'' ?>">
                                                    </div>
                                              </div>
                                              <div class=" col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                          <label class=" control-label" for="name">Email Address<span class=" "> </span></label>
                                                          <input id="email" name="email" type="text" placeholder="Email Address " class="form-control input-md <?php echo !empty($errors['email'])?'error':'' ?>" value="<?php echo !empty($email)?$email:'' ?>">
                                                    </div>
                                              </div>
                                              <div style="clear: both"></div><br/>
                                              <div class=" col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                          <label class=" control-label" for="matric_number">Matric Number<span class=" "> </span></label>
                                                          <input id="matric_number" name="matric_number" type="text" placeholder="Matric Number" class=" form-control input-md <?php echo !empty($errors['matric_number'])?'error':'' ?>" value="<?php echo !empty($matric_number)?strtoupper($matric_number):'' ?>">
                                                    </div>
                                              </div>
                                              <div class=" col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                          <label class=" control-label" for="name">Department<span class=" "> </span></label>
                                                          <input id="department" name="department" type="text" placeholder="Department" class=" form-control input-md <?php echo !empty($errors['department'])?'error':'' ?>" value="<?php echo !empty($department)?$department:'' ?>">
                                                    </div>
                                              </div>
                                              <div style="clear: both"></div><br/>
                                              <div class=" col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                          <label class=" control-label" for="level">Level<span class=" "> </span></label>
                                                          <input id="level" name="level" type="text" placeholder="level" class=" form-control input-md <?php echo !empty($errors['level'])?'error':'' ?>" value="<?php echo !empty($level)?$level:'' ?>">
                                                    </div>
                                              </div>
                                          
                                              <div style="clear: both"></div><br/>
                                        </div>
                                    <?php endif; ?>
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

<script >$(document).ready(function(){
        $('.fish_data_form input,.fish_data_form select,.fish_data_form textarea').prop('disabled',true);
    });
</script>

</body>

</html>
