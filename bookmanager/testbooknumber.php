<?php
	header('Content-type: text/json; charset:utf-8');
	$booknumber=$_POST['booknumber'];
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo json_encode(array("status" => "-1"));
	}
	else
	{
			$sql="select * from `book` where `booknumber`='$booknumber'";
			$result=mysqli_query($test,$sql);
			if(!mysqli_fetch_array($result))
			{
				echo json_encode(array("status" => "1"));
			}
			else
			{
				echo json_encode(array("status" => "-1"));
			}
	}

?>