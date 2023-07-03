<?php
	include('includes/config.php');
	$query = "SELECT * FROM tbl_user";
	$stmt = $db->prepare($query);
	$stmt->execute();
	if($stmt->rowCount() > 0){
		
	}
	else
	{
		header('location:setup.php');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Inventory and Billing System</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="css/layout.css" rel="stylesheet" type="text/css"/>
		<link href="css/alert/sweetalert.css" rel="stylesheet" type="text/css"/>
		<link href="css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body class="wrap-index">
		<div class="wrapHeader">
		</div>
			<div class="wrap-container">
				<div class="wrap-content-container">
					<div class="col-md-7">
						<img src="images/bglogin.png" width="100%">
					</div>
					<div class="col-md-5">
						<div class="loginForm">
							<div class="loginTop">
								<h3>ShiroInv</h3>
							</div>
							<form name="lgnForm" id="lgnForm">
								<div class="myUserIcon">
								<i class="fa fa-user" aria-hidden="true"></i><input type="text" id="loginid" name="userid" class="wrap-text-login" placeholder="Login ID" required>
								</div>
								<div class="clear"></div>
								<div class="myUserIcon">
								<i class="fa fa-key" aria-hidden="true"></i><input type="password" name="userpass" class="wrap-text-login" placeholder="Password" required>
								</div>
								<div class="clear"></div>
								<input type="hidden" name="flag" value="1">
								<Button type="submit" class="loginbtn">Sign In</Button>
							</form>
						</div>
					</div>
				</div>
			</div>
		<div class="wrapFooter">
		</div>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/alert/sweetalert.min.js" type="text/javascript"></script>
		<script src="js/alert.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#loginid').focus();
				$('#lgnForm').on('submit',function(e){
					e.preventDefault();
					start();
					$.ajax({
						url:'controller/controller.user.php',
						type:'POST',
						data:new FormData(this),
						processData:false,
						contentType:false,
						success:function(html){
							if(html == 1)
							{
								location.href="order.php";
								end();
							}
							else if(html == 2)
							{
								location.href="setup.php";
								end();
							}
							else{
								swal("Invalid Credentials","","error");
							}
							
						}
					});
				});
			});
		</script>
	</body>
</html>