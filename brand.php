<?php
	session_start();
	if(!isset($_SESSION['user']))
	{
		header('location:index.php');
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
		<link href="css/alert/sweetalert.css" rel="stylesheet" type="text/css"/>
		<link href="css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<div class="wrap-container">
			<div class="wrap-heading">
				<h1>Manage Brand</h1>
			</div>
			<div class="wrap-content">
				<div class="row">
					<div class="col-md-3">
						<input type="text" id="brandSearch" class="wrap-text wrap-focus" placeholder="Search">
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2 padding-left">
						<a href="#" id="newBrand" class="wrap-btn-new"><i class="fa fa-plus" aria-hidden="true"></i> New Brand</a>
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
							<option value="50">50</option>
							<option value="">All</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>
				<div id="brandView">
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
						<input type="text" name="brandName" id="sbrandName" class="wrap-text brandName cinput" required>
						<div class="errMsg" id="errorName">Brand Name Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Short Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="brandShort" class="wrap-text brandShort cinput" required>
						<div class="errMsg" id="errorShortName">Brand Short Name Already Exists!</div>
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
						<input type="text" name="brandName" id="brandName" class="wrap-text brandEName" required>
						<div class="errMsg" id="errorEName">Brand Name Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Brand Short : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="brandShort" id="brandShort" class="wrap-text brandEShort" required>
						<div class="errMsg" id="errorEShortName">Brand Short Name Already Exists!</div>
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
  
  <!--Delete Mode-->
	<div class="modal fade" id="deleteModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">This action will permanently delete the Brand, and can not be undone.<br>Are You Sure Want to Delete?</h4>
        </div>
        <div class="modal-body">
			<div id="brandShows">
				
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
		<script type="text/javascript">
		$('#newBrand').click(function(){
				$('#brandModel').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('.cinput').val("");
				setTimeout(function() { $('input[id="sbrandName"]').focus() }, 500);
			});
		$(document).ready(function(){
			$('.wrap-focus').focus();
			var activepage = "";
				var flag = 0;
				start();
				getbranddetails();
				
				$('#brandForm').on('submit',function(e){
						e.preventDefault();
						start();
						$.ajax({
							url:'controller/controller.brand.php',
							type:'POST',
							data:new FormData(this),
							processData:false,
							contentType:false,
							success:function(html){
								if(html == 1)
								{
									$('.cinput').val("");
									getbranddetails();
									$('#brandModel').modal('hide');
									$('.wrap-focus').focus();
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
				
				$(document).on('click','.brandDelete',function(e){
					e.preventDefault();
					var flag = 9;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						success:function(html)
						{
							
							$('#deleteModel').modal({
							backdrop: 'static',
							keyboard: false
							});
							$('#brandShows').html(html);
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
				
				$(document).on('click','.wrapClose',function(){
					$('#deleteModel').modal('hide');
				});
				
				$('#brandEditForm').on('submit',function(e){
					e.preventDefault();
					start();
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
				
				$(document).on('blur','.brandName',function(){
					var bname = $(this).val();
					var flag = 6;
					var data = {bname:bname,flag:flag};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorName').fadeIn();
								$('.brandName').val("");
								$('.brandName').focus();
							}
							else
							{
								$('#errorName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.brandEName',function(){
					var bname = $(this).val();
					var flag = 6;
					var id= $('#brandId').val();
					var data = {bname:bname,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEName').fadeIn();
								$('.brandEName').val("");
								$('.brandEName').focus();
							}
							else
							{
								$('#errorEName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.brandShort',function(){
					var bname = $(this).val();
					var flag = 7;
					var data = {bname:bname,flag:flag};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorShortName').fadeIn();
								$('.brandShort').val("");
								$('.brandShort').focus();
							}
							else
							{
								$('#errorShortName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.brandEShort',function(){
					var bname = $(this).val();
					var flag = 7;
					var id= $('#brandId').val();
					var data = {bname:bname,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEShortName').fadeIn();
								$('.brandEShort').val("");
								$('.brandEShort').focus();
							}
							else
							{
								$('#errorEShortName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('click','#pdfExport',function(){
					flag = 8;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportpdf.php?flag=brand&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','#xlExport',function(){
					flag = 8;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportxl.php?flag=brand&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','.spage',function(){
					start();
					activepage = this.id;
					getbranddetails();
				});
				
				$('#brandSearch').on('keyup',function(){
					start();
					getbranddetails();
				});
				
				$(document).on('change','.show',function(){
					start();
					activepage = 1;
					getbranddetails();
				});
				
				function getbranddetails(){
					flag = 2;
					var show = $('.show').val();
					var search = $('#brandSearch').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show};
					$.ajax({
						url:'controller/controller.brand.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#brandView').html(html);
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