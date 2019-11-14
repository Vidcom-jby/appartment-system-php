<?php
session_start();
require_once 'url.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
   <title>Online Apartment Management System | Home</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/fontello.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/animsition.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Merriweather:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- owl Carousel Css -->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/site_favicon.png?v=<?php echo time(); ?>">
      <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
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
<div class="header">
      <div class="container">
            <div class="row">
                  <div class="col-md-2 col-sm-12 col-xs-6">
                        <!-- logo -->
                        <div class="logo">
                              <a href="<?php echo $url; ?>"><img src="images/site_logo.png?v=2.1" alt="site logo" style=""></a>
                        </div>
                  </div>
                  <!-- logo -->
                  <div class="col-md-10 col-sm-12 col-xs-12">
                        <div id="navigation">
                              <!-- navigation start-->
 <!-- navigation start-->

                              <ul>
                                    <li class="active" ><a href="#home" >Home</a>
                                    </li>
                                    <li><a href="javascript:void(0)"  ><?php echo !empty($_SESSION['user'])?'Account':'Login'; ?></a>
                                          <ul>
                <?php if(!empty($_SESSION['user'])): ?>
                  <?php if(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('administrator')): ?>
                                                            <li><a href="admin_students/profile.php?id=<?php echo !empty($_SESSION['user']['id'])?$_SESSION['user']['id']:'' ?>"  >Profile</a></li>
                  <?php endif;  ?>
                  <?php if(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('student')): ?>
                                                            <li><a href="students/add_update.php?id=<?php echo !empty($_SESSION['user']['id'])?$_SESSION['user']['id']:'' ?>"  >Profile</a></li>
                  <?php elseif(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('personnel')): ?>
                                                            <li><a href="personnel/profile.php?id=<?php echo !empty($_SESSION['user']['id'])?$_SESSION['user']['id']:'' ?>"  >Profile</a></li>
                  <?php endif; ?>
                                                      <li> <a href="logout.php"  >Logout</a></li>
                <?php endif; ?>
                <?php if(empty($_SESSION['user'])): ?>
                                                      <li>
                                                            <a href="login.php?user_group=administrator"  >Admin Login</a>
                                                      </li>
                                                      <li>
                                                            <a href="login.php?user_group=personnel"  >Personnel Login</a>
                                                      </li>
                                                      <li>
                                                            <a href="login.php?user_group=student" >Student Login</a>
                                                      </li>
                                                      <li>
                                                            <a href="students/add_update.php" >Student Registration</a>
                                                      </li>
                <?php endif; ?>
                                          </ul>
                                    </li>
            <?php if(!empty($_SESSION['user'])): ?>
              <?php if(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('student')): ?>
                                                <li><a href="javascript:void(0)"  >Accommodation</a>
                                                      <ul>
                                                            <li><a href="students/register_courses.php"  >Apply Accommodation</a></li>
                                                            <li><a href="students/register_exams.php"  >View Status</a></li>
                           
                                                      </ul>
                                                </li>
                                                <li><a href="javascript:void(0)">Payment</a>
                                                      <ul>
                                                                   <li><a href="students/load_wallet.php"  >Upload Bank Teller</a></li>
                                                            <li><a href="students/view_payments.php"  >View Payment Status</a></li>
                                               
                                                      </ul>
                                                </li>
              <?php elseif(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('personnel')): ?>
                                                <li><a href="javascript:void(0)"  >Payments</a>
                                                      <ul>
                                                            <li><a href="personnel/manage_payments.php"  >Manage Payments</a></li>
                                                      </ul>
                                                </li>
              <?php elseif(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('administrator')): ?>
                                                <li><a href="javascript:void(0)" >Hostels</a>
                                                      <ul>
                                                            <li><a href="admin_hostels">Manage Hostels</a></li>
                                                            <li><a href="admin_hostels/add_update.php" >Add Hostel</a></li>
                                                      </ul>
                                                </li>
                                                <li><a href="#" class="">Rooms</a>
                                                      <ul>
                                                            <li><a href="admin_rooms">Manage Rooms</a></li>
                                                            <li><a href="admin_rooms/add_update.php"  >Add a Room</a></li>
                                                      </ul>
                                                </li>
                                                <li><a href="#" class="">Students</a>
                                                      <ul>
                                                            <li><a href="admin_students"  >Manage Students</a></li>
                                                            <li><a href="admin_students/add_update.php"  >Add a Student</a></li>
                                                      </ul>
                                                </li>
              <?php endif; ?>
            <?php endif; ?>
                                    <li><a href="#" class="">About</a>
                                          <ul>
                                                <li>
                                                      <a href="#about_section"  >Overview</a>
                                                </li>
                                                <li>
                                                      <a href="#process_section" >How to use Portal</a>
                                                </li>
                                          </ul>
                                    </li>
                                    <li><a href="#contact_section" title="Contact us" >Contact Us</a></li>
            <?php if(!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('student')): ?>
                                    <li><a  title="Wallet Balance" class="wallet_val"><?php echo !empty($_SESSION['user']['wallet_balance'])?'#'.number_format(floatval($_SESSION['user']['wallet_balance']),2,'.',','):'#0.00' ?></a></li>
                                    <?php endif; ?>
                              </ul>
                        </div>
                        <!-- /.navigation start-->
                  </div>
                  <!-- /.search start-->
            </div>
      </div>
