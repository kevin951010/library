 <!doctype html>
<html>
<head>
<title>当日查询</title>
</head>

<body>
<div style="position:absolute;top:40px;left:100px">
	<h3>当日书本归还信息获取</h3>
	<table style="width:1050px;" border="3" >
	<tr> 
		<td style="width:175px">还书人</td>
        <td style="width:175px">图书编号</td>
		<td style="width:175px">书名</td>
		<td style="width:175px">作者</td>
		<td style="width:175px">出版社</td>
		<td style="width:175px">归还时间</td>
	</tr>
<?php
    header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	session_start();
if(isset($_SESSION['user'])){
    
}else{
   echo "<script>location.href='loginbook.php';</script>";
}
	$thisyear=$_POST['thisyear0'];
	$thismonth=$_POST['thismonth0'];
	$thisday=$_POST['thisday0'];
	$Cost=0;
   	$time=$thisyear."/".$thismonth."/".$thisday;
	$tab_str="";
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo "数据库连接失败";
	}
	else
		{	
			$sql="select * from giveback where givebacktime like '$time%'";
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
						$tab_str.="<td style='width:175px'>".$row['people']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['booknumber']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookname']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookauthor']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookpublic']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['givebacktime']."</td>\n";
						$tab_str.="</tr>\n";
					}
					$Cost=$num;
			}
		}
		print $tab_str;
		echo "今日归还人次:".$Cost;
?>
	</table>
</div>
</body> 
</html>