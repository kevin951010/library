<?php
	header('Content-type: text/json; charset:utf-8');
	$isbn=$_POST['isbn'];
	$people=$_POST['people'];
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，预订失败"));
	}
	else
	{
		$sql="select * from user where username='$people'";
		$result=mysqli_query($test,$sql);
		$row=mysqli_fetch_array($result);
		$availbooknumber=$row['availbooknumber'];
		
		$sql="DELETE FROM reservation where people='$people' and isbn='$isbn'";
		if(!mysqli_query($test,$sql))
		{	
			echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，取消预订失败","ava"=>$availbooknumber));
		}
		else
		{
			$sql="select * from number where isbn='$isbn'";
			$result=mysqli_query($test,$sql);
			$row=mysqli_fetch_array($result);
			$availnumber=$row['availnumber'];
			$availnumber++;
			$sql="UPDATE number SET availnumber = '$availnumber' WHERE isbn = '$isbn'";
			mysqli_query($test,$sql);
			$availbooknumber++;
			$sql="UPDATE  user SET availbooknumber = '$availbooknumber' WHERE username = '$people'";
			mysqli_query($test,$sql);
			echo json_encode(array("status" => "1", "mes" => "你好，该书取消预订成功","ava"=>$availbooknumber));
		}
	}
?>