<?php
session_start();
if(empty($_SESSION['user']) || (!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtolower($_SESSION['user']['user_group']) !=="administrator")) {
	header('Location:index.php');
	exit();
}else{
	$user_group=$_SESSION['user']['user_group'];
}
require_once "departments_process.php";
require_once "../url.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Student Registration System | Manage Departments</title>
      <base  href="<?php echo $url; ?>"/>
	<?php require_once '../css_imports.php'?>
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
<?php require_once "../header.php"; ?>

<div style="clear: both;padding-bottom: 10pt"></div>


<!--  Login Section  -->
<section id="contact_section" class="section-space80 ">
	<div style="clear: both"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="wrapper-content bg-white pinside40">
                              <div class="form-group top_right_btn">
                                    <div class="col-xs-12 text-right">
                                         <a href="departments/add_update.php" class="site_default_btn_small">Add Department</a>
                                    </div>
                              </div>
					<?php if(!empty($_SESSION['failure'])): ?>
						<div class="form-group ">
							<div class="col-xs-12">
								<div class="alert alert-danger text-center ">
									<p><strong><?php echo $_SESSION['failure']; ?></strong></p>
								</div>
							</div>
						</div>
						<?php unset($_SESSION['failure']); ?>
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
									<div class="" style="width: 100%;max-width: 100%;display: block;margin: 0 auto">
										<div class="col-sm-12 col-xs-12">
											<div class="mb60  section-title text-center  ">
												<!-- section title start-->
												<h1><b>Departments</b></h1>
												<p>The following are Lists of Departments</p>
											</div>
										</div>
										<input id="user_group" name="user_group" type="hidden" value="CLIENT" >
										<!-- Text input-->
										<div class="col-xs-12">
                                                                  <table id="dept_list_data_table" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
                                                                        <thead>
												<tr>
													<th class="text-center">Name</th>
													<th  class="text-center">Code</th>
													<th  class="text-center">Faculty</th>
													<th  class="text-center">Date Added</th>
													<?php if(!empty($_SESSION['user']['user_group']) && $_SESSION['user']['user_group']===strtoupper('administrator')): ?>
														<th  class="text-center">Action</th>
													<?php endif; ?>
												</tr>
												</thead>
												<tbody>
												<?php while($dept_list = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
                                                                              <tr>
                                                                                    <td  class="text-center" style="vertical-align: middle"><?php echo !empty($dept_list['name'])?$dept_list['name']:'' ?></td>
                                                                                    <td  class="text-center" style="vertical-align: middle"><?php echo !empty($dept_list['code'])?$dept_list['code']:'' ?></td>
                                                                                    <td  class="text-center" style="vertical-align: middle"><?php echo !empty($dept_list['faculty'])?$dept_list['faculty']:'' ?></td>
                                                                                    <td  class="text-center" style="vertical-align: middle"><?php echo !empty($dept_list['created'])?$dept_list['created']:'' ?></td>
														<?php if(!empty($_SESSION['user']['user_group']) && $_SESSION['user']['user_group']===strtoupper('administrator')): ?>
                                                                                          <td  class="text-center" style="vertical-align: middle">
                                                                                                <a data-toggle="tooltip" title="Update this Department (<?php  echo !empty($dept_list['name'])?$dept_list['name']:'' ?>)" href="departments/add_update.php?id=<?php echo !empty($dept_list['id'])?$dept_list['id']:'' ?>" class="btn btn-info " ><span class="glyphicon glyphicon-edit"></span></a>
                                                                                                <a data-location_url="departments/delete.php?id=<?php echo !empty($dept_list['id'])?$dept_list['id']:'' ?>" data-message="Are you sure you want to delete this Department?" data-toggle="tooltip" title="Delete this Department (<?php  echo !empty($dept_list['name'])?$dept_list['name']:'' ?>)" href="javascript:;" class="btn btn-danger modal_action_btn"><i class="fas fa-trash"></i></a>
                                                                                          </td>
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
<?php require_once "../footer.php"; ?>


</body>

</html>
