<?php
session_start();
	if(!isset($_SESSION['user']))
	{
		header('location:index.php');
	}
	include('includes/config.php');
	//$tempname = $_SESSION['tempname'];
	$areacode = 33;//$_SESSION['user'];
	$billid = 0;
	$clientid = 0;
	if(isset($_GET['billid']))
	{
		$billid = $_GET['billid'];
		$clientid = $_GET['clientid'];
		
		$bquery = "SELECT `billDate` FROM `tbl_bill` WHERE `billId` = :billid";
		$bstmt = $db->prepare($bquery);
		$bstmt->execute(array(":billid"=>$billid));
		$brow = $bstmt->fetch(PDO::FETCH_ASSOC);
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
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/bootstrap-select.min.css" rel="stylesheet">
		<link href="css/alert/sweetalert.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<div class="wrap-container">
			<form name="orderForm" id="orderForm">
			<div class="wrap-heading">
				<h1>New Order</h1>
			</div>
			<div class="wrap-content">
				<div class="row">
					<div class="col-md-6">
						<label class="leftalign">Date : <?php 
						if(isset($_GET['billid'])){
							$selectedDate = strtr($brow['billDate'], '/', '-');
							$selectedDate=date('d-m-Y',strtotime($selectedDate));
							echo $selectedDate;
						}
						else
						{
						echo date('d-m-Y'); 
						}
						?></label>
					</div>
					<div class="col-md-6">
						<label>Order No. : <span id="myorderNo">STOCK1234</span></label>
					</div>
				</div>
				<div class="border-bottom"></div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-6">
					<div class="col-md-3 wrap-padding-right">
						<label>Customer Name : </label>
					</div>
					<div class="col-md-9">
						<select name="clientGet" id="clientGet" class="wrap-text selectpicker" data-live-search="true">
						    <option value="">Select Customer</option>
							<option value="-1"><Button>Add New Customer</Button></option>
							<?php
								$query = "SELECT * FROM `tbl_client`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option value="'.$row['clientId'].'">';
										echo $row['clientName'];
										echo '</option>';
									}
								}
							?>
						</select>
						
					</div>
					</div>
					<div class="col-md-6">
					<div id="clientInfo">
					
					</div>
					</div>
					
				</div>
				<div class="clear"></div>
				
				<div class="border-bottom"></div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-3">
						<label>Item</label>
						<select class="wrap-text selectpicker" id="selItem" data-live-search="true">
							<option value="">Select Item</option>
							<!--<option value="-1"><Button>Add New Stock</Button></option>-->
							<?php
								$query = "SELECT ts.stockId,ts.itemId,tb.brandName,ti.itemName,ti.itemShort,ti.itemDescription,ti.itemHSN,ts.stockQty,ts.sellingPrice,ts.stockTax FROM `tbl_item` ti INNER JOIN `tbl_stock` ts INNER JOIN tbl_brand tb ON ti.itemId = ts.itemId AND tb.brandId = ts.brandId";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option value="'.$row['stockId'].'">';
										echo $row['itemName'].' '.$row['brandName'];
										echo '</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-2">
						<label>HSN</label>
						<input type="text" id="selHsn" class="wrap-text numeric" readonly>
					</div>
					<div class="col-md-1">
						<label>QTY</label>
						<input type="text" id="selQty" class="wrap-text numeric">
					</div>
					<div class="col-md-1">
						<label>Price</label>
						<input type="text" id="selPrice" class="wrap-text dnumeric"> 
						<input type="hidden" id="purPrice">
						<input type="hidden" id="supItem">
					</div>
					<div class="col-md-1">
						<label>Discount</label>
						<select class="wrap-text" id="disMode">
							<option value="1">Percentage</option>
							<option value="2">Flat Amount</option>
						</select>
					</div>
					<div class="col-md-1">
						<label>Discount</label>
						<input type="text" id="selDis" class="wrap-text dnumeric" value="0">
					</div>
					<div class="col-md-2">
						<label>Tax</label>
						<select class="wrap-text" id="selTax" readonly>
							<option value="">Select Tax</option>
							<?php
								$query = "SELECT * FROM tbl_tax";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option value="'.$row['taxId'].'">';
										echo $row['taxName'].'-'.$row['taxPercentage'];
										echo '</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-1">
						<a href="" class="wrap-btn btnmargin" id="addItem">Add</a>
					</div>
				</div>
				<div class="clear"></div>
				<table class="table table-bordered" id="billItem">
					<tr class="tableheading">
						<th rowspan="2">#</th>
						<th rowspan="2">Item Description</th>
						<th rowspan="2">HSN</th>
						<th rowspan="2">Qty.</th>
						<th rowspan="2">Rate</th>
						<th rowspan="2">Total</th>
						<th rowspan="2">Discount</th>
						<th rowspan="2">Taxable Value</th>
						<th colspan="2">CGST</th>
						<th colspan="2">SGST</th>
						<th colspan="2">IGST</th>
						<th rowspan="2">Action</th>
					</tr>
					<tr valign="middle">	
						<th>Rate</th>
						<th>Amt</th>
						<th>Rate</th>
						<th>Amt</th>
						<th>Rate</th>
						<th>Amt</th>
					</tr>
					
				</table>
				<div class="clear"></div>
				<div class="col-md-9 padding-left">
				
					<div class="col-md-2 padding-left">
						<a href="" class="printBill"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
					</div>
				<div class="clear"></div>
					<div class="col-md-2">
						<input type="checkbox" id="addPayment" name="addPayment"> Add Payment
					</div>
					<div class="col-md-2">
						<label>Amount Paid</label>
					</div>
					<div class="col-md-2">
						<input type="text" id="paidAmount" class="wrap-text dnumeric" name="paidAmount" disabled>
					</div>
				
				</div>
				<div class="col-md-3">
					<div class="row">
						<div class="col-md-6">
							<label>Sub Total : </label>
						</div>
						<div class="col-md-6">
							<span class="wrap-amount" id="subTotal"><i class="fa fa-inr"></i>. 0.00</span>
						</div>
					</div>
					<div class="clear"></div>
					<div class="row">
						<div class="col-md-6">
							<label>Total Discount : </label>
						</div>
						<div class="col-md-6">
							<span class="wrap-amount" id="disTotal"><i class="fa fa-inr"></i>. 0.00</span>
						</div>
					</div>
					<div class="clear"></div>
					<div class="row">
						<div class="col-md-6">
							<label>GST Total : </label>
						</div>
						<div class="col-md-6">
							<span class="wrap-amount" id="gstTotal"><i class="fa fa-inr"></i>. 0.00</span>
						</div>
					</div>
					
					<div class="clear"></div>
					<div class="row">
						<div class="col-md-6">
							<label>Total : </label>
						</div>
						<div class="col-md-6">
							<span class="wrap-amount" id="grandTotal"><i class="fa fa-inr"></i>. 0.00</span>
						</div>
					</div>
					<div class="clear"></div>
					<div class="row">
						<div class="col-md-6">
							<label>Amount Paid : </label>
						</div>
						<div class="col-md-6">
							<span class="wrap-amount" id="paidTotal"><i class="fa fa-inr"></i>. 0.00</span>
						</div>
					</div>
					
					<div class="clear"></div>
					<div class="row">
						<div class="col-md-6">
							<label>Balance : </label>
						</div>
						<div class="col-md-6">
							<span class="wrap-amount" id="balanceTotal"><i class="fa fa-inr"></i>. 0.00</span>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			</form>
		</div>
		<div class="clear"></div>
		<!--Edit Item-->
		<div class="modal fade" id="itemEditModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Item</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
				<div class="row">
				<div class="col-md-2">
						<label>Item</label>
				</div>
				<div class="col-md-5">
						<select class="wrap-text wrap-text-left selectpicker" id="selEditItem" data-live-search="true">
							<option value="">Select Item</option>
							<?php
								$query = "SELECT ts.stockId,ts.itemId,tb.brandName,ti.itemName,ti.itemShort,ti.itemDescription,ti.itemHSN,ts.stockQty,ts.sellingPrice,ts.stockTax FROM `tbl_item` ti INNER JOIN `tbl_stock` ts INNER JOIN tbl_brand tb ON ti.itemId = ts.itemId AND tb.brandId = ts.brandId";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option value="'.$row['stockId'].'">';
										echo $row['itemName'].' '.$row['brandName'];
										echo '</option>';
									}
								}
							?>
						</select>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row">
				<div class="col-md-2">
						<label>HSN</label>
				</div>
				<div class="col-md-5">
						<input type="text" id="selEditHsn" class="wrap-text numeric" readonly/>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row">
				<div class="col-md-2">
						<label>Quantity</label>
				</div>
				<div class="col-md-5">
						<input type="text" id="selEditQty" class="wrap-text numeric"/>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row">
				<div class="col-md-2">
						<label>Unit Price</label>
				</div>
				<div class="col-md-5">
						<input type="text" id="selEditPrice" class="wrap-text dnumeric"/>
						<input type="hidden" id="selEditPurchasePrice" class="wrap-text dnumeric"/>
					<input type="hidden" id="selEditSupplier" class="wrap-text dnumeric"/>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row">
				<div class="col-md-2">
						<label>Discount Mode</label>

				</div>
				<div class="col-md-5">
						<select id="selEditDiscountMode" class="wrap-text">
							<option value="1">Percentage</option>
							<option value="2">Flat Amount</option>
						</select>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row">
				<div class="col-md-2">
						<label>Discount</label>
				</div>
				<div class="col-md-5">
						<input type="text" id="selEditDis" class="wrap-text dnumeric"/>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row">
				<div class="col-md-2">
						<label>Tax</label>
				</div>
				<div class="col-md-5">
						<select class="wrap-text" id="selEditTax" readonly>
							<option value="">Select Tax</option>
							<?php
								$query = "SELECT * FROM tbl_tax";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC))
									{
										echo '<option value="'.$row['taxId'].'">';
										echo $row['taxName'].'-'.$row['taxPercentage'];
										echo '</option>';
									}
								}
							?>
						</select>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-2"></div>
					<input type="hidden" id="billRow"/>
					<div class="col-md-5"><input type="button" class="btn btn-primary" id="editItemBtn" value="Save Changes"/></div>
				</div>
			</div>
      </div>
    </div>
  </div>
  </div>
  </div>
  
  <!-- Add New Customer -->
  <div class="modal fade" id="customerModel" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Client</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="clientForm" id="clientForm">
				<div class="col-md-6">
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Client Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientName" id="sclientName" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Contact Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientContactName" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Phone / Mobile. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientContact" class="wrap-text cinput numeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Email : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientEmail" class="wrap-text cinput">
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> GSTIN : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientGstin" class="wrap-text cinput clientGstin" maxlength="15">
						<div class="errMsg" id="errorGST">GSTIN Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Customer Type : </label>
					</div>
					<div class="col-md-7">
						<select name="clientType" class="wrap-text cinput" required>
							<option value="">Select Type</option>
							<option value="1">General</option>
							<option value="2">Discount</option>
							<option value="3">Fixed</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label>Status : </label>
					</div>
					<div class="col-md-7">
						<select name="clientStatus" class="wrap-text cinput" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
				</div>
				
				<h4 class="modal-title">Billing Address</h4>
				
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Address : </label>
					</div>
					<div class="col-md-7">
						<textarea name="clientBillAddress" class="wrap-text wrap-address cinput" required></textarea>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> City : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientBillCity" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> State : </label>
					</div>
					<div class="col-md-7">
						<select name="clientBillState" class="wrap-text cinput" required>
							<option value="">Select State</option>
							<?php
								$query = "SELECT * FROM `tbl_state`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								while($row = $stmt->fetch(PDO::FETCH_ASSOC))
								{
									echo "<option value='".$row['stateDigit']."'>";
									echo $row['stateName'];
									echo "</option>";
								}
							?>
						</select>
						
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Pincode : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientBillPin" class="wrap-text cinput numeric" maxlength="6" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Country : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientBillCountry" class="wrap-text cinput" required>
					</div>
				</div>
				</div>
				<div class="col-md-6">
				
				
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-12">
						<input type="checkbox" name="clientShipDiff" id="ShipDiff"> Ship To Different Address
					</div>
					
				</div>
				<div class="clear"></div>
				<div id="shipAdd">
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Address : </label>
					</div>
					<div class="col-md-7">
						<textarea name="clientShipAddress" id="clientSAddress" class="wrap-text wrap-address cinput" disabled></textarea>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> City : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientShipCity" id="clientSCity" class="wrap-text cinput" disabled>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> State : </label>
					</div>
					<div class="col-md-7">
						<select name="clientShipState" id="clientSState" class="wrap-text cinput" disabled>
							<option value="">Select State</option>
							<?php
								$query = "SELECT * FROM `tbl_state`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								while($row = $stmt->fetch(PDO::FETCH_ASSOC))
								{
									echo "<option value='".$row['stateDigit']."'>";
									echo $row['stateName'];
									echo "</option>";
								}
							?>
						</select>
						
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Pincode : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientShipPin" id="clientSPin" class="wrap-text cinput numeric" maxlength="6" disabled>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Country : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientShipCountry" id="clientSCountry" class="wrap-text cinput" disabled>
					</div>
				</div>
				<div class="clear"></div>
				</div>
				
				<div class="row wrap-margin">
					
					<div class="col-md-7">
						<input type="hidden" name="flag" value="1">
						<Button type="submit" class="btn btn-primary">Submit</Button>
					</div>
				</div>
				
				</div>
				
				<div class="row wrap-margin">
					
				</div>
				</form>
      </div>
    </div>
  </div>
  </div>
  </div>
  
  <!-- New Item -->
  	<div class="modal fade" id="itemModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Item</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="itemForm" id="itemForm">
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Item Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemName" id="sitemName" class="wrap-text cinput itemName" required>
						<div class="errMsg" id="errorName">Stock Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Item Short Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemShort" class="wrap-text cinput itemShort" required>
						<div class="errMsg" id="errorShortName">Item Short Name Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Item Description : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemDescription" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> HSN : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemHSN" class="wrap-text cinput itemHsn numeric" required>
						<div class="errMsg" id="errorHsn">HSN Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Quantity : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemQuantity" class="wrap-text cinput numeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Unit Price : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemPrice" class="wrap-text cinput dnumeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Tax(%) : </label>
					</div>
					<div class="col-md-7">
						<select name="itemTax" class="wrap-text cinput" required>
							<option value="">Select Tax</option>
							<?php
								$query = "SELECT * FROM `tbl_tax`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										echo '<option value="'.$row['taxId'].'">';
										echo $row['taxName'].'-'.$row['taxPercentage'].'%';
										echo '</option>';
									}
								}
							?>
						</select>
						</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Category : </label>
					</div>
					<div class="col-md-7">
						<select name="itemCategory" class="wrap-text cinput" required>
							<option value="">Select Category</option>
							<?php
								$query = "SELECT * FROM `tbl_category`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										echo '<option value="'.$row['catId'].'">';
										echo $row['catName'];
										echo '</option>';
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Brand : </label>
					</div>
					<div class="col-md-7">
						<select name="itemBrand" class="wrap-text cinput" required>
							<option value="">Select Brand</option>
							<?php
								$query = "SELECT * FROM `tbl_brand`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										echo '<option value="'.$row['brandId'].'">';
										echo $row['brandName'];
										echo '</option>';
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Supplier : </label>
					</div>
					<div class="col-md-7">
						<select name="itemSupplier" class="wrap-text cinput" required>
							<option value="">Select Supplier</option>
							<?php
								$query = "SELECT * FROM `tbl_supplier`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
										echo '<option value="'.$row['supplierId'].'">';
										echo $row['supplierName'];
										echo '</option>';
									}
								}
							?>
						</select>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Status : </label>
					</div>
					<div class="col-md-7">
						<select name="itemStatus" class="wrap-text cinput" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					<input type="hidden" value="1" name="flag">
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						
					</div>
					<div class="col-md-7">
						<Button type="submit" class="btn btn-primary">Submit</Button>
					</div>
				</div>
				</form>
      </div>
    </div>
  </div>
  </div>
  </div>
  
  <!-- Preview Model -->
   <!-- New Item -->
  	<div class="modal fade" id="printPreviewModel" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Print Preview</h4>
        </div>
        <div class="modal-body">
			<div id="printShow">
			<iframe src="<?php echo $tempname; ?>" width="100%" height="600"></iframe>
			</div>
    </div>
  </div>
  </div>
  </div>
  <!-- The Modal -->
