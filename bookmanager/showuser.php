 <!doctype html>
<html>
<head>
<title>用户信息查询</title>
</head>

<body>
<div style="position:absolute;top:40px;left:100px">
	<h3>用户信息</h3>
	<table style="width:700px;" border="3" >
	<tr> 
		<td style="width:175px">用户名</td>
		<td style="width:175px">电话</td>
		<td style="width:175px">邮箱</td>
		<td style="width:175px">可借书本</td>
	</tr>
<?php
	session_start();
if(isset($_SESSION['user'])){
    
}else{
   echo "<script>location.href='loginbook.php';</script>";
}
	$username=$_POST['username'];
	$phonenumber=$_POST['phonenumber'];
	$mail=$_POST['mail'];
    header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");

	$tab_str="";
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo "数据库连接失败";
	}
	else
		{	
			$sql="select * from user where username = '$username' or phonenumber ='$phonenumber' or mail='$mail'";
			$result=mysqli_query($test,$sql);
			if(!mysqli_fetch_array($result))
			{
				$array="";
			}
			else
			{
				$result=mysqli_query($test,$sql);
				$num=mysqli_num_rows($result);
				for($i=0;$i<$num;$i++)
					{
						$row=mysqli_fetch_array($result);
						$username=$row['username'];
						$tab_str.="<tr>\n";
						$tab_str.="<td style='width:175px'>".$row['username']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['phonenumber']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['mail']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['availbooknumber']."</td>\n";
						$tab_str.="</tr>\n";
					}
			}
		}
		print $tab_str;
?>
	</table>
    
    <h3>借阅/归还记录</h3>
	<table style="width:700px;" border="3" >
	<tr> 
		<td style="width:175px">图书编号</td>
		<td style="width:175px">书名</td>
		<td style="width:175px">借阅时间</td>
		<td style="width:175px">归还时间</td>
	</tr>
    <?php
    header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");;
	$tab_str="";
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo "数据库连接失败";
	}
	else
		{	
			$sql="select * from borrow_behind where people = '$username' order by time desc";
			$result=mysqli_query($test,$sql);
			if(!mysqli_fetch_array($result))
			{
				$sql="select * from giveback where people = '$username' order by givebacktime desc";
				$result=mysqli_query($test,$sql);
				if(!mysqli_fetch_array($result))
				{
					$array="";
				}
				else
				{
					$result=mysqli_query($test,$sql);
					$num=mysqli_num_rows($result);
					for($i=0;$i<$num;$i++)
					{
						$row=mysqli_fetch_array($result);
						$tab_str.="<tr>\n";
						$tab_str.="<td style='width:175px'>".$row['booknumber']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookname']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['borrowtime']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['givebacktime']."</td>\n";
						$tab_str.="</tr>\n";
					}
				}
			}
			else
			{
				$result=mysqli_query($test,$sql);
				$num=mysqli_num_rows($result);
				for($i=0;$i<$num;$i++)
					{
						$row=mysqli_fetch_array($result);
						$tab_str.="<tr>\n";
						$tab_str.="<td style='width:175px'>".$row['booknumber']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookname']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['time']."</td>\n";
						$tab_str.="<td style='width:175px'>"."还未归还"."</td>\n";
						$tab_str.="</tr>\n";
					}
				$sql="select * from giveback where people = '$username' order by givebacktime desc";
				$result=mysqli_query($test,$sql);
				if(!mysqli_fetch_array($result))
				{
					$array="";
				}
				else
				{
					$result=mysqli_query($test,$sql);
					$num=mysqli_num_rows($result);
					for($i=0;$i<$num;$i++)
					{
						$row=mysqli_fetch_array($result);
						$tab_str.="<tr>\n";
						$tab_str.="<td style='width:175px'>".$row['booknumber']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookname']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['borrowtime']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['givebacktime']."</td>\n";
						$tab_str.="</tr>\n";
					}
				}
			}
		}
		print $tab_str;
?>
</div>
</body> 
</html>