
<?php
	header('Content-type: text/json; charset:utf-8');
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$phonenumber=$_POST['phonenumber'];
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		//数据库连接失败
		echo json_encode(array("status" => "-3"));
	}
	else
	{
		$value='1'.'+'.rand(000,999).'*'.$username;
		$sql="INSERT INTO `user`(`username`, `password`, `phonenumber`, `mail`, `availbooknumber`,`qrcode`) VALUES ('$username','$password','$phonenumber','空','2','$value')";
		if(!mysqli_query($test,$sql))
		{	
			
			echo json_encode(array("status" => "-2"));
		}
		else
		{
			$sql="INSERT INTO `search`(`username`, `isrecommend`, `frequency`, `science`, `economy`,`military`,`literary`,`art`,`philosophy`,`political`,`education`) VALUES ('$username','false','10','0','0','0','0','0','0','0','0')";
			mysqli_query($test,$sql);
			echo json_encode(array("status" => "1"));
		} 
	}
?>
