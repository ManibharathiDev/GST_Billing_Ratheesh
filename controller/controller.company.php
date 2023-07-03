<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
		$compname = $_POST['compName'];
		$compadd = $_POST['compAdd'];
		$compcity = $_POST['compCity'];
		$compstate = $_POST['compState'];
		$comppin = $_POST['compPin'];
		$compphone = $_POST['compPhone'];
		$compemail = $_POST['compEmail'];
		$compweb = $_POST['compWeb'];
		$compgst = $_POST['compGst'];
		$comppan = $_POST['compPan'];
		$status=$comp->create_company($compname,$compadd,$compcity,$compstate,$comppin,$compphone,$compemail,$compweb,$compgst,$comppan);
		echo $status;
		}
		else if($flag == 2)
		{
			$status = $comp->view_company();
			echo $status;
		}
		else if($flag == 3)
		{
			$compid = $_POST['id'];
			$status = $comp->view_company_by_id($compid);
			echo $status;
		}
		else if($flag == 4)
		{
			$compname = $_POST['compName'];
		$compadd = $_POST['compAdd'];
		$compcity = $_POST['compCity'];
		$compstate = $_POST['compState'];
		$comppin = $_POST['compPin'];
		$compphone = $_POST['compPhone'];
		$compemail = $_POST['compEmail'];
		$compweb = $_POST['compWeb'];
		$compgst = $_POST['compGst'];
		$comppan = $_POST['compPan'];
			$compid = $_POST['compId'];
			$status=$comp->update_company($compname,$compadd,$compcity,$compstate,$comppin,$compphone,$compemail,$compweb,$compgst,$comppan,$compid);
			echo $status;
		}
		else if($flag == 5)
		{
			$compid = $_POST['id'];
			$status = $comp->delete_company($compid);
			echo $status;
		}
		else if($flag == 6){ // Template Select
			$tempid = $_POST['id'];
			$status = $comp->update_template($tempid);
			echo $status;
		}
		else if($flag == 7){ //get Template details
			$status = $comp->getTemplate();
			echo $status;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>