<div id="myModal" class="printModal">

  	
  <!-- Modal content -->
  <div class="print-modal-content">
	<div class="print-left-content">
		<!--<Button class="btn btn-danger close">Close</Button>-->
		<div class="printContent">
			<?php
				if(isset($_GET['billid']))
				{
					?>
				<a class="wrap-btn-new printtext" id="updateBill"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update Bill</a>
			<?php			
			}
			else
			{
			?>
			<a class="wrap-btn-new printtext" id="saveBill"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Bill</a>
			<?php
			}
			?>
			<div class="clear"></div>
			<?php
				if(isset($_GET['billid']))
				{
					?>
				<a class="wrap-btn-new printtext" id="updatePrintBill"><i class="fa fa-print" aria-hidden="true"></i> Update & Print</a>
			<?php
				}
				else
				{
			?>
				<a class="wrap-btn-new printtext" id="savePrintBill"><i class="fa fa-print" aria-hidden="true"></i> Save & Print</a>
			<?php
				}
			?>				
			<div class="clear"></div>
			<a class="wrap-btn-new printtext" id="editPrintBill"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Bill</a>
		</div>
	</div>
	<div class="print-right-content">
    <!--<span class="close">&times;</span>-->
    <iframe id="myPrint" width="100%" height="800"></iframe>
	</div>
  </div>

