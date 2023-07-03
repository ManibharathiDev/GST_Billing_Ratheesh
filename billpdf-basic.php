<?php
    ob_start();
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
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}
	}
	$data = "";
		$pdf = new PDF('P','mm','A4');
		//$pdf = new FPDF('L','mm','A4');
		$pdf->AddPage();
		$pdf->SetFontSize(25);
		$pdf->Cell(145,8,$crow['compName'],0,'C');
		$pdf->SetFontSize(10);
		if($clientstatus == 1){
		$pdf->Cell(20,8,"GSTIN No",0,'C');
		$pdf->Cell(2,8,": ",0,'C');
		$pdf->Cell(15,8,$crow['compGSTIN'],0,'C');
		}
		$pdf->Ln();
		$pdf->Cell(145,8,$crow['compAddress'].','.$crow['compCity'].','.$crow['stateName'].'-'.$crow['compPin'],0,'C');
		if($clientstatus == 1){
		$pdf->Cell(20,8,"State Code",0,'C');
		$pdf->Cell(2,8,": ",0,'C');
		$pdf->Cell(15,8,'TN/33',0,'C');
		}
		$pdf->SetLineWidth(0);
		$pdf->Ln();
		$pdf->Line(10,30,205,30);
		$pdf->SetLineWidth(0);
		$pdf->SetFontSize(10);
		$pdf->Ln();
		$pdf->Cell(25,8,"Bill Date.",0,'C');
		$pdf->Cell(2,8,": ",0,'C');
		if(isset($_GET['flag'])){
			$selectedDate = strtr($drow['billDate'], '/', '-');
			$selectedDate=date('d-m-Y',strtotime($selectedDate));
			$pdf->Cell(15,8,$selectedDate,0,'C');
		}
		else
		{
		$pdf->Cell(15,8,$tdate,0,'C');
		}
		$pdf->Cell(100,8,"",0,'C');
		$pdf->Cell(25,8,"Invoice No.",0,'C');
		$sno = $_GET['sno'];
		$pdf->Cell(2,8,": ",0,'C');
		$pdf->Cell(15,8,$sno,0,'C');
		$pdf->Ln();
		$cusid = $_GET['cusid'];
		$csquery = "SELECT * FROM `tbl_client` WHERE clientId = :id";
		$cstmt = $db->prepare($csquery);
		$cstmt->bindparam(":id",$cusid);
		$cstmt->execute();
		$csrow = $cstmt->fetch(PDO::FETCH_ASSOC);
		$pdf->Cell(65,8,"Details of Receiver(Billed To)",0,'C');
		$pdf->Cell(50,8,"",0,'C');
		$pdf->Cell(70,8,"Details of Consignee(Shipped To)",0,'C');
		$pdf->Ln();
		$pdf->Cell(33,8,"Name",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(80,8,$csrow['clientName'],0,'C');
		$pdf->Cell(33,8,"Name",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(80,8,$csrow['clientName'],0,'C');
		$pdf->Ln();
		$pdf->Cell(33,8,"Address",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(80,8,$csrow['clientBillingAdd'],0,'C');
		$pdf->Cell(33,8,"Address",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(80,8,$csrow['clientShippingAdd'],0,'C');
		$pdf->Ln();
		$pdf->Cell(33,8,"State",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		$state = $csrow['clientBillingState'];
		$stquery = "SELECT * FROM tbl_state where stateDigit = :stdigit";
		$ststmt = $db->prepare($stquery);
		$ststmt->bindparam(":stdigit",$state);
		$ststmt->execute();
		$strow = $ststmt->fetch(PDO::FETCH_ASSOC);
		$pdf->Cell(80,8,$strow['stateName'],0,'C');
		$pdf->Cell(33,8,"State",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		if($csrow['clientShipping'] == 0)
		{
			$pdf->Cell(80,8,$strow['stateName'],0,'C');
		}
		else
		{
			$cstate = $csrow['clientShippingState'];
			$cstquery = "SELECT * FROM tbl_state where stateDigit = :stdigit";
			$cststmt = $db->prepare($stquery);
			$cststmt->bindparam(":stdigit",$cstate);
			$cststmt->execute();
			$cstrow = $cststmt->fetch(PDO::FETCH_ASSOC);
			$pdf->Cell(80,8,$cstrow['stateName'],0,'C');
		}
		$pdf->Ln();
		if($clientstatus == 1){
		$pdf->Cell(33,8,"State Code",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(80,8,$strow['stateCode'].'/'.$strow['stateDigit'],0,'C');
		$pdf->Cell(33,8,"State Code",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		if($csrow['clientShipping'] == 0)
		{
			$pdf->Cell(80,8,$strow['stateCode'].'/'.$strow['stateDigit'],0,'C');
			$billstate = $strow['stateDigit'];
		}
		else
		{
			$pdf->Cell(80,8,$strow['stateCode'].'/'.$strow['stateDigit'],0,'C');
			$billstate = $cstrow['stateDigit'];
		}
		$pdf->Ln();
		$pdf->Cell(33,8,"GSTIN / Unique ID",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(80,8,$csrow['clientGSTIN'],0,'C');
		$pdf->Cell(33,8,"GSTIN / Unique ID",0,'C');
		$pdf->Cell(2,8,":",0,'C');
		$pdf->Cell(80,8,$csrow['clientGSTIN'],0,'C');
		
		$pdf->Ln();
		$pdf->Ln();
		}
		
		$pdf->SetFontSize(8);
		$pdf->Cell(10,16,"Sr.No",1,0,'C');
		$pdf->Cell(40,16,"Item Description",1,0,'C');
		$pdf->Cell(15,16,"HSN",1,0,'C');
		$pdf->Cell(10,16,"Qty.",1,0,'C');
		/*$pdf->Cell(10,16,"Unit.",1,0,'C');*/
		$pdf->Cell(10,16,"Rate.",1,0,'C');
		$pdf->Cell(10,16,"Total.",1,0,'C');
		$pdf->Cell(15,16,"Discount.",1,0,'C');
		$pdf->Cell(21,16,"Taxable Value.",1,0,'C');
		$pdf->Cell(21,8,"CGST",1,0,'C');
		$pdf->Cell(21,8,"SGST",1,0,'C');
		$pdf->Cell(21,8,"IGST",1,0,'C');
		$pdf->Ln();
		$pdf->Cell(10,8,"",0,'C');
		$pdf->Cell(30,8,"",0,'C');
		$pdf->Cell(15,8,"",0,'C');
		$pdf->Cell(10,8,"",0,'C');
		$pdf->Cell(10,8,"",0,'C');
		$pdf->Cell(10,8,"",0,'C');
		$pdf->Cell(10,8,"",0,'C');
		$pdf->Cell(15,8,"",0,'C');
		$pdf->Cell(21,8,"",0,'C');
		$pdf->Cell(10,8,"Rate",1,0,'C');
		$pdf->Cell(11,8,"Amt.",1,0,'C');
		$pdf->Cell(10,8,"Rate",1,0,'C');
		$pdf->Cell(11,8,"Amt.",1,0,'C');
		$pdf->Cell(10,8,"Rate",1,0,'C');
		$pdf->Cell(11,8,"Amt.",1,0,'C');
		$pdf->Ln();
		
		$itemid = $_GET['itemid'];
		$itemqty =$_GET['itemqty'];
		$itemprice = $_GET['itemprice'];
		$itemdis = $_GET['itemdis'];
		$itemdismode = $_GET['itemdismode'];
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
		//$x = $pdf->GetX();
	//$y = $pdf->GetY();
		foreach($item as $index => $value)
		{
			$i++;
			$istmt = $db->prepare($iquery);
			$pid = $item[$index];
			$istmt->bindparam(":productid",$pid);
			$istmt->execute();
			$row = $istmt->fetch(PDO::FETCH_ASSOC);
		$pdf->Cell(10,8,$i,1,'C');
		//$pdf->Multicell(40,8,"This is a multi-line text string\nNew line\nNew line",1,'C'); 
		$pdf->Cell(40,8,$row['itemName'].' '.$row['brandName'],1,'C');
		$pdf->Cell(15,8,$row['itemHSN'],1,'C');
		$pdf->Cell(10,8,$qty[$index],1,'C');
		$tqty += $qty[$index];
		/*$pdf->Cell(10,8,"",1,'C');*/
		$pdf->Cell(10,8,$price[$index],1,'C');
		$total = $price[$index]*$qty[$index];
		$totalrate += $total;
		$pdf->Cell(10,8,$total,1,'C');
		$totaldiscount += $dis[$index];
		$pdf->Cell(15,8,$dis[$index],1,'C');
		$tvalue = $total - $dis[$index];
		$totataxvalue += $tvalue;
		$pdf->Cell(21,8,$tvalue,1,'C');
			$tstmt = $db->prepare($tquery);
			$taxid = $tax[$index];
			$tstmt->bindparam(":taxid",$taxid);
			$tstmt->execute();
			$trow = $tstmt->fetch(PDO::FETCH_ASSOC);
			$taxrate = $trow['taxPercentage'];
			$ivalue = 0;
			$invalue = 0;
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
		$pdf->Cell(10,8,$irgst,1,'C');
		$pdf->Cell(11,8,$ivalue,1,'C');
		$pdf->Cell(10,8,$irgst,1,'C');
		$pdf->Cell(11,8,$ivalue,1,'C');
		$pdf->Cell(10,8,$igst,1,'C');
		$pdf->Cell(11,8,$invalue,1,'C');
		$pdf->Ln();
		}
		$pdf->Cell(10,8,"",1,'C');
		$pdf->Cell(55,8,"Total Quantity(Nos)",1,'C');
		//$pdf->Cell(15,8,"",1,'C');
		$pdf->Cell(10,8,$tqty,1,'C');
		/*$pdf->Cell(10,8,"",1,'C');*/
		$pdf->Cell(10,8,"Total",1,'C');
		$pdf->Cell(10,8,$totalrate,1,'C');
		$pdf->Cell(15,8,$totaldiscount,1,'C');
		/*if($itemdismode == 1)
			$pdf->Cell(15,8,$totaldiscount." %",1,'C');
		else
			$pdf->Cell(15,8,$totaldiscount,1,'C');*/
		$pdf->Cell(21,8,$totataxvalue,1,'C');
		$pdf->Cell(21,8,$totalcsgst,1,0,'C');
		$pdf->Cell(21,8,$totalcsgst,1,0,'C');
		$pdf->Cell(21,8,$totaligst,1,0,'C');
		$pdf->Ln();
		$gtotal = $totataxvalue + $gst;
		//$gtotal = $totataxvalue;
		$pdf->Cell(95,8,"Total Invoice Value (In Figure)",1,'C');
		
		
		
		$pdf->Cell(99,8,"Rs. ".$gtotal,1,'C');
		$pdf->Ln();
		$pdf->Cell(95,8,"Total Invoice Value (In Words)",1,'C');
		
		
		$wtotal = convert_number_to_words($gtotal);
		$pdf->Cell(99,8,$wtotal,1,'C');
		$pdf->Ln();
		$pdf->Cell(95,8,"Total Paid",1,'C');
		$tpaid = $_GET['paidamount'];
		if($tpaid == "")
		{
			$tpaid = 0.00;
		}
		$pdf->Cell(99,8,"Rs. ".$tpaid,1,'C');
		$pdf->Ln();
		$pdf->Cell(95,8,"Balance",1,'C');
		$balance = $gtotal - $tpaid;
		$pdf->Cell(99,8,"Rs. ".$balance,1,'C');
		$pdf->Ln();
		$pdf->Cell(110,8,"Amount of Tax Subject to Reverse Charges",1,'C');
		
		$pdf->Cell(21,8,"",1,'C');
		$pdf->Cell(21,8,"",1,0,'C');
		$pdf->Cell(21,8,"",1,0,'C');
		$pdf->Cell(21,8,"",1,0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(0,8,"Declaration:",0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(100,8,"Name of the Signature",0,'R');
		$pdf->Output();
		function convert_number_to_words($number) 
		{

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
ob_end_flush(); 
?>