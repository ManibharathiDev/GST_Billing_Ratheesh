<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header('location:index.php');
	}
	$tempname = $_SESSION['tempname'];
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
		<link href="css/alert/sweetalert.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<div class="wrap-container">
			<div class="wrap-heading">
				<h1>Manage Bill</h1>
			</div>
			<div class="wrap-content">
				<div class="row">
					<div class="col-md-3">
						<input type="text" id="billSearch" class="wrap-text wrap-focus" placeholder="Search">
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2 padding-left">
						<a href="neworder.php" id="newOrder" class="wrap-btn-new"><i class="fa fa-plus" aria-hidden="true"></i> New Order</a>
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
				<div id="billView">
				</div>
			</div>
		</div>
		<div class="modal fade" id="brandModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Brand</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="brandForm" id="brandForm">
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Brand Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="brandName" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Short Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="brandShort" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Description : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="brandDescription" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Status : </label>
					</div>
					<div class="col-md-7">
						<select name="brandStatus" class="wrap-text cinput" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					<input type="hidden" value="1" name="flag">
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						
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
  
  <!-- Edit Category -->
  	<div class="modal fade" id="brandEditModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Brand</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="brandEditForm" id="brandEditForm">
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Brand Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="brandName" id="brandName" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Brand Short : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="brandShort" id="brandShort" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Description : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="brandDescription" id="brandDescription" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Status : </label>
					</div>
					<div class="col-md-7">
						<select name="brandStatus" id="brandStatus" class="wrap-text" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					<input type="hidden" name="brandId" id="brandId">
					<input type="hidden" value="4" name="flag">
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						
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
  
  <!-- The Modal -->
