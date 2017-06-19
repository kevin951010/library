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
		$sql="DELETE FROM collect where people='$people' and isbn='$isbn'";
		if(!mysqli_query($test,$sql))
		{	
			echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，取消预订失败"));
		}
		else
		{
			echo json_encode(array("status" => "1", "mes" => "你好，该书已经从你的收藏中移除"));
		}
	}
?>