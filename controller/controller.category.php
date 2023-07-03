<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
		$catname = $_POST['catName'];
		$catshort = $_POST['catShort'];
		$catdescription = $_POST['catDescription'];
		$catstatus = $_POST['catStatus'];
		$status=$category->create_category($catname,$catshort,$catdescription,$catstatus);
		echo $status;
		}
		else if($flag == 2)
		{
			$status = $category->view_category();
			echo $status;
		}
		else if($flag == 3)
		{
			$catid = $_POST['id'];
			$status = $category->view_category_by_id($catid);
			echo $status;
		}
		else if($flag == 4)
		{
			$catname = $_POST['catName'];
			$catshort = $_POST['catShort'];
			$catdescription = $_POST['catDescription'];
			$catstatus = $_POST['catStatus'];
			$catid = $_POST['catId'];
			$status=$category->update_category($catname,$catshort,$catdescription,$catstatus,$catid);
			echo $status;
		}
		else if($flag == 5)
		{
			$catid = $_POST['id'];
			$status = $category->delete_category($catid);
			echo $status;
		}
		else if($flag == 6)
		{
			$cname = $_POST['cname'];
			$status = $category->checkCatName($cname);
			echo $status;
		}
		else if($flag == 7)
		{
			$cname = $_POST['cname'];
			$status = $category->checkCatShortName($cname);
			echo $status;
		}
		else if($flag == 8)
		{
			$status = $category->export();
			echo $status;
		}
		else if($flag == 9)
		{
			$catid = $_POST['id'];
			$status = $category->get_cat_by_id($catid);
			echo $status;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>