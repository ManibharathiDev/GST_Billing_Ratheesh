<?php
class stock
{
	private $db;
	private $current_date;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
		$this->current_date = date('Y-m-d');
	}
	
	public function create_stock($itemid,$brandid,$itemquantity,$oldquantity,$itempurchaseprice,$itemsellingprice,$itemtax,$itemcat,$itembrand,$itemsupplier){
		try
		{
			if(isset($_POST['itemShort']))
			{
				$itemshort = $_POST['itemShort'];
				if($itemshort != "")
				{
					
				
				//echo $_POST['itemShort'];
				$itemname = $_POST['itemName'];
				$itemhsn = $_POST['itemHSN'];
				$itemdescription = $_POST['itemDescription'];
				$itemshort = $_POST['itemShort'];
				$iquery = "INSERT INTO `tbl_item` (`itemId`, `itemName`, `itemShort`, `itemDescription`, `itemHSN`, `itemAddDate`, `itemModDate`) VALUES (NULL, :itemname, :itemshort, :itemdescription, :itemhsn, :adate, NULL)";
				$istmt = $this->db->prepare($iquery);
				$istmt->execute(array(":itemname"=>$itemname,":itemshort"=>$itemshort,":itemdescription"=>$itemdescription,":itemhsn"=>$itemhsn,":adate"=>$this->current_date));
				$id = $this->db->lastInsertId();
				
				$query = "INSERT INTO `tbl_stock` (`stockId`, `itemId`, `supplierId`, `stockQty`, `purchasedPrice`, `sellingPrice`, `stockTax`, `catId`, `brandId`) VALUES (NULL, :itemid, :supid, :qty, :pprice, :sprice, :tax, :catid, :brandid)";
				$stmt = $this->db->prepare($query);
				$stmt->execute(array(":itemid"=>$id,":supid"=>$itemsupplier,":qty"=>$itemquantity,":pprice"=>$itempurchaseprice,":sprice"=>$itemsellingprice,":tax"=>$itemtax,":catid"=>$itemcat,":brandid"=>$itembrand));
				$stockid = $this->db->lastInsertId();
				$pquery = "INSERT INTO `tbl_purchase_history` (`purchaseId`, `stockId`, `purchaseQty`, `purchaseDate`, `purchasePrice`, `sellingPrice`, `catId`, `brandId`, `purchaseSupplier`) VALUES (NULL, :stockid, :itemqty, :purchasedate, :purchaseprice, :sellingprice, :catid, :brandid, :supplier)";
				$pstmt = $this->db->prepare($pquery);
				$pstmt->execute(array(":stockid"=>$stockid,":itemqty"=>$itemquantity,":purchasedate"=>$this->current_date,":purchaseprice"=>$itempurchaseprice,":sellingprice"=>$itemsellingprice,":catid"=>$itemcat,":brandid"=>$itembrand,":supplier"=>$itemsupplier));
				}
				else
			{
				
			if($brandid != 0)
			{
				$uquery = "UPDATE `tbl_stock` SET `supplierId` = :supid, `stockQty` = :qty, `purchasedPrice` = :pprice, `sellingPrice` = :sprice, `stockTax` = :tax, `catId` = :catid WHERE `itemId` = :itemid AND `brandId` = :brandid";
				$ustmt = $this->db->prepare($uquery);
				$ustmt->execute(array(":itemid"=>$itemid,":supid"=>$itemsupplier,":qty"=>$itemquantity,":pprice"=>$itempurchaseprice,":sprice"=>$itemsellingprice,":tax"=>$itemtax,":catid"=>$itemcat,":brandid"=>$itembrand));
				
				if($oldquantity > $itemquantity)
				{
					$nqty = $oldquantity - $itemquantity;
					$pquery = "INSERT INTO `tbl_purchase_history` (`purchaseId`, `stockId`, `purchaseQty`, `purchaseDate`, `purchasePrice`, `sellingPrice`, `catId`, `brandId`, `purchaseSupplier`) VALUES (NULL, :itemid, :itemqty, :purchasedate, :purchaseprice, :sellingprice, :catid, :brandid, :supplier)";
					$pstmt = $this->db->prepare($pquery);
					$pstmt->execute(array(":itemid"=>$itemid,":itemqty"=>$nqty,":purchasedate"=>$this->current_date,":purchaseprice"=>$itempurchaseprice,":sellingprice"=>$itemsellingprice,":catid"=>$itemcat,":brandid"=>$itembrand,":supplier"=>$itemsupplier));
				}
				else if($oldquantity < $itemquantity)
				{
					$nqty = $itemquantity - $oldquantity;
					$pquery = "INSERT INTO `tbl_purchase_history` (`purchaseId`, `stockId`, `purchaseQty`, `purchaseDate`, `purchasePrice`, `sellingPrice`, `catId`, `brandId`, `purchaseSupplier`) VALUES (NULL, :itemid, :itemqty, :purchasedate, :purchaseprice, :sellingprice, :catid, :brandid, :supplier)";
					$pstmt = $this->db->prepare($pquery);
					$pstmt->execute(array(":itemid"=>$itemid,":itemqty"=>$nqty,":purchasedate"=>$this->current_date,":purchaseprice"=>$itempurchaseprice,":sellingprice"=>$itemsellingprice,":catid"=>$itemcat,":brandid"=>$itembrand,":supplier"=>$itemsupplier));
				}
				
			}
			else
			{
				$query = "INSERT INTO `tbl_stock` (`stockId`, `itemId`, `supplierId`, `stockQty`, `purchasedPrice`, `sellingPrice`, `stockTax`, `catId`, `brandId`) VALUES (NULL, :itemid, :supid, :qty, :pprice, :sprice, :tax, :catid, :brandid)";
				$stmt = $this->db->prepare($query);
				$stmt->execute(array(":itemid"=>$itemid,":supid"=>$itemsupplier,":qty"=>$itemquantity,":pprice"=>$itempurchaseprice,":sprice"=>$itemsellingprice,":tax"=>$itemtax,":catid"=>$itemcat,":brandid"=>$itembrand));
				$stockid = $this->db->lastInsertId();
				$pquery = "INSERT INTO `tbl_purchase_history` (`purchaseId`, `stockId`, `purchaseQty`, `purchaseDate`, `purchasePrice`, `sellingPrice`, `catId`, `brandId`, `purchaseSupplier`) VALUES (NULL, :stockid, :itemqty, :purchasedate, :purchaseprice, :sellingprice, :catid, :brandid, :supplier)";
				$pstmt = $this->db->prepare($pquery);
				$pstmt->execute(array(":stockid"=>$stockid,":itemqty"=>$itemquantity,":purchasedate"=>$this->current_date,":purchaseprice"=>$itempurchaseprice,":sellingprice"=>$itemsellingprice,":catid"=>$itemcat,":brandid"=>$itembrand,":supplier"=>$itemsupplier));
			}
			}
			}
			
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getitembyid($item){
		try{
			$query = "SELECT ts.itemId,ti.itemName,ti.itemShort,ti.itemDescription,ti.itemHSN,ts.stockQty,ts.sellingPrice,ts.purchasedPrice,ts.supplierId,ts.stockTax,TT.taxPercentage FROM `tbl_item` ti INNER JOIN `tbl_stock` ts INNER JOIN `tbl_tax` tt ON ti.itemId = ts.itemId AND tt.taxId = ts.stockTax where ts.stockId = :itemid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":itemid"=>$item));
			$rows = array();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$rows[] = $row;
			echo json_encode($rows);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getitemid($itemid,$brandid){
		try{
			
			$query = "SELECT ts.itemId,ts.supplierId,ts.catId,ts.brandId,ts.purchasedPrice,ts.sellingPrice,ti.itemName,ti.itemShort,ti.itemDescription,ti.itemHSN,ts.stockQty,ts.stockTax FROM `tbl_item` ti INNER JOIN `tbl_stock` ts ON ti.itemId = ts.itemId where ts.itemId = :itemid AND ts.brandId = :brandid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":itemid"=>$itemid,":brandid"=>$brandid));
			$rows = array();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$rows[] = $row;
			echo json_encode($rows);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function get_stock($stockid){
		try{
			$query = "SELECT ts.stockId,ti.itemName,ti.itemShort,ti.itemDescription,ts.stockQty FROM `tbl_stock` ts INNER JOIN `tbl_item` ti ON ti.itemId = ts.itemId WHERE ts.stockId = :sid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":sid"=>$stockid));
			$content = "";
			if($stmt->rowCount()>0)
			{
				$content .= '<table class="table table-bordered">';
				$content .= '<tr class="tableheading">';
				$content .= '<td>Item Name</td>';
				$content .= '<td>Short Name</td>';
				$content .= '<td>Description</td>';
				$content .= '<td>Availability</td>';
				$content .= '</tr>';
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$content .= '<tr>';
				$content .= '<td>'.$row['itemName'].'</td>';
				$content .= '<td>'.$row['itemShort'].'</td>';
				$content .= '<td>'.$row['itemDescription'].'</td>';
				$content .= '<td>'.$row['stockQty'].'</td>';
				$content .= '</tr>';
				$content .= '<tr>';
				$content .= '<td colspan="4">';
				$content .= '<a id="'.$row['stockId'].'" class="btn btn-primary wrapClose"><i class="fa fa-times" aria-hidden="true"></i> No</a>  <a id="'.$row['stockId'].'" class="btn btn-danger wrapDelete"><i class="fa fa-check" aria-hidden="true"></i> Yes</a>';
				
				$content .= '</td>';
				$content .= '</tr>';
				$content .= '</table>';
			}
			else
			{
				$content .= 'No Data Found';
			}
			echo $content;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function get_stock_for_damage($stockid){
		try{
			$query = "SELECT ts.stockId,ti.itemName,ti.itemShort,ti.itemDescription,ts.stockQty,ts.damageItems FROM `tbl_stock` ts INNER JOIN `tbl_item` ti ON ti.itemId = ts.itemId WHERE ts.stockId = :sid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":sid"=>$stockid));
			$content = "";
			if($stmt->rowCount()>0)
			{
				$content .= '<form name="damageForm" id="damageForm">';
				$content .= '<input type="hidden" value="10" name="flag">';
				$content .= '<table class="table table-bordered">';
				$content .= '<tr class="tableheading">';
				$content .= '<td>Item Name</td>';
				$content .= '<td>Short Name</td>';
				$content .= '<td>Description</td>';
				$content .= '<td>Damaged Items</td>';
				$content .= '<td>Availability</td>';
				$content .= '</tr>';
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$content .= '<input type="hidden" value="'.$row['stockId'].'" name="damagestockid">';
				$content .= '<tr>';
				$content .= '<td>'.$row['itemName'].'</td>';
				$content .= '<td>'.$row['itemShort'].'</td>';
				$content .= '<td>'.$row['itemDescription'].'</td>';
				$content .= '<td>'.$row['damageItems'].'</td>';
				$content .= '<td>'.$row['stockQty'].'</td>';
				$content .= '</tr>';
				$content .= '<tr>';
				$content .= '<td><label>Damaged Counts</label></td>';
				$content .= '<td><input type="text" class="wrap-text dnumeric" value="'.$row['stockQty'].'" name="damageCount" id="damageCount" required></td>';
				$content .= '<td><Button type="submit" class="btn damagedBtn"><i class="fa fa-money" aria-hidden="true"></i> Submit</Button></td>';
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
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function delete_stock($stockid){
		try{
			$cquery = "SELECT * FROM `tbl_itembill` where `itemId` = :stockid";
			$csstmt = $this->db->prepare($cquery);
			$csstmt->execute(array(":stockid"=>$stockid));
			if($csstmt->rowCount()>0)
			{
				return false;
			}
			$query = "DELETE FROM `tbl_stock` WHERE `stockId`=:stockid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":stockid"=>$stockid));
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getstockbrand(){
		try{
				$query = "SELECT itemId,itemName FROM `tbl_item`";
				$stmt = $this->db->prepare($query);
				$stmt->execute();
				$content = "";
				if($stmt->rowCount()>0)
					{
						while($row = $stmt->fetch(PDO::FETCH_ASSOC))
						{
							$itemid = $row['itemId'];
							$cquery = "SELECT * FROM `tbl_item` ti INNER JOIN `tbl_stock` ts INNER JOIN `tbl_brand` tb ON ti.itemId = ts.itemId AND tb.brandId = ts.brandId WHERE ti.itemId = :itemid";
							$cstmt = $this->db->prepare($cquery);
							$cstmt->bindparam(":itemid",$itemid);
							$cstmt->execute();
							if($cstmt->rowCount()>0)
								{
									while($crow =$cstmt->fetch(PDO::FETCH_ASSOC))
									{
									$content .='<option data-id="'.$crow['itemId'].','.$crow['brandId'].'" value="'.$row['itemName'].' '.$crow['brandName'].'">';
									}
									}
									$content .='<option data-id="'.$row['itemId'].',0" value="'.$row['itemName'].'">';
									
									}
					}
					echo $content;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function checkitembrand($itemid,$brandid){
		try{
			$query = "SELECT * FROM tbl_stock where itemId = :itemid AND brandId = :brandid";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":itemid",$itemid);
			$stmt->bindparam(":brandid",$brandid);
			$stmt->execute();
			if($stmt->rowCount()>0){
				return true;
			}
			else
				return false;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function view_stock(){
		try
		{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT ts.stockId,ts.brandId,ts.catId,ts.itemId,ts.stockQty,ts.sellingPrice,ts.purchasedPrice,ti.itemName,ti.itemHSN,ti.itemShort,ti.itemDescription,tb.brandName,tc.catName FROM `tbl_stock` ts INNER JOIN `tbl_item` ti INNER JOIN `tbl_brand` tb INNER JOIN `tbl_category` tc ON ts.itemId = ti.itemId AND ts.brandId = tb.brandId AND ts.catId = tc.catId";
			if(isset($_POST['search'])){
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND (ti.itemName like '%$search%' OR ti.itemDescription like '%$search%' or ti.itemShort like '%$search%' OR tb.brandName like '%$search%' OR tc.catName like '%$search%')";
				}
			}
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
				$content .= '<th>Item Name</th>';
				$content .= '<th>Short Name</th>';
				$content .= '<th>Description</th>';
				$content .= '<th>Brand</th>';
				$content .= '<th>Category</th>';
				$content .= '<th>HSN</th>';
				$content .= '<th>Purchased Price</th>';
				$content .= '<th>Selling Price</th>';
				$content .= '<th>Available</th>';
				
				$content .= '<th>Action</th>';
				$content .= '</tr>';
				$i = 0;
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$content .= '<tr>';
					$content .= '<td>'.$i.'</td>';
					$content .= '<td>'.$row['itemName'].' - '.$row['brandName'].'</td>';
					$content .= '<td>'.$row['itemShort'].'</td>';
					$content .= '<td>'.$row['itemDescription'].'</td>';
					$content .= '<td>'.$row['brandName'].'</td>';
					$content .= '<td>'.$row['catName'].'</td>';
					$content .= '<td>'.$row['itemHSN'].'</td>';
					$content .= '<td><span><i class="fa fa-inr"></i></span><span class="alignRight">'.$row['purchasedPrice'].'</span></td>';
					$content .= '<td><span><i class="fa fa-inr"></i></span><span class="alignRight">'.$row['sellingPrice'].'</span></td>';
					$content .= '<td>'.$row['stockQty'].'</td>';
					
					$content .= '<td align="center"><a  class="productDamage damageBtn" id="'.$row['stockId'].'" href="#"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a>&nbsp;<a id="'.$row['stockId'].'"  href="#" class="productDelete deleteBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
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

	public function insert_damage_stock($stockid,$damagecount){
		try{
			$query = "UPDATE `tbl_stock` SET `damageItems` = :damagecount,`stockQty`=`stockQty`-:damagecount WHERE `stockId` = :stockid";
				$stmt = $this->db->prepare($query);
				$status = $stmt->execute(array(
					":damagecount"=>$damagecount,
					":stockid"=>$stockid
				));
				if($status){
					echo 1;
				}
				else
					echo 0;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
}