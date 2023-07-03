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
				<h1>New Item</h1>
			</div>
			<div class="wrap-content">
				<form name="newBrand" id="newBrand">
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label> Item Name : </label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label> Item Short Name : </label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label> Item Description : </label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label> HSN : </label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label> Quantity : </label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label> Unit Price : </label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label> Tax(%) : </label>
					</div>
					<div class="col-md-5">
						<select name="" class="wrap-text
							<option value=""></option>
							<option value="1">GST RATE 3%</option>
							<option value="2">GST RATE 5%</option>
							<option value="3">GST RATE 6%</option>
							<option value="4">GST RATE 8%</option>
						</select>
						</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label> Category : </label>
					</div>
					<div class="col-md-5">
						<select name="" class="wrap-text" required>
							<option value="">Select Category</option>
							<option value="1">XXX</option>
							<option value="2">YYY</option>
							<option value="3">ZZZ</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-2">
						<label> Brand : </label>
					</div>
					<div class="col-md-5">
						<select name="" class="wrap-text" required>
							<option value="">Select Brand</option>
							<option value="1">XXX</option>
							<option value="2">YYY</option>
							<option value="3">ZZZ</option>
						</select>
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