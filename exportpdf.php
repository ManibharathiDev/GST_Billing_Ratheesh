<?php
	include('includes/config.php');
	require('fpdf/fpdf.php');
	
	class PDF extends FPDF
	{
		function Header()
		{
		$this->SetFont('Arial','B',12);
		}
		// Page footer
		function Footer()
		{
			// Position at 1.5 cm from bottom
			$this->SetY(-15);
			// Arial italic 8
			$this->SetFont('Arial','I',8);
			// Page number
			$this->Cell(0,5,'Page '.$this->PageNo(),0,0,'C');
			$this->Ln();
			$this->Cell(0,5,date('d-m-Y H:i:s'),0,0,'C');
		}
	}
		$query = $_GET['query'];
		$query = stripslashes($query);
		//echo $query;
		$stmt = $db->prepare($query);
		$stmt->execute();
	    $data = "";
		$pdf = new PDF('P','mm','A4');
		//$pdf = new FPDF('P','mm','A4');
		$flag = $_GET['flag'];
		$cquery = "SELECT * FROM `tbl_company`";
		$cstmt = $db->prepare($cquery);
		$cstmt->execute();
		$crow = $cstmt->fetch(PDO::FETCH_ASSOC);
		$compName = $crow['compName'];
		if($flag == 'brand')
		{
		$pdf->AddPage();
		$pdf->Cell(190,10,$crow['compName'],0,0,'C');
		$pdf->Ln();
		$pdf->Cell(190,10,"List of Brands",0,0,'C');
		$pdf->Ln();
		if($stmt->rowCount()>0)
		{
			
			$pdf->Cell(15,8,"Sl.No",1,'C');
			$pdf->Cell(47,8,"Brand Name",1,'C');
			$pdf->Cell(47,8,"Short Name",1,'C');
			$pdf->Cell(47,8,"Description",1,'C');
			$pdf->Cell(34,8,"Status",1,'C');
			$i=0;					
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				
				$pdf->SetFont('Arial','',10);
				$pdf->Ln();
				$pdf->Cell(15,8,$i,1);
				$pdf->Cell(47,8,$row['brandName'],1);
				$pdf->Cell(47,8,$row['brandShort'],1);
				$pdf->Cell(47,8,$row['brandDescription'],1);
				if($row['brandStatus'] == 1)
				{
					$status = "Active";
				}
				else
				{
					$status = "In-Active";
				}
				$pdf->Cell(34,8,$status,1);
			}
			
			
		}
		}
		else if($flag == 'cat')
		{
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"List of Category",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
		{
			
			$pdf->Cell(15,8,"Sl.No",1,'C');
			$pdf->Cell(47,8,"Category Name",1,'C');
			$pdf->Cell(47,8,"Short Name",1,'C');
			$pdf->Cell(47,8,"Description",1,'C');
			$pdf->Cell(34,8,"Status",1,'C');
			$i=0;					
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',10);
				$pdf->Ln();
				$pdf->Cell(15,8,$i,1);
				$pdf->Cell(47,8,$row['catName'],1);
				$pdf->Cell(47,8,$row['catShort'],1);
				$pdf->Cell(47,8,$row['catDescription'],1);
				if($row['catStatus'] == 1)
				{
					$status = "Active";
				}
				else
				{
					$status = "In-Active";
				}
				$pdf->Cell(34,8,$status,1);
			}	
		}
		}
		else if($flag == 'item')
		{
			
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"List of Items",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
			{
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(35);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Item Name",1,'C');
			$pdf->Cell(18,8,"Short Name",1,'C');
			$pdf->Cell(30,8,"Description",1,'C');
			$pdf->Cell(25,8,"HSN",1,'C');
			$i=0;					
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(35);
				$pdf->Cell(12,8,$i,1);
				$pdf->Cell(30,8,$row['itemName'],1);
				$pdf->Cell(18,8,$row['itemShort'],1);
				$pdf->Cell(30,8,$row['itemDescription'],1);
				$pdf->Cell(25,8,$row['itemHSN'],1);
			}	
		}
		}
		else if($flag == 'client')
		{
			
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"List of Clients",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
		{
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Client Name",1,'C');
			$pdf->Cell(25,8,"Contact Name",1,'C');
			$pdf->Cell(30,8,"Phone",1,'C');
			$pdf->Cell(30,8,"Email",1,'C');
			$pdf->Cell(25,8,"GSTIN",1,'C');
			$pdf->Cell(15,8,"Status",1,'C');
			$i=0;					
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(12,8,$i,1);
				$pdf->Cell(30,8,$row['clientName'],1);
				$pdf->Cell(25,8,$row['clientcontactName'],1);
				$pdf->Cell(30,8,$row['clientPhone'],1);
				$pdf->Cell(30,8,$row['clientEmail'],1);
				$pdf->Cell(25,8,$row['clientGSTIN'],1);
				if($row['clientStatus'] == 1)
				{
					$status = "Active";
				}
				else
				{
					$status = "In-Active";
				}
				$pdf->Cell(15,8,$status,1);
			}	
		}
		}
		else if($flag == 'tax')
		{
			
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"List of Tax",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
		{
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(32);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Tax Name",1,'C');
			$pdf->Cell(25,8,"Description",1,'C');
			$pdf->Cell(30,8,"Percentage",1,'C');
			$pdf->Cell(30,8,"Status",1,'C');
			$i=0;					
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(32);
				$pdf->Cell(12,8,$i,1);
				$pdf->Cell(30,8,$row['taxName'],1);
				$pdf->Cell(25,8,$row['taxDescription'],1);
				$pdf->Cell(30,8,$row['taxPercentage'],1);
				if($row['taxStatus'] == 1)
				{
					$status = "Active";
				}
				else
				{
					$status = "In-Active";
				}
				$pdf->Cell(30,8,$status,1);
			}	
		}
		}
		else if($flag == 'order')
		{
			
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"List of Orders",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
		{
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(15);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Bill No",1,'C');
			$pdf->Cell(25,8,"Client Name",1,'C');
			$pdf->Cell(30,8,"Amount",1,'C');
			$pdf->Cell(30,8,"Paid",1,'C');
			$pdf->Cell(30,8,"Balance",1,'C');
			$i=0;					
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(15);
				$pdf->Cell(12,8,$i,1);
				$pdf->Cell(30,8,$row['billOrderNo'],1);
				$pdf->Cell(25,8,$row['clientName'],1);
				$pdf->Cell(30,8,number_format((float)$row['billAmount'], 2, '.', ''),1);
				$pdf->Cell(30,8,number_format((float)$row['billPaid'], 2, '.', ''),1);
				$pdf->Cell(30,8,number_format((float)$row['billBalance'], 2, '.', ''),1);
			}	
		}
		}
		else if($flag == 'supplier'){
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"List of Suppliers",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
		{
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Supplier Name",1,'C');
			$pdf->Cell(25,8,"Contact Name",1,'C');
			$pdf->Cell(20,8,"Phone",1,'C');
			$pdf->Cell(30,8,"Email",1,'C');
			$pdf->Cell(20,8,"GSTIN",1,'C');
			$pdf->Cell(18,8,"PAN",1,'C');
			$pdf->Cell(20,8,"City",1,'C');
			$pdf->Cell(15,8,"State",1,'C');
			$i=0;					
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',6);
				$pdf->Ln();
				$pdf->Cell(12,8,$i,1);
				$pdf->Cell(30,8,$row['supplierName'],1);
				$pdf->Cell(25,8,$row['supplierContactName'],1);
				$pdf->Cell(20,8,$row['supplierPhone'],1);
				$pdf->Cell(30,8,$row['supplierEmail'],1);
				$pdf->Cell(20,8,$row['supplierGSTIN'],1);
				$pdf->Cell(18,8,$row['supplierPAN'],1,'C');
				$pdf->Cell(20,8,$row['supplierCity'],1,'C');
				$pdf->Cell(15,8,$row['stateName'],1,'C');
					
			}	
		}
		}
		else if($flag == 'stockreport')
		{
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"Stock Report",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
			{
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(1);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Item",1,'C');
			$pdf->Cell(30,8,"HSN",1,'C');
			$pdf->Cell(25,8,"Category",1,'C');
			$pdf->Cell(30,8,"Brand",1,'C');
			$pdf->Cell(30,8,"Tax",1,'C');
			$pdf->Cell(30,8,"Available",1,'C');
			$i=0;					
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(1);
				$pdf->Cell(12,8,$i,1);
				$pdf->Cell(30,8,$row['itemName'].' '.$row['brandName'],1);
				$pdf->Cell(30,8,$row['itemHSN'],1);
				$pdf->Cell(25,8,$row['catName'],1);
				$pdf->Cell(30,8,$row['brandName'],1);
				$pdf->Cell(30,8,$row['taxPercentage'].'%',1);
				$pdf->Cell(30,8,$row['stockQty'],1);
			}	
			}
		}
		else if($flag == 'stockdamagereport')
		{
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"Stock Report",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
			{
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(1);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Item",1,'C');
			$pdf->Cell(30,8,"HSN",1,'C');
			$pdf->Cell(25,8,"Category",1,'C');
			$pdf->Cell(30,8,"Brand",1,'C');
			$pdf->Cell(30,8,"Available",1,'C');
			$pdf->Cell(30,8,"Damage",1,'C');
			$i=0;					
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(1);
				$pdf->Cell(12,8,$i,1);
				$pdf->Cell(30,8,$row['itemName'].' '.$row['brandName'],1);
				$pdf->Cell(30,8,$row['itemHSN'],1);
				$pdf->Cell(25,8,$row['catName'],1);
				$pdf->Cell(30,8,$row['brandName'],1);
				$pdf->Cell(30,8,$row['stockQty'],1);
				$pdf->Cell(30,8,$row['damageItems'],1);
			}	
			}
		}
		else if($flag == 'salereport')
		{
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"Sales Report",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
			{
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(15);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Item",1,'C');
			$pdf->Cell(30,8,"HSN",1,'C');
			$pdf->Cell(30,8,"Brand",1,'C');
			$pdf->Cell(30,8,"Total Sales",1,'C');
			$pdf->Cell(30,8,"Total Earn",1,'C');
			$i=0;	
			$sumcount = 0;				
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(15);
				$pdf->Cell(12,8,$i,1,'C');
				$pdf->Cell(30,8,$row['itemName'].' '.$row['brandName'],1);
				$pdf->Cell(30,8,$row['itemHSN'],1);
				$pdf->Cell(30,8,$row['brandName'],1);
				$pdf->Cell(30,8,$row['count'],1);
				$itemprice = $row['itemPrice'];
				$pdf->Cell(30,8,number_format((float)$itemprice+$row['gst'], 2, '.', ''),1);
				$sumcount += ($itemprice+$row['gst']);
			}	
			$pdf->Ln();
			$pdf->Cell(15);
			$pdf->Cell(12,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"Total",1,'C');
			$pdf->Cell(30,8,number_format((float)$sumcount, 2, '.', ''),1,'C');
			}
		}
		else if($flag == 'profitreport')
		{
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"Profit Report",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
			{
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(45);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Bill Date",1,'C');
			$pdf->Cell(30,8,"Bill No",1,'C');
			$pdf->Cell(30,8,"Profit",1,'C');
			$i=0;	
			$sumcount = 0;				
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(45);
				$pdf->Cell(12,8,$i,1,'C');
				$pdf->Cell(30,8,$row['billDate'],1);
				$pdf->Cell(30,8,$row['itemBillNo'],1);
				$pdf->Cell(30,8,number_format((float)$row['profit'], 2, '.', ''),1);
				$sumcount += $row['profit'];
			}	
			$pdf->Ln();
			$pdf->Cell(45);
			$pdf->Cell(12,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"Total",1,'C');
			$pdf->Cell(30,8,number_format((float)$sumcount, 2, '.', ''),1,'C');
			}
		}
		else if($flag == 'taxreport')
		{
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"GST Report",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
			{
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(45);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Bill No",1,'C');
			$pdf->Cell(30,8,"Bill Date",1,'C');
			$pdf->Cell(30,8,"GST",1,'C');
			$i=0;	
			$sumcount = 0;				
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(45);
				$pdf->Cell(12,8,$i,1,'C');
				$pdf->Cell(30,8,$row['itemBillNo'],1);
				$pdf->Cell(30,8,$row['billDate'],1);
				$pdf->Cell(30,8,number_format((float)$row['gst'], 2, '.', ''),1);
				$sumcount += $row['gst'];
			}	
			$pdf->Ln();
			$pdf->Cell(45);
			$pdf->Cell(12,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"Total",1,'C');
			$pdf->Cell(30,8,number_format((float)$sumcount, 2, '.', ''),1,'C');
			}
		}
		else if($flag == 'paymentreport')
		{
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"Payment Report",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
			{
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(15);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Bill No",1,'C');
			$pdf->Cell(30,8,"Client Name",1,'C');
			$pdf->Cell(30,8,"Payment Date",1,'C');
			$pdf->Cell(30,8,"Bill Date",1,'C');
			$pdf->Cell(30,8,"Amount Paid",1,'C');
			$i=0;	
			$sumcount = 0;				
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(15);
				$pdf->Cell(12,8,$i,1,'C');
				$pdf->Cell(30,8,$row['billOrderNo'],1);
				$pdf->Cell(30,8,$row['clientName'],1);
				$pdf->Cell(30,8,$row['paymentDate'],1);
				$pdf->Cell(30,8,$row['billDate'],1);
				$pdf->Cell(30,8,number_format((float)$row['paymentAmount'], 2, '.', ''),1);
				$sumcount += $row['paymentAmount'];
			}	
			$pdf->Ln();
			$pdf->Cell(15);
			$pdf->Cell(12,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"Total",1,'C');
			$pdf->Cell(30,8,number_format((float)$sumcount, 2, '.', ''),1,'C');
			}
		}
		else if($flag == 'pendingreport')
		{
			$pdf->AddPage();
			$pdf->Cell(190,10,$crow['compName'],0,0,'C');
			$pdf->Ln();
			$pdf->Cell(190,10,"Pending Report",0,0,'C');
			$pdf->Ln();
			if($stmt->rowCount()>0)
			{
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(30);
			$pdf->Cell(12,8,"Sl.No",1,'C');
			$pdf->Cell(30,8,"Bill No",1,'C');
			$pdf->Cell(30,8,"Client Name",1,'C');
			$pdf->Cell(30,8,"Bill Date",1,'C');
			$pdf->Cell(30,8,"Balance",1,'C');
			$i=0;	
			$sumcount = 0;				
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$i++;
				$pdf->SetFont('Arial','',8);
				$pdf->Ln();
				$pdf->Cell(30);
				$pdf->Cell(12,8,$i,1,'C');
				$pdf->Cell(30,8,$row['billOrderNo'],1);
				$pdf->Cell(30,8,$row['clientName'],1);
				$pdf->Cell(30,8,$row['billDate'],1);
				$pdf->Cell(30,8,number_format((float)$row['billBalance'], 2, '.', ''),1);
				$sumcount += $row['billBalance'];
			}	
			$pdf->Ln();
			$pdf->Cell(30);
			$pdf->Cell(12,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"",1,'C');
			$pdf->Cell(30,8,"Total",1,'C');
			$pdf->Cell(30,8,number_format((float)$sumcount, 2, '.', ''),1,'C');
			}
		}
	$pdf->Output();
	
?>