<?php
class client
{
	private $db;
	private $current_date;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
		$this->current_date = date('Y-m-d');
	}
	
	public function create_client($clientname,$clientcontactname,$clientcontact,$clientemail,$clientgstin,$clienttype,$clientstatus,$clientbilladdress,$clientbillcity,$clientbillstate,$clientbillpin,$clientbillcountry,$clientshipdiff,$clientshipaddress,$clientshipcity,$clientshipstate,$clientshippin,$clientshipcountry){
		try
		{
			
			$query = "INSERT INTO `tbl_client` (`clientId`, `clientName`, `clientcontactName`, `clientPhone`, `clientEmail`, `clientGSTIN`,`clientBillingAdd`, `clientBillingCity`, `clientBillingState`, `clientBillingPincode`, `clientBillingCountry`, `clientShipping`, `clientShippingAdd`, `clientShippingCity`, `clientShippingState`, `clientShippingPincode`, `clientShippingCountry`, `clientType`,`clientStatus`, `clientAddDate`, `clientModDate`) 
			VALUES (NULL, :name, :contactname, :contact, :email, :gstin,:baddress, :bcity, :bstate, :bpin, :bcountry, :shipping, :saddress, :scity, :sstate, :spin, :scountry, :type,:status,:adate, NULL)";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":name",$clientname);
			$stmt->bindparam(":contactname",$clientcontactname);
			$stmt->bindparam(":contact",$clientcontact);
			$stmt->bindparam(":email",$clientemail);
			$stmt->bindparam(":gstin",$clientgstin);
			$stmt->bindparam(":baddress",$clientbilladdress);
			$stmt->bindparam(":bcity",$clientbillcity);
			$stmt->bindparam(":bstate",$clientbillstate);
			$stmt->bindparam(":bpin",$clientbillpin);
			$stmt->bindparam(":bcountry",$clientbillcountry);
			$stmt->bindparam(":shipping",$clientshipdiff);
			$stmt->bindparam(":saddress",$clientshipaddress);
			$stmt->bindparam(":scity",$clientshipcity);
			$stmt->bindparam(":sstate",$clientshipstate);
			$stmt->bindparam(":spin",$clientshippin);
			$stmt->bindparam(":scountry",$clientshipcountry);
			$stmt->bindparam(":type",$clienttype);
			$stmt->bindparam(":status",$clientstatus);
			$stmt->bindparam(":adate",$this->current_date);
			$stmt->execute();
			//$stmt->execute(array(":name"=>$brandname,":short"=>$brandshort,":description"=>$branddescription,":status"=>$brandstatus,":adate"=>$this->current_date));
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function view_client(){
		try
		{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT * FROM `tbl_client` WHERE 1";
			if(isset($_POST['search'])){
				$search = $_POST['search'];
				$query .= " AND clientName like '%$search%' OR clientcontactName like '%$search%' OR clientPhone like '%$search%' OR clientEmail like '%$search%' OR clientGSTIN like '%$search%'";
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
				$content .= '<th>Client Name</th>';
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
					$content .= '<td>'.$row['clientName'].'</td>';
					$content .= '<td>'.$row['clientcontactName'].'</td>';
					$content .= '<td align="center">'.$row['clientPhone'].'</td>';
					$content .= '<td>'.$row['clientEmail'].'</td>';
					$content .= '<td align="center">'.$row['clientGSTIN'].'</td>';
					
					if($row['clientStatus'] == 1)
					{
						$status = "Active";
					}
					else
					{
						$status = "Inactive";
					}
					$content .= '<td align="center">'.$status.'</td>';
					$content .= '<td align="center"><a id="'.$row['clientId'].'" href="#" class="clientEdit editBtn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;<a id="'.$row['clientId'].'"  href="#" class="clientDelete deleteBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
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
	
	public function view_client_by_id($clientid){
		try
		{
			$query = "SELECT * FROM `tbl_client` WHERE `clientId`=:clientid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":clientid"=>$clientid));
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
	
	public function update_client($clientname,$clientcontactname,$clientcontact,$clientemail,$clientgstin,$clienttype,$clientstatus,$clientbilladdress,$clientbillcity,$clientbillstate,$clientbillpin,$clientbillcountry,$clientshipdiff,$clientshipaddress,$clientshipcity,$clientshipstate,$clientshippin,$clientshipcountry,$clientid){
		try
		{
			$query = "UPDATE `tbl_client` SET `clientName` = :name, `clientcontactName` = :contactname, `clientPhone` = :contact, `clientEmail` = :email, `clientGSTIN` = :gstin,`clientBillingAdd` = :baddress, `clientBillingCity` = :bcity, `clientBillingState` = :bstate, `clientBillingPincode` = :bpin, `clientBillingCountry` = :bcountry, `clientShipping` = :shipping, `clientShippingAdd` = :saddress, `clientShippingCity` = :scity, `clientShippingState` = :sstate, `clientShippingPincode` = :spin, `clientShippingCountry` = :scountry, `clientType` = :type, `clientStatus` = :status, `clientModDate` = :mdate WHERE `tbl_client`.`clientId` = :id";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":name",$clientname);
			$stmt->bindparam(":contactname",$clientcontactname);
			$stmt->bindparam(":contact",$clientcontact);
			$stmt->bindparam(":email",$clientemail);
			$stmt->bindparam(":gstin",$clientgstin);
			$stmt->bindparam(":baddress",$clientbilladdress);
			$stmt->bindparam(":bcity",$clientbillcity);
			$stmt->bindparam(":bstate",$clientbillstate);
			$stmt->bindparam(":bpin",$clientbillpin);
			$stmt->bindparam(":bcountry",$clientbillcountry);
			$stmt->bindparam(":shipping",$clientshipdiff);
			$stmt->bindparam(":saddress",$clientshipaddress);
			$stmt->bindparam(":scity",$clientshipcity);
			$stmt->bindparam(":sstate",$clientshipstate);
			$stmt->bindparam(":spin",$clientshippin);
			$stmt->bindparam(":scountry",$clientshipcountry);
			$stmt->bindparam(":type",$clienttype);
			$stmt->bindparam(":status",$clientstatus);
			$stmt->bindparam(":mdate",$this->current_date);
			$stmt->bindparam(":id",$clientid);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function delete_client($clientid){
		try
		{
			$query = "DELETE FROM `tbl_client` WHERE `clientId`=:clientid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":clientid"=>$clientid));
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function checkClientGst($gst){
		try
		{
			$query = "SELECT * FROM `tbl_client` WHERE clientGSTIN = '$gst'";
			if(isset($_POST['id']))
			{
				$id = $_POST['id'];
				$query = "SELECT * FROM `tbl_client` WHERE clientGSTIN = '$gst' AND clientId != $id";
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
			$query = "SELECT * FROM `tbl_client` WHERE 1";
			return $query;
 		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function get_client_by_id($clientid){
		try
		{
			$query = "SELECT * FROM `tbl_client` WHERE `clientId` = :clientid";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":clientid",$clientid);
			$stmt->execute();
			$content = "";
			if($stmt->rowCount()>0)
			{
				$content .= '<table class="table table-bordered">';
				$content .= '<tr class="tableheading">';
				$content .= '<td>Client Name</td>';
				$content .= '<td>GSTIN</td>';
				$content .= '<td>Contact Name</td>';
				$content .= '</tr>';
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$content .= '<tr>';
				$content .= '<td>'.$row['clientName'].'</td>';
				$content .= '<td>'.$row['clientGSTIN'].'</td>';
				$content .= '<td>'.$row['clientcontactName'].'</td>';
				$content .= '</tr>';
				$content .= '<tr>';
				$content .= '<td colspan="4">';
				$content .= '<a id="'.$row['clientId'].'" class="btn btn-primary wrapClose"><i class="fa fa-times" aria-hidden="true"></i> No</a>  <a id="'.$row['clientId'].'" class="btn btn-danger wrapDelete"><i class="fa fa-check" aria-hidden="true"></i> Yes</a>';
				
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