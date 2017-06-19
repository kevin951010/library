
<?php
	header('Content-type: text/json; charset:utf-8');
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		//数据库连接失败
		echo json_encode(array("status" => "-3"));
	}
	else
	{
		$sql="select * from user where username='$username'";
		if(!mysqli_query($test,$sql))
		{	
			
		}
		else
		{
			$result=mysqli_query($test,$sql); 
			$row=mysqli_fetch_array($result);
			if(!mysqli_num_rows($result))
			{
				//没有这个用户
				echo json_encode(array("status" => "-1"));
			}
			else
			{
				if($password==$row['password'])
				{
					//密码匹配成功
					echo json_encode(array("status" => "1"));
				}
				else
				{
					//密码匹配失败
					echo json_encode(array("status" => "-2"));	
				}
			}
		}
	}
?>
