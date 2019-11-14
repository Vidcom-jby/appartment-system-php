<div class="footer section-space80">
    <!-- footer -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="footer-logo">
                    <!-- Footer Logo -->
                      <img src="images/site_logo.png?v=2.1" alt="site logo" style=""></div>
                <!-- /.Footer Logo -->
            </div>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="col-md-5">
                    <h3 class="newsletter-title">Signup Our Newsletter</h3>
                </div>
                <div class="col-md-7">
                    <div class="newsletter-form">
                        <!-- Newsletter Form -->
                        <form method="post" name="news_form" id="news_form">
                            <div class="input-group">
                                <input type="email" class="form-control" id="newsletter" name="newsletter" placeholder="Enter Email">
                                <span class="input-group-btn">
                <button class="btn btn-default" type="submit" id="submit_news_form" style="text-transform: none;line-height: 100%">SIGN UP</button>
                </span> </div>
                            <!-- /input-group -->
                        </form>
                    </div>
                    <!-- /.Newsletter Form -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
        </div>
        <hr class="dark-line">
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="widget-text mt40">
                    <!-- widget text -->
                      
                      <p>The National Open University of Nigeria is an ODL institution renowned for providing functional,
                            flexible, accessible, cost-effective education adequate for flourishing in the 21st  century and beyond.
                            Right from its first inception in July 1983, NOUN mandate has remained to deliver university education
                            at the doorstep of every interested  Nigerian.
                      </p>
                      <p>
                            This Portal is an registration system for students of NOUN to enable them process  their Semester,
                            Course and Exam registrations with relative ease. Students are to read the guides below on
                            how to use this portal for their semester registrations.
                      </p>
                </div>
                <!-- /.widget text -->
            </div>
            <div class="col-md-2 hidden-sm hidden-xs"></div>
            <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="widget-footer mt40">
                    <!-- widget footer -->
                    <!-- navigation start-->
    <ul class="footer_menu">
                                    <li class="active" ><a href="index.php#home" >Home</a>
                                    </li>
                                    <li><a href="javascript:void(0)"  ><?php echo !empty($_SESSION['user'])?'Account':'Login'; ?></a>
                                          <ul class="footer_sub_menu">
                <?php if(!empty($_SESSION['user'])): ?>
                  <?php if(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('administrator')): ?>
                                                            <li><a href="admin_students/profile.php?id=<?php echo !empty($_SESSION['user']['id'])?$_SESSION['user']['id']:'' ?>"  >My Profile</a></li>
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
                                                <li><a href="javascript:void(0)"  >Courses</a>
                                                      <ul class="footer_sub_menu">
                                                            <li><a href="students/register_courses.php"  >Register Courses</a></li>
                                                            <li><a href="students/register_exams.php"  >Register Exams</a></li>
                              <li><a href="students/registered_courses.php"  >View Registered Courses</a></li>
                                                      </ul>
                                                </li>
                                                <li><a href="javascript:void(0)"  >Wallet</a>
                                                      <ul class="footer_sub_menu">
                                                            <li><a href="students/view_payments.php"  >View Wallet Payments</a></li>
                                                            <li><a href="students/load_wallet.php"  >Fund Wallet</a></li>
                                                      </ul>
                                                </li>
              <?php elseif(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('personnel')): ?>
                                                <li><a href="javascript:void(0)"  >Payments</a>
                                                      <ul class="footer_sub_menu">
                                                            <li><a href="personnel/manage_payments.php"  >Manage Payments</a></li>
                                                      </ul>
                                                </li>
              <?php elseif(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('administrator')): ?>
                                                <li><a href="javascript:void(0)" >Courses</a>
                                                      <ul class="footer_sub_menu">
                                                            <li><a href="admin_courses"  >Manage Courses</a></li>
                                                            <li><a href="admin_courses/add_update.php" >Add Course</a></li>
                                                      </ul>
                                                </li>
                                                <li><a href="#" class="">Departments</a>
                                                      <ul class="footer_sub_menu">
                                                            <li><a href="departments"  >Manage Departments</a></li>
                                                            <li><a href="departments/add_update.php"  >Add  a Department</a></li>
                                                      </ul>
                                                </li>
                                                <li><a href="#" class="">Students</a>
                                                      <ul class="footer_sub_menu">
                                                            <li><a href="admin_students"  >Manage Students</a></li>
                                                            <li><a href="admin_students/add_update.php"  >Add a Student</a></li>
                                                      </ul>
                                                </li>
              <?php endif; ?>
            <?php endif; ?>
                                    <li><a href="#" class="">About</a>
                                          <ul class="footer_sub_menu">
                                                <li>
                                                      <a href="index.php#about_section"  >Overview</a>
                                                </li>
                                                <li>
                                                      <a href="index.php#process_section" >How to use Portal</a>
                                                </li>
                                          </ul>
                                    </li>
                                    <li><a href="index.php#contact_section" title="Contact us" >Contact Us</a></li>
            <?php if(!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('student')): ?>
                                    <li><a  title="Wallet Balance" class="wallet_val"><?php echo !empty($_SESSION['user']['wallet_balance'])?'#'.number_format(floatval($_SESSION['user']['wallet_balance']),2,'.',','):'#0.00' ?></a></li>
                                    <?php endif; ?>
                              </ul>





                </div>
                <!-- /.widget footer -->
            </div>


        </div>
    </div>
