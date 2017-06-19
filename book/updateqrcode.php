<?php
	header('Content-type: text/json; charset:utf-8');
	$username=$_POST['username'];
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	//$value='';
	if(mysqli_connect_errno())
	{
		//数据库连接失败
		echo json_encode(array("status" => "-3"));
	}
	else
	{
		$value='1'.'+'.rand(000,999).'*'.$username;
		$sql="UPDATE  `user` SET `qrcode`='$value' where `username`='$username' ";
		if(!mysqli_query($test,$sql))
		{	
			
			echo json_encode(array("status" => "-2"));
		}
		else
		{
			include "phpqrcode.php"; 
			$errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H  
			$matrixPointSize = "3"; // 点的大小：1到10 
			$picturename=$username.".png"; 
			QRcode::png($value, $picturename, $errorCorrectionLevel, $matrixPointSize); 
			echo json_encode(array("status" => "1","message"=>$value));
		} 
	}
?>