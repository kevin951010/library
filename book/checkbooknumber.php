
<?php
	header('Content-type: text/json; charset:utf-8');
	$booknumber=$_POST['booknumber'];
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		//���ݿ�����ʧ��
		echo json_encode(array("status" => "-3"));
	}
	else
	{
		$sql="select * from book where booknumber='$booknumber'";
		if(!mysqli_query($test,$sql))
		{	
			
		}
		else
		{
			$result=mysqli_query($test,$sql); 
			$row=mysqli_fetch_array($result);
			if(!mysqli_num_rows($result))
			{
				echo json_encode(array("status" => "-1"));
			}
			else
			{
				echo json_encode(array("status" => "1"));
			}
		}
	}
?>
