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
				<h1>Manage Tax</h1>
			</div>
			<div class="wrap-content">
				<div class="row">
					<div class="col-md-3">
						<input type="text" id="taxSearch" class="wrap-text wrap-focus" placeholder="Search">
					</div>
					<div class="col-md-6">
					</div>
					<div class="col-md-1 padding-left">
						<a href="#" id="newTax" class="wrap-btn-new"><i class="fa fa-plus" aria-hidden="true"></i> New Tax</a>
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
				<div id="taxView">
				
				</div>
			</div>
		</div>
		
	<div class="modal fade" id="taxModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Tax</h4>
        </div>
        <div class="modal-body">
			<div id="taxShow">
			<form id="taxForm">
				<div class="row">
					<div class="col-md-3">
						<label class="wrap-float-right">Tax Name : <label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text cinput taxName" id="staxName" name="taxName" required>
						<div class="errMsg" id="errorName">Tax Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-3">
						<label class="wrap-float-right">Tax Rate (%) : <label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text cinput numeric" name="taxRate" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-3">
						<label class="wrap-float-right">Description : <label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text cinput" name="taxDescription" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-3">
						<label class="wrap-float-right">Status : <label>
					</div>
					<div class="col-md-5">
						<select name="taxStatus" class="wrap-text cinput" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					<input type="hidden" value="1" name="flag">
				</div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-5">
						<Button type="submit" class="btn btn-primary">Submit</Button>
					</div>
				</div>
				</form>
				<div class="clear"></div>
			<div>
        </div>
        
      </div>
    </div>
  </div>
  </div>
  </div>
  
  <!-- Edit Content -->
  <div class="modal fade" id="taxEditModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Tax</h4>
        </div>
        <div class="modal-body">
			<div id="taxEditShow">
			<form id="taxEditForm">
				<div class="row">
					<div class="col-md-3">
						<label class="wrap-float-right">Tax Name : <label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text taxEName" id="taxName" name="taxName" required>
						<div class="errMsg" id="errorEName">Category Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-3">
						<label class="wrap-float-right">Tax Rate (%) : <label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text numeric" id="taxRate" name="taxRate" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-3">
						<label class="wrap-float-right">Description : <label>
					</div>
					<div class="col-md-5">
						<input type="text" class="wrap-text" id="taxDescription" name="taxDescription" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-3">
						<label class="wrap-float-right">Status : <label>
					</div>
					<div class="col-md-5">
						<select name="taxStatus" id="taxStatus" class="wrap-text" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					<input type="hidden" name="taxId" id="taxId">
					<input type="hidden" value="4" name="flag">
				</div>
				<div class="clear"></div>
				<div class="row">
					<div class="col-md-3">
						
					</div>
					<div class="col-md-5">
						<Button type="submit" class="btn btn-primary">Update</Button>
					</div>
				</div>
				</form>
				<div class="clear"></div>
			<div>
        </div>
        
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
          <h4 class="modal-title">This action will permanently delete the Tax, and can not be undone.<br>Are You Sure Want to Delete?</h4>
        </div>
        <div class="modal-body">
			<div id="taxShows">
				
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
		<?php
			include('headerright.php');
		?>
		<script type="text/javascript">
			$('#newTax').click(function(){
				$('#taxModel').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('.cinput').val("");
				setTimeout(function() { $('input[id="staxName"]').focus() }, 500);
			});
			
			$(document).ready(function(){
				$('.wrap-focus').focus();
				var activepage = "";
				var flag = 0;
				start();
				gettaxdetails();
				
				$('#taxForm').on('submit',function(e){
						e.preventDefault();
						start();
						$.ajax({
							url:'controller/controller.tax.php',
							type:'POST',
							data:new FormData(this),
							processData:false,
							contentType:false,
							success:function(html){
								if(html == 1)
								{
									gettaxdetails();
									$('#taxModel').modal('hide');
									$('.cinput').val("");
								}
							}
						});
				});
				
				
				$(document).on('click','.taxEdit',function(){
					var flag = 3;
					start();
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.tax.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data){
							$('#taxEditModel').modal({
								backdrop: 'static',
								keyboard: false
								});
							$.each(data, function(index, element) 
							{
							$('#taxId').val(element.taxId);
							$('#taxName').val(element.taxName);
							$('#taxRate').val(element.taxPercentage)
							$('#taxDescription').val(element.taxDescription);
							$('#taxStatus').val(element.taxStatus);
							});
							end();
						}
					});
					
					
				});
				
				$(document).on('click','.taxDelete',function(e){
					e.preventDefault();
					start();
					var flag = 9;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.tax.php',
						type:'POST',
						data:data,
						success:function(html)
						{
							$('#deleteModel').modal({
							backdrop: 'static',
							keyboard: false
							});
							$('#taxShows').html(html);
							end();
						}
					});
				});
				
				$(document).on('click','.wrapDelete',function(e){
					e.preventDefault();
					var flag = 5;
					var id = this.id;
					var data = {id:id,flag:flag};
					start();
					$.ajax({
						url:'controller/controller.tax.php',
						type:'POST',
						data:data,
						success:function(html){
							
							if(html == 1)
							{
								start();
								$('#deleteModel').modal('hide');
								gettaxdetails();
							}
							else
							{
								$('#deleteModel').modal('hide');
								swal("You can't do this operation!, Tax Assigned","","warning");
							}
						}
					});
				});
				
				$(document).on('click','.wrapClose',function(){
					$('#deleteModel').modal('hide');
				});
				
				$('#taxEditForm').on('submit',function(e){
					e.preventDefault();
					start();
					$.ajax({
						url:'controller/controller.tax.php',
						type:'POST',
						data:new FormData(this),
						processData:false,
						contentType:false,
						success:function(html){
							$('#taxEditModel').modal('hide');
							gettaxdetails();
						}
						});
				});
				
				$(document).on('blur','.taxName',function(){
					var tname = $(this).val();
					var flag = 6;
					var data = {tname:tname,flag:flag};
					$.ajax({
						url:'controller/controller.tax.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorName').fadeIn();
								$('.taxName').val("");
								$('.taxName').focus();
							}
							else
							{
								$('#errorName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.taxEName',function(){
					var tname = $(this).val();
					var flag = 6;
					var id= $('#taxId').val();
					var data = {tname:tname,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.tax.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEName').fadeIn();
								$('.taxEName').val("");
								$('.taxEName').focus();
							}
							else
							{
								$('#errorEName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('click','#pdfExport',function(){
					flag = 8;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.tax.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportpdf.php?flag=tax&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','#xlExport',function(){
					flag = 8;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.tax.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportxl.php?flag=tax&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','.spage',function(){
					start();
					activepage = this.id;
					gettaxdetails();
				});
				
				$('#taxSearch').on('keyup',function(){
					start();
					gettaxdetails();
				});
				
				$(document).on('change','.show',function(){
					start();
					activepage = 1;
					gettaxdetails();
				});
				
				
				function gettaxdetails(){
					flag = 2;
					var show = $('.show').val();
					var search = $('#taxSearch').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show};
					$.ajax({
						url:'controller/controller.tax.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#taxView').html(html);
							end();
						}
					});
				}
			});
		</script>
	</body>
</html>