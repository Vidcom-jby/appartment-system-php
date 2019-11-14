<?php
session_start();
if(empty($_SESSION['user']) || ( !empty($_SESSION['user']) && $_SESSION['user']['user_group'] !== strtoupper('administrator'))){
    return header('Location:index.php');
}else{
    $user_group=$_SESSION['user']['user_group'];
}
$old_email=$_GET['email'];
if(empty($old_email) ){
    header("Location: index.php");
}
require_once "update_process.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Borrow - is the loan company, Business Website Template.">
    <meta name="keywords" content="Financial Website Template, Bootstrap Template, Loan Product, Personal Loan">
    <title>Fish Pond Management System - Update User</title>
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
    <link rel="shortcut icon" href="images/site_logo.png?v=2">
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
<?php require_once "slide.php"; ?>

<div style="clear: both;padding-bottom: 10pt"></div>


<!--  Login Section  -->
<section id="contact_section" class="section-space80 ">
    <div style="clear: both"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrapper-content bg-white pinside40">
                    <div class="contact-form mb60">
                        <div class=" ">
                            <div class="row">
                                <form class="reg_form" id="reg_form" method="post" action="" >
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
                                                <h1><b>Update User Data</b></h1>
                                                <p>Kindly complete the form below to Update member</p>
                                            </div>
                                            <?php if (!empty($error)): ?>
                                                <?php if (empty($errors['failure'])): ?>
                                                    <div class="text-center alert alert-danger" style="width: 100%">
                                                        <p>Error(s) Occurred while processing you request. please fix the errors below to continue</p>
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
                                                      <input id="name" name="name" type="text" placeholder="Name *" class="form-control input-md <?php echo !empty($errors['name'])?'error':'' ?>" value="<?php echo !empty($name)?$name:'' ?>" >
                                                      <p><?php if(!empty($errors['name'])){echo $errors['name']; } ?></p>
                                                </div>
                                          </div>
                                          <div class=" col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <input id="phone" name="phone" type="text" placeholder="Phone Number *" class="form-control input-md <?php echo !empty($errors['phone'])?'error':'' ?>" value="<?php echo !empty($phone)?$phone:'' ?>">
                                                      <p><?php if(!empty($errors['phone'])){echo $errors['phone']; } ?></p>
                                                </div>
                                          </div>
                                          <div style="clear: both"></div><br/>
                                          <div class=" col-xs-12">
                                                <div class="form-group">
                                                      <textarea id="address" name="address" type="text" placeholder="Address *" style="height: 100%;min-height: 150px" class="form-control input-md <?php echo !empty($errors['address'])?'error':'' ?>" ><?php echo !empty($address)?$address:'' ?></textarea>
                                                      <p><?php if(!empty($errors['address'])){echo $errors['address']; } ?></p>
                                                </div>
                                          </div>
                                          <div style="clear: both"></div><br/>
                                          <div class=" col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <input id="email" name="email" type="text" placeholder="Email Address *" class="form-control input-md <?php echo !empty($errors['email'])?'error':'' ?>" value="<?php echo !empty($email)?$email:'' ?>">
                                                      <p><?php if(!empty($errors['email'])){echo $errors['email']; } ?></p>
                                                </div>
                                          </div>
                                          <div class=" col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <input id="dob" name="dob" type="text" placeholder="Date of Birth (dd/mm/yyyy) *" class="dob form-control input-md <?php echo !empty($errors['dob'])?'error':'' ?>" value="<?php echo !empty($dob)?$dob:'' ?>">
                                                      <p><?php if(!empty($errors['dob'])){echo $errors['dob']; } ?></p>
                                                </div>
                                          </div>
                                          <div style="clear: both"></div><br/>
                                          <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <input id="password" name="password" type="password" placeholder="Password *" class="form-control input-md <?php echo !empty($errors['password'])?'error':'' ?>" >
                                                      <p><?php if(!empty($errors['password'])){echo $errors['password']; } ?></p>
                                                </div>
                                          </div>
                                          <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                      <input id="cpassword" name="cpassword" type="password" placeholder="Confirm Password *" class="form-control input-md <?php echo !empty($errors['cpassword'])?'error':'' ?>" >
                                                      <p><?php if(!empty($errors['cpassword'])){echo $errors['cpassword']; } ?></p>
                                                </div>
                                          </div>

                                        <div style="clear: both"></div><br/>
                                        <!-- Button -->
                                        <div class="col-md-12 col-xs-12 text-center">
                                            <button type="submit" id="submit_update_form" class="btn btn-default"  style="width: 60%;border-radius: 10px;font-size: 16pt;text-transform: none"><b>Update User</b></button>
                                        </div>
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
        $('.dob').datetimepicker({format: 'd/m/Y', timepicker: false});
    });
</script>

</body>

</html>
