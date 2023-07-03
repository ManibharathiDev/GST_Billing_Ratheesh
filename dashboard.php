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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Inventory and Billing System</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="css/layout.css" rel="stylesheet" type="text/css"/>
		<link href="css/alert/sweetalert.css" rel="stylesheet" type="text/css"/>
		<link href="css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body class="wrap-home">
		<?php
			include('header.php');
		?>
		<div class="wrap-container">
			<div class="wrap-heading">
				<h1>Dashboard</h1>
			</div>
			<div class="wrap-content">
			
				<div class="row">
					<div class="col-md-4">
						<div class="wrap-dash-top dash-col1">
							<h2>Quantity in Hand</h2>
							<span>
							<?php
								$query = "SELECT sum(stockQty) as stockquantity FROM `tbl_stock`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									$row = $stmt->fetch(PDO::FETCH_ASSOC);
									echo $row['stockquantity'];
								}
								else
								{
									echo '0';
								}
							?>
							</span>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="wrap-dash-top dash-col2">
						<h2>Total Customers</h2>
							<span>
							<?php
								$query = "SELECT count(clientId) as clientcount FROM `tbl_client`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									$row = $stmt->fetch(PDO::FETCH_ASSOC);
									echo $row['clientcount'];
								}
								else
								{
									echo '0';
								}
							?>
							</span>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="wrap-dash-top dash-col3">
						<h2>Total Bills</h2>
							<span>
							<?php
								$query = "SELECT count(billId) as billcount FROM `tbl_bill`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									$row = $stmt->fetch(PDO::FETCH_ASSOC);
									echo $row['billcount'];
								}
								else
								{
									echo '0';
								}
							?>
							</span>
						</div>
					</div>
				
		</div>
		<div class="clear">
		</div>
		<div class="row">
			
					<div class="col-md-4">
						<div class="wrap-dash-normal">
						<h2>Product Details</h2>
						<span class="wrap-left">
							<h3 class="wrap-red">Low Stock Items</h3>
							
							<h3 class="wrap-normal">All Item Brands</h3>
							
							<h3 class="wrap-normal">All Items</h3>
						</span>
						
						<span class="wrap-right">
							<h3 class="wrap-red">
							<?php
								$query = "SELECT count(stockId) as stockcount FROM `tbl_stock` WHERE stockQty <= 400";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									$row = $stmt->fetch(PDO::FETCH_ASSOC);
									echo $row['stockcount'];
								}
								else
								{
									echo '0';
								}
							?>
							</h3>
							<h3 class="wrap-normal">
							<?php
								$query = "SELECT count(brandId) as brandcount from tbl_brand";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									$row = $stmt->fetch(PDO::FETCH_ASSOC);
									echo $row['brandcount'];
								}
								else
								{
									echo '0';
								}
							?>
							</h3>
							
							<h3 class="wrap-normal">
							<?php
								$query = "SELECT count(itemId) as itemcount from tbl_item";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									$row = $stmt->fetch(PDO::FETCH_ASSOC);
									echo $row['itemcount'];
								}
								else
								{
									echo '0';
								}
							?>
							<h3>
						</span>
						</div>
					</div>
		</div>
		</div>
		</div>
		
  

		<?php
			include('footer.php');
		?>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/alert/sweetalert.min.js" type="text/javascript"></script>
		<script src="js/alert.js" type="text/javascript"></script>
		<?php include('accept.php') ?>
		
		<?php
			include('headerright.php');
		?>
	</body>
</html>