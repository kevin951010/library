<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>用户检验</title>
</head>

<body>
<?php
	$username=$_POST['username'];
	session_start();
	$_SESSION['username']=$username ;
	echo "<script>location.href='host.php';</script>";
?>
</body>
</html>