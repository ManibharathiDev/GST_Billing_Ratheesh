<!DOCTYPE html>
<html>
	<head>
		<title>Inventory and Billing System</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="css/layout.css" rel="stylesheet" type="text/css"/>
		<link href="css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<div class="wrap-container">
			<div class="wrap-heading">
				<h1>New Brand</h1>
			</div>
			<div class="wrap-content">
				<form name="newBrand" id="newBrand">
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label>Brand Name : </label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label>Status : </label>
					</div>
					<div class="col-md-5">
						<select name="" class="wrap-text">
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						
					</div>
					<div class="col-md-5">
						<Button type="submit" class="btn btn-primary">Submit</Button>
					</div>
				</div>
				</form>
			</div>
		</div>
		<?php
			include('footer.php');
		?>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<?php
			include('headerright.php');
		?>
	</body>
</html>