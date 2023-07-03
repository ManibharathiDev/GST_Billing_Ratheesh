<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
		$itemname = $_POST['itemName'];
		$itemshort = $_POST['itemShort'];
		$itemdescription = $_POST['itemDescription'];
		$itemhsn = $_POST['itemHSN'];
		$itemstatus = $_POST['itemStatus'];
		$status=$item->create_item($itemname,$itemshort,$itemdescription,$itemhsn,$itemstatus);
		echo $status;
		}
		else if($flag == 2)
		{
			$status = $item->view_item();
			echo $status;
		}
		else if($flag == 3)
		{
			$itemid = $_POST['id'];
			$status = $item->view_item_by_id($itemid);
			echo $status;
		}
		else if($flag == 4)
		{
		$itemname = $_POST['itemName'];
		$itemshort = $_POST['itemShort'];
		$itemdescription = $_POST['itemDescription'];
		$itemhsn = $_POST['itemHSN'];
		$itemid = $_POST['itemId'];
		$status=$item->update_item($itemname,$itemshort,$itemdescription,$itemhsn,$itemid);
		echo $status;
		}
		else if($flag == 5)
		{
			$itemid = $_POST['id'];
			$status = $item->delete_item($itemid);
			echo $status;
		}
		else if($flag == 6)
		{
			$iname = $_POST['iname'];
			$status = $item->checkItemName($iname);
			echo $status;
		}
		else if($flag == 7)
		{
			$iname = $_POST['iname'];
			$status = $item->checkItemShortName($iname);
			echo $status;
		}
		else if($flag == 8)
		{
			$status = $item->export();
			echo $status;
		}
		else if($flag == 9)
		{
			$iname = $_POST['iname'];
			$status = $item->checkHsn($iname);
			echo $status;
		}
		else if($flag == 10)
		{
			$itemid = $_POST['id'];
			$status = $item->get_item_by_id($itemid);
			echo $status;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>