</div>
<!-- /.footer -->
<div class="tiny-footer">
    <!-- tiny footer -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <p>© Copyright <?php echo date('Y'); ?>&nbsp; | &nbsp;Online Student Registration System</p>
            </div>

        </div>
    </div>
</div>
<!-- /.tiny footer -->
<!-- back to top icon -->
<a href="#0" class="cd-top" title="Go to top">Top</a>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootbox.min.js"></script>
<script type="text/javascript" src="js/menumaker.js"></script>
<!-- animsition -->
<script type="text/javascript" src="js/animsition.js"></script>
<script type="text/javascript" src="js/animsition-script.js"></script>
<!-- sticky header -->
<script type="text/javascript" src="js/jquery.sticky.js"></script>
<script type="text/javascript" src="js/sticky-header.js"></script>
<!-- slider script -->
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/slider-carousel.js"></script>
<script type="text/javascript" src="js/service-carousel.js"></script>
<script src="js/vendor/underscore/underscore.min.js"></script>

<!----DataTables Lib --->

<script src="js/vendor/datatables/jquery.dataTables.js"></script>
<script src="js/vendor/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="js/vendor/datatables/dataTables.fixedHeader.min.js"></script>
<script src="js/vendor/icheck.js"></script>
<script src="js/vendor/datatables/dataTables.buttons.min.js"></script>
<script src="js/vendor/datatables/buttons.flash.min.js"></script>
<script src="js/vendor/datatables/jszip.min.js"></script>
<script src="js/vendor/datatables/pdfmake.min.js"></script>
<script src="js/vendor/datatables/vfs_fonts.js"></script>
<script src="js/vendor/datatables/buttons.html5.min.js"></script>
<script src="js/vendor/datatables/buttons.print.min.js"></script>
<script src="js/vendor/bootstrap/bootstrap-datetimepicker.js"></script>
<script src="js/vendor/bootstrap/bootstrap-tagsinput.js"></script>
<script src="js/vendor/jquery.cropit.js"></script>

<!-- Back to top script -->
<script src="js/back-to-top.js" type="text/javascript"></script>
<script src="js/smoothscroll.js" type="text/javascript"></script>
<script src="js/select2.min.js?v=<?php echo time(); ?>" type="text/javascript"></script>
<script src="js/main.js?v=<?php echo time(); ?>" type="text/javascript"></script>
