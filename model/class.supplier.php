<?php
class supplier
{
	private $db;
	private $current_date;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
		$this->current_date = date('Y-m-d');
	}
	
	public function create_supplier($supname,$supcontname,$supphone,$supemail,$supgstin,$suppan,$supaadhar,$supadd,$supcity,$supstate,$suppin,$supcountry,$supstatus){
		try
		{
			$query = "INSERT INTO `tbl_supplier` (`supplierId`, `supplierName`, `supplierContactName`, `supplierPhone`, `supplierEmail`, `supplierGSTIN`, `supplierPAN`, `supplierAadhar`, `supplierAdd`, `supplierCity`, `supplierState`, `supplierPin`, `supplierCountry`, `supplierStatus`, `supplierAddDate`, `supplierModDate`) VALUES (NULL, :supname, :supcontname, :supphone, :supemail, :supgstin, :suppan, :supaadhar, :supadd, :supcity, :supstate, :suppin, :supcountry, :supstatus, :adate, NULL)";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":supname",$supname);
			$stmt->bindparam(":supcontname",$supcontname);
			$stmt->bindparam(":supphone",$supphone);
			$stmt->bindparam(":supemail",$supemail);
			$stmt->bindparam(":supgstin",$supgstin);
			$stmt->bindparam(":suppan",$suppan);
			$stmt->bindparam(":supaadhar",$supaadhar);
			$stmt->bindparam(":supadd",$supadd);
			$stmt->bindparam(":supcity",$supcity);
			$stmt->bindparam(":supstate",$supstate);
			$stmt->bindparam(":supcountry",$supcountry);
			$stmt->bindparam(":suppin",$suppin);
			$stmt->bindparam(":supstatus",$supstatus);
			$stmt->bindparam(":adate",$this->current_date);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function view_supplier(){
		try
		{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT * FROM `tbl_supplier` WHERE 1";
			if(isset($_POST['search'])){
				$search = $_POST['search'];
				$query .= " AND supplierName like '%$search%' OR supplierContactName like '%$search%' OR supplierPhone like '%$search%' OR supplierEmail like '%$search%' OR supplierGSTIN like '%$search%'";
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
				$content .= '<th>Supplier Name</th>';
				$content .= '<th>Contact Name</th>';
				$content .= '<th>Phone</th>';
				$content .= '<th>Email</th>';
				$content .= '<th>GSTIN</th>';
				$content .= '<th>Status</th>';
				$content .= '<th>Action</th>';
				$content .= '</tr>';
				$i = 0;
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$content .= '<tr>';
					$content .= '<td align="center">'.$i.'</td>';
					$content .= '<td>'.$row['supplierName'].'</td>';
					$content .= '<td>'.$row['supplierContactName'].'</td>';
					$content .= '<td align="center">'.$row['supplierPhone'].'</td>';
					$content .= '<td>'.$row['supplierEmail'].'</td>';
					$content .= '<td align="center">'.$row['supplierGSTIN'].'</td>';
					
					if($row['supplierStatus'] == 1)
					{
						$status = "Active";
					}
					else
					{
						$status = "Inactive";
					}
					$content .= '<td align="center">'.$status.'</td>';
					$content .= '<td align="center"><a id="'.$row['supplierId'].'" href="#" class="supEdit editBtn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;<a id="'.$row['supplierId'].'"  href="#" class="supDelete deleteBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
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
	
	public function view_supplier_by_id($supid){
		try
		{
			$query = "SELECT * FROM `tbl_supplier` WHERE `supplierId`=:supid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":supid"=>$supid));
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
	
	public function update_supplier($supid,$supname,$supcontname,$supphone,$supemail,$supgstin,$suppan,$supaadhar,$supadd,$supcity,$supstate,$suppin,$supcountry,$supstatus){
		try
		{
			$query = "UPDATE `tbl_supplier` SET `supplierName` = :supname, `supplierContactName` = :supcontname, `supplierPhone` = :supphone, `supplierEmail` = :supemail, `supplierGSTIN` = :supgstin, `supplierPAN` = :suppan, `supplierAadhar` = :supaadhar, `supplierAdd` = :supadd, `supplierCity` = :supcity, `supplierState` = :supstate, `supplierPin` = :suppin, `supplierCountry` = :supcountry, `supplierStatus` = :supstatus, `supplierModDate` = :mdate WHERE `tbl_supplier`.`supplierId` = :supid";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":supname",$supname);
			$stmt->bindparam(":supcontname",$supcontname);
			$stmt->bindparam(":supphone",$supphone);
			$stmt->bindparam(":supemail",$supemail);
			$stmt->bindparam(":supgstin",$supgstin);
			$stmt->bindparam(":suppan",$suppan);
			$stmt->bindparam(":supaadhar",$supaadhar);
			$stmt->bindparam(":supadd",$supadd);
			$stmt->bindparam(":supcity",$supcity);
			$stmt->bindparam(":supstate",$supstate);
			$stmt->bindparam(":supcountry",$supcountry);
			$stmt->bindparam(":suppin",$suppin);
			$stmt->bindparam(":supstatus",$supstatus);
			$stmt->bindparam(":mdate",$this->current_date);
			$stmt->bindparam(":supid",$supid);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function delete_supplier($subid){
		try
		{
			$query = "DELETE FROM `tbl_supplier` WHERE `supplierId`=:subid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":subid"=>$subid));
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function checkSupplierName($name){
		try
		{
			$query = "SELECT * FROM `tbl_supplier` WHERE supplierName = '$name'";
			if(isset($_POST['id']))
			{
				$id = $_POST['id'];
				$query = "SELECT * FROM `tbl_supplier` WHERE supplierName = '$name' AND supplierId != $id";
			}
			
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0)
			{
				echo 1;
			}
			else 
				echo 0;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	public function checkSupplierPhone($phone){
		try
		{
			$query = "SELECT * FROM `tbl_supplier` WHERE supplierPhone = '$phone'";
			if(isset($_POST['id']))
			{
				$id = $_POST['id'];
				$query = "SELECT * FROM `tbl_supplier` WHERE supplierPhone = '$phone' AND supplierId != $id";
			}
			
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0)
			{
				echo 1;
			}
			else 
				echo 0;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	public function checkSupplierEmail($email){
		try
		{
			$query = "SELECT * FROM `tbl_supplier` WHERE supplierEmail = '$email'";
			if(isset($_POST['id']))
			{
				$id = $_POST['id'];
				$query = "SELECT * FROM `tbl_supplier` WHERE supplierEmail = '$email' AND supplierId != $id";
			}
			
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0)
			{
				echo 1;
			}
			else 
				echo 0;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	public function checkSupplierGst($gst){
		try
		{
			$query = "SELECT * FROM `tbl_supplier` WHERE supplierGSTIN = '$gst'";
			if(isset($_POST['id']))
			{
				$id = $_POST['id'];
				$query = "SELECT * FROM `tbl_supplier` WHERE supplierGSTIN = '$gst' AND supplierId != $id";
			}
			
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0)
			{
				echo 1;
			}
			else 
				echo 0;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	public function checkSupplierPan($pan){
		try
		{
			$query = "SELECT * FROM `tbl_supplier` WHERE supplierPAN = '$pan'";
			if(isset($_POST['id']))
			{
				$id = $_POST['id'];
				$query = "SELECT * FROM `tbl_supplier` WHERE supplierPAN = '$gst' AND supplierId != $id";
			}
			
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0)
			{
				echo 1;
			}
			else 
				echo 0;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	
	public function checkSupplierAad($aad){
		try
		{
			$query = "SELECT * FROM `tbl_supplier` WHERE supplierAadhar = '$aad'";
			if(isset($_POST['id']))
			{
				$id = $_POST['id'];
				$query = "SELECT * FROM `tbl_supplier` WHERE supplierAadhar = '$aad' AND supplierId != $id";
			}
			
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0)
			{
				echo 1;
			}
			else 
				echo 0;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	
	public function export(){
		try
		{
			$query = "SELECT * FROM `tbl_supplier` ts INNER JOIN `tbl_state` tst ON ts.supplierState = tst.stateDigit WHERE 1";
			return $query;
 		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function get_supplier_by_id($supid){
		try
		{
			$query = "SELECT * FROM `tbl_supplier` WHERE `supplierId` = :supid";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":supid",$supid);
			$stmt->execute();
			$content = "";
			if($stmt->rowCount()>0)
			{
				$content .= '<table class="table table-bordered">';
				$content .= '<tr class="tableheading">';
				$content .= '<td>Supplier Name</td>';
				$content .= '<td>GSTIN</td>';
				$content .= '<td>Contact Name</td>';
				$content .= '</tr>';
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$content .= '<tr>';
				$content .= '<td>'.$row['supplierName'].'</td>';
				$content .= '<td>'.$row['supplierGSTIN'].'</td>';
				$content .= '<td>'.$row['supplierContactName'].'</td>';
				$content .= '</tr>';
				$content .= '<tr>';
				$content .= '<td colspan="4">';
				$content .= '<a id="'.$row['supplierId'].'" class="btn btn-primary wrapClose"><i class="fa fa-times" aria-hidden="true"></i> No</a>  <a id="'.$row['supplierId'].'" class="btn btn-danger wrapDelete"><i class="fa fa-check" aria-hidden="true"></i> Yes</a>';
				
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
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}