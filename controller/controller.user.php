<?php
	include('../includes/config.php');
	try
	{
		$flag = $_POST['flag'];
		if($flag == 1)
		{
			$userid = $_POST['userid'];
			$userpass = $_POST['userpass'];
			$status = $user->loginCheck($userid,$userpass);
			echo $status;
		}
		else if($flag == 2)
		{
			$username = $_POST['username'];
			$userid = $_POST['userid'];
			$new_password = $_POST['pass'];
			$password = $password->password_hash($new_password, PASSWORD_BCRYPT);
			
			$compname = $_POST['compname'];
			$compgstin = $_POST['compgstin'];
			$compaddress = $_POST['compaddress'];
			$compcity = $_POST['compcity'];
			$compstate = $_POST['compstate'];
			$comppincode = $_POST['comppincode'];
			$compphone = $_POST['compphone'];
			$compemail = $_POST['compemail'];
			$compweb = $_POST['compweb'];
			$status = $user->createaccount($username,$userid,$password,$compname,$compgstin,$compaddress,$compcity,$compstate,$comppincode,$compphone,$compemail,$compweb);
			echo $status;
		}
		else if($flag == 3){
			$status = $user->viewusers();
			echo $status;
		}
		else if($flag == 4)
		{
			$username = $_POST['userName'];
			$userid = $_POST['userId'];
			$new_password = $_POST['userPass'];
			$password = $password->password_hash($new_password, PASSWORD_BCRYPT);
			$userstatus = $_POST['userStatus'];
			$status = $user->createusers($username,$userid,$password,$userstatus);
			echo $status;
		}
		
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>