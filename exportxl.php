<?php
	include('includes/config.php');
	$flag = $_GET['flag'];
	if($flag == 'brand')
	{
	$filename = "List of Brands-".date('d-m-Y h:i:s');
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$filename.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	$query = $_GET['query'];
	$query = stripslashes($query);
	$stmt = $db->prepare($query);
		$stmt->execute();
	    $data = "";
		if($stmt->rowCount()>0)
		{
			$data.= "Sl.No\t";
			$data.= "Brand Name\t";
			$data.= "Short Name\t";
			$data.= "Description\t";
			$data.= "Status\n";
			$i=0;			
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['brandName']."\t";
				$data .= $row['brandShort']."\t";
				$data .= $row['brandDescription']."\t";
				if($row['brandStatus']==1)
				{
					$status = 'Active';
				}
				else
					$status = 'In-Active';
				$data .= $status."\n";
				
			}
		}
		}
		else if($flag == 'cat')
		{
			$filename = "List of Category-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Category Name\t";
			$data.= "Short Name\t";
			$data.= "Description\t";
			$data.= "Status\n";
			$i=0;			
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['catName']."\t";
				$data .= $row['catShort']."\t";
				$data .= $row['catDescription']."\t";
				if($row['catStatus']==1)
				{
					$status = 'Active';
				}
				else
					$status = 'In-Active';
				$data .= $status."\n";
				
			}
			}
		}
		else if($flag == 'item')
		{
			$filename = "List of Items-".date('d-m-Y h:is');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Item Name\t";
			$data.= "Short Name\t";
			$data.= "Description\t";
			$data.= "HSN\n";
			
			$i=0;			
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['itemName']."\t";
				$data .= $row['itemShort']."\t";
				$data .= $row['itemDescription']."\t";
				$data .= $row['itemHSN']."\n";
			
				
			}
			}
		}
		else if($flag == 'client')
		{
			$filename = "List of Clients-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Client Name\t";
			$data.= "Contact Name\t";
			$data.= "Phone\t";
			$data.= "Email\t";
			$data.= "GSTIN\t";
			$data.= "Status\n";
			
			$i=0;			
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['clientName']."\t";
				$data .= $row['clientcontactName']."\t";
				$data .= $row['clientPhone']."\t";
				$data .= $row['clientEmail']."\t";
				$data .= $row['clientGSTIN']."\t";
				if($row['clientStatus']==1)
				{
					$status = 'Active';
				}
				else
					$status = 'In-Active';
				$data .= $status."\n";
				
			}
			}
		}
		else if($flag == 'supplier')
		{
			$filename = "List of Suppliers-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Client Name\t";
			$data.= "Contact Name\t";
			$data.= "Phone\t";
			$data.= "Email\t";
			$data.= "GSTIN\t";
			$data.= "PAN\t";
			$data.= "City\t";
			$data.= "State\n";
			$i=0;			
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['supplierName']."\t";
				$data .= $row['supplierContactName']."\t";
				$data .= $row['supplierPhone']."\t";
				$data .= $row['supplierEmail']."\t";
				$data .= $row['supplierGSTIN']."\t";
				$data .= $row['supplierPAN']."\t";
				$data .= $row['supplierCity']."\t";
				$data .= $row['stateName']."\n";
				
			}
			}
		}
		else if($flag == 'tax')
		{
			$filename = "List of Tax-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Tax Name\t";
			$data.= "Description\t";
			$data.= "Percentage\t";
			$data.= "Status\n";
			
			$i=0;			
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['taxName']."\t";
				$data .= $row['taxDescription']."\t";
				$data .= $row['taxPercentage']."\t";
				if($row['taxStatus']==1)
				{
					$status = 'Active';
				}
				else
					$status = 'In-Active';
				$data .= $status."\n";
				
			}
			}
		}
		else if($flag == 'order')
		{
			$filename = "List of Orders-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Bill No\t";
			$data.= "Client Name\t";
			$data.= "Amount\t";
			$data.= "Paid\t";
			$data.= "Balance\n";
			
			$i=0;			
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['billOrderNo']."\t";
				$data .= $row['clientName']."\t";
				$data .= $row['billAmount']."\t";
				$data .= $row['billPaid']."\t";
				$data .= $row['billBalance']."\n";
				
			}
			}
		}
		else if($flag == 'stockreport')
		{
			$filename = "Stock Report-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Item\t";
			$data.= "HSN\t";
			$data.= "Category\t";
			$data.= "Brand\t";
			$data.= "Tax\t";
			$data.= "Available\n";
			
			$i=0;			
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['itemName'].' '.$row['brandName']."\t";
				$data .= $row['itemHSN']."\t";
				$data .= $row['catName']."\t";
				$data .= $row['brandName']."\t";
				$data .= $row['taxPercentage']."%\t";
				$data .= $row['stockQty']."\n";
				
			}
			}
		}
		else if($flag == 'stockdamagereport')
		{
			$filename = "Stock Damage Report-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Item\t";
			$data.= "HSN\t";
			$data.= "Category\t";
			$data.= "Brand\t";
			$data.= "Available\t";
			$data.= "Damage\n";
			$i=0;			
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['itemName'].' '.$row['brandName']."\t";
				$data .= $row['itemHSN']."\t";
				$data .= $row['catName']."\t";
				$data .= $row['brandName']."\t";
				$data .= $row['stockQty']."\t";
				$data .= $row['damageItems']."\n";
			}
			}
		}
		else if($flag == 'salereport')
		{
			$filename = "Sales Report-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Item\t";
			$data.= "HSN\t";
			$data.= "Brand\t";
			$data.= "Total Sales\t";
			$data.= "Total Earn\n";
			
			$i=0;	
			$sumcount = 0;	
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['itemName'].' '.$row['brandName']."\t";
				$data .= $row['itemHSN']."\t";
				$data .= $row['brandName']."\t";
				$data .= $row['count']."%\t";
				$itemprice = $row['itemPrice']*$row['count'];
				$data .= $itemprice."\n";
				$sumcount += $itemprice;
				
			}
			$data.= "\t";
			$data.= "\t";
			$data.= "\t";
			$data.= "\t";
			$data.= "Total\t";
			$data.= $sumcount."\n";
			}
		}
		else if($flag == 'profitreport')
		{
			$filename = "Sales Report-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Bill Date\t";
			$data.= "Bill No\t";
			$data.= "Profit\n";
			
			$i=0;	
			$sumcount = 0;	
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['billDate']."\t";
				$data .= $row['itemBillNo']."\t";
				$data .= $row['profit']."%\n";
				$sumcount += $row['profit'];
				
			}
			$data.= "\t";
			$data.= "\t";
			$data.= "Total\t";
			$data.= $sumcount."\n";
			}
		}
		else if($flag == 'taxreport')
		{
			$filename = "GST Report-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Bill No\t";
			$data.= "Bill Date\t";
			$data.= "GST\n";
			
			$i=0;	
			$sumcount = 0;	
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['itemBillNo']."\t";
				$data .= $row['billDate']."\t";
				$data .= $row['gst']."%\n";
				$sumcount += $row['gst'];
				
			}
			$data.= "\t";
			$data.= "\t";
			$data.= "Total\t";
			$data.= $sumcount."\n";
			}
		}
		else if($flag == 'paymentreport')
		{
			$filename = "Payment Report-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Bill No\t";
			$data.= "Client Name\t";
			$data.= "Payment Date\t";
			$data.= "Bill Date\t";
			$data.= "Amount Paid\n";
			
			$i=0;	
			$sumcount = 0;	
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['billOrderNo']."\t";
				$data .= $row['clientName']."\t";
				$data .= $row['paymentDate']."\t";
				$data .= $row['billDate']."\t";
				$data .= $row['paymentAmount']."\n";
				$sumcount += $row['paymentAmount'];
				
			}
			$data.= "\t";
			$data.= "\t";
			$data.= "\t";
			$data.= "\t";
			$data.= "Total\t";
			$data.= $sumcount."\n";
			}
		}
		else if($flag == 'pendingreport')
		{
			$filename = "Pending Report-".date('d-m-Y h:i:s');
			header("Content-type: application/octet-stream");
			header("Content-Disposition: attachment; filename=$filename.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			$query = $_GET['query'];
			$query = stripslashes($query);
			$stmt = $db->prepare($query);
			$stmt->execute();
			$data = "";
			if($stmt->rowCount()>0)
			{
			$data.= "Sl.No\t";
			$data.= "Bill No\t";
			$data.= "Client Name\t";
			$data.= "Bill Date\t";
			$data.= "Balance\n";
			
			$i=0;	
			$sumcount = 0;	
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$data .= $i."\t";
				$data .= $row['billOrderNo']."\t";
				$data .= $row['clientName']."\t";
				$data .= $row['billDate']."\t";
				$data .= $row['billBalance']."\n";
				$sumcount += $row['billBalance'];
				
			}
			$data.= "\t";
			$data.= "\t";
			$data.= "\t";
			$data.= "Total\t";
			$data.= $sumcount."\n";
			}
		}
	echo $data;
	exit();
?>