<div id="myModal" class="printModal">

  	
  <!-- Modal content -->
  <div class="print-modal-content">
	<div class="print-left-content">
		<!--<Button class="btn btn-danger close">Close</Button>-->
		<div class="printContent">
			<a class="wrap-btn-new printtext" id="viewPrintBill"><i class="fa fa-print" aria-hidden="true"></i> Print</a>		
			<div class="clear"></div>
			<a class="wrap-btn-new printtext" id="editPrintBill"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Bill</a>
			<div class="clear"></div>
			<a class="wrap-btn-new printtext" id="closePrintBill"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Close</a>
		</div>
	</div>
	<div class="print-right-content">
    <!--<span class="close">&times;</span>-->
    <iframe id="myPrint" width="100%" height="800"></iframe>
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
          <h4 class="modal-title">This action will permanently delete the Bill, and can not be undone.<br>Are You Sure Want to Delete?</h4>
        </div>
        <div class="modal-body">
			<div id="billShows">
				
			<div>
        </div>
       
      </div>
    </div>
  </div>
  </div>
  </div>
  
  <!--Payment Mode-->
	<div class="modal fade" id="paymentModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Make Payment</h4>
        </div>
        <div class="modal-body">
			<div id="paymentShows">
				
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
		$('#newBrand').click(function(){
				$('#brandModel').modal({
					backdrop: 'static',
					keyboard: false
				});
			});
		$(document).ready(function(){
			var billid = "";
			start();
				var activepage = "";
				$('.wrap-focus').focus();
				var flag = 0;
				getbilldetails();
				
				$('#brandForm').on('submit',function(e){
						e.preventDefault();
						$.ajax({
							url:'controller/controller.brand.php',
							type:'POST',
							data:new FormData(this),
							processData:false,
							contentType:false,
							success:function(html){
								if(html == 1)
								{
									$('#cinput').val("");
									getbranddetails();
									$('#brandModel').modal('hide');
									alert("Brand Added");
								}
							}
						});
				});
				
				
				$(document).on('click','.brandEdit',function(e){
					e.preventDefault();
					var flag = 3;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data){
							$('#brandEditModel').modal({
								backdrop: 'static',
								keyboard: false
								});
							$.each(data, function(index, element) 
							{
							$('#brandId').val(element.brandId);
							$('#brandName').val(element.brandName);
							$('#brandShort').val(element.brandShort)
							$('#brandDescription').val(element.brandDescription);
							$('#brandStatus').val(element.brandStatus);
							});
						}
					});
				});
				
				$(document).on('click','.billDelete',function(e){
					e.preventDefault();
					var flag = 11;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html)
						{
							$('#deleteModel').modal({
							backdrop: 'static',
							keyboard: false
							});
							$('#billShows').html(html);
							end();
						}
					});
					
				});
				
				$(document).on('click','.wrapDelete',function(){
					var id = this.id;
					var flag = 5;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								start();
								$('#deleteModel').modal('hide');
								getbranddetails();
							}
							else
							{
								$('#deleteModel').modal('hide');
								swal("You can't do this operation!, Stock Created","","warning");
							}
						}
					})
				});
				
				$('#brandEditForm').on('submit',function(e){
					e.preventDefault();
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:new FormData(this),
						processData:false,
						contentType:false,
						success:function(html){
							$('#brandEditModel').modal('hide');
							getbranddetails();
						}
						});
				});
				
				$(document).on('click','.billEdit',function(){
					var billid = this.id;
					if(billid == 0){
						swal("You can't do this operation","","warning");
						return false;
					}
					billid = billid.split('-');
					var id = billid[0];
					var clientid = billid[1];
					location.href="neworder.php?billid="+id+"&clientid="+clientid;
				});	
				
				$(document).on('click','.billPay',function(){
					var id = this.id;
					if(id == 0){
						swal("Full Amount Paid","","warning");
						return false;
					}
					var flag = 11;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#paymentModel').modal({
							backdrop: 'static',
							keyboard: false
							});	
							$('#paymentShows').html(html);
						}
					});
				});
				
				$(document).on('keyup','#amountPayable',function(){
					var topay = parseFloat($(this).val());
					var oldpay = parseFloat($('#payBalance').val());
					if(topay > oldpay){
						$(this).val(oldpay);
					}
					else if(topay == 0){
						$(this).val("");
					}
				});
				
				$(document).on('submit','#paymentForm',function(e){
					e.preventDefault();
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data : new FormData(this),
						processData:false,
						contentType:false,
						success:function(html){
							if(html == 1)
							{
								
								start();
								$('#paymentModel').modal('hide');	
								getbilldetails();
							}
						}
					});
				});

				$(document).on('click','#pdfExport',function(){
					flag = 9;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportpdf.php?flag=order&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','#xlExport',function(){
					flag = 9;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportxl.php?flag=order&query="+html,"_blank");
						}
					});
				});				

				$(document).on('click','.spage',function(){
					start();
					activepage = this.id;
					getbilldetails();
				});		
				
				$(document).on('keyup','#billSearch',function(){
					start();
					getbilldetails();
				});
				
				$(document).on('change','.show',function(){
					start();
					activepage = 1;
					getbilldetails();
				});
				function getbilldetails()
				{
					flag = 6;
					var search = $('#billSearch').val();
					var show = $('.show').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#billView').html(html);
						}
					});
					end();
				}
				
				$(document).on('click','.billView',function()
				{
					var tempname = "";
					billid = this.id;
					var flag = 14;
					var data = {flag:flag};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						success:function(html){
							tempname = html;
							$('#myModal').fadeIn();
							var billfile = 'view'+tempname+'.php';
							$('#myPrint').attr('src',billfile+'?billid='+billid);
						}
					});
					
					
					
				});
				
				$(document).on('click','#editPrintBill',function(){
					var clientid="";
					var data = {billid:billid,flag:10};
					$.ajax({
						url:'controller/controller.order.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data)
						{
							$.each(data, function(index, element) 
							{
							clientid = element.billCusId;
							});
							
							location.href="neworder.php?billid="+billid+"&clientid="+clientid;
						}
					});
				});
				$(document).on('click','#viewPrintBill',function(){
					$('#myPrint').get(0).contentWindow.print();
				});
				
				$(document).on('click','#closePrintBill',function(){
					$('#myModal').fadeOut();
				});
				
			});	
		</script>
		<?php
			include('headerright.php');
		?>
	</body>
</html>