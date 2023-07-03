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
				<h1>Manage Suppliers</h1>
			</div>
			<div class="wrap-content">
				<div class="row">
					<div class="col-md-3">
						<input type="text" id="supSearch" class="wrap-text wrap-focus" placeholder="Search">
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2 padding-left">
						<a href="#" id="newSupplier" class="wrap-btn-new"><i class="fa fa-plus" aria-hidden="true"></i> New Supplier</a>
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
				<div id="supView">
				
				</div>
			</div>
		</div>
		
		
		<div class="modal fade" id="supplierModel" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Supplier</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="supplierForm" id="supplierForm">
				<div class="col-md-6">
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Supplier Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supname" id="supname" class="wrap-text cinput" required>
						<div class="errMsg" id="errorName">Supplier Name Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Contact Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supcontname" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Phone / Mobile. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supphone" class="wrap-text cinput numeric supPhone" required>
						<div class="errMsg" id="errorPhone">Mobile Number Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Email : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supemail" class="wrap-text cinput supEmail">
						<div class="errMsg" id="errorEmail">Mobile Number Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> GSTIN : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supgstin" class="wrap-text cinput supGstin" maxlength="15">
						<div class="errMsg" id="errorGST">GSTIN Already Exists!</div>
					</div>
				</div>
				
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> PAN : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="suppan" class="wrap-text cinput supPan" maxlength="15">
						<div class="errMsg" id="errorPAN">PAN Already Exists!</div>
					</div>
				</div>
				
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Aadhar No. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supaadhar" class="wrap-text cinput supAadhar" maxlength="15">
						<div class="errMsg" id="errorAAD">Aadhar Already Exists!</div>
					</div>
				</div>
				
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label>Status : </label>
					</div>
					<div class="col-md-7">
						<select name="supstatus" class="wrap-text cinput" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
				</div>
				</div>
				<div class="col-md-6">
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Address : </label>
					</div>
					<div class="col-md-7">
						<textarea name="supadd" class="wrap-text cinput" required></textarea>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> City : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supcity" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> State : </label>
					</div>
					<div class="col-md-7">
						<select name="supstate" class="wrap-text cinput" required>
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
						<input type="text" name="suppin" class="wrap-text cinput numeric" maxlength="6" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Country : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supcountry" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					
					<div class="col-md-7">
						<input type="hidden" name="flag" value="1">
						<Button type="submit" class="btn btn-primary">Submit</Button>
					</div>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					
				</div>
				</div>
				</form>
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- Edit Client -->
  	<div class="modal fade" id="supplierEditModel" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Supplier</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="supplierEditForm" id="supplierEditForm">
				<div class="col-md-6">
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Supplier Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supname" id="supename" class="wrap-text cinput" required>
						<div class="errMsg" id="errorEName">Supplier Name Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Contact Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supcontname" id="supecontname" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Phone / Mobile. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supphone" id="supephone" class="wrap-text cinput numeric supEPhone" required>
						<div class="errMsg" id="errorEPhone">Mobile Number Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Email : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supemail" id="supeemail" class="wrap-text supEEmail cinput">
						<div class="errMsg" id="errorEEmail">Mobile Number Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> GSTIN : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supgstin" id="supegstin" class="wrap-text cinput supEGstin" maxlength="15">
						<div class="errMsg" id="errorEGST">GSTIN Already Exists!</div>
					</div>
				</div>
				
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> PAN : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="suppan" id="supepan" class="wrap-text cinput supEPan" maxlength="15">
						<div class="errMsg" id="errorEPAN">PAN Already Exists!</div>
					</div>
				</div>
				
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Aadhar No. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supaadhar" id="supeaadhar" class="wrap-text cinput supEAadhar" maxlength="15">
						<div class="errMsg" id="errorEAAD">Aadhar Already Exists!</div>
					</div>
				</div>
				
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label>Status : </label>
					</div>
					<div class="col-md-7">
						<select name="supstatus" id="supestatus" class="wrap-text cinput" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
				</div>
				</div>
				<div class="col-md-6">
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Address : </label>
					</div>
					<div class="col-md-7">
						<textarea name="supadd" id="supeadd" class="wrap-text cinput" required></textarea>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> City : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supcity" id="supecity" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> State : </label>
					</div>
					<div class="col-md-7">
						<select name="supstate" id="supestate" class="wrap-text cinput" required>
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
						<input type="text" name="suppin" id="supepin" class="wrap-text cinput numeric" maxlength="6" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-5">
						<label> Country : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="supcountry" id="supecountry" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					
					<div class="col-md-7">
						<input type="hidden" name="supId" id="supId">
						<input type="hidden" name="flag" value="4">
						<Button type="submit" class="btn btn-primary">Update</Button>
					</div>
				</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					
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
          <h4 class="modal-title">This action will permanently delete the Supplier, and can not be undone.<br>Are You Sure Want to Delete?</h4>
        </div>
        <div class="modal-body">
			<div id="supShows">
				
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
		$('#newSupplier').click(function()
		{
				$('#supplierModel').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('.cinput').val("");
				setTimeout(function() { $('input[id="supname"]').focus() }, 500);
				$('.wrap-text').val("");
				$('.show').val("10");
		});
		$(document).ready(function(){
				$('.wrap-focus').focus();
				var activepage = "";
				var flag = 0;
				start();
				getsupdetails();
				$('#supplierForm').on('submit',function(e){
						e.preventDefault();
						start();
						$.ajax({
							url:'controller/controller.supplier.php',
							type:'POST',
							data:new FormData(this),
							processData:false,
							contentType:false,
							success:function(html){
								if(html == 1)
								{
									$('.cinput').val("");
									$('#supplierModel').modal('hide');
									getsupdetails();
									$('.wrap-focus').focus();
								}
							}
						});
				});
				
				$(document).on('click','.supEdit',function(e){
					start();
					e.preventDefault();
					var flag = 3;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data){
							$('#supplierEditModel').modal({
								backdrop: 'static',
								keyboard: false
								});
							$.each(data, function(index, element) 
							{
							$('#supename').val(element.supplierName);
							$('#supecontname').val(element.supplierContactName);
							$('#supephone').val(element.supplierPhone)
							$('#supeemail').val(element.supplierEmail);
							$('#supegstin').val(element.supplierGSTIN);
							$('#supepan').val(element.supplierPAN);
							$('#supeaadhar').val(element.supplierAadhar);
							$('#supeadd').val(element.supplierAdd);
							$('#supestate').val(element.supplierState);
							$('#supecity').val(element.supplierCity);
							$('#supepin').val(element.supplierPin);
							$('#supecountry').val(element.supplierCountry);
							$('#supestatus').val(element.supplierStatus);
							$('#supId').val(element.supplierId);
								
							});
							end();
						}
					});
				});
				
				$(document).on('click','.supDelete',function(e){
					e.preventDefault();
					var flag = 8;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html)
						{
							$('#deleteModel').modal({
							backdrop: 'static',
							keyboard: false
							});
							$('#supShows').html(html);
							end();
						}
					});
				});
				
				$(document).on('click','.wrapDelete',function(){
					
					var flag = 5;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								start();
								$('#deleteModel').modal('hide');
								getsupdetails();
							}
							else
							{
								$('#deleteModel').modal('hide');
								swal("You can't do this operation!, Supplier Assigned","","warning");
							}
						}
					});
					
				});
				
				$(document).on('click','.wrapClose',function(){
					$('#deleteModel').modal('hide');
				});
				
				$('#supplierEditForm').on('submit',function(e){
					e.preventDefault();
					start();
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:new FormData(this),
						processData:false,
						contentType:false,
						success:function(html)
						{
							$('#supplierEditModel').modal('hide');
							getsupdetails();
						}
						});
				});
				
				
				$(document).on('blur','#supname',function(){
					var name = $(this).val();
					var flag = 11;
					var data = {name:name,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorName').fadeIn();
								$('#supname').val("");
								$('#supname').focus();
							}
							else
							{
								$('#errorName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','#supEname',function(){
					var name = $(this).val();
					var flag = 11;
					var data = {name:name,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEName').fadeIn();
								$('#supEname').val("");
								$('#supEname').focus();
							}
							else
							{
								$('#errorEName').fadeOut();
							}
						}
					});
				});
				
				
				$(document).on('blur','.supPhone',function(){
					var phone = $(this).val();
					var flag = 12;
					var data = {phone:phone,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorPhone').fadeIn();
								$('.supPhone').val("");
								$('.supPhone').focus();
							}
							else
							{
								$('#errorPhone').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.supEPhone',function(){
					var phone = $(this).val();
					var flag = 12;
					var data = {phone:phone,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEPhone').fadeIn();
								$('.supEPhone').val("");
								$('.supEPhone').focus();
							}
							else
							{
								$('#errorEPhone').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.supEmail',function(){
					var email = $(this).val();
					var flag = 13;
					var data = {email:email,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEmail').fadeIn();
								$('.supEmail').val("");
								$('.supEmail').focus();
							}
							else
							{
								$('#errorEmail').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.supEEmail',function(){
					var email = $(this).val();
					var flag = 13;
					var data = {email:email,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEEmail').fadeIn();
								$('.supEEmail').val("");
								$('.supEEmail').focus();
							}
							else
							{
								$('#errorEEmail').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.supGstin',function(){
					var gst = $(this).val();
					var flag = 6;
					var data = {gst:gst,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorGST').fadeIn();
								$('.supGstin').val("");
								$('.supGstin').focus();
							}
							else
							{
								$('#errorGST').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.supEGstin',function(){
					var gst = $(this).val();
					var flag = 6;
					var id= $('#supId').val();
					var data = {gst:gst,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEGST').fadeIn();
								$('.supEGstin').val("");
								$('.supEGstin').focus();
							}
							else
							{
								$('#errorEGST').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.supPan',function(){
					var pan = $(this).val();
					var flag = 9;
					var data = {pan:pan,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorPAN').fadeIn();
								$('.supPan').val("");
								$('.supPan').focus();
							}
							else
							{
								$('#errorPAN').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.supEPan',function(){
					var pan = $(this).val();
					var flag = 9;
					var id= $('#supId').val();
					var data = {pan:pan,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEPAN').fadeIn();
								$('.supEPan').val("");
								$('.supEPan').focus();
							}
							else
							{
								$('#errorEPAN').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.supAadhar',function(){
					var aad = $(this).val();
					var flag = 10;
					var data = {aad:aad,flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorAAD').fadeIn();
								$('.supAadhar').val("");
								$('.supAadhar').focus();
							}
							else
							{
								$('#errorAAD').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.supEAadhar',function(){
					var aad = $(this).val();
					var flag = 10;
					var id= $('#supId').val();
					var data = {aad:aad,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEAAD').fadeIn();
								$('.supEAadhar').val("");
								$('.supEAadhar').focus();
							}
							else
							{
								$('#errorEAAD').fadeOut();
							}
						}
					});
				});
				
				
				
				
				$(document).on('click','#pdfExport',function(){
					flag = 7;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportpdf.php?flag=supplier&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','#xlExport',function(){
					flag = 7;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportxl.php?flag=supplier&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','.spage',function(){
					start();
					activepage = this.id;
					getsupdetails();
				});
				
				$('#supSearch').on('keyup',function(){
					start();
					getsupdetails();
				});
				
				$(document).on('change','.show',function(){
					start();
					activepage = 1;
					getsupdetails();
				});
				
				
				
				function getsupdetails(){
					flag = 2;
					var show = $('.show').val();
					var search = $('#supSearch').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show};
					$.ajax({
						url:'controller/controller.supplier.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#supView').html(html);
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