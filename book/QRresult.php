<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>二维码扫描结果</title>
</head>

<body>
	<?php session_start(); //初始化一个session
		$_SESSION['booknumber']="300"; 
		echo "<script>location.href='bookintroduction.php';</script>";
	?>  
</body>
</html>