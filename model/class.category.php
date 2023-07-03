<?php
class category
{
	private $db;
	private $current_date;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
		$this->current_date = date('Y-m-d');
	}
	
	public function create_category($catname,$catshort,$catdescription,$catstatus){
		try
		{
			
			$query = "INSERT INTO `tbl_category` (`catId`, `catName`, `catShort`, `catDescription`, `catStatus`, `catAddDate`, `catModDate`) VALUES (NULL, :name, :short, :description, :status, :adate, NULL)";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":name"=>$catname,":short"=>$catshort,":description"=>$catdescription,":status"=>$catstatus,":adate"=>$this->current_date));
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function view_category(){
		try
		{
			$starting_position=0;
			$records_per_page = $_POST['show'];
			$query = "SELECT * FROM `tbl_category` WHERE 1";
			if(isset($_POST['search'])){
				$search = $_POST['search'];
				$query .= " AND catName like '%$search%' OR catDescription like '%$search%' or catShort like '%$search%'";
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
				$content .= '<th>Category Name</th>';
				$content .= '<th>Short Name</th>';
				$content .= '<th>Description</th>';
				$content .= '<th>Status</th>';
				$content .= '<th>Action</th>';
				$content .= '</tr>';
				$i = 0;
				while($row = $stmt->fetch(PDO::FETCH_ASSOC))
				{
					$i++;
					$content .= '<tr>';
					$content .= '<td align="center">'.$i.'</td>';
					$content .= '<td>'.$row['catName'].'</td>';
					$content .= '<td align="center">'.$row['catShort'].'</td>';
					$content .= '<td>'.$row['catDescription'].'</td>';
					
					
					if($row['catStatus'] == 1)
					{
						$status = "Active";
					}
					else
					{
						$status = "Inactive";
					}
					$content .= '<td align="center">'.$status.'</td>';
					$content .= '<td align="center"><a id="'.$row['catId'].'" href="#" class="catEdit editBtn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;<a id="'.$row['catId'].'"  href="#" class="catDelete deleteBtn"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
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
	
	public function view_category_by_id($catid){
		try
		{
			$query = "SELECT * FROM `tbl_category` WHERE `catId`=:catid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":catid"=>$catid));
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
	
	public function update_category($catname,$catshort,$catdescription,$catstatus,$catid){
		try
		{
			$query = "UPDATE `tbl_category` SET `catName` = :name, `catShort` = :short, `catDescription` = :description, `catStatus` = :status, `catModDate` = :mdate WHERE `tbl_category`.`catId` = :id";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":name"=>$catname,":short"=>$catshort,":description"=>$catdescription,":status"=>$catstatus,":mdate"=>$this->current_date,":id"=>$catid));
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function delete_category($catid){
		try
		{	
			$cquery = "SELECT * FROM `tbl_product` WHERE `productBrand` = :catid";
			$csstmt = $this->db->prepare($cquery);
			$csstmt->execute(array(":catid"=>$catid));
			if($csstmt->rowCount()>0)
			{
				return false;
			}
			$query = "DELETE FROM `tbl_category` WHERE `catId`=:catid";
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(":catid"=>$catid));
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function checkCatName($cname){
		try
		{
			$query = "SELECT * FROM `tbl_category` WHERE catName = '$cname'";
			if(isset($_POST['id']))
			{
				$id = $_POST['id'];
				$query = "SELECT * FROM `tbl_category` WHERE catName = '$cname' AND catId != $id";
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
	
	public function checkCatShortName($cname){
		try
		{
			
			$query = "SELECT * FROM `tbl_category` WHERE catShort = '$cname'";
			if(isset($_POST['id']))
			{
				$id = $_POST['id'];
				$query = "SELECT * FROM `tbl_category` WHERE catShort = '$cname' AND catId != $id";
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
			$query = "SELECT * FROM `tbl_category` WHERE 1";
			return $query;
 		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function get_cat_by_id($catid){
		try
		{
			$query = "SELECT * FROM `tbl_category` WHERE `catId` = :catid";
			$stmt = $this->db->prepare($query);
			$stmt->bindparam(":catid",$catid);
			$stmt->execute();
			$content = "";
			if($stmt->rowCount()>0)
			{
				$content .= '<table class="table table-bordered">';
				$content .= '<tr class="tableheading">';
				$content .= '<td>Category Name</td>';
				$content .= '<td>Short Name</td>';
				$content .= '<td>Description</td>';
				$content .= '</tr>';
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$content .= '<tr>';
				$content .= '<td>'.$row['catName'].'</td>';
				$content .= '<td>'.$row['catShort'].'</td>';
				$content .= '<td>'.$row['catDescription'].'</td>';
				$content .= '</tr>';
				$content .= '<tr>';
				$content .= '<td colspan="4">';
				$content .= '<a id="'.$row['catId'].'" class="btn btn-primary wrapClose"><i class="fa fa-times" aria-hidden="true"></i> No</a>  <a id="'.$row['catId'].'" class="btn btn-danger wrapDelete"><i class="fa fa-check" aria-hidden="true"></i> Yes</a>';
				
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