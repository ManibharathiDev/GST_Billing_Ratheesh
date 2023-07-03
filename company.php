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
				<h1>Manage Company</h1>
			</div>
			<div class="wrap-content">
				
				<div class="clear"></div>
				<div id="compView">
				</div>
			</div>
		</div>
		<div class="modal fade" id="compModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Company</h4>
        </div>
        <div class="modal-body">
			<div id="compShow">
			<form name="compForm" id="compForm">
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Company Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compName" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Address : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compAdd" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>City : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compCity" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>State : </label>
					</div>
					<div class="col-md-7">
						<select name="compState" class="wrap-text cinput" required>
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
					<div class="col-md-4">
						<label>Pincode : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compPin" class="wrap-text cinput numeric" required>
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Mobile/Phone : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compPhone" class="wrap-text cinput numeric" required>
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Email : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compEmail" class="wrap-text cinput">
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Website : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compWeb" class="wrap-text cinput">
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>GSTIN No. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compGst" class="wrap-text cinput" required>
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>PAN No. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compPan" class="wrap-text cinput" required>
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						
					</div>
					<div class="col-md-7">
					<input type="hidden" value="1" name="flag">
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
  	<div class="modal fade" id="compEditModel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Company</h4>
        </div>
        <div class="modal-body">
			<div id="brandShow">
			<form name="compEditForm" id="compEditForm">
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Company Name : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compName" id="compName" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Address : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compAdd" id="compAdd" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>City : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compCity" id="compCity" class="wrap-text cinput" required>
					</div>
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>State : </label>
					</div>
					<div class="col-md-7">
						
						<select name="compState" id="compState" class="wrap-text" required>
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
					<div class="col-md-4">
						<label>Pincode : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compPin" id="compPin" class="wrap-text cinput numeric" required>
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Mobile/Phone : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compPhone" id="compPhone" class="wrap-text cinput numeric" required>
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Email : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compEmail" id="compEmail" class="wrap-text cinput">
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>Website : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compWeb" id="compWeb" class="wrap-text cinput">
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>GSTIN No. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compGst" id="compGst" class="wrap-text cinput" required>
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						<label>PAN No. : </label>
					</div>
					<div class="col-md-7">
						<input type="text" name="compPan" id="compPan" class="wrap-text cinput" required>
					</div>
					
				</div>
				<div class="clear"></div>
				<div class="row wrap-margin">
					<div class="col-md-4">
						
					</div>
					<div class="col-md-7">
					<input type="hidden" value="4" name="flag">
					<input type="hidden" name="compId" id="compId">
						<Button type="submit" class="btn btn-primary">Submit</Button>
					</div>
				</div>
				</form>
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
		$('#newComp').click(function(){
				$('#compModel').modal({
					backdrop: 'static',
					keyboard: false
				});
				setTimeout(function() { $('input[id="compName"]').focus() }, 500);
			});
		$(document).ready(function(){
				var flag = 0;
				getcompdetails();
				
				$('#compForm').on('submit',function(e){
						e.preventDefault();
						$.ajax({
							url:'controller/controller.company.php',
							type:'POST',
							data:new FormData(this),
							processData:false,
							contentType:false,
							success:function(html){
								if(html == 1)
								{
									$('#cinput').val("");
									getcompdetails();
									$('#compModel').modal('hide');
									alert("Company Added");
								}
							}
						});
				});
				
				$('#compSearch').on('keyup',function(){
					getcompdetails();
				});
				
				$(document).on('click','.compEdit',function(e){
					e.preventDefault();
					var flag = 3;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.company.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data){
							$('#compEditModel').modal({
								backdrop: 'static',
								keyboard: false
								});
							$.each(data, function(index, element) 
							{
							$('#compId').val(element.compId);
							$('#compName').val(element.compName);
							$('#compAdd').val(element.compAddress)
							$('#compCity').val(element.compCity);
							$('#compState').val(element.compState);
							$('#compPin').val(element.compPin);
							$('#compPhone').val(element.compPhone);
							$('#compEmail').val(element.compEmail);
							$('#compWeb').val(element.compWeb);
							$('#compGst').val(element.compGSTIN);
							$('#compPan').val(element.compPAN);
							});
						}
					});
				});
				
				$(document).on('click','.compDelete',function(e){
					e.preventDefault();
					var flag = 5;
					var id = this.id;
					var data = {id:id,flag:flag};
					$.ajax({
						url:'controller/controller.company.php',
						type:'POST',
						data:data,
						success:function(html){
							if(html == 1)
							{
								alert("Company Deleted");
								getcompdetails();
							}
						}
					});
				});
				
				$('#compEditForm').on('submit',function(e){
					e.preventDefault();
					$.ajax({
						url:'controller/controller.company.php',
						type:'POST',
						data:new FormData(this),
						processData:false,
						contentType:false,
						success:function(html){
							$('#compEditModel').modal('hide');
							getcompdetails();
						}
						});
				});
				
				function getcompdetails(){
					flag = 2;
					var search = $('#compSearch').val();
					var data = {flag:flag,search:search};
					$.ajax({
						url:'controller/controller.company.php',
						type:'POST',
						data:data,
						success:function(html){
							$('#compView').html(html);
							//$('#newComp').hide();
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