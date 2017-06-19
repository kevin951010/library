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
	$_SESSION['user']=$username ;
	echo "<script>location.href='boxbook.php';</script>";
?>
</body>
</html>