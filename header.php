<div class="header">
      <div class="container">
            <div class="row">
                  <div class="col-md-2 col-sm-12 col-xs-6">
                        <!-- logo -->
                        <div class="logo">
                              <a href="<?php echo !empty($url)?$url:''; ?>"><img src="images/site_logo.png?v=2.1" alt="site logo" style=""></a>
                        </div>
                  </div>
                  <!-- logo -->
                  <div class="col-md-10 col-sm-12 col-xs-12">
                        <div id="navigation">
                              <!-- navigation start-->
                              <ul>
                                    <li class="active" ><a href="index.php#home" >Home</a>
                                    </li>
                                    <li><a href="javascript:void(0)"  ><?php echo !empty($_SESSION['user'])?'Account':'Login'; ?></a>
                                          <ul>
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
                                                      <ul>
                                                            <li><a href="students/register_courses.php"  >Register Courses</a></li>
                                                            <li><a href="students/register_exams.php"  >Register Exams</a></li>
															<li><a href="students/registered_courses.php"  >View Registered Courses</a></li>
                                                      </ul>
                                                </li>
                                                <li><a href="javascript:void(0)"  >Wallet</a>
                                                      <ul>
                                                            <li><a href="students/view_payments.php"  >View Wallet Payments</a></li>
                                                            <li><a href="students/load_wallet.php"  >Fund Wallet</a></li>
                                                      </ul>
                                                </li>
							<?php elseif(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('personnel')): ?>
                                                <li><a href="javascript:void(0)"  >Payments</a>
                                                      <ul>
                                                            <li><a href="personnel/manage_payments.php"  >Manage Payments</a></li>
                                                      </ul>
                                                </li>
							<?php elseif(!empty($_SESSION['user']['user_group']) && strtoupper($_SESSION['user']['user_group'])===strtoupper('administrator')): ?>
                                                <li><a href="javascript:void(0)" >Courses</a>
                                                      <ul>
                                                            <li><a href="admin_courses"  >Manage Courses</a></li>
                                                            <li><a href="admin_courses/add_update.php" >Add Course</a></li>
                                                      </ul>
                                                </li>
                                                <li><a href="#" class="">Departments</a>
                                                      <ul>
                                                            <li><a href="departments"  >Manage Departments</a></li>
                                                            <li><a href="departments/add_update.php"  >Add  a Department</a></li>
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
                        <!-- /.navigation start-->
                  </div>

                  <!-- /.search start-->
            </div>
      </div>
</div>