</div>
		<?php
			include('footer.php');
		?>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/bootstrap-select.min.js" type="text/javascript"></script>
		<script src="js/alert/sweetalert.min.js" type="text/javascript"></script>
		<script src="js/alert.js" type="text/javascript"></script>
		<?php include('accept.php') ?>
		<?php
			include('headerright.php');
		?>
		<script type="text/javascript">
			$(document).ready(function()
			{
				var productQuantity = 0;
				var editrow = 0;
				var oldpaid = 0.00;
				var billpaid = 0.00;
				var billbalance = 0.00;
				var currentstate = parseInt(<?php echo $areacode; ?>);
				var clientbillingstate = parseInt(<?php echo $areacode; ?>);
				var clientshippingstate = parseInt(<?php echo $areacode; ?>);
				var clientshipping = 0;
				var clientstatus = 1;
				<?php
					if(isset($_GET['billid']))
					{
						?>
					var billid = <?php echo $billid ?>;
					var clientid = <?php echo $clientid ?>;
				<?php		
					}
					else
					{
						?>
					var billid = 0;
					var clientid = 0;
				<?php		
					}
				?>
				
				if(billid !=0)
				{
					var totaldiscount = 0;
					var subtotal = 0;
					var gsttotalcost = 0;
					var totalgsttax = 0;
					
					$('#clientGet').selectpicker('refresh'); 
					$("#clientGet").selectpicker('val', clientid);
					var content = "";
					var id = $('#clientGet').val();
					if(id == '-1')
					{
						$('#customerModel').modal({
						backdrop: 'static',
						keyboard: false
					});
						$('#clientGet').val("");
						return false;
					}
					var flag = 1;
					var data = {clientid:id,flag:flag};
					$.ajax({
						type:'POST',
						url:'controller/controller.order.php',
						data:data,
						dataType:'json',
						success:function(data)
						{
							
							$.each(data, function(index, element) 
							{
								
									content += '<h4>Billed To</h4>';
									content += element.clientBillingAdd +", "+ element.clientBillingCity +" ,"+ element.stateName +"-"+element.clientBillingPincode+" ,"+element.clientBillingCountry;
									clientshipping = parseInt(element.clientShipping);
									if(clientshipping == 0)
									{
										clientbillingstate = parseInt(element.clientBillingState);
										
									}
									else
									{
										clientshippingstate = parseInt(element.clientShippingState);
										
									}
							});
							$('#clientInfo').html(content);
							var flag = 7;
					var data = {billid:billid,flag:flag};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data){
							$.each(data, function(index, element) 
							{
								$('#myorderNo').html(element.itemBillNo);
								var totaldiscount = 0;
								var subtotal = 0;
								
								var productname = element.stockId;
								var producttext = element.itemName+' '+element.brandName;
								var producthsn = element.itemHSN;
								var productqty = element.itemQuantity;
								var productprice = element.itemPrice;
								var productPurchasePrice = element.itemPurchasePrice;
								var productSupplier = element.itemSupplier;
								var productdis = element.itemDiscount;
								var disMode = element.itemDiscountMode;

								var producttax = element.taxId;
								var producttaxtext = element.taxPercentage;
								billpaid = element.billPaid;
								
								var tes = producttaxtext;
					var totalcost = parseFloat(productqty)*parseFloat(productprice);
					var totaltax = (totalcost/100)*parseFloat(tes);
					//gsttotal += totaltax;
					var halftotal = totaltax/2;
					var content = '';
					var producttotal = parseFloat(productqty) * parseFloat(productprice);
					var producttotaldis = parseFloat(producttotal)-parseFloat(productdis);
					var taxrate = 0;
					var taxirate = 0;
					itemCount++;
					productRowTotal++;
					if(clientshipping == 0)
					{
						if(clientbillingstate == currentstate )
						{
							var halftax = tes/2;
							taxrate = halftax;
							var IRGST = ((producttotaldis*halftax)/100).toFixed(2);
							IRGST = IRGST;
							var IGST = '0.00';
							
						}
						else
						{
							var IRGST = '0.00';
							var IGST = ((producttotaldis*tes)/100).toFixed(2);
							IGST = IGST;
							taxirate = tes;
						}
					}
					else if(clientshipping == 1)
					{
						if(clientshippingstate == currentstate )
						{
							var halftax = tes/2;
							taxrate = halftax;
							var IRGST = ((producttotaldis*halftax)/100).toFixed(2);
							IRGST = IRGST;
							var IGST = '0.00';
						}
						else
						{
							var IRGST = '0.00';
							var IGST = ((producttotaldis*tes)/100).toFixed(2);
							IGST = IGST;
							taxirate = tes;
						}
					}
					content += "<tr id="+itemCount+">";
					content += "<td>"+productRowTotal+"</td>";
					content +="<td><span id='pname-"+itemCount+"'>"+producttext+"</span><input type='hidden' value='"+productname+"' id='piname-"+itemCount+"' name='itemid[]'/></td>";
					content +="<td><span id='phsn-"+itemCount+"'>"+producthsn+"</span><input type='hidden' value='"+producthsn+"' id='pihsn-"+itemCount+"' name='itemhsn[]'/></td>";
					content += "<td><span id='pqty-"+itemCount+"'>"+productqty+"</span><input type='hidden' value='"+productqty+"' id='piqty-"+itemCount+"' name='itemqty[]'/></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='pprice-"+itemCount+"'>"+productprice+"</span><input type='hidden' value='"+productprice+"' id='piprice-"+itemCount+"' name='itemprice[]'/></td>";
					content += "<input type='hidden' value='"+productPurchasePrice+"' id='pipurchaseprice-"+itemCount+"' name='itempurchaseprice[]'>";
					content += "<input type='hidden' value='"+productSupplier+"' id='pisupplier-"+itemCount+"' name='itemsupplier[]'>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='ptotal-"+itemCount+"'>"+producttotal.toFixed(2)+"</span></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='pdis-"+itemCount+"'>"+productdis+"</span><input type='hidden' value='"+productdis+"' id='pidis-"+itemCount+"' name='itemdis[]'/><input type='hidden' id='pidismode-"+itemCount+"' name='itemdismode[]' value='"+disMode+"'></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='ptaxvalue-"+itemCount+"'>"+producttotaldis.toFixed(2)+"</span></td>";
					content += "<input type='hidden' value="+producttax+" id='pitax-"+itemCount+"' name='itemtax[]'><input type='hidden' value="+tes+" id='pistax-"+itemCount+"'>";
					content += "<td><span id='pcgtax-"+itemCount+"'>"+taxrate+"%</span><input type='hidden' value='"+taxrate+"' id='pcgitax-"+itemCount+"'/><input type='hidden' value='"+tes+"' id='pstax-"+itemCount+"'></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='pcgst-"+itemCount+"'>"+IRGST+"</span><input type='hidden' value="+IRGST+" name='itemcgst[]'></td>";
					content += "<td><span id='psgtax-"+itemCount+"'>"+taxrate+"%</span><input type='hidden' value='"+taxrate+"' id='psgitax-"+itemCount+"'/><input type='hidden' value='"+tes+"' id='pstax-"+itemCount+"'></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='psgst-"+itemCount+"'>"+IRGST+"</span><input type='hidden' value="+IRGST+" name='itemsgst[]'></td>";
					content += "<td><span id='pigtax-"+itemCount+"'>"+taxirate+"%</span><input type='hidden' value='"+taxrate+"' id='pigitax-"+itemCount+"'/><input type='hidden' value='"+tes+"' id='pstax-"+itemCount+"'></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='pigst-"+itemCount+"'>"+IGST+"</span><input type='hidden' value="+IGST+" name='itemigst[]'></td>";
					content += "<td align='center'><a class='billEdit editBtn' id='bEdit-"+itemCount+"'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>&nbsp;<a class='taxDelete deleteBtn' id='bDelete-"+itemCount+"'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td></tr>";
					//subtotal += producttotal;
					//totaldiscount += parseFloat(productdis);
					$('#billItem').append(content);
					
							});
							
					var j = 0;
					var flags = 0;
					var i = 0;
					$('#billItem tr').each(function() 
					{
						if(i>1)
						{
						console.log(this.id);
						var cid = this.id;
						var pqty = "piqty-"+cid;
						var pprice = "piprice-"+cid;
						var pdis = "pidis-"+cid;
						var ptax = "pistax-"+cid;
						//var pstax = "pstax-"+cid;
						var pqtyval = $('input[id="'+pqty+'"]').val();
						var ppriceval = $('input[id="'+pprice+'"]').val();
						var pdisval = $('input[id="'+pdis+'"]').val();
						var ptaxval = $('input[id="'+ptax+'"]').val();
						subtotal += parseFloat(pqtyval) * parseFloat(ppriceval);
						totaldiscount += parseFloat(pdisval);
						gsttotalcost = (parseFloat(pqtyval)*parseFloat(ppriceval))-parseFloat(pdisval);
						totalgsttax += (gsttotalcost/100)*parseFloat(ptaxval);
						}
						i++;
					});
					
					$('#subTotal').html("<i class='fa fa-inr'></i>. "+subtotal.toFixed(2));
					$('#disTotal').html("<i class='fa fa-inr'></i>. "+totaldiscount.toFixed(2));
					$('#gstTotal').html("<i class='fa fa-inr'></i>. "+totalgsttax.toFixed(2));
					grandtotal = (subtotal- totaldiscount)+totalgsttax;
					//grandtotal = (subtotal- totaldiscount);
					$('#grandTotal').html("<i class='fa fa-inr'></i>. "+grandtotal.toFixed(2));
					var paidbill = parseFloat(billpaid);
					oldpaid = paidbill;
					$('#paidTotal').html("<i class='fa fa-inr'></i>. "+paidbill.toFixed(2));
					billbalance = grandtotal - paidbill;
					$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+billbalance.toFixed(2));
					$('#selDis').val("0");
					
					var rid = 0;
					$('td:first-child').each(function() {
						rid++;
						$(this).text(rid);
						
					});
					}
					});
						}
					});
					
				}
				
				if(billid == 0)
				{
				createbillno();
				}
				function createbillno(){
					flag = 8;
					var data = {flag:flag};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#myorderNo').text(html);
						}
					});
				}
				
				var itemCount = 0;
				var cusType = "";
				var subtotal = 0;
				var grandtotal = 0;
				var totaldiscount = 0;
				var gsttotal = 0;
				var clientshipping = 0;
				var clientbillingstate = 0;
				var clientshippingstate = 0;
				var currentstate = <?php echo $areacode; ?>;
				var productRowTotal = 0;
				var totalgsttax = 0;
				$('#clientGet').on('change',function(){
					var content = "";
					start();
					var id = $(this).val();
					if(id == '-1')
					{
						$('#customerModel').modal({
						backdrop: 'static',
						keyboard: false
					});
					end();
						$('#clientGet').val("");
						return false;
					}
					var flag = 1;
					var data = {clientid:id,flag:flag};
					$.ajax({
						type:'POST',
						url:'controller/controller.order.php',
						data:data,
						dataType:'json',
						success:function(data)
						{
							
							$.each(data, function(index, element) 
							{
								
									content += '<h4>Billed To</h4>';
									content += element.clientBillingAdd +", "+ element.clientBillingCity +" ,"+ element.stateName +"-"+element.clientBillingPincode+" ,"+element.clientBillingCountry;
									clientshipping = element.clientShipping;
									if(clientshipping == 0)
									{
										clientbillingstate = element.clientBillingState;
										
									}
									else
										clientshippingstate = element.clientShippingState;
									
									if(element.clientGSTIN == null){
										clientstatus = 0;
									}
									else
										clientstatus = 1;
									
							});
							$('#clientInfo').html(content);
						}
					});
					end();
				});
				
				
				$("#ShipDiff").change(function() {
					if(this.checked) {
						$('#clientSAddress').attr('disabled',false);
						$('#clientSAddress').prop('required',true);
						$('#clientSCity').attr('disabled',false);
						$('#clientSCity').prop('required',true);
						$('#clientSState').attr('disabled',false);
						$('#clientSState').prop('required',true);
						$('#clientSPin').attr('disabled',false);
						$('#clientSPin').prop('required',true);
						$('#clientSCountry').attr('disabled',false);
						$('#clientSCountry').prop('required',true);
					}
					else
					{
						$('#clientSAddress').val("");
						$('#clientSCity').val("");
						$('#clientSState').val("");
						$('#clientSPin').val("");
						$('#clientSCountry').val("");
						$('#clientSAddress').attr('disabled',true);
						$('#clientSCity').attr('disabled',true);
						$('#clientSState').attr('disabled',true);
						$('#clientSPin').attr('disabled',true);
						$('#clientSCountry').attr('disabled',true);
					}
				});
				
				$('#clientForm').on('submit',function(e){
						e.preventDefault();
						start();
						$.ajax({
							url:'controller/controller.client.php',
							type:'POST',
							data:new FormData(this),
							processData:false,
							contentType:false,
							success:function(html){
								if(html == 1)
								{
									$('#customerModel').modal('hide');
									getlastclient();
									
								}
							}
						});
				});
				
				function getlastclient(){
					var flag = 3;
					var data = {flag:flag};
					var selvalue = "";
					content = "";
					$.ajax({
							url:'controller/controller.order.php',
							type:'POST',
							data:data,
							dataType:'json',
							success:function(data)
							{
								$.each(data, function(index, element) 
								{
									$('#clientGet')
           						    .append($("<option></option>")
									.attr("value",element.clientId)
									.text(element.clientName)); 
									selvalue = element.clientId;
									cusType = element.clientArea;
									
									if(element.clientShipping != 1)
									{
									content += '<h4>Billed To</h4>';
									content += element.clientBillingAdd +", "+ element.clientBillingCity +" ,"+ element.clientBillingState +"-"+element.clientBillingPincode+" ,"+element.clientBillingCountry;
									cusType = element.clientArea;
									}
									
								});
								$('#clientGet').selectpicker('refresh');
								$("#clientGet").selectpicker('val', selvalue);
								$('#clientInfo').html(content);
								//alert(data.clientId);
									
							}
						});
						end();
				}
				
				$('#selItem').on('change',function(){
					start();
					var id = $(this).val();
					if(id == '-1')
					{
						end();
						$('#itemModel').modal({
						backdrop: 'static',
						keyboard: false
					});
							$('#selItem').val("");
						return false;
					}
					
					var flag = 2;
					var data = {stockid:id,flag:flag};
					$.ajax({
						url:'controller/controller.stock.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data)
						{
							$.each(data, function(index, element) 
							{
								$('#selHsn').val(element.itemHSN);
								$('#selPrice').val(element.sellingPrice);
								$('#purPrice').val(element.purchasedPrice);
								$('#supItem').val(element.supplierId);
								$('#selTax').val(element.stockTax);
								productQuantity = parseFloat(element.stockQty);
								if(productQuantity == 0)
								{
									swal("No Stock Available","","warning");
								}
								else
								{
									$('#selQty').focus();
									end();
								}
								
							});
							
						}
					});
				});
				
				$(document).on('keyup','#selQty',function(){
					
					var currentQuantity = parseFloat($(this).val());
					if(currentQuantity > productQuantity)
					{
						$(this).val(productQuantity);
						swal("Quantity Exceeded","","warning");
					}
					
				});
				
				$('#itemForm').on('submit',function(e){
						start();
						e.preventDefault();
						$.ajax({
							url:'controller/controller.item.php',
							type:'POST',
							data:new FormData(this),
							processData:false,
							contentType:false,
							success:function(html){
								if(html == 1)
								{
									getlastitem();
									$('#itemModel').modal('hide');
									
								}
							}
						});
				});
				
				function getlastitem(){
					var flag = 4;
					var data = {flag:flag};
					var selvalue = "";
					$.ajax({
							url:'controller/controller.order.php',
							type:'POST',
							data:data,
							dataType:'json',
							success:function(data)
							{
								$.each(data, function(index, element) 
								{
									$('#selItem')
           						    .append($("<option></option>")
									.attr("value",element.productId)
									.text(element.productName)); 
									selvalue = element.productId;
									$('#selDes').val(element.productDescription);
								$('#selPrice').val(element.productUnitPrice);
								$('#selTax').val(element.productTaxId);
								$('#selQty').focus();
									
								});
								$('#selItem').selectpicker('refresh');
								$("#selItem").selectpicker('val', selvalue);
							}
						});
						end();
				}
				
				$('#selEditItem').on('change',function()
				{
					var id = $(this).val();
					var flag = 2;
					var data = {stockid:id,flag:flag};
					$.ajax({
						url:'controller/controller.stock.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data)
						{
							
							$.each(data, function(index, element) 
							{
								$('#selEditHsn').val(element.itemHSN);
								$('#selEditPrice').val(element.sellingPrice);
								$('#selEditPurchasePrice').val(element.purchasedPrice);
								$('#selEditSupplier').val(element.supplierId);
								$('#selEditTax').val(element.stockTax);
								$('#selEditQty').focus();
							});
						}
					});
				});
				
				$('#addItem').on('click',function(e){
					e.preventDefault();
					var disMode = 0;
					var totaldiscount = 0;
					var productdis = 0;
					var subtotal = 0;
					var gsttotalcost = 0;
					var totalgsttax = 0;
					var cid = $("#clientGet option:selected").text();
					if(cid == 'Select Customer')
					{
						swal("Please Add Customer","","warning");
						return false;
					}
					var productname = $('#selItem').val();
					/*Check Dublicate*/
					var i = 0;
					var dflag = 0;
					$('#billItem tr').each(function() 
					{
						if(i>1)
						{
							var cid = this.id;
							if($("#piname-"+cid).val() == productname)
							{
								swal("Dublicate Entry","","warning");
								dflag = 1;
							}
						}
						
						i++;
					});
					if(dflag == 1)
						{
						return false;
						}
					
					/*End Dublicate*/
					var producttext = $("#selItem option:selected").text();
					if(productname == "")
					{
						swal("Please Add Atlease One Item to Bill","","warning");
						return false;
					}
					var producthsn = $('#selHsn').val();
					
					var productqty = $('#selQty').val();
					if(productqty == "")
					{
						swal("Please Enter Item Quantity","","warning");
						$('#selQty').focus();
						return false;
					}
					var productprice = $('#selPrice').val();
					if(productprice == "")
					{
						swal("Please Enter Item Unit Price","","warning");
						$('#selPrice').focus();
						return false;
					}
					var productPurchasePrice = $('#purPrice').val();
					var productSupplier = $('#supItem').val();
					
					if($('#selDis').val() == "")
					{
						$('#selDis').val("0");
					}
					
					//var productdis = $('#selDis').val();



					var producttax = $('#selTax').val();
					var producttaxtext = $('#selTax option:selected').text();
					var tes = producttaxtext.split("-");
					var totalcost = parseFloat(parseFloat(productqty)*parseFloat(productprice));
					var totaltax = (totalcost/100)*parseFloat(tes[1]);
					//gsttotal += totaltax;
					var halftotal = totaltax/2;
					var content = '';
					var producttotal = parseFloat(productqty) * parseFloat(productprice);

					disMode = $('#disMode').val();
					if(disMode == 1){
						productdis = (parseFloat($('#selDis').val())/100)*parseFloat(producttotal)
					}
					else{
						productdis = $('#selDis').val();
					}

					var producttotaldis = parseFloat(producttotal)-parseFloat(productdis);
					var taxrate = 0;
					var taxirate = 0;
					itemCount++;
					productRowTotal++;
					if(clientshipping == 0)
					{
						if(clientbillingstate == currentstate )
						{
							var halftax = tes[1]/2;
							taxrate = halftax;
							var IRGST = ((producttotaldis*halftax)/100).toFixed(2);
							IRGST = IRGST;
							var IGST = '0.00';
							//totalgsttax += IRGST * 2;
						}
						else
						{
							var IRGST = '0.00';
							var IGST = ((producttotaldis*tes[1])/100).toFixed(2);
							IGST = IGST;
							taxirate = tes[1];
							//totalgsttax += IGST;
						}
					}
					else
					{
						if(clientshippingstate == currentstate )
						{
							var halftax = tes[1]/2;
							taxrate = halftax;
							var IRGST = ((producttotaldis*halftax)/100).toFixed(2);
							IRGST = IRGST;
							var IGST = '0.00';
						}
						else
						{
							var IRGST = '0.00';
							var IGST = ((producttotaldis*tes[1])/100).toFixed(2);
							IGST = IGST;
							taxirate = tes[1];
						}
					}
					content += "<tr id="+itemCount+">";
					content += "<td>"+productRowTotal+"</td>";
					content +="<td><span id='pname-"+itemCount+"'>"+producttext+"</span><input type='hidden' value='"+productname+"' id='piname-"+itemCount+"' name='itemid[]'/></td>";
					
					content +="<td><span id='phsn-"+itemCount+"'>"+producthsn+"</span><input type='hidden' value='"+producthsn+"' id='pihsn-"+itemCount+"' name='itemhsn[]'/></td>";
					content += "<td><span id='pqty-"+itemCount+"'>"+productqty+"</span><input type='hidden' value='"+productqty+"' id='piqty-"+itemCount+"' name='itemqty[]'/></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='pprice-"+itemCount+"'>"+productprice+"</span><input type='hidden' value='"+productprice+"' id='piprice-"+itemCount+"' name='itemprice[]'/></td>";
					content += "<input type='hidden' value='"+productPurchasePrice+"' id='pipurchaseprice-"+itemCount+"' name='itempurchaseprice[]'>";
					content += "<input type='hidden' value='"+productSupplier+"' id='pisupplier-"+itemCount+"' name='itemsupplier[]'>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='ptotal-"+itemCount+"'>"+producttotal.toFixed(2)+"</span></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='pdis-"+itemCount+"'>"+productdis+"</span><input type='hidden' value='"+productdis+"' id='pidis-"+itemCount+"' name='itemdis[]'/><input type='hidden' id='pidismode-"+itemCount+"' name='itemdismode[]' value='"+disMode+"'></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='ptaxvalue-"+itemCount+"'>"+producttotaldis.toFixed(2)+"</span></td>";
					content += "<input type='hidden' value="+producttax+" id='pitax-"+itemCount+"' name='itemtax[]'><input type='hidden' value="+tes[1]+" id='pistax-"+itemCount+"'>";
					content += "<td><span id='pcgtax-"+itemCount+"'>"+taxrate+"%</span><input type='hidden' value='"+taxrate+"' id='pcgitax-"+itemCount+"'/><input type='hidden' value='"+tes[1]+"' id='pstax-"+itemCount+"'></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='pcgst-"+itemCount+"'>"+IRGST+"</span><input type='hidden' value="+IRGST+" name='itemcgst[]'></td>";
					content += "<td><span id='psgtax-"+itemCount+"'>"+taxrate+"%</span><input type='hidden' value='"+taxrate+"' id='psgitax-"+itemCount+"'/><input type='hidden' value='"+tes[1]+"' id='pstax-"+itemCount+"'></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='psgst-"+itemCount+"'>"+IRGST+"</span><input type='hidden' value="+IRGST+" name='itemsgst[]'></td>";
					content += "<td><span id='pigtax-"+itemCount+"'>"+taxirate+"%</span><input type='hidden' value='"+taxrate+"' id='pigitax-"+itemCount+"'/><input type='hidden' value='"+tes[1]+"' id='pstax-"+itemCount+"'></td>";
					content += "<td><span class='alignLeft'><i class='fa fa-inr'></i></span><span class='alignRight' id='pigst-"+itemCount+"'>"+IGST+"</span><input type='hidden' value="+IGST+" name='itemigst[]'></td>";
					content += "<td align='center'><a class='billEdit editBtn' id='bEdit-"+itemCount+"'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>&nbsp;<a class='taxDelete deleteBtn' id='bDelete-"+itemCount+"'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td></tr>";
					//subtotal += producttotal;
					//totaldiscount += parseFloat(productdis);
					$('#billItem').append(content);
					$('#selItem').val("");
					$('#selHsn').val("");
					$('#selQty').val("");
					$('#selPrice').val("");
					$('#selDis').val("");
					$('#selTax').val("");
					$('#selItem').selectpicker('refresh'); 
				    $("#selItem").selectpicker('val', " ");
					$('#selItem').focus();
					var i = 0;
					$('#billItem tr').each(function() 
					{
						if(i>1)
						{
						console.log(this.id);
						var cid = this.id;
						var pqty = "piqty-"+cid;
						var pprice = "piprice-"+cid;
						var pdis = "pidis-"+cid;
						var ptax = "pistax-"+cid;
						//var pstax = "pstax-"+cid;
						var pqtyval = $('input[id="'+pqty+'"]').val();
						var ppriceval = $('input[id="'+pprice+'"]').val();
						var pdisval = $('input[id="'+pdis+'"]').val();
						var ptaxval = $('input[id="'+ptax+'"]').val();
						subtotal += parseFloat(pqtyval) * parseFloat(ppriceval);
						totaldiscount += parseFloat(pdisval);
						gsttotalcost = (parseFloat(pqtyval)*parseFloat(ppriceval))-parseFloat(pdisval);
						totalgsttax += (gsttotalcost/100)*parseFloat(ptaxval);
						
						
						}
						i++;
					});
					
					$('#subTotal').html("<i class='fa fa-inr'></i>. "+subtotal.toFixed(2));
					$('#disTotal').html("<i class='fa fa-inr'></i>. "+totaldiscount.toFixed(2));
					$('#gstTotal').html("<i class='fa fa-inr'></i>. "+totalgsttax.toFixed(2));
					grandtotal = (subtotal- totaldiscount)+totalgsttax;
					//grandtotal = (subtotal - totaldiscount);
					$('#grandTotal').html("<i class='fa fa-inr'></i>. "+grandtotal.toFixed(2));
					var paidbill = parseFloat(billpaid);
					$('#paidTotal').html("<i class='fa fa-inr'></i>. "+paidbill.toFixed(2));
					billbalance = grandtotal - paidbill;
					$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+grandtotal.toFixed(2));
					$('#selDis').val("0");
					
					var rid = 0;
					$('td:first-child').each(function() {
						rid++;
						$(this).text(rid);
						
					});
					
				});
				
				$(document).on('click','.billEdit',function()
				{
					var bid = this.id;
					
					var res = bid.split("-");
					editrow = res[1];
					var pname = "piname-"+res[1];
					var phsn = "pihsn-"+res[1];
					var pqty = "piqty-"+res[1];
					var pprice = "piprice-"+res[1];
					var purprice = "pipurchaseprice-"+res[1];
					var supitem = "pisupplier-"+res[1];
					var pdis = "pidis-"+res[1];
					var pdisMode = "pidismode-"+res[1];
					var ptax = "pitax-"+res[1];
					
					var pnameval = $('input[id="'+pname+'"]').val();
					var phsnval = $('input[id="'+phsn+'"]').val();
					var pqtyval = $('input[id="'+pqty+'"]').val();
					var ppriceval = $('input[id="'+pprice+'"]').val();
					var ppurchasevalue = $('input[id="'+purprice+'"]').val();
					var psuppliervalue = $('input[id="'+supitem+'"]').val();
					var pdisval = $('input[id="'+pdis+'"]').val();
					var pdismodeval = $('input[id="'+pdisMode+'"]').val();
					var ptaxval = $('input[id="'+ptax+'"]').val();
					totalRateQty = parseFloat(ppriceval)*parseFloat(pqtyval);
					alert(totalRateQty);
					if(pdismodeval == 1)
						pdisval = parseFloat(pdisval)*(100/(totalRateQty));

						
					


					$('#itemEditModel').modal({
					backdrop: 'static',
					keyboard: false
					});
					$('#selEditItem').selectpicker('refresh'); 
				    $("#selEditItem").selectpicker('val',pnameval);
					$('#selEditHsn').val(phsnval);
					$('#selEditQty').val(pqtyval);
					$('#selEditPrice').val(ppriceval);
					$('#selEditPurchasePrice').val(ppurchasevalue);
					$('#selEditSupplier').val(psuppliervalue);
					$('#selEditDiscountMode').val(pdismodeval);
					$('#selEditDis').val(pdisval);
					$('#selEditTax').val(ptaxval);
					$('#billRow').val(res[1]);
					
					
				});
				
				$('#editItemBtn').on('click',function()
				{
					var productname = $('#selEditItem').val();
					/*Check Dublicate*/
					var i = 0;
					var dflag = 0;
					$('#billItem tr').each(function() 
					{
						if(i>1)
						{
							var cid = this.id;
							if(editrow != cid)
							{
							if($("#piname-"+cid).val() == productname)
							{
								swal("Dublicate Entry","","warning");
								dflag = 1;
							}
							}
						}
						
						i++;
					});
					if(dflag == 1)
						{
						return false;
						}
					
					bid = $('#billRow').val();
					pname = "piname-"+bid;
					phsn = "pihsn-"+bid;
					pqty = "piqty-"+bid;
					pprice = "piprice-"+bid;
					ppurchaseprice = "pipurchaseprice-"+bid;
					psupplier = "pisupplier-"+bid;
					pdismode = "pidismode-"+bid;
					pidis = "pidis-"+bid;
					ptax = "pitax-"+bid;
					$('input[id="'+pname+'"]').val($('#selEditItem').val());
					$('input[id="'+phsn+'"]').val($('#selEditHsn').val());
					$('input[id="'+pqty+'"]').val($('#selEditQty').val());
					$('input[id="'+pprice+'"]').val($('#selEditPrice').val());
					$('input[id="'+ppurchaseprice+'"]').val($('#selEditPurchasePrice').val());
					$('input[id="'+psupplier+'"]').val($('#selEditSupplier').val());
					//$('input[id="'+pdis+'"]').val($('#selEditDis').val());
					$('input[id="'+pdismode+'"]').val($('#selEditDiscountMode').val());
					$('input[id="'+ptax+'"]').val($('#selEditTax').val());
					
					pname = "pname-"+bid;
					phsn = "phsn-"+bid;
					pqty = "pqty-"+bid;
					pprice = "pprice-"+bid;
					ptotal = "ptotal-"+bid;
					pdis = "pdis-"+bid;
					ptaxvalue = "ptaxvalue-"+bid;
					//ptax = "ptax-"+bid;
					pstax = "pistax-"+bid;
					
					pcgtax = "pcgtax-"+bid; // CGTAX RATE;
					psgtax = "psgtax-"+bid;
					
					pcgst = "pcgst-"+bid // Tax Price;
					psgst = "psgst-"+bid
					
					pigtax = "pigtax-"+bid; // IGST RATE
					pigst = "pigst-"+bid; // IGST Price;
					
					var producttext = $("#selEditItem option:selected").text();
					$('#'+pname).text(producttext);
					$('#'+phsn).text($('#selEditHsn').val());
					$('#'+pqty).text($('#selEditQty').val());
					$('#'+pprice).text($('#selEditPrice').val());
					

					
					var pedittaxtext = $('#selEditTax option:selected').text();
					var tes = pedittaxtext.split("-");
					//$('#'+ptax).text(tes[1]+"%");
					$('input[id="'+pstax+'"]').val(tes[1]);
					$('#itemEditModel').modal('hide');
					
					
					var producttotal = parseFloat($('#selEditQty').val()) * parseFloat($('#selEditPrice').val());
					$('#'+ptotal).text(producttotal);
					var productdis = $('#selEditDis').val();


					if($('#selEditDiscountMode').val() == 1){
						productdis = (parseFloat($('#selEditDis').val())/100)*parseFloat(producttotal)
					}
					else{
						productdis = $('#selEditDis').val();
					}
					//$('#'+pdis).text($('#selEditDis').val());
					$('input[id="'+pidis+'"]').val(productdis);
					$('#'+pdis).text(productdis);
					var producttotaldis = parseFloat(producttotal)-parseFloat(productdis);
					
					$('#'+ptaxvalue).text(producttotaldis);
					var taxrate = 0;
					var taxirate = 0;
					if(clientshipping == 0)
					{
						if(clientbillingstate == currentstate )
						{
							var halftax = tes[1]/2;
							taxrate = halftax;
							$('#'+pcgtax).text(taxrate+'%');
							$('#'+psgtax).text(taxrate+'%');
							var IRGST = (producttotaldis*halftax)/100;
							$('#'+pcgst).text(IRGST);
							$('#'+psgst).text(IRGST);
							var IGST = '0.00';
							//totalgsttax += IRGST * 2;
						}
						else
						{
							$('#'+pigtax).text(tes[1]+"%");
							var IRGST = '0.00';
							var IGST = (producttotaldis*tes[1])/100;
							$('#'+pigst).text(IGST);
							taxirate = tes[1];
							//totalgsttax += IGST;
						}
					}
					else
					{
						if(clientshippingstate == currentstate )
						{
							var halftax = tes[1]/2;
							taxrate = halftax;
							$('#'+pcgtax).text(taxrate+'%');
							$('#'+psgtax).text(taxrate+'%');
							var IRGST = (producttotaldis*halftax)/100;
							$('#'+pcgst).text(IRGST);
							$('#'+psgst).text(IRGST);
							var IGST = '0.00';
						}
						else
						{
							$('#'+pigtax).text(tes[1]+"%");
							var IRGST = '0.00';
							var IGST = (producttotaldis*tes[1])/100;
							$('#'+pigst).text(IGST);
							taxirate = tes[1];
						}
					}
					
					
					subtotal = 0;
					totaldiscount = 0;
					gsttotalcost = 0;
					totalgsttax = 0;
					var i = 0;
					$('#billItem tr').each(function() 
					{
						console.log(this.id);
						if(i>1)
						{
						var cid = this.id;
						var pqty = "piqty-"+cid;
						var pprice = "piprice-"+cid;
						var ppurchaseprice = "pipurchaseprice-"+cid;
						var psupplier = "pisupplier-"+cid;
						var pdis = "pidis-"+cid;
						var ptax = "pitax-"+cid;
						var pstax = "pstax-"+cid;
						var pqtyval = $('input[id="'+pqty+'"]').val();
						var ppriceval = $('input[id="'+pprice+'"]').val();
						var pdisval = $('input[id="'+pdis+'"]').val();
						var ptaxval = $('input[id="'+ptax+'"]').val();
						var pstaxval = $('input[id="'+pstax+'"]').val();
						subtotal += parseFloat(pqtyval)*parseFloat(ppriceval);
						totaldiscount += parseFloat(pdisval);
						gsttotalcost = (parseFloat(pqtyval)*parseFloat(ppriceval))-parseFloat(pdisval);
						totalgsttax += (gsttotalcost/100)*parseFloat(pstaxval);
						
						}
						i++;
					});
					
					$('#subTotal').html("<i class='fa fa-inr'></i>. "+subtotal.toFixed(2));
					$('#disTotal').html("<i class='fa fa-inr'></i>. "+totaldiscount.toFixed(2));
					$('#gstTotal').html("<i class='fa fa-inr'></i>. "+totalgsttax.toFixed(2));
					grandtotal = (subtotal- totaldiscount)+totalgsttax;
					$('#grandTotal').html("<i class='fa fa-inr'></i>. "+grandtotal.toFixed(2));
					var paidbill = parseFloat(billpaid);
					$('#paidTotal').html("<i class='fa fa-inr'></i>. "+paidbill.toFixed(2));
					billbalance = grandtotal - paidbill;
					$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+grandtotal.toFixed(2));
				});
				
				$(document).on('click','.taxDelete',function(){
					var did = this.id;
					var dres = did.split("-");
					$('table#billItem tr#'+dres[1]).remove();
					
					subtotal = 0;
					totaldiscount = 0;
					gsttotalcost = 0;
					totalgsttax = 0;
					var i = 0;
					$('#billItem tr').each(function() 
					{
						console.log(this.id);
						if(i>1)
						{
						console.log(this.id);
						var cid = this.id;
						var pqty = "piqty-"+cid;
						var pprice = "piprice-"+cid;
						var pdis = "pidis-"+cid;
						var ptax = "pistax-"+cid;
						//var pstax = "pstax-"+cid;
						var pqtyval = $('input[id="'+pqty+'"]').val();
						var ppriceval = $('input[id="'+pprice+'"]').val();
						var pdisval = $('input[id="'+pdis+'"]').val();
						var ptaxval = $('input[id="'+ptax+'"]').val();
						subtotal += parseFloat(pqtyval) * parseFloat(ppriceval);
						totaldiscount += parseFloat(pdisval);
						//var pstaxval = $('input[id="'+pstax+'"]').val();
						//subtotal += parseFloat(pqtyval)*parseFloat(ppriceval);
						//totaldiscount += parseFloat(pdisval);
						gsttotalcost = (parseFloat(pqtyval)*parseFloat(ppriceval))-parseFloat(pdisval);
						totalgsttax += (gsttotalcost/100)*parseFloat(ptaxval);
						}
						i++;
					});
					
					$('#subTotal').html("<i class='fa fa-inr'></i>. "+subtotal.toFixed(2));
					$('#disTotal').html("<i class='fa fa-inr'></i>. "+totaldiscount.toFixed(2));
					$('#gstTotal').html("<i class='fa fa-inr'></i>. "+totalgsttax.toFixed(2));
					grandtotal = (subtotal- totaldiscount)+totalgsttax;
					$('#grandTotal').html("<i class='fa fa-inr'></i>. "+grandtotal.toFixed(2));
					var paidbill = parseFloat(billpaid);
					$('#paidTotal').html("<i class='fa fa-inr'></i>. "+paidbill.toFixed(2));
					billbalance = grandtotal - paidbill;
					$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+grandtotal.toFixed(2));
					var rid = 0;
					$('td:first-child').each(function() {
						rid++;
						$(this).text(rid);
						
					});
				});
				
				$('#paidAmount').blur(function()
				{
					var paidValue = parseFloat($(this).val());
					var cpaid = 0;
					var gtotal = parseFloat(grandtotal);
					if(paidValue != "")
					{
						if(billid !=0)
							{
								billpaid = oldpaid + paidValue;
								billbalance = gtotal-billpaid;
								balance = gtotal - oldpaid;
								if(paidValue > balance)
								{
									billpaid = gtotal-oldpaid;
									balance = 0.00;
									$(this).val(billpaid.toFixed(2));
									$('#paidTotal').html("<i class='fa fa-inr'></i>. "+gtotal.toFixed(2));
									$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+balance.toFixed(2));
								}
								else
								{
									$('#paidTotal').html("<i class='fa fa-inr'></i>. "+billpaid.toFixed(2));
									$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+billbalance.toFixed(2));
								}
								
							}
							else
							{
								billpaid = paidValue;
								balance = gtotal - billpaid;
								
								if(billpaid > gtotal)
								{
									$(this).val(gtotal.toFixed(2));
									billpaid = gtotal;
									balance = 0.00;
									$('#paidTotal').html("<i class='fa fa-inr'></i>. "+billpaid.toFixed(2));
									$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+balance.toFixed(2));
									swal("Paid Amount Should not excess the Grand Total","","error");
									
								}
								else
								{
								$('#paidTotal').html("<i class='fa fa-inr'></i>. "+billpaid.toFixed(2));
								$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+balance.toFixed(2));
								}
							}
					}
				});
				
				$('#selDis').keyup(function(){
					var mydis = $(this).val();
					var selqty = $('#selQty').val();
					var selprice = parseFloat($('#selPrice').val());
					var purprice = parseFloat($('#purPrice').val());
					var profitbalance = (selprice-purprice)*selqty;
					if(mydis>profitbalance){
						swal("Loss","","warning");
					}
				});
				
				$('#selEditDis').keyup(function(){
					var mydis = $(this).val();
					var selqty = $('#selEditQty').val();
					var selprice = parseFloat($('#selEditPrice').val());
					var purprice = parseFloat($('#selEditPurchasePrice').val());
					var profitbalance = (selprice-purprice)*selqty;
					if(mydis>profitbalance){
						swal("Loss","","warning");
					}
				});
				
					
				$('.printBill').click(function(e){
					e.preventDefault();
					printbill();
				});
				
				$('.close').click(function(e){
					$('#myModal').hide();
				});
				
				$('#saveBill').on('click',function(){
					start();
					var cusid = $('#clientGet').val();
					var itemid = $('input[name="itemid[]"]').map(function(){return $(this).val();}).get(); 
					var itemprice = $('input[name="itemprice[]"]').map(function(){return $(this).val();}).get();
					var itempurchaseprice = $('input[name="itempurchaseprice[]"]').map(function(){return $(this).val();}).get();
					var itemsupplier = $('input[name="itemsupplier[]"]').map(function(){return $(this).val();}).get();
					var itemqty = $('input[name="itemqty[]"]').map(function(){return $(this).val();}).get();
					var itemdis = $('input[name="itemdis[]"]').map(function(){return $(this).val();}).get();		
					var item_dis_mode = $('input[name="itemdismode[]"]').map(function(){return $(this).val();}).get(); 
					var itemtax = $('input[name="itemtax[]"]').map(function(){return $(this).val();}).get();					
					var paidamount = $('#paidAmount').val();
					var flag = 5;
					var data = {"cusid":cusid,"paidamount":paidamount,"itemid":itemid,"itemprice":itemprice,"itempurchaseprice":itempurchaseprice,"itemsupplier":itemsupplier,"itemqty":itemqty,"itemdis":itemdis,"itemtax":itemtax,"flag":flag,"itemdismode":item_dis_mode};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								location.href="order.php";
							}
						}
					});
					end();
				});
				
				//Update Bill
				$('#updateBill').on('click',function()
				{
					var cusid = $('#clientGet').val();
					var itemid = $('input[name="itemid[]"]').map(function(){return $(this).val();}).get(); 
					var itemprice = $('input[name="itemprice[]"]').map(function(){return $(this).val();}).get();
					var itempurchaseprice = $('input[name="itempurchaseprice[]"]').map(function(){return $(this).val();}).get();
					var itemsupplier = $('input[name="itemsupplier[]"]').map(function(){return $(this).val();}).get();
					var itemqty = $('input[name="itemqty[]"]').map(function(){return $(this).val();}).get();
					var itemdis = $('input[name="itemdis[]"]').map(function(){return $(this).val();}).get();	
					var item_dis_mode = $('input[name="itemdismode[]"]').map(function(){return $(this).val();}).get(); 
					var itemtax = $('input[name="itemtax[]"]').map(function(){return $(this).val();}).get();					
					var paidamount = $('#paidAmount').val();
					var billid = $('#myorderNo').text();
					var flag = 5;
					var data = {"billid":billid,"cusid":cusid,"paidamount":paidamount,"itemid":itemid,"itemprice":itemprice,"itempurchaseprice":itempurchaseprice,"itemsupplier":itemsupplier,"itemqty":itemqty,"itemdis":itemdis,"itemtax":itemtax,"flag":flag,"itemdismode":item_dis_mode};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								
								location.href="order.php";
							}
						}
					});
				});
				
				//Update & Print
				//Update Bill
				$('#updatePrintBill').on('click',function()
				{
					var cusid = $('#clientGet').val();
					var itemid = $('input[name="itemid[]"]').map(function(){return $(this).val();}).get(); 
					var itemprice = $('input[name="itemprice[]"]').map(function(){return $(this).val();}).get();
					var itempurchaseprice = $('input[name="itempurchaseprice[]"]').map(function(){return $(this).val();}).get();
					var itemsupplier = $('input[name="itemsupplier[]"]').map(function(){return $(this).val();}).get();
					var itemqty = $('input[name="itemqty[]"]').map(function(){return $(this).val();}).get();
					var itemdis = $('input[name="itemdis[]"]').map(function(){return $(this).val();}).get();	
					var item_dis_mode = $('input[name="itemdismode[]"]').map(function(){return $(this).val();}).get(); 
					var itemtax = $('input[name="itemtax[]"]').map(function(){return $(this).val();}).get();					
					var paidamount = $('#paidAmount').val();
					var billid = $('#myorderNo').text();
					var flag = 5;
					var data = {"billid":billid,"cusid":cusid,"paidamount":paidamount,"itemid":itemid,"itemprice":itemprice,"itempurchaseprice":itempurchaseprice,"itemsupplier":itemsupplier,"itemqty":itemqty,"itemdis":itemdis,"itemtax":itemtax,"flag":flag,"itemdismode":item_dis_mode};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#myPrint').get(0).contentWindow.print();
								$('#myModal').fadeOut();
								var i = 0;
								//$('#1').remove();
								$('#billItem tr').each(function() 
								{
										$('#'+i).remove();
										i++;
								});
								$('#subTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#disTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#gstTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#grandTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#balanceTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#paidTotal').html("<i class='fa fa-inr'></i>. 0.00");
							}
						}
					});
				});
				
				$('#savePrintBill').on('click',function()
				{
					var cusid = $('#clientGet').val();
					var itemid = $('input[name="itemid[]"]').map(function(){return $(this).val();}).get(); 
					var itemprice = $('input[name="itemprice[]"]').map(function(){return $(this).val();}).get();
					var itempurchaseprice = $('input[name="itempurchaseprice[]"]').map(function(){return $(this).val();}).get();
					var itemsupplier = $('input[name="itemsupplier[]"]').map(function(){return $(this).val();}).get();
					var itemqty = $('input[name="itemqty[]"]').map(function(){return $(this).val();}).get();
					var itemdis = $('input[name="itemdis[]"]').map(function(){return $(this).val();}).get();	
					var item_dis_mode = $('input[name="itemdismode[]"]').map(function(){return $(this).val();}).get(); 
					var itemtax = $('input[name="itemtax[]"]').map(function(){return $(this).val();}).get();					
					var paidamount = $('#paidAmount').val();
					var flag = 5;
					var data = {"cusid":cusid,"paidamount":paidamount,"itemid":itemid,"itemprice":itemprice,"itempurchaseprice":itempurchaseprice,"itemsupplier":itemsupplier,"itemqty":itemqty,"itemdis":itemdis,"itemtax":itemtax,"flag":flag,"itemdismode":item_dis_mode};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#myPrint').get(0).contentWindow.print();
								$('#myModal').fadeOut();
								var i = 0;
								//$('#1').remove();
								$('#billItem tr').each(function() 
								{
										$('#'+i).remove();
										i++;
								});
								$('#subTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#disTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#gstTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#grandTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#balanceTotal').html("<i class='fa fa-inr'></i>. 0.00");
								$('#paidTotal').html("<i class='fa fa-inr'></i>. 0.00");
							}
						}
					});
					
				});
				
				$(window).keydown(function(event) 
				{
					if(event.ctrlKey && (event.which == 80))
					{
					printbill();
					return false;
					}
				});
				
				function printbill()
				{
					var tempname = "";
					var flag = 14;
					var data = {flag:flag};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							tempname = html;
					var rowCount = $('#billItem tr').length;
					if(rowCount==2)
					{
							swal("Please Add Item","","warning");
							return false;
					}
					
					$('#myModal').fadeIn();
					var content = "";
					var item_id = $('input[name="itemid[]"]').map(function(){return $(this).val();}).get(); 
					var item_qty = $('input[name="itemqty[]"]').map(function(){return $(this).val();}).get(); 
					var item_price = $('input[name="itemprice[]"]').map(function(){return $(this).val();}).get(); 
					var item_dis = $('input[name="itemdis[]"]').map(function(){return $(this).val();}).get(); 
					var item_dis_mode = $('input[name="itemdismode[]"]').map(function(){return $(this).val();}).get(); 
					var item_tax = $('input[name="itemtax[]"]').map(function(){return $(this).val();}).get(); 
					/*var item_cgst = $('input[name="itemcgst[]"]').map(function(){return $(this).val();}).get(); 
					var item_sgst = $('input[name="itemsgst[]"]').map(function(){return $(this).val();}).get(); 
					var item_igst = $('input[name="itemigst[]"]').map(function(){return $(this).val();}).get(); 
					*/
					var cusid = $('#clientGet').val();
					var sno = $('#myorderNo').text();
					var paidamount = 0;
					if($('#paidAmount').val() > 0)
					{
						paidamount = $('#paidAmount').val();
					}
					//content += "?itemid="+item_id+"&itemqty="+item_qty+"&itemprice="+item_price+"&itemdis="+item_dis+"&itemtax="+item_tax+"&itemcgst="+item_cgst+"&itemsgst="+item_sgst+"&itemigst="+item_igst+"&custype="+cusType+"&cusid="+cusid;
					if(billid !=0)
					{
					content += "?itemid="+item_id+"&itemqty="+item_qty+"&itemprice="+item_price+"&itemdis="+item_dis+"&itemtax="+item_tax+"&cusid="+cusid+"&sno="+sno+"&paidamount="+paidamount+"&flag=1&clientstatus="+clientstatus+"&itemdismode="+item_dis_mode;
					}
					else
					{
					content += "?itemid="+item_id+"&itemqty="+item_qty+"&itemprice="+item_price+"&itemdis="+item_dis+"&itemtax="+item_tax+"&cusid="+cusid+"&sno="+sno+"&paidamount="+paidamount+"&clientstatus="+clientstatus+"&itemdismode="+item_dis_mode;
					}
					var billfile = 'billbdf-basic.php';
					
					tempname = 'billpdf-basic';
					$('#myPrint').attr('src',tempname+'.php'+content);
						}
					});
					
				}
				
				$('#editPrintBill').on('click',function(){
					$('#myModal').fadeOut();
				});
				
				$("#addPayment").change(function() 
				{
					var gtotal = parseFloat(grandtotal);
					if(this.checked) 
					{
						
						$('#paidAmount').attr('disabled',false);
						$('#paidAmount').val(grandtotal.toFixed(2));
						
							cpaid = parseFloat(billbalance).toFixed(2);
							billpaid = parseFloat(billpaid) + parseFloat(cpaid);
							billbalance = gtotal - billpaid;
							$('#paidTotal').html("<i class='fa fa-inr'></i>. "+billpaid.toFixed(2));
							$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+billbalance.toFixed(2));
						
					}
					else
					{
						$('#paidAmount').val("");
						$('#paidAmount').attr('disabled',true);
						if(billid != 0)
						{
							billpaid = oldpaid;
							billbalance = gtotal - parseFloat(billpaid);
							
							$('#paidTotal').html("<i class='fa fa-inr'></i>. "+billpaid.toFixed(2));
						$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+billbalance.toFixed(2));
						}
						else
						{
							billpaid = 0.00
							billbalance = gtotal ;
							
							$('#paidTotal').html("<i class='fa fa-inr'></i>. "+billpaid.toFixed(2));
						$('#balanceTotal').html("<i class='fa fa-inr'></i>. "+gtotal.toFixed(2));
						}
						
						$('#paidAmount').val("");
						$('#paidAmount').attr('disabled',true);	
					}
				});
				
				$(document).on('blur','.itemName',function(){
					var iname = $(this).val();
					var flag = 6;
					var data = {iname:iname,flag:flag};
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorName').fadeIn();
								$('.itemName').val("");
								$('.itemName').focus();
							}
							else
							{
								$('#errorName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.itemShort',function(){
					var iname = $(this).val();
					var flag = 7;
					var data = {iname:iname,flag:flag};
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorShortName').fadeIn();
								$('.itemShort').val("");
								$('.itemShort').focus();
							}
							else
							{
								$('#errorShortName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('keyup','.itemHsn',function(){
					var iname = $(this).val();
					var flag = 9;
					var data = {iname:iname,flag:flag};
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorHsn').fadeIn();
								$('.itemHsn').val("");
								$('.itemHsn').focus();
							}
							else
							{
								$('#errorHsn').fadeOut();
							}
						}
					});
				});
				
				window.onbeforeunload = function() {
					return "Are you sure you want to navigate away?";
					
				}
				
			});
		</script>
	</body>
</html>