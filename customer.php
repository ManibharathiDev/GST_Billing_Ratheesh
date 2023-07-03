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
				<h1>Manage Customers</h1>
			</div>
			<div class="wrap-content">
				<div class="row">
					<div class="col-md-3">
						<input type="text" id="clientSearch" class="wrap-text wrap-focus" placeholder="Search">
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2 padding-left">
						<a href="#" id="newCustomer" class="wrap-btn-new"><i class="fa fa-plus" aria-hidden="true"></i> New Customer</a>
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
				<div id="clientView">
				
				</div>
			</div>
		</div>
		
		
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
						<textarea name="clientBillAddress"  class="wrap-text wrap-address cinput" required></textarea>
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
  <!-- Edit Client -->
  	<div class="modal fade" id="clientEditModel" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Client</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="clientEditForm" id="clientEditForm">
				<div class="col-md-6">
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Client Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientName" id="clientName" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Contact Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientContactName" id="clientContactName" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Phone / Mobile. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientContact" id="clientContact" class="wrap-text numeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Email : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientEmail" id="clientEmail" class="wrap-text">
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> GSTIN : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientGstin" id="clientGstin" class="wrap-text clientEGstin">
						<div class="errMsg" id="errorEGST">GSTIN Already Exists!</div>
					</div>
				</div>
				
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Customer Type : </label>
					</div>
					<div class="col-md-7">
						<select name="clientType" id="clientType" class="wrap-text" required>
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
						<select name="clientStatus" id="clientStatus" class="wrap-text">
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
						<textarea name="clientBillAddress" id="clientBillAddress" class="wrap-text wrap-address" required>
						</textarea>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> City : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientBillCity" id="clientBillCity" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> State : </label>
					</div>
					<div class="col-md-7">
					<select name="clientBillState" id="clientBillState" class="wrap-text" required>
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
						<input type="text" name="clientBillPin" id="clientBillPin" class="wrap-text numeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Country : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientBillCountry" id="clientBillCountry" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				</div>
				<div class="col-md-6">
				
				
				<div class="row wrap-margin">
					<div class="col-md-12">
						<input type="checkbox" name="clientShipDiff" id="clientShipDiff"> Ship To Different Address
					</div>
					
				</div>
				<div class="clear"></div>
				<div id="shipAdd">
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Address : </label>
					</div>
					<div class="col-md-7">
						<textarea name="clientShipAddress" id="clientShipAddress" class="wrap-text wrap-address" required>
						</textarea>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> City : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientShipCity" id="clientShipCity" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> State : </label>
					</div>
					<div class="col-md-7">
					<select name="clientShipState" id="clintShipState" class="wrap-text" required>
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
						<input type="text" name="clientShipPin" id="clientShipPin" class="wrap-text numeric" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Country : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="clientShipCountry" id="clientShipCountry" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					
					<div class="col-md-7">
						
						<Button type="submit" class="btn btn-primary">Update</Button>
					</div>
				</div>
				<div class="clear"></div>
				<input type="hidden" name="clientId" id="clientId">
				<input type="hidden" name="flag" value="4">
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
  
  <!--Delete Mode-->
	<div class="modal fade" id="deleteModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">This action will permanently delete the Client, and can not be undone.<br>Are You Sure Want to Delete?</h4>
        </div>
        <div class="modal-body">
			<div id="clientShows">
				
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
		$('#newCustomer').click(function()
		{
				$('#customerModel').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('.cinput').val("");
				setTimeout(function() { $('input[id="sclientName"]').focus() }, 500);
				$('.wrap-text').val("");
				$('.show').val("10");
		});
		$(document).ready(function(){
				$('.wrap-focus').focus();
				var activepage = "";
				var flag = 0;
				start();
				getclientdetails();
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
									$('.cinput').val("");
									$('#customerModel').modal('hide');
									getclientdetails();
									$('.wrap-focus').focus();
								}
							}
						});
				});
				
				$(document).on('click','.clientEdit',function(e){
					start();
					e.preventDefault();
					var flag = 3;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.client.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data){
							$('#clientEditModel').modal({
								backdrop: 'static',
								keyboard: false
								});
							$.each(data, function(index, element) 
							{
							$('#clientName').val(element.clientName);
							$('#clientContactName').val(element.clientcontactName);
							$('#clientContact').val(element.clientPhone)
							$('#clientEmail').val(element.clientEmail);
							$('#clientGstin').val(element.clientGSTIN);
							$('#clientType').val(element.clientType);
							$('#clientStatus').val(element.clientStatus);
							$('#clientBillAddress').val(element.clientBillingAdd);
							$('#clientBillCity').val(element.clientBillingCity);
							$('#clientBillState').val(element.clientBillingState);
							$('#clientBillPin').val(element.clientBillingPincode);
							$('#clientBillCountry').val(element.clientBillingCountry);
							$('#clientShipDiff').val(element.clientShipping);
							$('#clientShipAddress').val(element.clientShippingAdd);
							$('#clientShipCity').val(element.clientShippingCity);
							$('#clintShipState').val(element.clientShippingState);
							$('#clientShipPin').val(element.clientShippingPincode);
							$('#clientShipCountry').val(element.clientShippingCountry);
							$('#clientId').val(element.clientId);
								if(element.clientShipping == 0)
								{
									$('#clientShipDiff').prop('checked', false);
									$('#clientShipAddress').val("");
									$('#clientShipCity').val("");
									$('#clientShipState').val("");
									$('#clientShipPin').val("");
									$('#clientShipCountry').val("");
									$('#clientShipAddress').attr('disabled',true);
									$('#clientShipCity').attr('disabled',true);
									$('#clintShipState').attr('disabled',true);
									$('#clientShipPin').attr('disabled',true);
									$('#clientShipCountry').attr('disabled',true);
								}
								else
								{
									$('#clientShipDiff').prop('checked', true);
								}
							});
							end();
						}
					});
				});
				
				$(document).on('click','.clientDelete',function(e){
					e.preventDefault();
					var flag = 8;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.client.php',
						type:'POST',
						data:data,
						success:function(html)
						{
							$('#deleteModel').modal({
							backdrop: 'static',
							keyboard: false
							});
							$('#clientShows').html(html);
							end();
						}
					});
				});
				
				$(document).on('click','.wrapDelete',function(){
					
					var flag = 5;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.client.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								start();
								$('#deleteModel').modal('hide');
								getclientdetails();
							}
							else
							{
								$('#deleteModel').modal('hide');
								swal("You can't do this operation!, Stock Created","","warning");
							}
						}
					});
					
				});
				
				$(document).on('click','.wrapClose',function(){
					$('#deleteModel').modal('hide');
				});
				
				$('#clientEditForm').on('submit',function(e){
					e.preventDefault();
					start();
					$.ajax({
						url:'controller/controller.client.php',
						type:'POST',
						data:new FormData(this),
						processData:false,
						contentType:false,
						success:function(html)
						{
							$('#clientEditModel').modal('hide');
							getclientdetails();
						}
						});
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
				
				$("#clientShipDiff").change(function() {
					if(this.checked) {
						$('#clientShipAddress').attr('disabled',false);
						$('#clientShipAddress').prop('required',true);
						$('#clientShipCity').attr('disabled',false);
						$('#clientShipCity').prop('required',true);
						$('#clintShipState').attr('disabled',false);
						$('#clientShipState').prop('required',true);
						$('#clientShipPin').attr('disabled',false);
						$('#clientShipPin').prop('required',true);
						$('#clientShipCountry').attr('disabled',false);
						$('#clientShipCountry').prop('required',true);
					}
					else
					{
						$('#clientShipAddress').val("");
						$('#clientShipCity').val("");
						$('#clintShipState').val("");
						$('#clientShipPin').val("");
						$('#clientShipCountry').val("");
						$('#clientShipAddress').attr('disabled',true);
						$('#clientShipCity').attr('disabled',true);
						$('#clintShipState').attr('disabled',true);
						$('#clientShipPin').attr('disabled',true);
						$('#clientShipCountry').attr('disabled',true);
					}
				});
				
				
				
				$(document).on('blur','.clientGstin',function(){
					var gst = $(this).val();
					var flag = 6;
					var data = {gst:gst,flag:flag};
					$.ajax({
						url:'controller/controller.client.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorGST').fadeIn();
								$('.clientGstin').val("");
								$('.clientGstin').focus();
							}
							else
							{
								$('#errorGST').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.clientEGstin',function(){
					var gst = $(this).val();
					var flag = 6;
					var id= $('#clientId').val();
					var data = {gst:gst,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.client.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEGST').fadeIn();
								$('.clientEGstin').val("");
								$('.clientEGstin').focus();
							}
							else
							{
								$('#errorEGST').fadeOut();
							}
						}
					});
				});
				
				$(document).on('click','#pdfExport',function(){
					flag = 7;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.client.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportpdf.php?flag=client&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','#xlExport',function(){
					flag = 7;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.client.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportxl.php?flag=client&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','.spage',function(){
					start();
					activepage = this.id;
					getclientdetails();
				});
				
				$('#clientSearch').on('keyup',function(){
					start();
					getclientdetails();
				});
				
				$(document).on('change','.show',function(){
					start();
					activepage = 1;
					getclientdetails();
				});
				
				
				
				function getclientdetails(){
					flag = 2;
					var show = $('.show').val();
					var search = $('#clientSearch').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show};
					$.ajax({
						url:'controller/controller.client.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#clientView').html(html);
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