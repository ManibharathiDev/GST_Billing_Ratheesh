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
				<h1>Manage Category</h1>
			</div>
			<div class="wrap-content">
				<div class="row">
					<div class="col-md-3">
						<input type="text" id="catSearch" class="wrap-text wrap-focus" placeholder="Search">
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2 padding-left">
						<a href="#" id="newCategory" class="wrap-btn-new"><i class="fa fa-plus" aria-hidden="true"></i> New Category</a>
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
				<div id="catView">
				</div>
			</div>
		</div>
		<?php
			include('footer.php');
		?>
	<div class="modal fade" id="catModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Category</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="catForm" id="catForm">
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Category Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="catName" id="scatName" class="wrap-text cinput catName" required>
						<div class="errMsg" id="errorName">Category Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Category Short : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="catShort" class="wrap-text cinput catShort" required>
						<div class="errMsg" id="errorShortName">Category Short Name Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Description : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="catDescription" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Status : </label>
					</div>
					<div class="col-md-7">
						<select name="catStatus" class="wrap-text cinput" required>
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
  	<div class="modal fade" id="catEditModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Category</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="catEditForm" id="catEditForm">
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Category Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="catName" id="catName" class="wrap-text catEName" required>
						<div class="errMsg" id="errorEName">Category Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Category Short : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="catShort" id="catShort" class="wrap-text catEShort" required>
						<div class="errMsg" id="errorEShortName">Category Short Name Already Exists!</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Description : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="catDescription" id="catDescription" class="wrap-text" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-3">
						<label>Status : </label>
					</div>
					<div class="col-md-7">
						<select name="catStatus" id="catStatus" class="wrap-text" required>
							<option value="">Select Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					<input type="hidden" name="catId" id="catId">
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
          <h4 class="modal-title">This action will permanently delete the Category, and can not be undone.<br>Are You Sure Want to Delete?</h4>
        </div>
        <div class="modal-body">
			<div id="catShows">
				
			<div>
        </div>
       
      </div>
    </div>
  </div>
  </div>
  </div>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/alert/sweetalert.min.js" type="text/javascript"></script>
		<script src="js/alert.js" type="text/javascript"></script>
		<script type="text/javascript">
		$('#newCategory').click(function(){
				$('#catModel').modal({
					backdrop: 'static',
					keyboard: false
				});
				$('.cinput').val("");
				setTimeout(function() { $('input[id="scatName"]').focus() }, 500);
			});
			
			$(document).ready(function(){
			
				$('.wrap-focus').focus();
				var activepage= "";
				var flag = 0;
				start();
				getcatdetails();
				
				$('#catForm').on('submit',function(e){
						e.preventDefault();
						start();
						$.ajax({
							url:'controller/controller.category.php',
							type:'POST',
							data:new FormData(this),
							processData:false,
							contentType:false,
							success:function(html){
								if(html == 1)
								{
									getcatdetails();
									$('.cinput').val("");
									$('#catModel').modal('hide');
									$('.wrap-focus').focus();
								}
							}
						});
				});
				
				
				$(document).on('click','.catEdit',function(e){
					e.preventDefault();
					start();
					var flag = 3;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data){
							$('#catEditModel').modal({
								backdrop: 'static',
								keyboard: false
								});
							$.each(data, function(index, element) 
							{
							$('#catId').val(element.catId);
							$('#catName').val(element.catName);
							$('#catShort').val(element.catShort)
							$('#catDescription').val(element.catDescription);
							$('#catStatus').val(element.catStatus);
							});
							end();
						}
					});
				});
				
				$(document).on('click','.catDelete',function(e){
					e.preventDefault();
					var flag = 9;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						success:function(html)
						{
							
							$('#deleteModel').modal({
							backdrop: 'static',
							keyboard: false
							});
							$('#catShows').html(html);
							end();
						}
					});
					
				});
				
				$(document).on('click','.wrapDelete',function(){
					
					var flag = 5;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								start();
								$('#deleteModel').modal('hide');
								getcatdetails();
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
				
				$('#catEditForm').on('submit',function(e){
					e.preventDefault();
					start();
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:new FormData(this),
						processData:false,
						contentType:false,
						success:function(html){
							$('#catEditModel').modal('hide');
							getcatdetails();
						}
						});
				});
				
				$(document).on('blur','.catName',function(){
					var cname = $(this).val();
					var flag = 6;
					var data = {cname:cname,flag:flag};
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorName').fadeIn();
								$('.catName').val("");
								$('.catName').focus();
							}
							else
							{
								$('#errorName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.catEName',function(){
					var cname = $(this).val();
					var flag = 6;
					var id= $('#catId').val();
					var data = {cname:cname,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEName').fadeIn();
								$('.catEName').val("");
								$('.catEName').focus();
							}
							else
							{
								$('#errorEName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.catShort',function(){
					var cname = $(this).val();
					var flag = 7;
					var data = {cname:cname,flag:flag};
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorShortName').fadeIn();
								$('.catShort').val("");
								$('.catShort').focus();
							}
							else
							{
								$('#errorShortName').fadeOut();
							}
						}
					});
				});
				
				$(document).on('blur','.catEShort',function(){
					var cname = $(this).val();
					var flag = 7;
					var id= $('#catId').val();
					var data = {cname:cname,flag:flag,id:id};
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								$('#errorEShortName').fadeIn();
								$('.catEShort').val("");
								$('.catEShort').focus();
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
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportpdf.php?flag=cat&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','#xlExport',function(){
					flag = 8;
					var data ={flag:flag};
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportxl.php?flag=cat&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','.spage',function(){
					start();
					activepage = this.id;
					getcatdetails();
				});
				
				$('#catSearch').on('keyup',function(){
					start();
					getcatdetails();
				});
				
				$(document).on('change','.show',function(){
					start();
					activepage = 1;
					getcatdetails();
				});
				
				function getcatdetails(){
					flag = 2;
					var show = $('.show').val();
					var search = $('#catSearch').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show};
					$.ajax({
						url:'controller/controller.category.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#catView').html(html);
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