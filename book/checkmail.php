<?php
	header('Content-type: text/json; charset:utf-8');
	$mail=$_POST['mail'];
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		//数据库连接失败
		echo json_encode(array("status" => "-3"));
	}
	else
	{
		$sql="select * from user where mail='$mail'";
		if(!mysqli_query($test,$sql))
		{	
			
		}
		else
		{
			$result=mysqli_query($test,$sql); 
			$row=mysqli_fetch_array($result);
			if(mysqli_num_rows($result))
			{
				//存在这个邮箱
				echo json_encode(array("status" => "-1"));
			}
			else
			{
				echo json_encode(array("status" => "1"));
			}
		}
	}
?>