</div>

  <?php require_once 'slide.php' ?>
    <div style="clear: both;padding-bottom: 10pt"></div>


    <!-- About Section  -->

    <section id="about_section" class="" >
        <div style="clear: both;padding-bottom: 10pt"></div>
        <div class="container" >
            <div class="row" >
                <div class="col-md-12">
                    <div class="wrapper-content bg-white ">
                        <div class="about-section pinside40" style="background-color: #eee;">
                            <div class="row">
                                <h1 class="text-center "><strong>Overview</strong></h1>
                                <br>
                                <div class="col-xs-12 text-justify">
                                    
                                     
                                      <p>
                                                This Portal is an apartment allocation system for students of IMT to enable them apply and get their hostel accommodations. Students are adviced to read the guides below on how to use this portal for their hostel accommodations.
                                      </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section  -->

<section id="process_section" class="" >
<div class="bg-white section-space80">
      <div class="container">
            <div class="row">
                  <div class="col-md-offset-2 col-md-8 col-xs-12">
                        <div class="mb100 text-center section-title">
                              <!-- section title start-->
                              <h1><span class="how_to">How to use this portal</span></h1>
                        </div>
                        <!-- /.section title start-->
                  </div>
            </div>
            <div class="row">
                  <div class="col-sm-3 col-xs-12">
                        <div class="bg-white pinside40 number-block mb30 outline">
                              <div class="circle"><span class="number">1</span></div>
                              <h3>Register on this site</h3>
                              <p>Students are required to first register on this site in order to process their hostel accommodations.
                              </p>
                        </div>
                  </div>
                  <div class=" col-sm-3 col-xs-12">
                        <div style="margin-top: 30px" class="visible-xs"></div>
                        <div class="bg-white pinside40 number-block mb30 outline">
                              <div class="circle"><span class="number">2</span></div>
                              <h3>Login and Upload your Bank Payment Teller</h3>
                             <p>Students and required to make the necessary payment into the school bank account. After payment has been made, students will return to this site and upload their payment teller before applying for hostel accommodation.
                        </div>
                  </div>
                  <div class=" col-sm-3 col-xs-12">
                        <div style="margin-top: 30px" class="visible-xs"></div>
                        <div class="bg-white pinside40 number-block mb30 outline">
                              <div class="circle"><span class="number">3</span></div>
                              <h3>Apply for Hostel Accommodation</h3>
                              <p>After uploading bank teller and payment is approved, students can then apply for their hostel accommodation.</p>
                        </div>
                  </div>
                  <div class="col-sm-3 col-xs-12">
                        <div style="margin-top: 30px" class="visible-xs"></div>
                        <div class="bg-white pinside40 number-block mb30 outline">
                              <div class="circle"><span class="number">4</span></div>
                              <h3>View Accommodation status and room allocated to.</h3>
                              <p>After successful application, students are to wait for their application to be  processed after which they can view the room allocated to them (if any).</p>
                        </div>
                  </div>
            </div>
            
      </div>
</div>
    <!--  Contact Section  -->
    <section id="contact_section" class="section-space80 ">
        <div style="clear: both"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrapper-content bg-white pinside40">
                    <div class="contact-form mb60">
                        <div class=" ">
                            <div class="col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                                <div class="mb60  section-title text-center  ">
                                    <!-- section title start-->
                                    <h1><b>Get In Touch With Us</b></h1>
                                    <p>If you have any Questions,<br/> Reach out to us &amp; we will respond as soon as possible.</p>
                                </div>
                            </div>
                            <div class="row">
                                <form class="contact_form" id="contact_form" method="post" >
                                    <div class="">
                                        <!-- Text input-->
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="sr-only control-label" for="name">name<span class=" "> </span></label>
                                                <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" >
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="sr-only control-label" for="email">Email<span class=" "> </span></label>
                                                <input id="email" name="email" type="email" placeholder="Email" class="form-control input-md" >
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="sr-only control-label" for="phone">Phone<span class=" "> </span></label>
                                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control input-md" >
                                            </div>
                                        </div>
                                        <!-- Select Basic -->
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label" for="message"> </label>
                                                <textarea class="form-control" id="message" rows="7" name="message" placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="col-md-12 col-xs-12 text-center submit_btn_holder">
                                            <button type="submit" id="submit_contact_form" class="btn btn-default" style="width: 30%;border-radius: 10px;font-size: 16pt;text-transform: none"><b>SUBMIT</b></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.section title start-->
                    </div>
                    <div class="contact-us mb60">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb60  section-title text-center">
                                    <!-- section title start-->
                                    <h1><b>We are here to help you</b></h1>
                                    <p class="lead"><em>Alternatively, you can Locate our Study Centre as follows:</em></p>
                                </div>
                                <!-- /.section title start-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <div class="bg-boxshadow pinside60 outline text-center mb30">
                                    <div class="mb40"><i class="icon-briefcase icon-2x icon-default"></i></div>
                                    <h2 class="capital-title"><b>School Address:</b></h2>
                                      <p>IMT, Independent Layout, Enugu, Enugu State, Nigeria.</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="bg-boxshadow pinside60 outline text-center mb30">
                                    <div class="mb40"><i class="icon-phone-call icon-2x icon-default"></i></div>
                                    <h2 class="capital-title"><b>Call us at </b></h2>
                                    <h1 class="text-big">+2348165688126</h1>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="bg-boxshadow pinside60 outline text-center mb30">
                                    <div class="mb40"> <i class="icon-letter icon-2x icon-default"></i></div>
                                    <h2 class="capital-title"><b>Email Address</b></h2>
                                    <p>
                                          <a href="mailto:info@imt.edu.ng" class="no_link_color">info@imt.edu.ng</a> </p>
                                </div>
                            </div>
                        </div>
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
