<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>书本信息查询</title>
</head>

<body>
<div style="position:absolute;top:40px;left:50px">
	<h3>用户信息</h3>
	<table style="width:1250px;" border="3" >
	<tr> 
		<td style="width:75px">图书编号</td>
		<td style="width:175px">书名</td>
		<td style="width:175px">作者</td>
		<td style="width:175px">出版社</td>
        <td style="width:150px">isbn编号</td>
        <td style="width:75px">分类</td>
        <td style="width:75px">状态</td>
        <td style="width:175px">借出人</td>
        <td style="width:150px">借出时间</td>
	</tr>
    <?php
    header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	session_start();
if(isset($_SESSION['user'])){
    
}else{
   echo "<script>location.href='loginbook.php';</script>";
}
	$bookname=$_POST['bookname'];
	$booknumber=$_POST['booknumber'];
	$isbn=$_POST['isbninput'];
	$tab_str="";
	$BOOKNB=array("0","0","0");
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	if($booknumber!="")
	{
		$sql="select * from book where booknumber = '$booknumber' ";
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
						$tab_str.="<td style='width:75px'>".$row['booknumber']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookname']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookauthor']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookpublic']."</td>\n";
						$tab_str.="<td style='width:150px'>".$row['isbn']."</td>\n";
						$tab_str.="<td style='width:75px'>".$row['classify']."</td>\n";
				}
				$sql="select * from borrow_behind where booknumber = '$booknumber' ";
				$result=mysqli_query($test,$sql);
				if(!mysqli_fetch_array($result))
				{
					$tab_str.="<td style='width:75px'>"."在馆"."</td>\n";
					$tab_str.="<td style='width:175px'>"."暂无"."</td>\n";
					$tab_str.="<td style='width:150px'>"."\\"."</td>\n";
					$tab_str.="</tr>\n";
				}
				else
				{
					$result=mysqli_query($test,$sql);
					$num=mysqli_num_rows($result);
					for($i=0;$i<$num;$i++)
					{
						$row=mysqli_fetch_array($result);
						$tab_str.="<td style='width:75px'>"."借出"."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['people']."</td>\n";
						$tab_str.="<td style='width:150px'>".$row['time']."</td>\n";
						$tab_str.="</tr>\n";
					}
				}
				print $tab_str;
		}
	}
	else
	{
	 	$sql="select * from book where bookname = '$bookname' or isbn='$isbn'";
		$result=mysqli_query($test,$sql);
		if(!mysqli_fetch_array($result))
		{
			$array="";
		}
		else
		{
			$result0=mysqli_query($test,$sql);
			$num0=mysqli_num_rows($result0);
			for($i=0;$i<$num0;$i++)
			{
				$row=mysqli_fetch_array($result0); 
				$BOOKNB[$i]=$row['booknumber'];
				$sql="select * from book where booknumber = '$BOOKNB[$i]' ";
				$result=mysqli_query($test,$sql);
				$num=mysqli_num_rows($result);
				for($j=0;$j<$num;$j++)
				{
						$row=mysqli_fetch_array($result);
						$tab_str.="<tr>\n";
						$tab_str.="<td style='width:75px'>".$row['booknumber']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookname']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookauthor']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookpublic']."</td>\n";
						$tab_str.="<td style='width:150px'>".$row['isbn']."</td>\n";
						$tab_str.="<td style='width:75px'>".$row['classify']."</td>\n";
				}
				$sql="select * from borrow_behind where booknumber = '$BOOKNB[$i]' ";
				$result=mysqli_query($test,$sql);
				if(!mysqli_fetch_array($result))
				{
					$tab_str.="<td style='width:75px'>"."在馆"."</td>\n";
					$tab_str.="<td style='width:175px'>"."暂无"."</td>\n";
					$tab_str.="<td style='width:150px'>"."\\"."</td>\n";
					$tab_str.="</tr>\n";
				}
				else
				{
					$result=mysqli_query($test,$sql);
					$num=mysqli_num_rows($result);
					for($k=0;$k<$num;$k++)
					{
						$row=mysqli_fetch_array($result);
						$tab_str.="<td style='width:75px'>"."借出"."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['people']."</td>\n";
						$tab_str.="<td style='width:150px'>".$row['time']."</td>\n";
						$tab_str.="</tr>\n";
					}
				}
			}
			print $tab_str;
		}
	}
	?>
	</table>
</div>
</body>
</html>