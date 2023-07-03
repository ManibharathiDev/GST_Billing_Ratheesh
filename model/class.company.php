<?php
class company
{
	private $db;
	private $current_date;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
		$this->current_date = date('Y-m-d');
	}
	
	public function create_company($compname,$compadd,$compcity,$compstate,$comppin,$compphone,$compemail,$compweb,$compgst,$comppan){
		try
		{
			
			$query = "INSERT INTO `tbl_company` (`compId`, `compName`, `compAddress`, `compCity`, `compState`, `compPin`, `compPhone`, `compEmail`, `compWeb`, `compGSTIN`, `compPAN`, `compAddDate`, `compModDate`) VALUES (NULL, :compname, :compadd, :compcity, :compstate, :comppin, :compphone, :compemail, :compweb, :compgst, :comppan, :adate, NULL)";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":compname",$compname);
			$stmt->bindparam(":compadd",$compadd);
			$stmt->bindparam(":compcity",$compcity);
			$stmt->bindparam(":compstate",$compstate);
			$stmt->bindparam(":comppin",$comppin);
			$stmt->bindparam(":compphone",$compphone);
			$stmt->bindparam(":compemail",$compemail);
			$stmt->bindparam(":compweb",$compweb);
			$stmt->bindparam(":compgst",$compgst);
			$stmt->bindparam(":comppan",$comppan);
			$stmt->bindparam(":adate",$this->current_date);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function view_company(){
		try
		{
			$query = "SELECT * FROM `tbl_company` WHERE 1";
			if(isset($_POST['search'])){
				$search = $_POST['search'];
				$query .= " AND compName like '%$search%'";
			}
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$content = "";
			if($stmt->rowCount()>0)
			{
				$content .= '<table class="table table-bordered customTable">';
				$content .= '<tr class="tableheading">';
				$content .= '<th>#</th>';
				$content .= '<th>Company Name</th>';
				$content .= '<th>Phone</th>';
				$content .= '<th>Email</th>';
				$content .= '<th>Web</th>';
				$content .= '<th>GSTIN</th>';
				$content .= '<th>PAN</th>';
				$content .= '<th>Action</th>';
				$content .= '</tr>';
				$i = 0;
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$content .= '<tr>';
					$content .= '<td>'.$i.'</td>';
					$content .= '<td>'.$row['compName'].'</td>';
					$content .= '<td>'.$row['compPhone'].'</td>';
					$content .= '<td>'.$row['compEmail'].'</td>';
					$content .= '<td>'.$row['compWeb'].'</td>';
					$content .= '<td>'.$row['compGSTIN'].'</td>';
					$content .= '<td>'.$row['compPAN'].'</td>';
					$content .= '<td align="center"><a id="'.$row['compId'].'" href="#" class="compEdit editBtn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>';
					$content .= '</tr>';
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
	
	public function view_company_by_id($compid){
		try
		{
			$query = "SELECT * FROM `tbl_company` WHERE `compId`=:compid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":compid"=>$compid));
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
	
	public function update_company($compname,$compadd,$compcity,$compstate,$comppin,$compphone,$compemail,$compweb,$compgst,$comppan,$compid){
		try
		{
			$query = "UPDATE `tbl_company` SET `compName` = :compname, `compAddress` = :compadd, `compCity` = :compcity, `compState` = :compstate, `compPin` = :comppin, `compPhone` = :compphone, `compEmail` = :compemail, `compWeb` = :compweb, `compGSTIN` = :compgst, `compPAN` = :comppan, `compModDate` = :mdate WHERE `tbl_company`.`compId` = :id;";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":compname",$compname);
			$stmt->bindparam(":compadd",$compadd);
			$stmt->bindparam(":compcity",$compcity);
			$stmt->bindparam(":compstate",$compstate);
			$stmt->bindparam(":comppin",$comppin);
			$stmt->bindparam(":compphone",$compphone);
			$stmt->bindparam(":compemail",$compemail);
			$stmt->bindparam(":compweb",$compweb);
			$stmt->bindparam(":compgst",$compgst);
			$stmt->bindparam(":comppan",$comppan);
			$stmt->bindparam(":mdate",$this->current_date);
			$stmt->bindparam(":id",$compid);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function delete_company($compid){
		try
		{
			$query = "DELETE FROM `tbl_company` WHERE `compId`=:compid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":compid"=>$compid));
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function update_template($tempid){
		try{
			
		$temp = explode("/",$tempid);
		$tempid = $temp[0];
		$tempname = $temp[1];
		
		$query = "UPDATE `tbl_template` SET `tempStatus` = '1' WHERE `tbl_template`.`tempid` = :id";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array(":id"=>$tempid));
		if (session_status() == PHP_SESSION_NONE) {
		session_start();
		$_SESSION['tempname'] = $tempname;
		}
		
		$query = "UPDATE `tbl_template` SET `tempStatus` = '0' WHERE `tbl_template`.`tempid` != :id";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array(":id"=>$tempid));
		
		return true;
			
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
	}
	
	public function getTemplate(){
		try{
					$query = "SELECT * FROM tbl_template";
						$stmt = $this->db->prepare($query);
						$stmt->execute();
						$rows = array();
						if($stmt->rowCount()>1){
						while($row = $stmt->fetch(PDO::FETCH_ASSOC))
						{
							$rows[] = $row; 
						}
						}
						echo json_encode($rows);
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
	}
}