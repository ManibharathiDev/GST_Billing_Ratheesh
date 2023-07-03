<?php
class order
{
	private $db;
	private $current_date;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
		$this->current_date = date('Y-m-d');
		$this->current_year = date('Y');
		$this->current_month = date('m');
	}
		
	public function getclientbyid($clientid){
		try
		{
			$query = "SELECT * FROM `tbl_client` tc INNER JOIN `tbl_state` ts ON tc.clientBillingState = ts.stateDigit WHERE tc.clientId = :clientid";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":clientid",$clientid);
			$stmt->execute();
			$rows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$rows[] = $row;
				}
				echo json_encode($rows);
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getproductbyid($productid){
		try
		{
			$query = "SELECT * FROM `tbl_product` WHERE productId=:productid";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":productid",$productid);
			$stmt->execute();
			$rows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$rows[] = $row;
				}
				echo json_encode($rows);
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getlastclient(){
		try
		{
			$query = "SELECT * FROM `tbl_client` ORDER BY clientId DESC LIMIT 1";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$rows[] = $row;
				}
				echo json_encode($rows);
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getlastitem()
	{
		try
		{
			$query = "SELECT * FROM `tbl_product` ORDER BY productId DESC LIMIT 1";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$rows[] = $row;
				}
				echo json_encode($rows);
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function savebill($cusid,$paidamount,$itemid,$itemqty,$itemprice,$itempurchaseprice,$itemsupplier,$itemdis,$itemtax,$itemdismode){
		try{
			$totalamount = 0;
			$taxsub = 0;
			
			//echo $itemid;
			//$item = explode(',',$itemid);
			$tquery = "SELECT * FROM `tbl_tax` WHERE taxId = :taxid";
			foreach($itemid as $index => $value)
			{
				$tstmt = $this->db->prepare($tquery);
				$taxid = $itemtax[$index];
				$tstmt->bindparam(":taxid",$taxid);
				$tstmt->execute();
				$trow = $tstmt->fetch(PDO::FETCH_ASSOC);
				$taxrate = $trow['taxPercentage'];
				$subamount = ($itemqty[$index]*$itemprice[$index])-$itemdis[$index];
				$taxsub = ($subamount*$taxrate)/100;
				$totalamount += $subamount+$taxsub;
				//$totalamount += $subamount;
			}
			$billno = '';
			$squery = "SELECT * FROM `tbl_bill` ORDER BY billId DESC LIMIT 1";
			$sstmt = $this->db->prepare($squery);
			$sstmt->execute();
			if($sstmt->rowCount()>0)
			{
				$srow = $sstmt->fetch(PDO::FETCH_ASSOC);
				$sbillno = $srow['billOrderNo'];
				$sbillno = explode('/',$sbillno);
				$billno = $this->current_year.'B/'.$this->current_month.'/'.($sbillno[2]+1);
			}
			else
			{
				$billno = $this->current_year.'B/'.$this->current_month.'/'.'1';
			}
			
			$query = "INSERT INTO `tbl_bill` (`billId`, `billOrderNo`, `billCusId`, `billDate`, `billAmount`, `billPaid`, `billBalance`) VALUES (NULL, :billno, :cusid, :adate, :amount, :paid, :balance)";
			$stmt = $this->db->prepare($query);
			$balance = 0;
			$stmt->bindparam(":billno",$billno);
			$stmt->bindparam(":cusid",$cusid);
			$stmt->bindparam(":adate",$this->current_date);
			$stmt->bindparam(":amount",$totalamount);
			$balance = $totalamount - $paidamount;
			$stmt->bindparam(":paid",$paidamount);
			$stmt->bindparam(":balance",$balance);
			$stmt->execute();
			
			$billid = $this->db->lastInsertId();
			
			$iquery = "INSERT INTO `tbl_itembill` (`itemBillId`, `itemBillNo`, `itemId`, `itemPurchasePrice`, `itemPrice`, `itemSupplier`, `itemQuantity`, `itemDiscount`, `itemGST`,`itemDiscountMode`) VALUES (NULL, :itembillno, :itemid, :itempurchaseprice, :itemprice, :itemsupplier, :itemquantity, :itemdiscount, :itemgst,:itemdismode)";
			foreach($itemid as $index => $value)
			{
				$istmt = $this->db->prepare($iquery);
				$item = $itemid[$index];
				$qty = $itemqty[$index];
				$purchaseprice = $itempurchaseprice[$index];
				$price = $itemprice[$index];
				$itemsup = $itemsupplier[$index];
				$dis = $itemdis[$index];
				$dismode = $itemdismode[$index];
				$tax = $itemtax[$index];
				$tstmt = $this->db->prepare($tquery);
				$taxid = $itemtax[$index];
				$tstmt->bindparam(":taxid",$tax);
				$tstmt->execute();
				$trow = $tstmt->fetch(PDO::FETCH_ASSOC);
				$taxrate = $trow['taxPercentage'];
				$subamount = ($qty*$price)-$dis;
				$tax = ($subamount*$taxrate)/100;
				$istmt->bindparam(":itembillno",$billno);
				$istmt->bindparam(":itemid",$item);
				$istmt->bindparam(":itempurchaseprice",$purchaseprice);
				$istmt->bindparam(":itemprice",$price);
				$istmt->bindparam(":itemsupplier",$itemsup);
				$istmt->bindparam(":itemquantity",$qty);
				$istmt->bindparam(":itemdiscount",$dis);
				$istmt->bindparam(":itemgst",$tax);
				$istmt->bindparam(":itemdismode",$dismode);
				$istmt->execute();
				
				$uquery = "UPDATE `tbl_stock` SET `stockQty` = stockQty-:qty WHERE `tbl_stock`.`stockId` = :itemid";
				$ustmt = $this->db->prepare($uquery);
				$ustmt->bindparam(":qty",$qty);
				$ustmt->bindparam(":itemid",$item);
				$ustmt->execute();
			}
			
			
			$pquery = "INSERT INTO `tbl_payment` (`paymentId`, `billId`, `paymentDate`, `paymentAmount`) VALUES (NULL, :billid, :pdate, :amount)";
			$pstmt = $this->db->prepare($pquery);
			$pstmt->execute(array(":billid"=>$billid,":pdate"=>$this->current_date,":amount"=>$paidamount));
			
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function updatebill($billid,$cusid,$itemid,$itemqty,$itemprice,$itempurchaseprice,$itemsupplier,$itemdis,$itemtax,$itemdismode){
		try
		{
			$totalamount = 0;
			$taxsub = 0;
			//echo $itemid;
			//$item = explode(',',$itemid);
			$tquery = "SELECT * FROM `tbl_tax` WHERE taxId = :taxid";
			foreach($itemid as $index => $value)
			{
				$tstmt = $this->db->prepare($tquery);
				$taxid = $itemtax[$index];
				$tstmt->bindparam(":taxid",$taxid);
				$tstmt->execute();
				$trow = $tstmt->fetch(PDO::FETCH_ASSOC);
				$taxrate = $trow['taxPercentage'];
				$subamount = ($itemqty[$index]*$itemprice[$index])-$itemdis[$index];
				$taxsub = ($subamount*$taxrate)/100;
				$totalamount += $subamount+$taxsub;
				//$totalamount += $subamount;
			}
			$billorderno = $billid;
			$uquery = "UPDATE `tbl_bill` SET `billCusId` = :cusid, `billAmount` = :billamount, `billBalance` = :billbalance, `billModDate` = :mdate WHERE `tbl_bill`.`billOrderNo` = :billid";
			$ustmt = $this->db->prepare($uquery);
			$ustmt->bindparam(":cusid",$cusid);
			$ustmt->bindparam(":billamount",$totalamount);
			$ustmt->bindparam(":billbalance",$totalamount);
			$ustmt->bindparam(":mdate",$this->current_date);
			$ustmt->bindparam(":billid",$billorderno);
			$ustmt->execute();
			$iquery = "INSERT INTO `tbl_itembill` (`itemBillId`, `itemBillNo`, `itemId`, `itemPrice`, `itemQuantity`, `itemDiscount`, `itemGST`,`itemDiscountMode`) VALUES (NULL, :itembillno, :itemid, :itemprice, :itemquantity, :itemdiscount, :itemgst,:itemdiscountmode)";
			$iuquery ="UPDATE `tbl_itembill` SET `itemPrice` = :itemprice, `itemQuantity` = :itemquantity, `itemDiscount` = :itemdiscount, `itemDiscountMode` = :itemdiscountmode, `itemGST` = :itemgst WHERE `itemBillNo` = :itembillno AND `itemId` = :itemid";
			$squery = "SELECT * FROM `tbl_itembill` WHERE `itemBillNo`=:itembillno AND `itemId`=:itemid";
			$addquery = "UPDATE tbl_stock SET stockQty = stockQty + :item WHERE stockId = :itemid";
			$subquery = "UPDATE tbl_stock SET stockQty = stockQty - :item WHERE stockId = :itemid";
			foreach($itemid as $index => $value)
			{
				//$iuquery ="UPDATE `tbl_itembill` SET `itemPrice` = $price, `itemQuantity` = $qty, `itemDiscount` = $dis, `itemGST` = $tax WHERE `itemBillNo` = '$billorderno' AND `itemId` = $item";
				$item = $itemid[$index];
				$qty = $itemqty[$index];
				$price = $itemprice[$index];
				$dis = $itemdis[$index];
				$dismode = $itemdismode[$index];
				$tax = $itemtax[$index];
				$taxid = $itemtax[$index];
				$sstmt = $this->db->prepare($squery);
				$iustmt = $this->db->prepare($iuquery);
				$tstmt = $this->db->prepare($tquery);
				$tstmt->bindparam(":taxid",$tax);
				$tstmt->execute();
				$trow = $tstmt->fetch(PDO::FETCH_ASSOC);
				$taxrate = $trow['taxPercentage'];
				$subamount = ($qty*$price)-$dis;
				$tax = ($subamount*$taxrate)/100;
				$sstmt->bindparam(":itembillno",$billorderno);
				$sstmt->bindparam(":itemid",$item);
				$sstmt->execute();
				if($sstmt->rowCount()>0)
				{
					$grow = $sstmt->fetch(PDO::FETCH_ASSOC);
					$productQT = $grow['itemQuantity'];
					if($qty > $productQT)
					{
						$subQT = ($qty - $productQT);
						$substmt = $this->db->prepare($subquery);
						$substmt->bindparam(":item",$subQT);
						$substmt->bindparam(":itemid",$item);
						$substmt->execute();
					}
					else if($qty < $productQT)
					{
						$addQT = ($productQT - $qty);
						$addstmt = $this->db->prepare($addquery);
						$addstmt->bindparam(":item",$addQT);
						$addstmt->bindparam(":itemid",$item);
						$addstmt->execute();
					}
				$iustmt->bindparam(":itemprice",$price);
				$iustmt->bindparam(":itemquantity",$qty);
				$iustmt->bindparam(":itemdiscount",$dis);
				$iustmt->bindparam(":itemdiscountmode",$dismode);
				$iustmt->bindparam(":itemgst",$tax);
				$iustmt->bindparam(":itembillno",$billorderno);
				$iustmt->bindparam(":itemid",$item);
				$iustmt->execute();
				}
				else
				{
				$istmt = $this->db->prepare($iquery);	
				$istmt->bindparam(":itembillno",$billorderno);
				$istmt->bindparam(":itemid",$item);
				$istmt->bindparam(":itemprice",$price);
				$istmt->bindparam(":itemquantity",$qty);
				$istmt->bindparam(":itemdiscount",$dis);
				$istmt->bindparam(":itemdiscountmode",$dismode);
				$istmt->bindparam(":itemgst",$tax);
				$istmt->execute();
				}
			}
			echo true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function viewbill(){
		try
		{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT * FROM `tbl_bill` tb INNER JOIN tbl_client tc ON tb.billCusId = tc.clientId WHERE 1";
			$gquery = "SELECT SUM(itemGST) as gst FROM `tbl_itembill` WHERE itemBillNo = :billno";
			$gstmt = $this->db->prepare($gquery);
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				$query .= " AND tb.billOrderNo like '%$search%' OR tc.clientName like '%$search%'";
			}
			
			$query .= " ORDER BY tb.billId DESC";
			
			
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			
			
			$query2 = $query;
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$content = "";
			if($stmt->rowCount()>0)
			{
				$content .= '<table class="table table-bordered customTable">';
				$content .= '<tr class="tableheading">';
				$content .= '<th>#</th>';
				$content .= '<th>Bill No</th>';
				$content .= '<th>Client Name</th>';
				$content .= '<th>Issue Date</th>';
				$content .= '<th>Amount</th>';
				$content .= '<th>Tax</th>';
				$content .= '<th>Total</th>';
				$content .= '<th>AmountPaid</th>';
				$content .= '<th>Balance</th>';
				$content .= '<th>Action</th>';
				$content .= '</tr>';
				$i = 0;
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$content .= '<tr>';
					$content .= '<td>'.$i.'</td>';
					$content .= '<td>'.$row['billOrderNo'].'</td>';
					$content .= '<td>'.$row['clientName'].'</td>';
					$selectedDate = strtr($row['billDate'], '/', '-');
					$selectedDate=date('d-m-Y',strtotime($selectedDate));
					$content .= '<td>'.$selectedDate.'</td>';
					$content .= '<input type="hidden" id="clientId" value="'.$row['clientId'].'">';
					$billorderno = $row['billOrderNo'];
					$gstmt->bindparam(":billno",$billorderno);
					$gstmt->execute();
					$grow = $gstmt->fetch(PDO::FETCH_ASSOC);
					$amount = $row['billAmount']-$grow['gst'];;
					$amount = $row['billAmount'];
					$content .= '<td><span><i class="fa fa-inr"></i></span><span class="alignRight">'.number_format((float)$amount, 2, '.', '').'</span></td>';
					$content .= '<td><span><i class="fa fa-inr"></i></span><span class="alignRight">'.number_format((float)$grow['gst'], 2, '.', '').'</span></td>';
					$content .= '<td><span><i class="fa fa-inr"></i></span><span class="alignRight">'.number_format((float)$row['billAmount'], 2, '.', '').'</span></td>';
					$content .= '<td><span><i class="fa fa-inr"></i></span><span class="alignRight">'.number_format((float)$row['billPaid'], 2, '.', '').'</span></td>';
					$content .= '<td><span><i class="fa fa-inr"></i></span><span class="alignRight">'.number_format((float)$row['billBalance'], 2, '.', '').'</span></td>';
					$content .= '<td align="center">';
					if($row['billBalance'] > 0){
					$content .= '<a id="'.$row['billId'].'" class="billPay printBtn" title="Pay Bill"><i class="fa fa-money" aria-hidden="true"></i></a>&nbsp;';
					}
					else
					{
						$content .= '<a id="0" class="billPay printBtn" title="Pay Bill"><i class="fa fa-money" aria-hidden="true"></i></a>&nbsp;';
					}
					$content .='<a id="'.$row['billId'].'" class="billView printBtn" title="View Bill"><i class="fa fa-search" aria-hidden="true"></i></a>&nbsp;';
					if($row['billPaid'] == 0){
					$content .='<a id="'.$row['billId'].'-'.$row['clientId'].'" href="#" class="billEdit editBtn" title="Edit Bill"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
					}
					else
					{
						$content .='<a id="0" href="#" class="billEdit editBtn" title="Edit Bill"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
					}
					$content .= '</td>';
					$content .= '</tr>';
				}
				$content .= '</table>';
				//echo $content;
				echo '<div class="pagination-wrap" align="center">';
				
				$fstmt = $this->db->prepare($query2);
				$fstmt->execute();
				
				$total_no_of_records = $fstmt->rowCount();
				if($total_no_of_records > 0)
				{
				$content .= '<ul class="pagination">';
				$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
				if(isset($_POST['activePage']))
				{
					$current_page=$_POST['activePage'];
					//echo $current_page;
				}
				else
					$current_page=1;
				$start = 1;
				if(isset($_POST["activepage"]))
				{
					if($_POST['activepage']>0)
					{
					$current_page=$_POST["activepage"];
					}
				
				}
				
				if($current_page!=1)
				{
				$previous =$current_page-1;
				$content .= "<li><a id=".$start." class='spage'>First</a></li>";
				$content .= "<li><a id=".$previous." class='spage'>Previous</a></li>";
				}
				$count = 0;
				$current = 10;
				for($i=1;$i<=$total_no_of_pages;$i++)
				{
					
					if($i==$current_page)
					{
					$content .= "<li><a id=".$i." class='spage sid activePage'>".$i."</a></li>";
					}
					else
					{
						if($current_page > 10)
						{
							$count++;
							if($count <= 10)
							{
								
								$val = $current_page - $current;
								$current--;
								$content .= "<li><a id=".$val." class='spage'>".$val."</a></li>";
							}
						}
						else if($i <= 10)
						{
							$content .= "<li><a id=".$i." class='spage'>".$i."</a></li>";
						}
					}
				}
				if($current_page!=$total_no_of_pages)
				{
				$next=$current_page+1;
				$content .= "<li><a id=".$next." class='spage'>Next</a></li>";
				$content .= "<li><a id=".$total_no_of_pages." class='spage'>Last</a></li>";
				}
				$content .= '</ul>';
				}
				echo $content;
			}
			else
			{
				echo "<table class='table table-bordered'><tr><td>There are no results for your search string...</td></tr></table>";
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function viewbillbyid($billid){
		try{
			$query = "SELECT tib.itemBillNo,ts.stockId,ti.itemId,ti.itemName,ti.itemHSN,tib.itemDiscount,tib.itemDiscountMode,tib.itemQuantity,tib.itemPrice,tt.taxId,tt.taxPercentage,tbr.brandName,tbr.brandId,tb.billPaid FROM `tbl_stock` ts INNER JOIN `tbl_bill` tb INNER JOIN `tbl_itembill` tib INNER JOIN `tbl_item` ti INNER JOIN `tbl_tax` tt INNER JOIN `tbl_brand` tbr ON tb.billOrderNo = tib.itemBillNo AND tib.itemId = ts.stockId AND ts.itemId = ti.itemId AND ts.stockTax = tt.taxId AND ts.brandId = tbr.brandId WHERE tb.billId = :billid";
			//echo $query;
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":billid",$billid);
			$stmt->execute();
			$rows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$rows[] = $row;
				}
				echo json_encode($rows);
			}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function createbillno(){
		try
		{
			
			$billno = '';
			$squery = "SELECT * FROM `tbl_bill` ORDER BY billId DESC LIMIT 1";
			$sstmt = $this->db->prepare($squery);
			$sstmt->execute();
			if($sstmt->rowCount()>0)
			{
				$srow = $sstmt->fetch(PDO::FETCH_ASSOC);
				$sbillno = $srow['billOrderNo'];
				$sbillno = explode('/',$sbillno);
				$billno = $this->current_year.'B/'.$this->current_month.'/'.($sbillno[2]+1);
			}
			else
			{
				$billno = $this->current_year.'B/'.$this->current_month.'/'.'1';
			}
			return $billno;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function export(){
		try{
			$query = "SELECT * FROM `tbl_bill` tb INNER JOIN tbl_client tc ON tb.billCusId = tc.clientId WHERE 1";
			return $query;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getclientid($billid){
		try{
			$query = "SELECT billCusId FROM `tbl_bill` WHERE billId = :billid";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":billid",$billid);
			$stmt->execute();
			$rows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$rows[] = $row;
				}
				echo json_encode($rows);
			}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function get_bill_by_id($billid){
		try
		{
			$query = "SELECT * FROM `tbl_bill` tb INNER JOIN `tbl_client` tc ON tb.billCusId = tc.clientId WHERE tb.billId = :billid";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":billid",$billid);
			$stmt->execute();
			$content = "";
			if($stmt->rowCount()>0)
			{
				$content .= '<form name="paymentForm" id="paymentForm">';
				
				$content .= '<input type="hidden" value="13" name="flag">';
				$content .= '<table class="table table-bordered">';
				$content .= '<tr class="tableheading">';
				$content .= '<td>Bill No</td>';
				$content .= '<td>Client Name</td>';
				$content .= '<td>Balance</td>';
				$content .= '</tr>';
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$content .= '<input type="hidden" value="'.$row['billId'].'" name="paybillid">';
				$content .= '<tr>';
				$content .= '<td>'.$row['billOrderNo'].'</td>';
				$content .= '<td>'.$row['clientName'].'</td>';
				$content .= '<td>'.$row['billBalance'].'</td>';
				$content .= '</tr>';
				$content .= '<tr>';
				/*$content .= '<td colspan="4">';
				$content .= '<a id="'.$row['billId'].'" class="btn btn-primary wrapClose"><i class="fa fa-times" aria-hidden="true"></i> No</a>  <a id="'.$row['billId'].'" class="btn btn-danger wrapDelete"><i class="fa fa-check" aria-hidden="true"></i> Yes</a>';
				
				$content .= '</td>';*/
				$content .= '<td><label>Amount Payable</label></td>';
				$content .= '<td><input type="text" class="wrap-text dnumeric" value="'.$row['billBalance'].'" name="amountPayable" id="amountPayable" required><input type="hidden" id="payBalance" value="'.$row['billBalance'].'"></td>';
				$content .= '<td><Button type="submit" class="btn payBtn"><i class="fa fa-money" aria-hidden="true"></i> Pay</Button></td>';
				$content .= '</tr>';
				$content .= '</table>';
				$content .= '</form>';
			}
			else
			{
				$content .= 'No Data Found';
			}
			echo $content;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function makepayment($billid,$amount){
		try{
			$query = "UPDATE `tbl_bill` SET `billBalance` = billBalance-:amount,billPaid = billPaid+:amount WHERE `tbl_bill`.`billId` = :id";
			$stmt =$this->db->prepare($query);
			$stmt->bindparam(":amount",$amount);
			$stmt->bindparam(":id",$billid);
			$stmt->execute();
			
			$query = "INSERT INTO `tbl_payment` (`paymentId`, `billId`, `paymentDate`, `paymentAmount`) VALUES (NULL, :billid, :adate, :amount)";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":billid",$billid);
			$stmt->bindparam(":adate",$this->current_date);
			$stmt->bindparam(":amount",$amount);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}