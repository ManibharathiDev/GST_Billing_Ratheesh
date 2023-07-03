<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
		$taxname = $_POST['taxName'];
		$taxrate = $_POST['taxRate'];
		$taxdescription = $_POST['taxDescription'];
		$taxstatus = $_POST['taxStatus'];
		$status=$tax->create_tax($taxname,$taxrate,$taxdescription,$taxstatus);
		echo $status;
		}
		else if($flag == 2)
		{
			$status = $tax->view_tax();
			echo $status;
		}
		else if($flag == 3)
		{
			$taxid = $_POST['id'];
			$status = $tax->view_tax_by_id($taxid);
			echo $status;
		}
		else if($flag == 4)
		{
			$taxname = $_POST['taxName'];
			$taxrate = $_POST['taxRate'];
			$taxdescription = $_POST['taxDescription'];
			$taxstatus = $_POST['taxStatus'];
			$taxid = $_POST['taxId'];
			$status=$tax->update_tax($taxname,$taxrate,$taxdescription,$taxstatus,$taxid);
			echo $status;
		}
		else if($flag == 5)
		{
			$taxid = $_POST['id'];
			$status = $tax->delete_tax($taxid);
			echo $status;
		}
		else if($flag == 6)
		{
			$tname = $_POST['tname'];
			$status = $tax->checkTaxName($tname);
			echo $status;
		}
		else if($flag == 7)
		{
			$tname = $_POST['tname'];
			$status = $tax->checkTaxShortName($tname);
			echo $status;
		}
		else if($flag == 8)
		{
			$status = $tax->export();
			echo $status;
		}
		else if($flag == 9)
		{
			$taxid = $_POST['id'];
			$status = $tax->get_tax_by_id($taxid);
			echo $status;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>