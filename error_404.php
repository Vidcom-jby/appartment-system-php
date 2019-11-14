<?php
session_start();
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
    <title>Online Student Registration System |  Page Not Found</title>
	<?php require_once 'css_imports.php'?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


<body class="animsition">

    <!-- /.top-bar -->
    <?php require_once "header.php"; ?>

    <div class=" ">
        <!-- content start -->
          <section id="contact_section" class="section-space80 ">
                <div class="container error_page">
                      <div class="row">
                            <div class="col-md-12">
                                  <div class="wrapper-content bg-white pinside60">
                                        <div class="row">
                                              <div class="col-md-offset-3 col-md-6 col-sm-12">
                                                    <div class="error-img mb60">
                                                          <img src="images/error-img.png" class="" alt="">
                                                    </div>
                                                    <div class="error-ctn text-center">
                                                          <h1 class="msg">OOPS</h1>
                                                          <p class="error_title">The web page you were trying to reach could not be found on the server, or that you typed in the URL incorrectly.</p>
                                                          <a href="<?php echo $url ?>" class="site_default_btn_small text-center">Go to homepage</a>
                                                    </div>
                                              </div>
                                        </div>
                                  </div>
                            </div>
                      </div>
                </div>
      
          </section>
    </div>

    <!-- Footer Section -->
    <?php require_once "footer.php"; ?>
</body>

</html>
