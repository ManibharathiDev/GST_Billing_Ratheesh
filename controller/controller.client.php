<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
		$clientname = $_POST['clientName'];
		$clientcontactname = $_POST['clientContactName'];
		$clientcontact = $_POST['clientContact'];
		$clientemail = (empty($_POST['clientEmail']))?NULL:$_POST['clientEmail'];
		$clientgstin = (empty($_POST['clientGstin']))?NULL:$_POST['clientGstin'];
		$clienttype = (empty($_POST['clientType']))?NULL:$_POST['clientType'];
		$clientstatus = $_POST['clientStatus'];
		$clientbilladdress = $_POST['clientBillAddress'];
		$clientbillcity = $_POST['clientBillCity'];
		$clientbillstate = $_POST['clientBillState'];
		$clientbillpin = $_POST['clientBillPin'];
		$clientbillcountry = $_POST['clientBillCountry'];
		$clientshipdiff = isset($_POST['clientShipDiff'])?'1':'0';
		$clientshipaddress = (empty($_POST['clientShipAddress']))?NULL:$_POST['clientShipAddress'];
		$clientshipcity = (empty($_POST['clientShipCity']))?NULL:$_POST['clientShipCity'];
		$clientshipstate =(empty($_POST['clientShipState']))?NULL:$_POST['clientShipState'];
		$clientshippin = (empty($_POST['clientShipPin']))?NULL:$_POST['clientShipPin'];
		$clientshipcountry =(empty($_POST['clientShipCountry']))?NULL:$_POST['clientShipCountry'];
		$status=$client->create_client($clientname,$clientcontactname,$clientcontact,$clientemail,$clientgstin,$clienttype,$clientstatus,$clientbilladdress,$clientbillcity,$clientbillstate,$clientbillpin,$clientbillcountry,$clientshipdiff,$clientshipaddress,$clientshipcity,$clientshipstate,$clientshippin,$clientshipcountry);
		echo $status;
		}
		else if($flag == 2)
		{
			$status = $client->view_client();
			echo $status;
		}
		else if($flag == 3)
		{
			$clientid = $_POST['id'];
			$status = $client->view_client_by_id($clientid);
			echo $status;
		}
		else if($flag == 4)
		{
		$clientid = $_POST['clientId'];
		$clientname = $_POST['clientName'];
		$clientcontactname = $_POST['clientContactName'];
		$clientcontact = $_POST['clientContact'];
		$clientemail = (empty($_POST['clientEmail']))?NULL:$_POST['clientEmail'];
		$clientgstin = (empty($_POST['clientGstin']))?NULL:$_POST['clientGstin'];
		$clienttype = (empty($_POST['clientType']))?NULL:$_POST['clientType'];$clientstatus = $_POST['clientStatus'];
		$clientbilladdress = $_POST['clientBillAddress'];
		$clientbillcity = $_POST['clientBillCity'];
		$clientbillstate = $_POST['clientBillState'];
		$clientbillpin = $_POST['clientBillPin'];
		$clientbillcountry = $_POST['clientBillCountry'];
		$clientshipdiff = isset($_POST['clientShipDiff'])?'1':'0';
		$clientshipaddress = (empty($_POST['clientShipAddress']))?NULL:$_POST['clientShipAddress'];
		$clientshipcity = (empty($_POST['clientShipCity']))?NULL:$_POST['clientShipCity'];
		$clientshipstate =(empty($_POST['clientShipState']))?NULL:$_POST['clientShipState'];
		$clientshippin = (empty($_POST['clientShipPin']))?NULL:$_POST['clientShipPin'];
		$clientshipcountry =(empty($_POST['clientShipCountry']))?NULL:$_POST['clientShipCountry'];
		$status=$client->update_client($clientname,$clientcontactname,$clientcontact,$clientemail,$clientgstin,$clienttype,$clientstatus,$clientbilladdress,$clientbillcity,$clientbillstate,$clientbillpin,$clientbillcountry,$clientshipdiff,$clientshipaddress,$clientshipcity,$clientshipstate,$clientshippin,$clientshipcountry,$clientid);
		echo $status;
		}
		else if($flag == 5)
		{
			$clientid = $_POST['id'];
			$status = $client->delete_client($clientid);
			echo $status;
		}
		else if($flag == 6)
		{
			$gst = $_POST['gst'];
			$status = $client->checkClientGst($gst);
			echo $status;
		}
		else if($flag == 7)
		{
			$status = $client->export();
			echo $status;
		}
		else if($flag == 8)
		{
			$clientid = $_POST['id'];
			$status = $client->get_client_by_id($clientid);
			echo $status;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>