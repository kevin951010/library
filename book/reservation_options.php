 
<?php  
	header('Content-type: text/json; charset:utf-8');
	$isbn=$_POST['isbn'];
	$bookname=$_POST['bookname'];
	$bookauthor=$_POST['bookauthor'];
	$bookpublic=$_POST['bookpublic'];
	$people=$_POST['people'];
	$availnumber=$_POST ['availnumber'];
	date_default_timezone_set("Asia/Shanghai");
	$time=date("Y/m/d G");
		$test=mysqli_connect('localhost:3306','root','');
		mysqli_select_db($test,'library');
		if(mysqli_connect_errno())
		{
			echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，预订失败", "ava" => $availnumber));
		}
		else
		{
			$sql="select * from number where isbn='$isbn'";
			$result=mysqli_query($test,$sql);
			$row=mysqli_fetch_array($result);
			$availnumber=$row['availnumber'];
			$sql="select * from user where username='$people'";
			if(!mysqli_query($test,$sql))
			{	
				echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，预订失败", "ava" => $availnumber));
			}
			else
			{
				$result=mysqli_query($test,$sql);
				$row=mysqli_fetch_array($result);
				$availbooknumber=$row['availbooknumber'];
				if($availbooknumber=='0')
				{
					echo json_encode(array("status" => "-3", "mes" => "借书数量已满，预订失败", "ava" => $availnumber));
				}
				else
				{
					if($availnumber=='0')
					{
						echo json_encode(array("status" => "0", "mes" => "该书已经借完了", "ava" => $availnumber));
					}
					else
					{		
							$sql="select * from reservation where people='$people' and isbn='$isbn'";
							if(!mysqli_query($test,$sql))
							{	
								echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，预订失败", "ava" => $availnumber));
							}
							else
							{
								$result=mysqli_query($test,$sql); 
								$row=mysqli_fetch_array($result);
								if(!mysqli_num_rows($result))
								{
									$sql="insert into reservation(isbn,bookname,bookaurhor,bookpublic,people,time) 		values('$isbn','$bookname','$bookauthor','$bookpublic','$people','$time')";
									if(!mysqli_query($test,$sql))
									{	
										echo json_encode(array("status" => "-2", "mes" =>"数据库预定表插入错误，预订失败", "ava" => $availnumber));
									}
									else
									{
										$availnumber=$availnumber-1;
										$sql="UPDATE number SET availnumber = '$availnumber' WHERE isbn = '$isbn'";
										mysqli_query($test,$sql);
										$availbooknumber=$availbooknumber-1;
										$sql="UPDATE  user SET availbooknumber = '$availbooknumber' WHERE username = '$people'";
										mysqli_query($test,$sql);
										echo json_encode(array("status" => "1", "mes" => "你好，预订成功", "ava" => $availnumber));
									}  
								}
								else
								{
										echo json_encode(array("status" => "2", "mes" => "该书已经预订成功，不要重复预订", "ava" => $availnumber));
								}
							}
						}
					}					
				}
			}
			
?>
