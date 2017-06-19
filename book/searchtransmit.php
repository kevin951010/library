<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
<?php
	$identification=$_POST['identification'];
	$context=$_POST['searchinput'];
	session_start();
	$_SESSION['identification']=$identification ;
	$_SESSION['searchinput']=$context;
	echo "<script>location.href='serchresult.php';</script>";
?>
</body>
</html>