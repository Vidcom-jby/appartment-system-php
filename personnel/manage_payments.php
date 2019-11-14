<?php
session_start();
if(empty($_SESSION['user']) || (!empty($_SESSION['user']) && !empty($_SESSION['user']['user_group']) && strtolower($_SESSION['user']['user_group']) !=="personnel")) {
	header('Location:index.php');
	exit();
}else{
	$user_group=$_SESSION['user']['user_group'];
}
require_once "view_payment_process.php";
require_once "../url.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Online Student Registration System | Approve Wallet Payments</title>
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
							<a href="students/load_wallet.php" class="site_default_btn_small">Fund Wallet</a>
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
						<?php unset($_SESSION['recover_email_failure']); ?>
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
												<h1><b>Payment Records</b></h1>
												<p>The following are List of Students Wallet Payments</p>
											</div>
										</div>
										<input id="user_group" name="user_group" type="hidden" value="CLIENT" >
										<!-- Text input-->
										<div class="col-xs-12">
											<table id="dept_list_data_table" class="table  responsive nowrap table-bordered" cellspacing="0" width="100%">
												<thead>
												<tr>
													<th class="text-center">Payment Date</th>
													<th  class="text-center">Amount</th>
													<th  class="text-center">Bank Name</th>
													<th  class="text-center">Bank Branch</th>
													<th  class="text-center">Teller</th>
													<th  class="text-center">Payment Status</th>
													<?php if(!empty($_SESSION['user']['user_group']) && $_SESSION['user']['user_group']===strtoupper('personnel')): ?>
														<th  class="text-center">Action</th>
													<?php endif; ?>
												</tr>
												</thead>
												<tbody>
												<?php while($dept_list = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
													<tr>
														<td  class="text-center" style="vertical-align: middle"><?php echo !empty($dept_list['date'])?($dept_list['date']):'' ?></td>
														<td  class="text-center" style="vertical-align: middle">#<?php echo !empty($dept_list['amount'])?number_format(floatval($dept_list['amount']),2,'.',','):0.00 ?></td>
														<td  class="text-center" style="vertical-align: middle"><?php echo !empty($dept_list['bank_name'])?($dept_list['bank_name']):'' ?></td>
														<td  class="text-center" style="vertical-align: middle"><?php echo !empty($dept_list['bank_branch'])?$dept_list['bank_branch']:'' ?></td>
														<td  class="text-center" style="vertical-align: middle"><a href="<?php echo !empty($dept_list['teller_image'])?$dept_list['teller_image']:'' ?>" target="_blank"><img src="<?php echo !empty($dept_list['teller_image'])?$dept_list['teller_image']:'' ?>" style="width: 100%;max-width: 200px" /></a></td>
														
                                                                                    <td  class="text-center" style="vertical-align: middle">
													<?php if( !empty($dept_list['status']) && strtolower( $dept_list['status'])==="approved"): ?>
                                                                                          <span class="label active item_status">
                                                                                          <?php echo !empty($dept_list['status'])?strtoupper($dept_list['status']):'' ?>
                                                                                          </span>
													<?php elseif ( !empty($dept_list['status']) && strtolower( $dept_list['status'])==="pending"): ?>
                                                                                    <span class="label inactive item_status">
                                                                                          <?php echo !empty($dept_list['status'])?strtoupper($dept_list['status']):'' ?>
                                                                                          </span>
													<?php endif; ?>
                                                                                    </td>
														<?php if(!empty($_SESSION['user']['user_group']) && $_SESSION['user']['user_group']===strtoupper('personnel')): ?>
															<td  class="text-center" style="vertical-align: middle">
                                                                                                <?php if( !empty($dept_list['status']) && strtolower( $dept_list['status'])==="approved"): ?>
																<a data-location_url="personnel/approve_payment.php?id=<?php echo !empty($dept_list['id'])?$dept_list['id']:'' ?>&action=disapprove" data-message="Are you sure you want to Disapprove this Payment?" data-toggle="tooltip" title="Disapprove this Payment of (#<?php echo !empty($dept_list['amount'])?number_format(floatval($dept_list['amount']),2,'.',','):0.00 ?>)" href="javascript:;" class="btn btn-danger modal_action_btn"><i class="fas fa-toggle-on"></i></a>
															      <?php elseif ( !empty($dept_list['status']) && strtolower( $dept_list['status'])==="pending"): ?>
                                                                                                      <a data-location_url="personnel/approve_payment.php?id=<?php echo !empty($dept_list['id'])?$dept_list['id']:'' ?>&action=approve" data-message="Are you sure you want to Approve this Payment?" data-toggle="tooltip" title="Approve this Payment of (#<?php echo !empty($dept_list['amount'])?number_format(floatval($dept_list['amount']),2,'.',','):0.00 ?>)" href="javascript:;" class="btn btn-success modal_action_btn"><i class="fas fa-toggle-off"></i></a>
																<?php endif; ?>
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
