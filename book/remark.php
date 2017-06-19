
<?php
	header('Content-type: text/json; charset:utf-8');
	$username=$_POST['username'];
	$isbn=$_POST['isbn'];
	$classify=$_POST['classify'];
	$remarksaid=$_POST['remarksaid'];
	$point=$_POST['point'];
	date_default_timezone_set("Asia/Shanghai");
	$time=date("Y/m/d h:i:s");
	file_put_contents('remark.txt',$username.$isbn.$classify.$point.$time.$remarksaid);
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		//数据库连接失败
		echo json_encode(array("status" => "-3"));
	}
	else
	{
		$sql="INSERT INTO `remark`(`isbn`, `remarkpeople`, `time`, `remark`, `point`, `classifytwo`) VALUES ('$isbn','$username','$time','$remarksaid','$point','$classify')";
		mysqli_query($test,$sql);
		echo json_encode(array("status" => "1"));
	}
?>
