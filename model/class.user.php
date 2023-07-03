<?php
include('class.password.php');
class user extends Password
{
	private $db;
	private $current_date;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
		$this->current_date = date('Y-m-d');
	}
	
	private function get_user_hash($userid){	

		try {

			$stmt = $this->db->prepare('SELECT userPassWord FROM `tbl_user` WHERE userId = :userid');
			$stmt->execute(array('userid' => $userid));
			$row = $stmt->fetch();
			return $row['userPassWord'];

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}
	
	public function loginCheck($userid,$password)
	{
		try
		{
			$hashed = $this->get_user_hash($userid);
			if($this->password_verify($password,$hashed) == 1)
			{
				if(!isset($_SESSION)) 
				{ 
				session_start(); 
				} 
				$_SESSION['user'] = $userid;
				
				$query = "SELECT * FROM tbl_company";
				$stmt = $this->db->prepare($query);
				$stmt->execute();
				if($stmt->rowCount()>0)
				{
					while($row = $stmt->fetch(PDO::FETCH_ASSOC))
					{
					$_SESSION['userState'] = $row['compState'];
					$_SESSION['company'] = $row['compName'];
					}
					$tquery = "SELECT * FROM `tbl_template` WHERE `tempStatus` = 1";
					$tstmt = $this->db->prepare($tquery);
					$tstmt->execute();
					$trow = $tstmt->fetch(PDO::FETCH_ASSOC);
					$_SESSION['tempname'] = $trow['fileName']; 
				}
				else{
					return 2;
				}
				
				return true;
			}
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	public function createaccount($username,$userid,$password,$compname,$compgstin,$compaddress,$compcity,$compstate,$comppincode,$compphone,$compemail,$compweb){
		try{
			$uquery = "INSERT INTO `tbl_user` (`id`, `userName`, `userId`, `userPassWord`, `userStatus`) VALUES (NULL, :username, :userid, :pass,1)";
			$ustmt = $this->db->prepare($uquery);
			$ustmt->execute(array(":username"=>$username,":userid"=>$userid,":pass"=>$password));
			
			$query = "INSERT INTO `tbl_company` (`compId`, `compName`, `compAddress`, `compCity`, `compState`, `compPin`, `compPhone`, `compEmail`, `compWeb`, `compGSTIN`, `compPAN`, `compAddDate`, `compModDate`) VALUES (NULL, :compname, :compadd, :compcity, :compstate, :comppin, :compphone, :compemail, :compweb, :compgst, NULL, :adate, NULL)";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":compname",$compname);
			$stmt->bindparam(":compadd",$compaddress);
			$stmt->bindparam(":compcity",$compcity);
			$stmt->bindparam(":compstate",$compstate);
			$stmt->bindparam(":comppin",$comppincode);
			$stmt->bindparam(":compphone",$compphone);
			$stmt->bindparam(":compemail",$compemail);
			$stmt->bindparam(":compweb",$compweb);
			$stmt->bindparam(":compgst",$compgstin);
			$stmt->bindparam(":adate",$this->current_date);
			$stmt->execute();
			
			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function createusers($username,$userid,$password,$userstatus){
		try
		{
			$uquery = "INSERT INTO `tbl_user` (`id`, `userName`, `userId`, `userPassWord`, `userStatus`) VALUES (NULL, :username, :userid, :pass,:status)";
			$ustmt = $this->db->prepare($uquery);
			$ustmt->execute(array(":username"=>$username,":userid"=>$userid,":pass"=>$password,":status"=>$userstatus));
			return true;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function viewusers(){
		try
		{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT * FROM `tbl_user` WHERE 1";
			if(isset($_POST['search'])){
				$search = $_POST['search'];
				$query .= " AND userId like '%$search%'";
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
				$content .= '<th>User Name</th>';
				$content .= '<th>User ID</th>';
				$content .= '<th>Password</th>';
				$content .= '<th>Action</th>';
				$content .= '</tr>';
				$i = 0;
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$content .= '<tr>';
					$content .= '<td align="center">'.$i.'</td>';
					$content .= '<td>Sample</td>';
					$content .= '<td>'.$row['userId'].'</td>';
					$content .= '<td>'.$row['userPassWord'].'<a id="'.$row['id'].'" href="#" class="viewPass"> <i class="fa fa-eye" aria-hidden="true"></i></a></td>';
					$content .= '<td align="center"><a id="'.$row['id'].'" href="#" class="clientEdit editBtn"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;<a id="'.$row['id'].'"  href="#" class="clientDelete deleteBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
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
	
	
}