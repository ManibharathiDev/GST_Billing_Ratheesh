<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
		$brandname = $_POST['brandName'];
		$brandshort = $_POST['brandShort'];
		$branddescription = $_POST['brandDescription'];
		$brandstatus = $_POST['brandStatus'];
		$status=$brand->create_brand($brandname,$brandshort,$branddescription,$brandstatus);
		echo $status;
		}
		else if($flag == 2)
		{
			$status = $brand->view_brand();
			echo $status;
		}
		else if($flag == 3)
		{
			$brandid = $_POST['id'];
			$status = $brand->view_brand_by_id($brandid);
			echo $status;
		}
		else if($flag == 4)
		{
			$brandname = $_POST['brandName'];
			$brandshort = $_POST['brandShort'];
			$branddescription = $_POST['brandDescription'];
			$brandstatus = $_POST['brandStatus'];
			$brandid = $_POST['brandId'];
			$status=$brand->update_brand($brandname,$brandshort,$branddescription,$brandstatus,$brandid);
			echo $status;
		}
		else if($flag == 5)
		{
			$brandid = $_POST['id'];
			$status = $brand->delete_brand($brandid);
			echo $status;
		}
		else if($flag == 6)
		{
			$bname = $_POST['bname'];
			$status = $brand->checkBrandName($bname);
			echo $status;
		}
		else if($flag == 7)
		{
			$bname = $_POST['bname'];
			$status = $brand->checkBrandShortName($bname);
			echo $status;
		}
		else if($flag == 8)
		{
			$status = $brand->exportpdf();
			echo $status;
		}
		else if($flag == 9)
		{
			$brandid = $_POST['id'];
			$status = $brand->get_brand_by_id($brandid);
			echo $status;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>