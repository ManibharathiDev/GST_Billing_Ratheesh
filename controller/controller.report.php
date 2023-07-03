<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1) // Stock
		{
			$status = $report->getstock();
			echo $status;
		}
		else if($flag == 2) // Stock PDF
		{
			$status = $report->getpdfstock();
			echo $status;
		}
		else if($flag == 3) // Sales Report
		{
			$status = $report->getsales();
			echo $status;
		}
		else if($flag == 4) //Tax Report
		{
			$status = $report->gettaxreport();
			echo $status;
		}
		else if($flag == 5){
			$status = $report->getprofitreport();
			echo $status;
		}
		else if($flag == 6){
			$status = $report->getpdfsales();
			echo $status;
		}
		else if($flag == 7){
			$status = $report->getpdfprofit();
			echo $status;
		}
		else if($flag == 8){
			$status = $report->getpdftax();
			echo $status;
		}
		else if($flag == 9){
			$status = $report->getpaymentreport();
			echo $status;
		}
		else if($flag == 10){
			$status = $report->getpdfpayment();
			echo $status;
		}
		else if($flag == 11){
			$status = $report->getpendingreport();
			echo $status;
		}
		else if($flag == 12){
			$status = $report->getpdfpending();
			echo $status;
		}
		else if($flag == 13){
			$status = $report->getdamagedstock();
			echo $status;
		}
		else if($flag == 14) // Stock PDF
		{
			$status = $report->getpdfdamagestock();
			echo $status;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>