<?php
class report
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
	
	public function getstock(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT ts.stockId,ts.brandId,ts.catId,ts.itemId,ts.stockQty,ts.sellingPrice,ts.purchasedPrice,ti.itemName,ti.itemHSN,ti.itemShort,ti.itemDescription,tb.brandName,tc.catName, tt.taxPercentage FROM `tbl_stock` ts INNER JOIN `tbl_item` ti INNER JOIN `tbl_brand` tb INNER JOIN `tbl_category` tc INNER JOIN tbl_tax tt ON ts.itemId = ti.itemId AND ts.brandId = tb.brandId AND ts.catId = tc.catId AND ts.stockTax = tt.taxId WHERE 1";
			
			if(isset($_POST['cat'])){
				$cat = $_POST['cat'];
				if($cat != ""){
					$query .=" AND tc.catId = $cat";
				}
			}
			
			if(isset($_POST['brand'])){
				$brand = $_POST['brand'];
				if($brand != ""){
					$query .=" AND tb.brandId = $brand";
				}
			}
			
			if(isset($_POST['item'])){
				
				$item = $_POST['item'];
				if($item != ""){
					$query .= " AND ti.itemId = $item";
				}
			}
			
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND ti.itemName like '%$search%' OR ti.itemDescription like '%$search%' or ti.itemShort like '%$search%' OR tc.catName like '%$search%' OR tb.brandName like '%$search%' OR tt.taxPercentage like '$search' OR ti.itemHSN like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			//echo $query;
			$query2 = $query;
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = array();
			$irows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$irows[] = $row;
				}
				$rows['data'] = $irows;
				$rows['success'] = 1;
				$rows['query'] = $query;
				//echo json_encode($rows);
				$content = "";
				//echo $content;
				$content .= '<div class="pagination-wrap" align="center">';
				
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
				$content .= '</div>';
				$rows['pagination'] = $content;
				
			}
			else
			{
				$rows['success'] = 0;
			}
			echo json_encode($rows);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function getdamagedstock(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT ts.stockId,ts.brandId,ts.catId,ts.itemId,ts.stockQty,ts.sellingPrice,ts.purchasedPrice,ts.damageItems,ti.itemName,ti.itemHSN,ti.itemShort,ti.itemDescription,tb.brandName,tc.catName, tt.taxPercentage FROM `tbl_stock` ts INNER JOIN `tbl_item` ti INNER JOIN `tbl_brand` tb INNER JOIN `tbl_category` tc INNER JOIN tbl_tax tt ON ts.itemId = ti.itemId AND ts.brandId = tb.brandId AND ts.catId = tc.catId AND ts.stockTax = tt.taxId WHERE 1";
			
			if(isset($_POST['cat'])){
				$cat = $_POST['cat'];
				if($cat != ""){
					$query .=" AND tc.catId = $cat";
				}
			}
			
			if(isset($_POST['brand'])){
				$brand = $_POST['brand'];
				if($brand != ""){
					$query .=" AND tb.brandId = $brand";
				}
			}
			
			if(isset($_POST['item'])){
				
				$item = $_POST['item'];
				if($item != ""){
					$query .= " AND ti.itemId = $item";
				}
			}
			
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND ti.itemName like '%$search%' OR ti.itemDescription like '%$search%' or ti.itemShort like '%$search%' OR tc.catName like '%$search%' OR tb.brandName like '%$search%' OR tt.taxPercentage like '$search' OR ti.itemHSN like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			//echo $query;
			$query2 = $query;
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = array();
			$irows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$irows[] = $row;
				}
				$rows['data'] = $irows;
				$rows['success'] = 1;
				$rows['query'] = $query;
				//echo json_encode($rows);
				$content = "";
				//echo $content;
				$content .= '<div class="pagination-wrap" align="center">';
				
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
				$content .= '</div>';
				$rows['pagination'] = $content;
				
			}
			else
			{
				$rows['success'] = 0;
			}
			echo json_encode($rows);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function getpdfstock(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT ts.stockId,ts.brandId,ts.catId,ts.itemId,ts.stockQty,ts.sellingPrice,ts.purchasedPrice,ti.itemName,ti.itemHSN,ti.itemShort,ti.itemDescription,tb.brandName,tc.catName, tt.taxPercentage FROM `tbl_stock` ts INNER JOIN `tbl_item` ti INNER JOIN `tbl_brand` tb INNER JOIN `tbl_category` tc INNER JOIN tbl_tax tt ON ts.itemId = ti.itemId AND ts.brandId = tb.brandId AND ts.catId = tc.catId AND ts.stockTax = tt.taxId WHERE 1";
			
			if(isset($_POST['cat'])){
				$cat = $_POST['cat'];
				if($cat != ""){
					$query .=" AND tc.catId = $cat";
				}
			}
			
			if(isset($_POST['brand'])){
				$brand = $_POST['brand'];
				if($brand != ""){
					$query .=" AND tb.brandId = $brand";
				}
			}
			
			if(isset($_POST['item'])){
				
				$item = $_POST['item'];
				if($item != ""){
					$query .= " AND ti.itemId = $item";
				}
			}
			
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND ti.itemName like '%$search%' OR ti.itemDescription like '%$search%' or ti.itemShort like '%$search%' OR tc.catName like '%$search%' OR tb.brandName like '%$search%' OR tt.taxPercentage like '$search' OR ti.itemHSN like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			echo $query;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function getpdfdamagestock(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT ts.stockId,ts.brandId,ts.catId,ts.itemId,ts.stockQty,ts.sellingPrice,ts.purchasedPrice,ts.damageItems,ti.itemName,ti.itemHSN,ti.itemShort,ti.itemDescription,tb.brandName,tc.catName, tt.taxPercentage FROM `tbl_stock` ts INNER JOIN `tbl_item` ti INNER JOIN `tbl_brand` tb INNER JOIN `tbl_category` tc INNER JOIN tbl_tax tt ON ts.itemId = ti.itemId AND ts.brandId = tb.brandId AND ts.catId = tc.catId AND ts.stockTax = tt.taxId WHERE 1";
			
			if(isset($_POST['cat'])){
				$cat = $_POST['cat'];
				if($cat != ""){
					$query .=" AND tc.catId = $cat";
				}
			}
			
			if(isset($_POST['brand'])){
				$brand = $_POST['brand'];
				if($brand != ""){
					$query .=" AND tb.brandId = $brand";
				}
			}
			
			if(isset($_POST['item'])){
				
				$item = $_POST['item'];
				if($item != ""){
					$query .= " AND ti.itemId = $item";
				}
			}
			
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND ti.itemName like '%$search%' OR ti.itemDescription like '%$search%' or ti.itemShort like '%$search%' OR tc.catName like '%$search%' OR tb.brandName like '%$search%' OR tt.taxPercentage like '$search' OR ti.itemHSN like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			echo $query;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getsales()
	{
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT ti.itemId,ts.stockId,ti.itemName,tb.brandName,ti.itemHSN,sum(tbi.itemDiscount) as discount, sum(tbi.itemGST) as gst,sum(tbi.itemPrice*tbi.itemQuantity) as itemPrice,sum(tbi.itemQuantity) as count FROM `tbl_itembill` tbi INNER JOIN `tbl_item` ti INNER JOIN `tbl_stock` ts INNER JOIN `tbl_brand` tb INNER JOIN `tbl_category` tc INNER JOIN tbl_bill tib ON tbi.itemBillNo = tib.billOrderNo AND tbi.itemId = ts.stockId AND ts.itemId = ti.itemId AND ts.brandId = tb.brandId AND tc.catId = ts.catId WHERE 1";
			
			if(isset($_POST['cat'])){
				$cat = $_POST['cat'];
				if($cat != ""){
					$query .=" AND tc.catId = $cat";
				}
			}
			
			if(isset($_POST['brand'])){
				$brand = $_POST['brand'];
				if($brand != ""){
					$query .=" AND tb.brandId = $brand";
				}
			}
			
			if(isset($_POST['item'])){
				
				$item = $_POST['item'];
				if($item != ""){
					$query .= " AND ti.itemId = $item";
				}
			}
			
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND ti.itemName like '%$search%' OR ti.itemDescription like '%$search%' or ti.itemShort like '%$search%' OR tb.brandName like '%$search%' OR ti.itemHSN like '%$search%'";
				}
			}
			
			if(isset($_POST['sdate']))
			{
				$sdate = $_POST['sdate'];
				//$sdate = strtr($sdate, '/', '-');
				//$sdate=date('Y-m-d',strtotime($sdate));
				$query .= " AND tib.billDate = '$sdate'";
			}
			
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tib.billDate BETWEEN '$start' AND '$end')";
			}
			
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			$query .="  GROUP BY ti.itemId ";
			//echo $query;
			$query2 = $query;
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = array();
			$irows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$irows[] = $row;
				}
				$rows['data'] = $irows;
				$rows['success'] = 1;
				$rows['query'] = $query;
				//echo json_encode($rows);
				$content = "";
				//echo $content;
				$content .= '<div class="pagination-wrap" align="center">';
				
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
				$content .= '</div>';
				$rows['pagination'] = $content;
				
			}
			else
			{
				$rows['success'] = 0;
			}
			echo json_encode($rows);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function getpdfsales(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT ti.itemId,ts.stockId,ti.itemName,tb.brandName,ti.itemHSN,sum(tbi.itemDiscount) as discount, sum(tbi.itemGST) as gst,sum(tbi.itemPrice*tbi.itemQuantity) as itemPrice,sum(tbi.itemQuantity) as count FROM `tbl_itembill` tbi INNER JOIN `tbl_item` ti INNER JOIN `tbl_stock` ts INNER JOIN `tbl_brand` tb INNER JOIN `tbl_category` tc INNER JOIN tbl_bill tib ON tbi.itemBillNo = tib.billOrderNo AND tbi.itemId = ts.stockId AND ts.itemId = ti.itemId AND ts.brandId = tb.brandId AND tc.catId = ts.catId WHERE 1";
			
			if(isset($_POST['cat'])){
				$cat = $_POST['cat'];
				if($cat != ""){
					$query .=" AND tc.catId = $cat";
				}
			}
			
			if(isset($_POST['brand'])){
				$brand = $_POST['brand'];
				if($brand != ""){
					$query .=" AND tb.brandId = $brand";
				}
			}
			
			if(isset($_POST['item'])){
				
				$item = $_POST['item'];
				if($item != ""){
					$query .= " AND ti.itemId = $item";
				}
			}
			
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND ti.itemName like '%$search%' OR ti.itemDescription like '%$search%' or ti.itemShort like '%$search%' OR tb.brandName like '%$search%' OR ti.itemHSN like '%$search%'";
				}
			}
			
			if(isset($_POST['sdate']))
			{
				$sdate = $_POST['sdate'];
				//$sdate = strtr($sdate, '/', '-');
				//$sdate=date('Y-m-d',strtotime($sdate));
				$query .= " AND tib.billDate = '$sdate'";
			}
			
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tib.billDate BETWEEN '$start' AND '$end')";
			}
			
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			$query .="  GROUP BY ti.itemId ";
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			echo $query;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function gettaxreport(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT sum(itemGST) as gst,ti.itemBillNo,tb.billDate FROM `tbl_itembill` ti INNER JOIN `tbl_bill` tb ON ti.itemBillNo = tb.billOrderNo WHERE 1";
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tb.billDate BETWEEN '$start' AND '$end')";
			}
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND tb.billOrderNo like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			$query .="   GROUP BY ti.itemBillNo";
			//echo $query;
			$query2 = $query;
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = array();
			$irows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$irows[] = $row;
				}
				$rows['data'] = $irows;
				$rows['success'] = 1;
				//echo json_encode($rows);
				$content = "";
				//echo $content;
				$content .= '<div class="pagination-wrap" align="center">';
				
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
				$content .= '</div>';
				$rows['pagination'] = $content;
				
			}
			else
			{
				$rows['success'] = 0;
			}
			echo json_encode($rows);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function getpdftax(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT sum(itemGST) as gst,ti.itemBillNo,tb.billDate FROM `tbl_itembill` ti INNER JOIN `tbl_bill` tb ON ti.itemBillNo = tb.billOrderNo WHERE 1";
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tb.billDate BETWEEN '$start' AND '$end')";
			}
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND tb.billOrderNo like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			$query .="   GROUP BY ti.itemBillNo";
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			echo $query;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getprofitreport(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			//$records_per_page = 2;
			$query = "SELECT tb.billDate,tib.itemBillNo, sum(((tib.itemPrice-tib.itemPurchasePrice)*tib.itemQuantity)-tib.itemDiscount) as profit FROM `tbl_itembill` tib INNER JOIN `tbl_bill` tb ON tib.itemBillNo = tb.billOrderNo WHERE 1";
			if(isset($_POST['sdate']))
			{
				$sdate = $_POST['sdate'];
				//$sdate = strtr($sdate, '/', '-');
				//$sdate=date('Y-m-d',strtotime($sdate));
				$query .= " AND tb.billDate = '$sdate'";
			}
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tb.billDate BETWEEN '$start' AND '$end')";
			}
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND tib.itemBillNo like '%$search%'";
				}
			}
			
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			$query .=" GROUP BY tib.itemBillNo";
			//echo $query;
			$query2 = $query;
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = array();
			$irows = array();
			$rows['query'] = $query;
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$irows[] = $row;
				}
				$rows['data'] = $irows;
				$rows['success'] = 1;
				//echo json_encode($rows);
				$content = "";
				//echo $content;
				$content .= '<div class="pagination-wrap" align="center">';
				
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
				$content .= '</div>';
				$rows['pagination'] = $content;
				
			}
			else
			{
				$rows['success'] = 0;
			}
			echo json_encode($rows);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function getpdfprofit(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			//$records_per_page = 2;
			$query = "SELECT tb.billDate,tib.itemBillNo, sum(((tib.itemPrice-tib.itemPurchasePrice)*tib.itemQuantity)-tib.itemDiscount) as profit FROM `tbl_itembill` tib INNER JOIN `tbl_bill` tb ON tib.itemBillNo = tb.billOrderNo WHERE 1";
			if(isset($_POST['sdate']))
			{
				$sdate = $_POST['sdate'];
				//$sdate = strtr($sdate, '/', '-');
				//$sdate=date('Y-m-d',strtotime($sdate));
				$query .= " AND tb.billDate = '$sdate'";
			}
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tb.billDate BETWEEN '$start' AND '$end')";
			}
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND tib.itemBillNo like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			
			$query .=" GROUP BY tib.itemBillNo";
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			echo $query;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function getpaymentreport(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT tp.paymentId,tp.paymentDate,tp.paymentAmount,tb.billOrderNo,tb.billDate,tc.clientName,tc.clientContactName FROM `tbl_payment` tp INNER JOIN `tbl_bill` tb INNER JOIN tbl_client tc ON tp.billId = tb.billId AND tc.clientId = tb.billCusId WHERE 1";
			if(isset($_POST['sdate'])){
				$sdate = $_POST['sdate'];
				$query .= " AND tP.paymentDate = '$sdate'";
			}
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tP.paymentDate BETWEEN '$start' AND '$end')";
			}
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND tb.billOrderNo like '%$search%' OR tc.clientName like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			//echo $query;
			$query2 = $query;
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = array();
			$irows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$irows[] = $row;
				}
				$rows['data'] = $irows;
				$rows['success'] = 1;
				//echo json_encode($rows);
				$content = "";
				//echo $content;
				$content .= '<div class="pagination-wrap" align="center">';
				
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
				$content .= '</div>';
				$rows['pagination'] = $content;
				
			}
			else
			{
				$rows['success'] = 0;
			}
			echo json_encode($rows);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function getpdfpayment(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT tp.paymentId,tp.paymentDate,tp.paymentAmount,tb.billOrderNo,tb.billDate,tc.clientName,tc.clientContactName FROM `tbl_payment` tp INNER JOIN `tbl_bill` tb INNER JOIN tbl_client tc ON tp.billId = tb.billId AND tc.clientId = tb.billCusId WHERE 1";
			if(isset($_POST['sdate'])){
				$sdate = $_POST['sdate'];
				$query .= " AND tP.paymentDate = '$sdate'";
			}
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tP.paymentDate BETWEEN '$start' AND '$end')";
			}
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND tb.billOrderNo like '%$search%' OR tc.clientName like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			echo $query;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function getpendingreport(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT * FROM `tbl_bill` tb INNER JOIN `tbl_client` tc ON tb.billCusId = tc.clientId WHERE billBalance > 0";
			if(isset($_POST['sdate'])){
				$sdate = $_POST['sdate'];
				$query .= " AND tb.billDate = '$sdate'";
			}
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tb.billDate BETWEEN '$start' AND '$end')";
			}
			
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND tb.billOrderNo like '%$search%' OR tc.clientName like '%$search%'";
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
			$rows = array();
			$irows = array();
			if($stmt->rowCount()>0)
			{
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$irows[] = $row;
				}
				$rows['data'] = $irows;
				$rows['success'] = 1;
				//echo json_encode($rows);
				$content = "";
				//echo $content;
				$content .= '<div class="pagination-wrap" align="center">';
				
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
				$content .= '</div>';
				$rows['pagination'] = $content;
				
			}
			else
			{
				$rows['success'] = 0;
			}
			echo json_encode($rows);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function getpdfpending(){
		try{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT * FROM `tbl_bill` tb INNER JOIN `tbl_client` tc ON tb.billCusId = tc.clientId WHERE billBalance > 0";
			if(isset($_POST['sdate'])){
				$sdate = $_POST['sdate'];
				$query .= " AND tb.billDate = '$sdate'";
			}
			if(isset($_POST['rdate']))
			{
				$rdate = $_POST['rdate'];
				$rdate = explode('-',$rdate);
				$start = $rdate[0];
				$end = $rdate[1];
				$query .= " AND (tb.billDate BETWEEN '$start' AND '$end')";
			}
			if(isset($_POST['search']))
			{
				$search = $_POST['search'];
				if($search != "")
				{
				$query .= " AND tb.billOrderNo like '%$search%' OR tc.clientName like '%$search%'";
				}
			}
			if(isset($_POST['activepage']))
			{
				if($_POST['activepage']>0)
				{
					$starting_position=($_POST["activepage"]-1)*$records_per_page;
				}
			}
			if($search == ""){
				$query .=" limit $starting_position,$records_per_page";
			}
			echo $query;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
		
}