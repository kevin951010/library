 <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>网站后台管理</title>
<script src="jquery-1.7.1.min.js"></script>
</head>
<style>
   
#link4{
text-decoration:none;
background-color:#BFD7D2;
border-left:2px solid black;
color:#535353;
font-weight:bold;
padding:5px;
width:300px;
text-align:center;
height:30px;
border-radius:0 20px 20px 0;
position:absolute;
left:830px;
top:0px;
box-shadow:2px 2px 1px #888888;
} 
#contact{
	position:absolute;
	left:80px;
	top:100px;
	width:1170px;
}

</style>

<body>
<?php
	session_start();
	if(isset($_SESSION['user']))
	{	
		$username=$_SESSION['user'];
	}
	else
	{
		echo "<script>location.href='loginbook.php';</script>";
	}
?>

<div id="contact">
	<iframe id="iframe_display" name="iframe_display" style="display:none"></iframe> 
</div>


<div style="position:absolute;top:100px;left:60px">
	<div style="position:relative;width:200px;height:100px;border:thin solid #E78518;">
		<p style="position:relative;top:20px;left:20px"><?php echo "您的名字:".$username ?><br>
		您的身份:manager<br>
		欢迎登陆！</p>
	</div>

	<div style="position:relative;top:60px;">
		<div style="border:thin solid #E78518;position:relative;width:200px;height:30px;" >
			<a href="insertbook.php" style="text-decoration:none;color:black;position:relative;top:10px;left:20px" >添加/删除书籍</a>
		</div>

		<div style="border:thin solid #E78518;position:relative;width:200px;height:30px;" >
			<a href="bookbook.php" style="text-decoration:none;color:black;position:relative;top:10px;left:20px" >预订/借阅书籍查询</a>
		</div>

		<div style="border:thin solid #E78518;position:relative;width:200px;height:30px;" >
			<a href="givebackbook.php" style="text-decoration:none;color:black;position:relative;top:10px;left:20px">显示归还</a>
		</div>

		<div style="border:thin solid #E78518;position:relative;width:200px;height:30px;" >
			<a href="searchuserorbook.php" style="text-decoration:none;color:black;position:relative;top:10px;left:20px">用户/书籍信息查询</a>
		</div>
		<form  method="post" id="form1" target="iframe_display"  enctype="multipart/form-data" >
			<div style="border:thin solid #E78518;position:relative;width:200px;height:30px;" >
				<p style="cursor:pointer;margin:0px;color:black;position:relative;top:10px;left:20px" onclick="download()">数据库备份</p>
			</div>
		</form>
	</div>
</div>

</body>
    <script>
	function download()
	{
		document.getElementById("form1").method="post" ;
		document.getElementById("form1").action = 'downloadbackup.php' ;
		document.getElementById("form1").submit();
	}
		$(document).ready(function(e){
		if(window.history&&window.history.pushState){
			$(window).on('popstate',function(){
				window.history.pushState('forward',null,'#');
				window.history.forward(1);
				window.location.href="loginbook.php";
			});
		}
				window.history.pushState('forward',null,'#');
				window.history.forward(1);
	});
    </script>
</html>