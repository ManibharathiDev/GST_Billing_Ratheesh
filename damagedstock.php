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
	<body>
		<?php
			include('header.php');
		?>
		<div class="wrap-container">
			<div class="wrap-heading">
				<h1>Manage Stocks</h1>
			</div>
			<div class="wrap-content">
				<div class="row">
					<div class="col-md-3">
						<input type="text" id="itemSearch" class="wrap-text wrap-focus" placeholder="Search">
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2 padding-left">
						<a href="#" id="newItem" class="wrap-btn-new"><i class="fa fa-plus" aria-hidden="true"></i> New Entry</a>
					</div>
					<div class="col-md-1 padding-left">
						<a class="wrap-btn-exp dropdown-toggle" data-toggle="dropdown">Export
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#" id="pdfExport"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a></li>
						<li><a href="#" id="xlExport"><i class="fa fa-file-excel-o" aria-hidden="true"></i> EXCEL</a></li>
					</ul>
						<!--<a href="#" class="wrap-btn-exp" width="100%"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF</a>-->
					</div>
					<div class="col-md-1">
						<select name="" class="wrap-text show">
							<option value="10">10</option>
							<option value="20">20</option>
							<option value="30">30</option>
							<option value="40">40</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>
				<div id="itemView">
				</div>
			</div>
		</div>
		<div class="modal fade" id="itemModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Entry</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="itemForm" id="itemForm">
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Item Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemName" id="sitemName" list="product" class="wrap-text cinput itemName" required>
						<input type="hidden" name="itemid" id="selItemId">
						<datalist id="product">
						<select id="listProduct">
							
							
						</select>
						</datalist>
					
					</div>
				</div>
				<div id="itemDetails">
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Item Short Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemShort" class="wrap-text cinput itemShort">
						<div class="errMsg" id="errorShortName">Item Short Name Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Item Description : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemDescription" class="wrap-text cinput">
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> HSN : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemHSN" class="wrap-text cinput itemHsn numeric">
						<div class="errMsg" id="errorHsn">HSN Already Exists!</div>
					</div>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Quantity : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemQuantity" id="itemQuantity" class="wrap-text cinput numeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Purchased Price : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemPurchasePrice" id="itemPurchasePrice" class="wrap-text cinput dnumeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Selling Price : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemSellingPrice" id="itemSellingPrice" class="wrap-text cinput dnumeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Tax(%) : </label>
					</div>
					<div class="col-md-7">
						<select name="itemTax" id="itemTax" class="wrap-text cinput" required>
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
						<select name="itemCategory" id="itemCategory" class="wrap-text cinput" required>
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
						<select name="itemBrand" id="itemBrand" class="wrap-text cinput" required>
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
						<select name="itemSupplier" id="itemSupplier" class="wrap-text cinput" required>
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
							<option value="1" selected>Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					<input type="hidden" name="qty" id="qty">
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
  
	<!-- Edit Item -->
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
			<form name="itemEditForm" id="itemEditForm">
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Item Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemName" id="itemName" class="wrap-text itemEName" required>
						<div class="errMsg" id="errorEName">Stock Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Item Short Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemShort" id="itemShort" class="wrap-text itemEShort">
						<div class="errMsg" id="errorEShortName">Item Short Name Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Item Description : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemDescription" id="itemDescription" class="wrap-text">
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> HSN : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemHSN" id="itemHSN" class="wrap-text itemEHsn numeric">
						<div class="errMsg" id="errorEHsn">HSN Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Quantity : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemQuantity" id="itemQuantity" class="wrap-text numeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Unit Price : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="itemPrice" id="itemPrice" class="wrap-text dnumeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label> Tax(%) : </label>
					</div>
					<div class="col-md-7">
						<select name="itemTax" id="itemTax" class="wrap-text">
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
						<select name="itemCategory" id="itemCategory" class="wrap-text" required>
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
						<select name="itemBrand" id="itemBrand" class="wrap-text" required>
							<option value="">Select Brand</option>
							<?php
								$query = "SELECT * FROM `tbl_brand`";
								$stmt = $db->prepare($query);
								$stmt->execute();
								if($stmt->rowCount()>0)
								{
									while($row = $stmt->fetch(PDO::FETCH_ASSOC))
									{
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
						<select name="itemSupplier" id="itemSupplier" class="wrap-text cinput" required>
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
						<select name="itemStatus" id="itemStatus" class="wrap-text" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					<input type="hidden" name="itemId" id="itemId">
					<input type="hidden" value="4" name="flag">
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						
					</div>
					<div class="col-md-7">
						<Button type="submit" class="btn btn-primary">Update</Button>
					</div>
				</div>
				</form>
      </div>
    </div>
  </div>
  </div>
  </div>
  
  <!--Delete Mode-->
	<div class="modal fade" id="deleteModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">This action will permanently delete the Item, and can not be undone.<br>Are You Sure Want to Delete?</h4>
        </div>
        <div class="modal-body">
			<div id="itemShows">
				
			<div>
        </div>
       
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
		<script type="text/javascript">
		$('#newItem').click(function()
		{
				$('#itemModel').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('#itemDetails').hide();
				var flag = 8;
				var data = {flag:flag};
				$.ajax({
					url:'controller/controller.stock.php',
					type:'POST',
					data:data,
					success:function(html){
						$('#listProduct').html(html);
					}
				});
				$('.cinput').val("");
				setTimeout(function() { $('input[id="sitemName"]').focus() }, 500);
			});
		$(document).ready(function(){
			var count = 0;
			var match = 0;
			$('.wrap-focus').focus();
			var activepage = "";
				var flag = 0;
				start();
				getitemdetails();
				
				/*$("#sitemName").on('input', function () {
					var val = this.value;
					if($('#product option').filter(function(){
						if(this.value == val)
						{
							id = $('#product [value="' + val + '"]').data('id');
							alert(id);
						}
					}).length) 
					{
						
					}
					});*/
					
				$('#sitemName').on('blur',function(){
					var val = this.value;
					
					$('#product option').filter(function()
					{
						id = $('#product [value="' + val + '"]').data('id');
						if (typeof id === "undefined") 
						{
							$('#itemDetails').show();
						}
						if(this.value == val)
						{
							count++;
							$('#itemDetails').hide();
							
							$('#selItemId').val(id);
							var splitid = id.split(",");
							if(splitid[1] == 0)
							{
										$('#itemQuantity').val("");
										$('#itemPurchasePrice').val("");
										$('#itemSellingPrice').val("");
										$('#itemTax').val("");
										$('#itemCategory').val("");
										$('#itemBrand').val("");
										$('#itemSupplier').val("");
										$('#qty').val("");
							}
							else
							{
							var flag = 3;
							var data = {flag:flag,itemid:id};
							$.ajax({
								url:'controller/controller.stock.php',
								type:'POST',
								data:data,
								dataType:'json',
								success:function(data){
									$.each(data,function(index,value){
										$('#itemQuantity').val(value.stockQty);
										$('#qty').val(value.stockQty);
										$('#itemPurchasePrice').val(value.purchasedPrice);
										$('#itemSellingPrice').val(value.sellingPrice);
										$('#itemTax').val(value.stockTax);
										$('#itemCategory').val(value.catId);
										$('#itemBrand').val(value.brandId);
										$('#itemSupplier').val(value.supplierId);
									});
								}
							});
							}
						}
						else
						{
										count = 0;
										$('#selItemId').val(id);
										$('#itemQuantity').val("");
										$('#itemPurchasePrice').val("");
										$('#itemSellingPrice').val("");
										$('#itemTax').val("");
										$('#itemCategory').val("");
										$('#itemBrand').val("");
										$('#itemSupplier').val("");
						}
					});
				});	
				
				/*$('#sitemName').on('blur',function(){
					if(match == 0){
						match = 0;
						$('#itemDetails').show();
					}
					else
					{
						
						$('#itemDetails').hide();
					}
				});*/
				
				$('#itemForm').on('submit',function(e){
						e.preventDefault();
						start();
						$.ajax({
							url:'controller/controller.stock.php',
							type:'POST',
							data:new FormData(this),
							processData:false,
							contentType:false,
							success:function(html){
								if(html == 1)
								{
									$('#itemDetails').hide();
									getitemdetails();
									$('.cinput').val("");
									$('#itemModel').modal('hide');
									$('.wrap-focus').focus();
								}
							}
						});
				});
				
				$('#itemBrand').on('change',function(){
					var id = $(this).val();
					var itemid = $('#selItemId').val();
					var flag = 4;
					var data = {flag:flag,itemid:itemid,brandid:id};
					$.ajax({
						url:'controller/controller.stock.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1){
								swal("Already Added for Same Brand","","warning");
										$('#itemQuantity').val("");
										$('#itemPurchasePrice').val("");
										$('#itemSellingPrice').val("");
										$('#itemTax').val("");
										$('#itemCategory').val("");
										$('#itemBrand').val("");
										$('#itemSupplier').val("");
							}
						}
					});
				});
				
				$('document').on('blur','#itemPurchasePrice',function(){
					var selprice = parseFloat($('#itemSellingPrice').val());
					var purprice = $(this).val();
					if(isNaN(selprice)){
						
					}
					else{
						if(selprice < purprice)
						{
							swal("Selling Price Should be Greater or Equal to Purchased Price","","error")
							$('#itemSellingPrice').val("");
						}
					}
				});
				
				$(document).on('blur','#itemSellingPrice',function(){
					var selprice = parseFloat($(this).val());
					var purprice = parseFloat($('#itemPurchasePrice').val());
					if(isNaN(purprice))
					{
						swal("Please Add Purchased Price","","warning");
						$(this).val("");
						setTimeout(function() { $('input[id="itemPurchasePrice"]').focus() }, 500);
						
					}
					else
					{
						if(selprice < purprice){
							swal("Selling Price Should be Greater or Equal to Purchased Price","","error")
							$(this).val("");
						}
					}
					
					
				});
				
				$(document).on('click','.productEdit',function(e){
					e.preventDefault();
					var flag = 3;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data){
							$('#itemEditModel').modal({
								backdrop: 'static',
								keyboard: false
								});
							$.each(data, function(index, element) 
							{
							$('#itemId').val(element.productId);
							$('#itemName').val(element.productName);
							$('#itemShort').val(element.productShort)
							$('#itemDescription').val(element.productDescription);
							$('#itemHSN').val(element.productHSN);
							$('#itemQuantity').val(element.productQuantity);
							$('#itemPrice').val(element.productUnitPrice);
							$('#itemTax').val(element.productTaxId);
							$('#itemCategory').val(element.productCat);
							$('#itemBrand').val(element.productBrand);
							$('#itemSupplier').val(element.productSupplier);
							$('#itemStatus').val(element.productStatus);
							});
						}
					});
				});
				
				$(document).on('click','.productDelete',function(e){
					e.preventDefault();
					var flag = 6;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.stock.php',
						type:'POST',
						data:data,
						success:function(html)
						{
							$('#deleteModel').modal({
							backdrop: 'static',
							keyboard: false
							});
							$('#itemShows').html(html);
							end();
						}
					});
				});
				
				$(document).on('click','.wrapDelete',function(){
					
					var flag = 7;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.stock.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								start();
								$('#deleteModel').modal('hide');
								getitemdetails();
							}
							else
							{
								$('#deleteModel').modal('hide');
								swal("You can't do this operation!, Biill Created","","warning");
							}
						}
					});
					
				});
				
				$(document).on('click','.wrapClose',function(){
					$('#deleteModel').modal('hide');
				});
				
				$('#itemEditForm').on('submit',function(e){
					e.preventDefault();
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:new FormData(this),
						processData:false,
						contentType:false,
						success:function(html)
						{
							$('#itemEditModel').modal('hide');
							getitemdetails();
						}
						});
				});
				
				/*$(document).on('blur','.itemName',function(){
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
				});*/
				
				$(document).on('blur','.itemEName',function(){
					var iname = $(this).val();
					var flag = 6;
					var id= $('#itemId').val();
					var data = {iname:iname,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEName').fadeIn();
								$('.itemEName').val("");
								$('.itemEName').focus();
							}
							else
							{
								$('#errorEName').fadeOut();
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
				
				$(document).on('blur','.itemEShort',function(){
					var iname = $(this).val();
					var flag = 7;
					var id= $('#itemId').val();
					var data = {iname:iname,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEShortName').fadeIn();
								$('.itemEShort').val("");
								$('.itemEShort').focus();
							}
							else
							{
								$('#errorEShortName').fadeOut();
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
				
				$(document).on('blur','.itemEHsn',function(){
					var iname = $(this).val();
					var flag = 9;
					var id= $('#itemId').val();
					var data = {iname:iname,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEHsn').fadeIn();
								$('.itemEHsn').val("");
								$('.itemEHsn').focus();
							}
							else
							{
								$('#errorEHsn').fadeOut();
							}
						}
					});
				});
				
				$(document).on('click','#pdfExport',function(){
					flag = 8;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportpdf.php?flag=item&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','#xlExport',function(){
					flag = 8;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.item.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportxl.php?flag=item&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','.spage',function(){
					start();
					activepage = this.id;
					getitemdetails();
				});
				
				$('#itemSearch').on('keyup',function(){
					start();
					getitemdetails();
				});
				
				$(document).on('change','.show',function(){
					start();
					activepage = 1;
					getitemdetails();
				});
				
				
				function getitemdetails(){
					flag = 5;
					var show = $('.show').val();
					var search = $('#itemSearch').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show};
					$.ajax({
						url:'controller/controller.stock.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#itemView').html(html);
							end();
						}
					});
				}
			});	
		</script>
		<?php
			include('headerright.php');
		?>
	</body>
</html>