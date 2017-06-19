
<?php  
	header('Content-type: text/json; charset:utf-8');
	$isbn=$_POST['isbn'];
	$bookname=$_POST['bookname'];
	$people=$_POST['people'];
	$time=date("Y-m-d");
	$test=mysqli_connect('localhost:3306','root','');
		mysqli_select_db($test,'library');
		if(mysqli_connect_errno())
		{
			echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，收藏失败"));
		}
		else
		{
			$sql="select * from collect where people='$people' and isbn='$isbn'";
			if(!mysqli_query($test,$sql))
			{	
				echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，收藏失败"));
			}
			else
			{
				$result=mysqli_query($test,$sql); 
				$row=mysqli_fetch_array($result);
				if(!mysqli_num_rows($result))
				{
					$sql="insert into collect(isbn,bookname,people,time) values('$isbn','$bookname','$people','$time')";
					if(!mysqli_query($test,$sql))
					{	
						echo json_encode(array("status" => "-2", "mes" =>"数据库预定表插入错误，收藏失败"));
					}
					else
					{
						echo json_encode(array("status" => "1", "mes" => "你好，收藏成功"));
					}  
				}
				else
				{
					echo json_encode(array("status" => "2", "mes" => "该书已经收藏成功，不要重复收藏"));
				}
			}
		}
	
?>
