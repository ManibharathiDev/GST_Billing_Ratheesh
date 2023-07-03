<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header('location:index.php');
	}
	include('includes/config.php');
?>
<!DOCTYPE html>
<html>
	<head>
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
					
					<div class="col-md-12">
						<div class="setupForm">
							<div class="loginTop">
								<h3>Company Setup</h3>
							</div>
							<form name="lgnForm" id="lgnForm">
							<div class="col-md-6">
									<label>Company Name</label>
									<input type="text" class="wrap-text" name="compname" required>
									<label>GSTIN Number</label> 
									<input type="text" class="wrap-text" name="compgstin" required>
									<label>Address</label>
									<textarea class="wrap-text wrap-address" name="compaddress" required></textarea>
									<label>City</label>
									<input type="text" class="wrap-text" name="compcity" required>
									<label>State</label>
									<select class="wrap-text" name="compstate" required>
										<option value="">Select State</option>
										<?php
											$query = "SELECT * FROM tbl_state";
											$stmt = $db->prepare($query);
											$stmt->execute();
											if($stmt->rowCount()>0)
											{
												while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
												echo '<option value ='.$row['sid'].'>';
												echo $row['stateName'];
												echo '</option>';
												}
											}
										?>
									</select>
									<label>Pincode</label>
									<input type="text" name="comppincode" class="wrap-text numeric" required>
								
							</div>
							<div class="col-md-6">
									<label>Phone Number</label>
									<input type="text" name="compphone" class="wrap-text" required>
									<label>Email</label>
									<textarea class="wrap-text wrap-address" name="compemail"></textarea>
									<label>Website</label>
									<input type="text" class="wrap-text" name="compweb">
									<div class="clear"></div>
									<input type="hidden" value = "2" name="flag">
									<Button type="submit" class="btn btn-primary">Submit</Button>
							</div>
								
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
				$('#setupForm').on('submit',function(e){
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
							else{
								swal("Invalid Transactions","","error");
							}
							
						}
					});
				});
			});
		</script>
	</body>
</html>