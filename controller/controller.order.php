<?php
	session_start();
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
		$clientid = $_POST['clientid'];
		$status=$order->getclientbyid($clientid);
		echo $status;
		}
		else if($flag == 2)
		{
			$productid = $_POST['productid'];
			$status = $order->getproductbyid($productid);
			echo $status;
		}
		else if($flag == 3){
			$status = $order->getlastclient();
			echo $status;
		}
		else if($flag == 4)
		{
			$status = $order->getlastitem();
			echo $status;
		}
		else if($flag == 5) // Save Bill
		{
			if(isset($_POST['billid']))
			{
			$billid = $_POST['billid'];
			$cusid = $_POST['cusid'];
			$itemid = $_POST['itemid'];
			$itemqty = $_POST['itemqty'];
			$itemprice = $_POST['itemprice'];
			$itempurchaseprice = $_POST['itempurchaseprice'];
			$itemsupplier = $_POST['itemsupplier'];
			$itemdis = $_POST['itemdis'];
			$itemtax = $_POST['itemtax'];
			$itemdismode = $_POST['itemdismode'];
			$status = $order->updatebill($billid,$cusid,$itemid,$itemqty,$itemprice,$itempurchaseprice,$itemsupplier,$itemdis,$itemtax,$itemdismode);
			echo $status;
			}
			else
			{
			$paidamount = (empty($_POST['paidamount']))?'0.00':$_POST['paidamount'];
			$cusid = $_POST['cusid'];
			$itemid = $_POST['itemid'];
			$itemqty = $_POST['itemqty'];
			$itemprice = $_POST['itemprice'];
			$itempurchaseprice = $_POST['itempurchaseprice'];
			$itemsupplier = $_POST['itemsupplier'];
			$itemdis = $_POST['itemdis'];
			$itemdismode = $_POST['itemdismode'];
			$itemtax = $_POST['itemtax'];
			$status = $order->savebill($cusid,$paidamount,$itemid,$itemqty,$itemprice,$itempurchaseprice,$itemsupplier,$itemdis,$itemtax,$itemdismode);
			echo $status;
			}
		}
		else if($flag == 6) //View Bill
		{
			$status = $order->viewbill();
			echo $status;
		}
		else if($flag == 7)
		{
			$billid = $_POST['billid'];
			$status = $order->viewbillbyid($billid);
			echo $status;
		}
		else if($flag == 8)
		{
			$status = $order->createbillno();
			echo $status;
		}
		else if($flag == 9)
		{
			$status = $order->export();
			echo $status;
		}
		else if($flag == 10)
		{
			$billid = $_POST['billid'];
			$status = $order->getclientid($billid);
			echo $status;
		}
		else if($flag == 11)
		{
			$billid = $_POST['id'];
			$status = $order->get_bill_by_id($billid);
			echo $status;
		
		}
		else if($flag == 12)
		{
			$billid = $_POST['id'];
			$status = $order->get_bill_by_id($billid);
			echo $status;
		}
		else if($flag == 13){
			$billid = $_POST['paybillid'];
			$amount = $_POST['amountPayable'];
			$status = $order->makepayment($billid,$amount);
			echo $status;
			
		}
		else if($flag == 14){
			$status = $_SESSION['tempname'];
			echo $status;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>