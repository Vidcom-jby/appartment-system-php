<?php
session_start();
if(empty($_SESSION['user'])){
    return header('Location:index.php');
}else{
    $user_group=$_SESSION['user']['user_group'];
}
require_once "student_lists_process.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Fish Pond Management System - Manage Users</title>
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
                                    <div class="text-center" style="width: 100%;max-width: 100%;display: block;margin: 0 auto">
                                        <div class="col-md-offset-2 col-md-9 col-sm-12 col-xs-12">
                                            <div class="mb60  section-title text-center  ">
                                                <!-- section title start-->
                                                <h1><b>Users</b></h1>
                                                <p>The following are Registered Users</p>
                                            </div>
                                        </div>
                                        <input id="user_group" name="user_group" type="hidden" value="CLIENT" >
                                        <!-- Text input-->
                                        <div class="col-xs-12">
                                            <table class="table-responsive members_table" width="100%" border="1" >
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Name</th>
                                                        <th  class="text-center">Email</th>
                                                        <th  class="text-center">Phone</th>
                                                         <th  class="text-center">Address</th>
                                                        <th  class="text-center">Date of Birth</th>
                                                        <?php if(!empty($_SESSION['user']['user_group']) && $_SESSION['user']['user_group']===strtoupper('administrator')): ?>
                                                        <th  class="text-center">Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while($fish_list = $stmt->fetch(PDO::FETCH_ASSOC)){;?>
                                                    <tr>
                                                        <td  class="text-center" style="vertical-align: middle"><?php echo !empty($fish_list['name'])?$fish_list['name']:'' ?></td>
                                                        <td  class="text-center" style="vertical-align: middle"><?php echo !empty($fish_list['email'])?$fish_list['email']:'' ?></td>
                                                        <td  class="text-center" style="vertical-align: middle"><?php echo !empty($fish_list['phone'])?$fish_list['phone']:'' ?></td>
                                                        <td  class="text-center" style="vertical-align: middle"><?php echo !empty($fish_list['address'])?$fish_list['address']:'' ?></td>
                                                        <td  class="text-center" style="vertical-align: middle"><?php echo !empty($fish_list['dob'])?$fish_list['dob']:'' ?></td>
                                                        <?php if(!empty($_SESSION['user']['user_group']) && $_SESSION['user']['user_group']===strtoupper('administrator')): ?>
                                                            <td  class="text-center" style="vertical-align: middle"><a href="update_member.php?email=<?php echo !empty($fish_list['email'])?$fish_list['email']:'' ?>" class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-edit"></span></a> <a href="javascript:;" onClick="javascript:if(confirm('Are you sure to Delete this User?')){location.href='delete_member.php?email=<?php echo !empty($fish_list['email'])?$fish_list['email']:'' ?>';}" class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-trash"></span></a></td>
                                                        <?php endif; ?>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
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
