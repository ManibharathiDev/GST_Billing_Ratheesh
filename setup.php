<?php
	session_start();
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Inventory and Billing System</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="css/layout.css" rel="stylesheet" type="text/css"/>
		<link href="css/form.css" rel="stylesheet" type="text/css"/>
		<link href="css/alert/sweetalert.css" rel="stylesheet" type="text/css"/>
		<link href="css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body class="wrap-index">
		
			<div class="wrap-container">
				<div class="wrap-content-container">
					
					<div class="col-md-12">
						<div class="setupForm">
<form id="msform">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Admin Account Setup</li>
    <li>Company Setup</li>
    <li>Contact Details</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Create Your Admin Account</h2>
    <h3 class="fs-subtitle">This is step 1</h3>
    <input type="text" name="userid" placeholder="User ID" required/>
    <input type="password" name="pass" placeholder="Password" required/>
    <input type="password" name="cpass" placeholder="Confirm Password" required/>
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Company Setup</h2>
    <h3 class="fs-subtitle">Your presence on the social network</h3>
    <input type="text" name="compname" placeholder="Company Name" required/>
    <input type="text" name="compgstin" placeholder="GSTIN Number" required/>
    <input type="text" name="compaddress" placeholder="Address" required/>
	<input type="text" name="compcity" placeholder="City" required/>
	<input type="text" name="compstate" placeholder="State" required/>
	<input type="text" name="comppincode" placeholder="Pin Code" required/>
	<input type="hidden" name="flag" value="2">
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Contact Details</h2>
    <h3 class="fs-subtitle">We will never sell it</h3>
    <input type="text" name="compphone" placeholder="Mobile / Phone" required/>
    <input type="text" name="compemail" placeholder="Email ID" />
    <input type="text" name="compweb" placeholder="Web Site" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </fieldset>
</form>
						</div>
					</div>
				</div>
			</div>
		
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/alert/sweetalert.min.js" type="text/javascript"></script>
		<script src="js/alert.js" type="text/javascript"></script>
		<script src="js/easing.js" type="text/javascript"></script>
		<script src="js/form.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#loginid').focus();
				$('#msform').on('submit',function(e){
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
								location.href="index.php";
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