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
	$booknumber=$_POST['booknumber'];
	$test=mysqli_connect('localhost:3306','root','');
	$peopleavailbook;
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，借阅失败", "ava" => $availnumber));
	}
	else
	{
		$sql="select * from borrow_behind where booknumber='$booknumber'";
		$result=mysqli_query($test,$sql);
		if(mysqli_fetch_array($result))
		{
			echo json_encode(array("status" => "-2", "mes" => "该书已经被人借阅，借阅失败", "ava" => $availnumber));
			exit();
		}
	
		$sql="select * from borrow_before where booknumber='$booknumber'";
		if(!mysqli_query($test,$sql))
		{	
			
		}
		else
		{
			$result=mysqli_query($test,$sql); 
			$row=mysqli_fetch_array($result);
			if(!mysqli_num_rows($result))
			{
				$sql="select * from borrow_behind where people='$people' and booknumber='$booknumber'";
				if(!mysqli_query($test,$sql))
				{	
			
				}
				else
				{
					$result=mysqli_query($test,$sql); 
					$row=mysqli_fetch_array($result);
					if(!mysqli_num_rows($result))
					{
						$sql="select * from user where username='$people'";
						$result=mysqli_query($test,$sql);
						$num=mysqli_num_rows($result);
						for($i=0;$i<$num;$i++)
						{
							$row=mysqli_fetch_array($result);
							$peopleavailbook=$row['availbooknumber'];
						}
						if($peopleavailbook>0)
						{
							if($availnumber>0)
							{
								$sql="insert into borrow_before(booknumber,bookname,bookauthor,bookpublic,people,time) 		values('$booknumber','$bookname','$bookauthor','$bookpublic','$people','$time')";
								mysqli_query($test,$sql);
								$sql="select * from reservation where people='$people' and isbn='$isbn'";
								if(!mysqli_query($test,$sql))
								{	
			
								}
								else
								{
									$result=mysqli_query($test,$sql); 
									$row=mysqli_fetch_array($result);
									if(!mysqli_num_rows($result))
									{
										$availnumber=$availnumber-1;
										$sql="UPDATE number SET availnumber = '$availnumber' WHERE isbn = '$isbn'";
										mysqli_query($test,$sql);
										$peopleavailbook=$peopleavailbook-1;
										$sql="UPDATE  user SET availbooknumber = '$peopleavailbook' WHERE username = '$people'";
										mysqli_query($test,$sql);
										echo json_encode(array("status" => "1", "mes" => "你好，借阅成功", "ava" => $availnumber));
									}
									else
									{
										$sql="Delete FROM `reservation` where people='$people' and isbn='$isbn'";
										mysqli_query($test,$sql);
										echo json_encode(array("status" => "1", "mes" => "你好，借阅成功", "ava" => $availnumber));
									}
								}
							}
							else
							{
								$sql="select * from reservation where people='$people' and isbn='$isbn'";
								if(!mysqli_query($test,$sql))
								{	
			
								}
								else
								{
									$result=mysqli_query($test,$sql); 
									$row=mysqli_fetch_array($result);
									if(!mysqli_num_rows($result))
									{
										echo json_encode(array("status" => "2", "mes" => "借阅失败，该书已经被其他用户预订", "ava" => $availnumber));
									}
									else
									{
										$sql="insert into borrow_before(booknumber,bookname,bookauthor,bookpublic,people,time) 		values('$booknumber','$bookname','$bookauthor','$bookpublic','$people','$time')";
										mysqli_query($test,$sql);
										$sql="Delete FROM `reservation` where people='$people' and isbn='$isbn'";
										mysqli_query($test,$sql);
							    			echo json_encode(array("status" => "1", "mes" => "你好，借阅成功", "ava" => $availnumber));
									}
								}
							}
						}
						else
						{
							$sql="select * from reservation where people='$people' and isbn='$isbn'";
							if(!mysqli_query($test,$sql))
							{	
						
							}
							else
							{
								$result=mysqli_query($test,$sql); 
								$row=mysqli_fetch_array($result);
								if(!mysqli_num_rows($result))
								{
									echo json_encode(array("status" => "4", "mes" => "你可借阅的书本已到上限，不可借阅其他书本", "ava" => $availnumber));
								}
								else
								{
									$sql="insert into borrow_before(booknumber,bookname,bookauthor,bookpublic,people,time) 		values('$booknumber','$bookname','$bookauthor','$bookpublic','$people','$time')";
									mysqli_query($test,$sql);
									$sql="Delete FROM `reservation` where people='$people' and isbn='$isbn'";
									mysqli_query($test,$sql);
									echo json_encode(array("status" => "1", "mes" => "你好，借阅成功", "ava" => $availnumber));
								}
							}
						}
			 		}				
					else
					{
						echo json_encode(array("status" => "3", "mes" => "该书已经被您借阅，不要重复借阅", "ava" => $availnumber));
					}
				}
			}
			else
			{
				echo json_encode(array("status" => "5", "mes" => "你已经扫描过该书了，快去管理员处借阅吧", "ava" => $availnumber));
			}
		}
	}
?>