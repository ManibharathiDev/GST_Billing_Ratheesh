<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
		$itemid = $_POST['itemid'];
		$brandid = $_POST['itemid'];
		if(isset($_POST['itemShort']))
		{
			$itemshort = $_POST['itemShort'];
			if($itemshort == "")
			{
				$item = explode(',',$itemid);
				$itemid = $item[0];
				$brandid = $item[1];
			}
		
		}
		$oldquantity = $_POST['qty'];
		$itemquantity = $_POST['itemQuantity'];
		$itempurchaseprice = $_POST['itemPurchasePrice'];
		$itemsellingprice = $_POST['itemSellingPrice'];
		$itemtax = $_POST['itemTax'];
		$itemcat = $_POST['itemCategory'];
		$itembrand = $_POST['itemBrand'];
		$itemsupplier = $_POST['itemSupplier'];
		$status=$stock->create_stock($itemid,$brandid,$itemquantity,$oldquantity,$itempurchaseprice,$itemsellingprice,$itemtax,$itemcat,$itembrand,$itemsupplier);
		echo $status;
		}
		else if($flag == 2)
		{
			$item = $_POST['stockid'];
			$status = $stock->getitembyid($item);
			echo $status;
		}
		else if($flag == 3)
		{
			$item = $_POST['itemid'];
			$item = explode(',',$item);
			$itemid = $item[0];
			$brandid = $item[1];
			$status = $stock->getitemid($itemid,$brandid);
			echo $status;
		}
		else if($flag == 4){
			$id = $_POST['itemid'];
			$id = explode(',',$id);
			$itemid = $id[0];
			$brandid = $_POST['brandid'];
			$status = $stock->checkitembrand($itemid,$brandid);
			echo $status;
		}
		else if($flag == 5){
			$status = $stock->view_stock();
			echo $status;
		}
		else if($flag == 6){
			$stockid = $_POST['id'];
			$status = $stock->get_stock($stockid);
			echo $status;
		}
		else if($flag == 7){
			$stockid = $_POST['id'];
			$status = $stock->delete_stock($stockid);
			echo $status;
		}
		else if($flag == 8){
			$status = $stock->getstockbrand();
			echo $status;
		}
		else if($flag == 9){
			$stockid = $_POST['id'];
			$status = $stock->get_stock_for_damage($stockid);
			echo $status;
		}
		else if($flag == 10){
			$stockid = $_POST['damagestockid'];
			$damagecount = $_POST['damageCount'];
			$status = $stock->insert_damage_stock($stockid,$damagecount);
			echo $status;
		}

		
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>