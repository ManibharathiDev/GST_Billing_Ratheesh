<?php
	include('includes/config.php');
	require('fpdf/fpdf.php');
	$currentstate = 33;
	$billstate = 0;
	$clientstatus = $_GET['clientstatus'];
	if(isset($_GET['myname']))
	{
		$myname = $_GET['myname'];
	}
	$cquery = "SELECT * FROM tbl_company tc INNER JOIN tbl_state ts on ts.stateDigit = tc.compState";
	$cstmt = $db->prepare($cquery);
	$cstmt->execute();
	$crow = $cstmt->fetch(PDO::FETCH_ASSOC);
	if(isset($_GET['flag'])){
		$sno = $_GET['sno'];
		$squery = "SELECT billDate FROM tbl_bill WHERE billOrderNo = :billno";
		$sstmt = $db->prepare($squery);
		$sstmt->execute(array(":billno"=>$sno));
		$drow = $sstmt->fetch(PDO::FETCH_ASSOC);
	}
	$tdate = date('d-m-Y');
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
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}
	}
	$data = "";
		$pdf = new PDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetTopMargin(10);
		$pdf->SetFontSize(10);
		if($clientstatus == 1){
		$pdf->Cell(190,5,"Tax Invoice",1,1,'C');
		}
		else
		{
			$pdf->Cell(190,5,"Tax Estimate",1,1,'C');
		}
		$pdf->SetFontSize(20);
		$pdf->Cell(137,8,$crow['compName'],"LT",'C');
		$pdf->SetFontSize(10);
		if($clientstatus == 1){
		$pdf->Cell(20,8,"GSTIN No","LB.",'C');
		$pdf->Cell(2,8,": ","B",'C');
		$pdf->Cell(31,8,$crow['compGSTIN'],"RB",'C');
		
		}
		$pdf->Ln();
		$pdf->Cell(137,8,$crow['compAddress'].','.$crow['compCity'].','.$crow['stateName'].'-'.$crow['compPin'],"LB",'C');
		if($clientstatus == 1){
		$pdf->Cell(20,8,"State Code","LB",'C');
		$pdf->Cell(2,8,": ","B",'C');
		$pdf->Cell(31,8,'TN/33',"RB",'C');
		}
		$pdf->SetLineWidth(0);
		$pdf->SetFontSize(10);
		$pdf->Ln();
		if($clientstatus == 1){
		$pdf->Cell(25,8,"Invoice Date.","LB",'C');
		}
		else
		{$pdf->Cell(25,8,"Estimate Date.","LB",'C');
			
		}
		$pdf->Cell(2,8,": ","B",'C');
		if(isset($_GET['flag']))
		{
			$selectedDate = strtr($drow['billDate'], '/', '-');
			$selectedDate=date('d-m-Y',strtotime($selectedDate));
			$pdf->Cell(15,8,$selectedDate,0,'C');
		}
		else
		{
			$pdf->Cell(110,8,$tdate,"RB",'C');
		}
		if($clientstatus == 1){
		$pdf->Cell(20,8,"Invoice No.","LB",'C');
		}
		else
		{
			$pdf->Cell(20,8,"Estimate No.","LB",'C');
		}
		$sno = $_GET['sno'];
		$pdf->Cell(2,8,": ","B",'C');
		$pdf->Cell(31,8,$sno,"RB",'C');
		$pdf->Ln();
		$cusid = $_GET['cusid'];
		$csquery = "SELECT * FROM `tbl_client` WHERE clientId = :id";
		$cstmt = $db->prepare($csquery);
		$cstmt->bindparam(":id",$cusid);
		$cstmt->execute();
		$csrow = $cstmt->fetch(PDO::FETCH_ASSOC);
		$pdf->Cell(95,8,"Details of Receiver(Billed To)",1,'C');
		
		$pdf->Cell(95,8,"Details of Consignee(Shipped To)",1,'C');
		$pdf->Ln();
		$pdf->Cell(33,8,"Name","L",'C');
		$pdf->Cell(2,8,":","0",'C');
		$pdf->Cell(60,8,$csrow['clientName'],"0",'C');
		$pdf->Cell(33,8,"Name","L",'C');
		$pdf->Cell(2,8,":","0",'C');
		$pdf->Cell(60,8,$csrow['clientName'],"R",'C');
		$pdf->Ln();
		$pdf->Cell(33,8,"Address","L",'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->SetFontSize(8);
		$pdf->Cell(60,8,$csrow['clientBillingAdd'],0,'C');
		$pdf->SetFontSize(10);
		$pdf->Cell(33,8,"Address","L",'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->SetFontSize(8);
		$pdf->Cell(60,8,$csrow['clientShippingAdd'],"R",'C');
		$pdf->Ln();
		$pdf->SetFontSize(10);
		$pdf->Cell(33,8,"City","L",'C');
		$pdf->Cell(2,8,":",0,'C');
		$state = $csrow['clientBillingState'];
		$stquery = "SELECT * FROM tbl_state where stateDigit = :stdigit";
		$ststmt = $db->prepare($stquery);
		$ststmt->bindparam(":stdigit",$state);
		$ststmt->execute();
		$strow = $ststmt->fetch(PDO::FETCH_ASSOC);
		$pdf->Cell(60,8,$strow['stateName'],0,'C');
		$pdf->Cell(33,8,"City","L",'C');
		$pdf->Cell(2,8,":",0,'C');
		if($csrow['clientShipping'] == 0)
		{
			$pdf->Cell(60,8,$csrow['clientBillingCity'],"R",'C');
		}
		else
		{
			
			$pdf->Cell(60,8,$csrow['clientShippingCity'],"R",'C');
		}
		$pdf->Ln();
		$pdf->Cell(33,8,"State Code","L",'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(60,8,$strow['stateCode'].'/'.$strow['stateDigit'],0,'C');
		$pdf->Cell(33,8,"State Code","L",'C');
		$pdf->Cell(2,8,":",0,'C');
		if($csrow['clientShipping'] == 0)
		{
			$pdf->Cell(60,8,$strow['stateCode'].'/'.$strow['stateDigit'],"R",'C');
			$billstate = $strow['stateDigit'];
		}
		else
		{
			$cstate = $csrow['clientShippingState'];
			$cstquery = "SELECT * FROM tbl_state where stateDigit = :stdigit";
			$cststmt = $db->prepare($stquery);
			$cststmt->bindparam(":stdigit",$cstate);
			$cststmt->execute();
			$cstrow = $cststmt->fetch(PDO::FETCH_ASSOC);
			$pdf->Cell(60,8,$cstrow['stateCode'].'/'.$cstrow['stateDigit'],"R",'C');
			$billstate = $cstrow['stateDigit'];
		}
		$pdf->Ln();
		if($clientstatus == 1){
		$pdf->Cell(33,8,"GSTIN / Unique ID","L",'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(60,8,$csrow['clientGSTIN'],0,'C');
		$pdf->Cell(33,8,"GSTIN / Unique ID","L",'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(60,8,$csrow['clientGSTIN'],"R",'C');
		$pdf->Ln();
		}
		$pdf->SetFontSize(8);
		$pdf->Cell(10,8,"Sr.No",1,0,'C');
		$pdf->Cell(85,8,"Item Description",1,0,'C');
		$pdf->Cell(15,8,"HSN",1,0,'C');
		$pdf->Cell(10,8,"Qty.",1,0,'C');
		$pdf->Cell(16,8,"Rate.",1,0,'C');
		$pdf->Cell(15,8,"Discount.",1,0,'C');
		$pdf->Cell(15,8,"GST",1,0,'C');
		$pdf->Cell(24,8,"Amount",1,0,'C');
		$pdf->Ln();
		
		$itemid = $_GET['itemid'];
		$itemqty =$_GET['itemqty'];
		$itemprice = $_GET['itemprice'];
		$itemdis = $_GET['itemdis'];
		$itemtax = $_GET['itemtax'];
		$item = explode(',',$itemid);
		$qty = explode(',',$itemqty);
		$price = explode(',',$itemprice);
		$dis = explode(',',$itemdis);
		$tax = explode(',',$itemtax);
		$iquery = "SELECT ti.itemName,tb.brandName,ti.itemHSN FROM `tbl_stock` ts INNER JOIN `tbl_item` ti INNER JOIN `tbl_brand` tb ON ts.itemId = ti.itemId AND ts.brandId = tb.brandId WHERE ts.stockId = :productid";
		$tquery = "SELECT * FROM `tbl_tax` WHERE taxId = :taxid";
		$i = 0;
		$totalrate = 0;
		$totaldiscount = 0;
		$totataxvalue = 0;
		$totalcsgst = 0;
		$totaligst = 0;
		$gst = 0;
		$tqty = 0;
		$gst_zero = 0;
		$gst_five = 0;
		$gst_twelve = 0;
		$gst_eighteen = 0;
		$gst_teighteen = 0;
		$gvalue = 0;
		$atotal = 0; 
		foreach($item as $index => $value)
		{
			$i++;
			$istmt = $db->prepare($iquery);
			$pid = $item[$index];
			$istmt->bindparam(":productid",$pid);
			$istmt->execute();
			$row = $istmt->fetch(PDO::FETCH_ASSOC);
			$pdf->Cell(10,8,$i,1,'C');
		
		$pdf->Cell(85,8,$row['itemName'].' '.$row['brandName'],1,'C');
		$pdf->Cell(15,8,$row['itemHSN'],1,'C');
		$pdf->Cell(10,8,$qty[$index],1,0,'C');
		$tqty += $qty[$index];
		$pdf->Cell(16,8,$price[$index],1,0,'R');
		$total = $price[$index]*$qty[$index];
		$totalrate += $total;
		$totaldiscount += $dis[$index];
		$pdf->Cell(15,8,$dis[$index],1,0,'C');
		$tvalue = $total - $dis[$index];
		$totataxvalue += $tvalue;
			$tstmt = $db->prepare($tquery);
			$taxid = $tax[$index];
			$tstmt->bindparam(":taxid",$taxid);
			$tstmt->execute();
			$trow = $tstmt->fetch(PDO::FETCH_ASSOC);
			$taxrate = $trow['taxPercentage'];
			$ivalue = 0;
			$invalue = 0;
			$gvalue += ($tvalue/100)*$taxrate;
			if($taxrate == 0){
				$gst_zero += $tvalue;
			}
			else if($taxrate == 5){
				$gst_five += $tvalue;
			}
			else if($taxrate == 12){
				$gst_twelve += $tvalue;
			}
			else if($taxrate == 18){
				$gst_eighteen += $tvalue;
			}
			else if($taxrate == 28){
				$gst_teighteen += $tvalue;
			}
			if($currentstate == $billstate)
			{
				$irgst = $taxrate/2;
				$igst = 0;
				$ivalue = ($tvalue*$irgst)/100;
				$totalcsgst += $ivalue;
				$gst += ($ivalue+$ivalue);
				
			}
			else
			{
				$irgst = 0;
				$igst = $taxrate;
				$invalue = ($tvalue*$igst)/100;
				$totaligst += $invalue;
				$gst += $invalue;
			}
		
		$pdf->Cell(15,8,$taxrate.'%',1,0,'C');
		$tamount = $tvalue;
		$atotal += $tvalue;
		$tvalue = (($tvalue/100)*$taxrate)+$tvalue;
		$pdf->Cell(24,8,number_format((float)$tvalue, 2, '.', ''),1,0,'R');
		$pdf->Ln();
		}
		/*$pdf->Cell(10,8,"",1,'C');
		$pdf->Cell(85,8,"IGST",1,0,'R');
		$pdf->Cell(71,8,"",1,0,'R');
		$pdf->Cell(24,8,number_format((float)$totaligst, 2, '.', ''),1,0,'R');*/
		$atotal += $totaligst;
		/*$pdf->Ln();
		$pdf->Cell(10,8,"",1,'C');
		$pdf->Cell(85,8,"CGST",1,0,'R');
		$pdf->Cell(71,8,"",1,0,'R');
		$pdf->Cell(24,8,number_format((float)$totalcsgst, 2, '.', ''),1,0,'R');*/
		$atotal += $totalcsgst;
		/*$pdf->Ln();
		$pdf->Cell(10,8,"",1,'C');
		$pdf->Cell(85,8,"SGST",1,0,'R');
		$pdf->Cell(71,8,"",1,0,'R');
		$pdf->Cell(24,8,number_format((float)$totalcsgst, 2, '.', ''),1,0,'R');*/
		$atotal += $totalcsgst;
		//$pdf->Ln();
		$pdf->Cell(10,8,"",1,'C');
		$pdf->Cell(85,8,"Total",1,0,'R');
		$pdf->Cell(71,8,"",1,0,'R');
		$pdf->Cell(24,8,number_format((float)$atotal, 2, '.', ''),1,0,'R');
		$pdf->Ln();
		$pdf->Cell(95,8,"Total Invoice Value (In Words)",1,'C');
		$wtotal = convert_number_to_words($atotal);
		$pdf->Cell(95,8,$wtotal,1,'C');
		$pdf->Ln();
		$pdf->Cell(38,8,"Taxable Value",1,0,'C');
		$pdf->Cell(38,8,"CGST",1,0,'C');
		$pdf->Cell(38,8,"SGST",1,0,'C');
		$pdf->Cell(38,8,"IGST",1,0,'C');
		$pdf->Cell(38,8,"TOTAL Inc. TAX",1,0,'C');
		$pdf->Ln();
		$gtax_total = 0;
		$cgst_total = 0;
		$sgst_total = 0;
		$igst_total = 0;
		$taxvalue_total = 0;
		if($currentstate == $billstate)
		{
				if($gst_zero != 0)
				{
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_zero, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_zero;
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(38,8,"0.00",1,0,'R');
					
					$pdf->Ln();
				}
				if($gst_five != 0)
				{
					$pdf->Cell(10,8,"5%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_five, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_five;
					$pdf->Cell(10,8,"2.5%",1,0,'C');
					$cgst = ($gst_five/100)*2.5;
					$cgst_total += $cgst;
					$sgst_total += $cgst;
					$pdf->Cell(28,8,number_format((float)$cgst, 2, '.', ''),1,0,'C');
					$pdf->Cell(10,8,"2.5%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$cgst, 2, '.', ''),1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(38,8,number_format((float)$gst_five+($cgst*2), 2, '.', ''),1,0,'R');
					$taxvalue_total+=$gst_five+($cgst*2);
					$pdf->Ln();
				}
				if($gst_twelve != 0)
				{
					$pdf->Cell(10,8,"12%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_twelve, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_twelve;
					$pdf->Cell(10,8,"6%",1,0,'C');
					$cgst = ($gst_twelve/100)*6;
					$cgst_total += $cgst;
					$sgst_total += $cgst;
					$pdf->Cell(28,8,number_format((float)$cgst, 2, '.', ''),1,0,'C');
					$pdf->Cell(10,8,"6%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$cgst, 2, '.', ''),1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(38,8,number_format((float)$gst_twelve+($cgst*2), 2, '.', ''),1,0,'R');
					$taxvalue_total+=$gst_twelve+($cgst*2);
					$pdf->Ln();
				}
				if($gst_eighteen != 0)
				{
					$pdf->Cell(10,8,"18%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_eighteen, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_eighteen;
					$pdf->Cell(10,8,"9%",1,0,'C');
					$cgst = ($gst_eighteen/100)*9;
					$cgst_total += $cgst;
					$sgst_total += $cgst;
					$pdf->Cell(28,8,number_format((float)$cgst, 2, '.', ''),1,0,'C');
					$pdf->Cell(10,8,"9%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$cgst, 2, '.', ''),1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(38,8,number_format((float)$gst_eighteen+($cgst*2), 2, '.', ''),1,0,'R');
					$taxvalue_total+=$gst_eighteen+($cgst*2);
					$pdf->Ln();
				}
				if($gst_teighteen != 0)
				{
					$pdf->Cell(10,8,"28%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_teighteen, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_teighteen;
					$pdf->Cell(10,8,"14%",1,0,'C');
					$cgst = ($gst_teighteen/100)*14;
					$cgst_total += $cgst;
					$sgst_total += $cgst;
					$pdf->Cell(28,8,number_format((float)$cgst, 2, '.', ''),1,0,'C');
					$pdf->Cell(10,8,"14%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$cgst, 2, '.', ''),1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(38,8,number_format((float)$gst_teighteen+($cgst*2), 2, '.', ''),1,0,'R');
					$taxvalue_total+=$gst_teighteen+($cgst*2);
					$pdf->Ln();
				}
		}
		else
		{
				if($gst_zero != 0)
				{
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_zero, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_zero;
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(38,8,"0.00",1,0,'R');
					$pdf->Ln();
				}
				if($gst_five != 0)
				{
					$pdf->Cell(10,8,"5%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_five, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_five;
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"5%",1,0,'C');
					$igst = ($gst_five/100)*5;
					$igst_total+=$igst;
					$pdf->Cell(28,8,number_format((float)$igst, 2, '.', ''),1,0,'C');
					$pdf->Cell(38,8,number_format((float)$gst_five+$igst, 2, '.', ''),1,0,'R');
					$taxvalue_total+=$gst_five+$igst;
					$pdf->Ln();
				}
				if($gst_twelve != 0)
				{
					$pdf->Cell(10,8,"12%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_twelve, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_twelve;
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"12%",1,0,'C');
					$igst = ($gst_twelve/100)*12;
					$igst_total+=$igst;
					$pdf->Cell(28,8,number_format((float)$igst, 2, '.', ''),1,0,'C');
					$pdf->Cell(38,8,number_format((float)$gst_twelve+$igst, 2, '.', ''),1,0,'R');
					$taxvalue_total+=$gst_twelve+$igst;
					$pdf->Ln();
				}
				if($gst_eighteen != 0)
				{
					$pdf->Cell(10,8,"18%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_eighteen, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_eighteen;
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"18%",1,0,'C');
					$igst = ($gst_eighteen/100)*18;
					$igst_total+=$igst;
					$pdf->Cell(28,8,$igst,1,0,'C');
					$pdf->Cell(38,8,$gst_eighteen+$igst,1,0,'R');
					$taxvalue_total+=$gst_eighteen+$igst;
					$pdf->Ln();
				}
				if($gst_teighteen != 0)
				{
					$pdf->Cell(10,8,"28%",1,0,'C');
					$pdf->Cell(28,8,number_format((float)$gst_teighteen, 2, '.', ''),1,0,'C');
					$gtax_total += $gst_teighteen;
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"0%",1,0,'C');
					$pdf->Cell(28,8,"0.00",1,0,'C');
					$pdf->Cell(10,8,"28%",1,0,'C');
					$igst = ($gst_teighteen/100)*28;
					$igst_total+=$igst;
					$pdf->Cell(28,8,number_format((float)$igst, 2, '.', ''),1,0,'C');
					$pdf->Cell(38,8,number_format((float)$gst_teighteen+$igst, 2, '.', ''),1,0,'R');
					$taxvalue_total+=$gst_teighteen+$igst;
					$pdf->Ln();
				}
		}
		
		$pdf->Cell(10,8,"Total",1,0,'C');
		$pdf->Cell(28,8,number_format((float)$gtax_total, 2, '.', ''),1,0,'R');
		$pdf->Cell(38,8,number_format((float)$cgst_total, 2, '.', ''),1,0,'R');
		$pdf->Cell(38,8,number_format((float)$sgst_total, 2, '.', ''),1,0,'R');
		$pdf->Cell(38,8,number_format((float)$igst_total, 2, '.', ''),1,0,'R');
		$pdf->Cell(38,8,number_format((float)$taxvalue_total, 2, '.', ''),1,0,'R');
		$pdf->Ln();
		/*$pdf->Cell(10,8,"",1,'C');
		$pdf->Cell(55,8,"Total Quantity(Nos)",1,'C');
		$pdf->Cell(10,8,$tqty,1,'C');
		$pdf->Cell(10,8,"Total",1,'C');
		$pdf->Cell(10,8,$totalrate,1,'C');
		$pdf->Cell(15,8,$totaldiscount,1,'C');
		$pdf->Cell(21,8,$totataxvalue,1,'C');
		$pdf->Cell(21,8,$totalcsgst,1,0,'C');
		$pdf->Cell(21,8,$totalcsgst,1,0,'C');
		$pdf->Cell(21,8,$totaligst,1,0,'C');*/
		$gtotal = $totataxvalue + $gst;
		
		$pdf->Cell(95,8,"",1,'C');
		$tpaid = $_GET['paidamount'];
		if($tpaid == "")
		{
			$tpaid = 0.00;
		}
		$pdf->Cell(57,8,"Total Paid",1,'C');
		$pdf->Cell(38,8,number_format((float)$tpaid, 2, '.', ''),1,0,'R');
		$pdf->Ln();
		$pdf->Cell(95,8,"",1,'C');
		$balance = $gtotal - $tpaid;
		$pdf->Cell(57,8,"Balance",1,'C');
		$pdf->Cell(38,8,number_format((float)$balance, 2, '.', ''),1,0,'R');
		$pdf->Ln();
		/*$pdf->Cell(110,8,"Amount of Tax Subject to Reverse Charges",1,'C');
		
		$pdf->Cell(21,8,"",1,'C');
		$pdf->Cell(21,8,"",1,0,'C');
		$pdf->Cell(21,8,"",1,0,'C');
		$pdf->Cell(21,8,"",1,0,'C');
		$pdf->Ln();*/
		$pdf->Ln();
		$pdf->Cell(0,8,"Declaration:",0,'C');
		$pdf->Ln();
		$pdf->Cell(0,8,"We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct",0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(100,8,"Name of the Signature",0,'R');
		$pdf->Output();
		
		function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'Zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}
?>