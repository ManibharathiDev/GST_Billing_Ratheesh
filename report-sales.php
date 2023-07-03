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
		<link href="css/datepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
		<link href="css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
		<?php
			include('header.php');
		?>
		<div class="wrap-container">
			<div class="wrap-heading">
				<h1>Sales Report</h1>
			</div>
			<div class="wrap-content">
			<div class="row">
					<div class="col-md-1">
						<label>Category</label>
					</div>
					<div class="col-md-2">
						<select name="selCat" id="selCat" class="wrap-text">
							<option value="">Select Category</option>
							<?php
								$cquery = "SELECT * FROM tbl_category";
								$cstmt = $db->prepare($cquery);
								$cstmt->execute();
								if($cstmt->rowCount())
								{
									while($row = $cstmt->fetch(PDO::FETCH_ASSOC)){
										echo '<option value="'.$row['catId'].'">';
										echo $row['catName'];
										echo '</option>';
									}
								}
							?>
						</select>
					</div>
					
					<div class="col-md-1">
						<label>Brand</label>
					</div>
					<div class="col-md-2">
						<select name="selBrand" id="selBrand" class="wrap-text">
							<option value="">Select Brand</option>
							<?php
								$cquery = "SELECT * FROM tbl_brand";
								$cstmt = $db->prepare($cquery);
								$cstmt->execute();
								if($cstmt->rowCount())
								{
									while($row = $cstmt->fetch(PDO::FETCH_ASSOC)){
										echo '<option value="'.$row['brandId'].'">';
										echo $row['brandName'];
										echo '</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-1">
						<label>Item</label>
					</div>
					<div class="col-md-2">
						<select name="selItem" id="selItem" class="wrap-text">
							<option value="">Select Item</option>
							<?php
								$cquery = "SELECT * FROM tbl_item";
								$cstmt = $db->prepare($cquery);
								$cstmt->execute();
								if($cstmt->rowCount())
								{
									while($row = $cstmt->fetch(PDO::FETCH_ASSOC)){
										echo '<option value="'.$row['itemId'].'">';
										echo $row['itemName'];
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
						<input type="text" id="wrapSearch" class="wrap-text wrap-focus" placeholder="Search">
					</div>
					<div class="col-md-2">
						<label>Select Date</label>
					</div>
					<div class="col-md-2">
						<input type="text" class="wrap-text" name="sdate" id="sdate">
					</div>
					
					<div class="col-md-2">
						<label>Select Range</label>
					</div>
					<div class="col-md-2">
						<input type="text" class="wrap-text"  name="rdate" id="rdate">
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
				<div id="reportView">
				
				</div>
			</div>
		</div>
		<?php
			include('footer.php');
		?>
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="js/alert/sweetalert.min.js" type="text/javascript"></script>
		<script src="js/datepicker/moment.min.js" type="text/javascript"></script>
		<script src="js/datepicker/daterangepicker.js" type="text/javascript"></script>
		<script src="js/alert.js" type="text/javascript"></script>
		<?php include('accept.php') ?>
		<script type="text/javascript">
			$(document).ready(function(){
				var activepage = "";
				getreport();
				var datemode = 0;
				var sdate = "";
				var edate = "";
				$('#sdate').daterangepicker({
				singleDatePicker: true,
		   
				locale: {
				format: 'DD/MM/YYYY'
				},
				startDate: moment().subtract(0, 'days')
				},function(start,end)
				{
					//alert(start.format('YYYY/MM/DD'));
					sdate = start.format('YYYY/MM/DD');
					datemode = 1;
					getreport();
				});
				$('#sdate').val("");
				
				$('#rdate').daterangepicker({
				singleDatePicker: false,
		   
				locale: {
				format: 'DD/MM/YYYY'
				},
				startDate: moment().subtract(0, 'days')
				},function(start,end){
					sdate = start.format('YYYY/MM/DD');
					edate = end.format('YYYY/MM/DD');
					datemode = 2;
					getreport();
				});
				
				$('#rdate').val("");
				
				$(document).on('click','.spage',function(){
					start();
					activepage = this.id;
					getreport();
				});
				
				$('#wrapSearch').on('keyup',function(){
					start();
					getreport();
				});
				
				$(document).on('change','.show',function(){
					start();
					activepage = 1;
					getreport();
				});
				
				$(document).on('change','#selCat',function(){
					start();
					getreport();
				});
				
				$(document).on('change','#selBrand',function(){
					start();
					getreport();
				});
				
				$(document).on('change','#selItem',function(){
					start();
					getreport();
				});
				
				function getreport()
				{
					var content = "";
					var count = 0;
					var flag = 3;
					var show = $('.show').val();
					var search = $('#wrapSearch').val();
					var selcat = $('#selCat').val();
					var selbrand = $('#selBrand').val();
					var selitem = $('#selItem').val();
					if(datemode == 1)
					{
						
						var data = {flag:flag,search:search,activepage:activepage,show:show,cat:selcat,brand:selbrand,item:selitem,sdate:sdate};
					}
					else if(datemode == 2)
					{
						var rdate = sdate+'-'+edate;
						var data = {flag:flag,search:search,activepage:activepage,show:show,cat:selcat,brand:selbrand,item:selitem,rdate:rdate};
					}
					else
					{
					var data = {flag:flag,search:search,activepage:activepage,show:show,cat:selcat,brand:selbrand,item:selitem};
					}
					$.ajax({
						url:'controller/controller.report.php',
						type:'POST',
						data:data,
						dataType:'json',
						success:function(data)
						{
							content += '<table class="table table-bordered customTable">';
							
								if(data.success == 1)
								{
									content += '<tr class="tableheading">';
									content += '<th>Sl.No</th>';
									content += '<th>Item</th>';
									content += '<th>HSN</th>';
									content += '<th>Brand</td>';
									content += '<th>Total Sales</td>';
									content += '<th>Total Earn</td>';
									content += '</tr>';
									item = data.data
									i = 0;
									var sumtotal = 0;
									var scount = 0;
									$.each(item, function(index, element) 
									{
										i++;
										count++;
										content += '<tr>';
										content += '<td>'+i+'</td>';
										content += '<td>'+element.itemName+' '+element.brandName+'</td>';
										content += '<td>'+element.itemHSN+'</td>';
										content += '<td>'+element.brandName+'</td>';
										content += '<td>'+element.count+'</td>';
										var total = parseFloat((element.itemPrice)-element.discount)+parseFloat(element.gst);
										content += '<td><span><i class="fa fa-inr"></i></span><span class="alignRight">'+total.toFixed(2)+'</span></td>';
										content += '</tr>';
										scount += parseInt(element.count);
										sumtotal += total;
									});
									content += '<tr class="tableheading">';
									content += '<td colspan="4" class="rightAlign textBold">Total</td>';
									content += '<td>'+scount+'</td>';
									content += '<td><span class="alignLeft"><i class="fa fa-inr"></i></span><span class="alignRight">'+sumtotal.toFixed(2)+'</span></td>';
									content += '</tr>';
									
								}
								else if(data.success == 0)
								{
									content += '<tr><td>There are no results for your search string...</td></tr>';
								}
								content += '</table>';	
								if(count != 0)
								{
								pagination = data.pagination;
								content += pagination;
								}
							$('#reportView').html(content);
						}
					});
					end();
				}
				
				$(document).on('click','#pdfExport',function(){
					flag = 6; // Stock PDF
					var show = $('.show').val();
					var search = $('#wrapSearch').val();
					var selcat = $('#selCat').val();
					var selbrand = $('#selBrand').val();
					var selitem = $('#selItem').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show,cat:selcat,brand:selbrand,item:selitem};
					$.ajax({
						url:'controller/controller.report.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportpdf.php?flag=salereport&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','#xlExport',function(){
					flag = 6; // Stock PDF
					var show = $('.show').val();
					var search = $('#wrapSearch').val();
					var selcat = $('#selCat').val();
					var selbrand = $('#selBrand').val();
					var selitem = $('#selItem').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show,cat:selcat,brand:selbrand,item:selitem};
					$.ajax({
						url:'controller/controller.report.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportxl.php?flag=salereport&query="+html,"_blank");
						}
					});
					
				});
			});
		</script>
		<?php
			include('headerright.php');
		?>
	</body>
</html>