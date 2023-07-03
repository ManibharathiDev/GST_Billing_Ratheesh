<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
			$supname = $_POST['supname'];
			$supcontname = $_POST['supcontname'];
			$supphone = $_POST['supphone'];
			$supemail = $_POST['supemail'];
			$supgstin = $_POST['supgstin'];
			$suppan = $_POST['suppan'];
			$supaadhar	= $_POST['supaadhar'];
			$supadd = $_POST['supadd'];
			$supcity = $_POST['supcity'];
			$supstate = $_POST['supstate'];
			$suppin = $_POST['suppin'];
			$supcountry = $_POST['supcountry'];
			$supstatus = $_POST['supstatus'];
			$status = $supplier->create_supplier($supname,$supcontname,$supphone,$supemail,$supgstin,$suppan,$supaadhar,$supadd,$supcity,$supstate,$suppin,$supcountry,$supstatus);
			echo $status;
		}
		else if($flag == 2)
		{
			$status = $supplier->view_supplier();
			echo $status;
		}
		else if($flag == 3)
		{
			$supid = $_POST['id'];
			$status = $supplier->view_supplier_by_id($supid);
			echo $status;
		}
		else if($flag == 4)
		{
			$supid = $_POST['supId'];
			$supname = $_POST['supname'];
			$supcontname = $_POST['supcontname'];
			$supphone = $_POST['supphone'];
			$supemail = $_POST['supemail'];
			$supgstin = $_POST['supgstin'];
			$suppan = $_POST['suppan'];
			$supaadhar	= $_POST['supaadhar'];
			$supadd = $_POST['supadd'];
			$supcity = $_POST['supcity'];
			$supstate = $_POST['supstate'];
			$suppin = $_POST['suppin'];
			$supcountry = $_POST['supcountry'];
			$supstatus = $_POST['supstatus'];
			$status = $supplier->update_supplier($supid,$supname,$supcontname,$supphone,$supemail,$supgstin,$suppan,$supaadhar,$supadd,$supcity,$supstate,$suppin,$supcountry,$supstatus);
			echo $status;
		}
		else if($flag == 5)
		{
			$supid = $_POST['id'];
			$status = $supplier->delete_supplier($supid);
			echo $status;
		}
		else if($flag == 6)
		{
			$gst = $_POST['gst'];
			$status = $supplier->checkSupplierGst($gst);
			echo $status;
		}
		else if($flag == 7)
		{
			$status = $supplier->export();
			echo $status;
		}
		else if($flag == 8)
		{
			$supid = $_POST['id'];
			$status = $supplier->get_supplier_by_id($supid);
			echo $status;
		}
		else if($flag == 9){
			$pan = $_POST['pan'];
			$status = $supplier->checkSupplierPan($pan);
			echo $status;
		}
		else if($flag == 10){
			$aad = $_POST['aad'];
			$status = $supplier->checkSupplierAad($aad);
			echo $status;
		}
		else if($flag == 11){
			$name = $_POST['name'];
			$status = $supplier->checkSupplierName($name);
			echo $status;
		}
		else if($flag == 12){
			$phone = $_POST['phone'];
			$status = $supplier->checkSupplierPhone($phone);
			echo $status;
		}
		else if($flag == 13){
			$email = $_POST['email'];
			$status = $supplier->checkSupplierEmail($email);
			echo $status;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>