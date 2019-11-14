<?php
$user_group=!empty($_GET['user_group'])?strtolower($_GET['user_group']):'';
if(empty($user_group)){
header("Location: index.php");
}
elseif(!in_array($user_group,array('student','administrator','personnel'))){
header("Location: index.php");
}else{
    $user_group=strtoupper($user_group);
}
require_once "login_process.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Online Student Registration System | Student Login</title>
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
                                <form class="login_form" id="login_form" method="post" action="" >
                                    <div class="text-center" style="width: 100%;max-width: 70%;display: block;margin: 0 auto">
                                        <div class="col-sm-12 col-xs-12 text-left">
                                            <div class="mb60  section-title text-center ">
                                                <!-- section title start-->
                                                <h1><b><?php echo (!empty($user_group) && $user_group===strtoupper('administrator'))?'Admin':(!empty($user_group)?ucwords(strtolower($user_group)):'') ?> Login</b></h1>
                                                <p>Kindly fill out the form below to Login</p>
                                            </div>
							    <?php if(!empty($errors)):?>
                                                    <div class="alert alert-dismissable alert-danger text-center text_bold">
                                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error(s) occurred processing your requests, Please fix your error(s) and try again
                                                    </div>
							    <?php endif; ?>
                                        </div>
                                        <input id="user_group" name="user_group" type="hidden" value="<?php echo !empty($user_group)?$user_group:'' ?>" >
                                        <!-- Text input-->
                                        <div class=" col-xs-12">
                                              <?php  if(!empty($user_group) && in_array(strtolower($user_group),array('administrator','personnel'))): ?>
                                            <div class="form-group">
                                                <label class="field_label" for="email">Email<span class=" "> </span></label>
                                                <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md <?php echo !empty($errors['email'])?'error':'' ?>" value="<?php echo !empty($post_data['email'])?$post_data['email']:'' ?>" >
								  <?php if(!empty($errors) && !empty($errors['email'])): ?><p class="help-block"><?php echo $errors['email'] ?></p><?php endif; ?>
                                            </div>
                                              <?php  else: ?>
                                              <div class="form-group">
                                                <label class="field_label control-label" for="matric_number">Matric Number<span class=" "> </span></label>
                                                <input id="matric_number" name="matric_number" type="text" placeholder="Matric Number" class="form-control input-md <?php echo !empty($errors['matric_number'])?'error':'' ?>" value="<?php echo !empty($post_data['matric_number'])?$post_data['matric_number']:'' ?>" >
								    <?php if(!empty($errors) && !empty($errors['matric_number'])): ?><p class="help-block"><?php echo $errors['matric_number'] ?></p><?php endif; ?>
                                              </div>
                                              <?php  endif;  ?>
                                        </div>
                                        <div style="clear: both"></div><br/>
                                        <!-- Text input-->
                                        <div class=" col-xs-12">
                                            <div class="form-group">
                                                <label class="field_label control-label" for="password">Password<span class=" "> </span></label>
                                                <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md <?php echo !empty($errors['password'])?'error':'' ?>" >
								  <?php if(!empty($errors) && !empty($errors['password'])): ?><p class="help-block"><?php echo $errors['password'] ?></p><?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                          <div style="clear: both"></div><br/>
                                        <div class="col-md-12 col-xs-12 text-center submit_btn_holder">
                                            <button type="submit" id="submit_login_form" class="btn btn-default"  style="width: 30%;border-radius: 10px;font-size: 16pt;text-transform: none"><b>SUBMIT</b></button>
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

</body>

</html>
