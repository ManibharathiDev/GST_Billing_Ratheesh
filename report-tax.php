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
				<h1>Tax Report</h1>
			</div>
			<div class="wrap-content">
				<div class="row">
					<div class="col-md-2">
						<input type="text" id="wrapSearch" class="wrap-text wrap-focus" placeholder="Search">
					</div>
					<div class="col-md-2">
						<label>Select Date</label>
					</div>
					<div class="col-md-2">
					<input type="text" class="wrap-text"  name="rdate" id="rdate">
					</div>
					<div class="col-md-4 padding-left">
						
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
				<div id="wrapView">
				
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
				var datemode = 0;
				var activepage = "";
				var sdate = "";
				var edate = "";
				
				getreport();
				$('#rdate').daterangepicker({
				singleDatePicker: false,
		   
				locale: {
				format: 'DD/MM/YYYY'
				},
				startDate: moment().subtract(0, 'days')
				},function(start,end){
					sdate = start.format('YYYY/MM/DD');
					edate = end.format('YYYY/MM/DD');
					datemode = 1;
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
				
				function getreport()
				{
					var content = "";
					var count = 0;
					var show = $('.show').val();
					var search = $('#wrapSearch').val();
					var flag = 4;
					if(datemode == 1)
					{
						var rdate = sdate+'-'+edate;
						var data = {flag:flag,search:search,rdate:rdate,activepage:activepage,show:show};
					}
					else
					{
						var data = {flag:flag,search:search,activepage:activepage,show:show};
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
									count++;
									content += '<tr class="tableheading">';
									content += '<th>Sl.No</th>';
									content += '<th>Bill No</th>';
									content += '<th>Bill Date</th>';
									content += '<th>GST</td>';
									content += '</tr>';
									item = data.data
									i = 0;
									var sumtotal = 0;
									$.each(item, function(index, element) 
									{
										i++;
										count++;
										content += '<tr>';
										content += '<td>'+i+'</td>';
										content += '<td>'+element.itemBillNo+'</td>';
										date=element.billDate;
										var cdate = date.split("-").reverse().join("-");
										content += '<td>'+cdate+'</td>';
										var gst = parseFloat(element.gst);
										content += '<td><span class="alignLeft"><i class="fa fa-inr"></i></span><span class="alignRight">'+gst.toFixed(2)+'</span></td>';
										content += '</tr>';
										sumtotal += gst;
									});
									content += '<tr class="tableheading">';
									content += '<td colspan="3" class="rightAlign textBold">Total</td>';
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
							$('#wrapView').html(content);
						}
					});
					end();
				}
				
				$(document).on('click','#pdfExport',function(){
					flag = 8; // Stock PDF
					var show = $('.show').val();
					var search = $('#wrapSearch').val();
					
					var data = {flag:flag,search:search,activepage:activepage,show:show};
					$.ajax({
						url:'controller/controller.report.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportpdf.php?flag=taxreport&query="+html,"_blank");
						}
					});
				});
				
				$(document).on('click','#xlExport',function(){
					
					flag = 8; // Stock PDF
					var show = $('.show').val();
					var search = $('#wrapSearch').val();
					var data = {flag:flag,search:search,activepage:activepage,show:show};
					$.ajax({
						url:'controller/controller.report.php',
						type:'POST',
						data:data,
						success:function(html){
							window.open("exportxl.php?flag=taxreport&query="+html,"_blank");
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