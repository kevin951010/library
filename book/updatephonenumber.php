
<?php
	header('Content-type: text/json; charset:utf-8');
	$username=$_POST['username'];
	$phonenumber=$_POST['phonenumber'];
	file_put_contents('updatephonenumber.txt',$username.$phonenumber);
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		//数据库连接失败
		echo json_encode(array("status" => "-3"));
	}
	else
	{
		$sql="UPDATE user SET `phonenumber`='$phonenumber' WHERE `username`='$username' ";
		if(!mysqli_query($test,$sql))
		{	
			
			echo json_encode(array("status" => "-2"));
		}
		else
		{
			echo json_encode(array("status" => "1"));
		} 
	}
?>
