
<?php
 	header('Content-type: text/json; charset:utf-8');
	mysql_query("SET NAMES 'utf-8'");
	$username=$_POST['username'];
	$password=$_POST['password'];
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo json_encode(array("status" => "-3"));
		
	}
	else
	{
		$sql="select * from manageuser where name='$username' ";	
		if(!mysqli_query($test,$sql))
		{	
			//echo mysqli_error($test);
			echo json_encode(array("status" => "-2"));
		}
		else
		{
			$result=mysqli_query($test,$sql); 
			$row=mysqli_fetch_array($result);
			$pw=$row['password'];
			if($password==$pw)
			{
				echo json_encode(array("status" => "1"));
			}
			else
			{
				echo json_encode(array("status" => "-1"));
			}
		}  
	}
?>
