 <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>多日查询</title>
</head>

<body>
<div style="position:absolute;top:40px;left:100px">
	<h3>多日借阅书本人次信息获取</h3>
	<table style="width:1050px;" border="3" >
	<tr> 
		<td style="width:175px">借书人</td>
        <td style="width:75px">图书编号</td>
		<td style="width:175px">书名</td>
		<td style="width:175px">作者</td>
		<td style="width:175px">出版社</td>
		<td style="width:175px">借出时间</td>
		<td style="width:75px">状态</td>
	</tr>
<?php
    header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	session_start();
if(isset($_SESSION['user'])){
    
}else{
   echo "<script>location.href='loginbook.php';</script>";
}
	$startyear=$_POST['startyear'];
	$startmonth=$_POST['startmonth'];
	$startday=$_POST['startday'];
	
	$startyear0=$startyear;
	$startmonth0=$startmonth;
	$startday0=$startday;
	
	$endyear=$_POST['endyear'];
	$endmonth=$_POST['endmonth'];
	$endday=$_POST['endday'];

	$Cost=0;
   	$Temp=$startyear."/".$startmonth."/".$startday;
	$tab_str="";
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo "数据库连接失败";
	}
	else
		{	
		  while(CompareTo($startyear,$startmonth,$startday,$endyear,$endmonth,$endday))
		  {
			$sql="select * from giveback where borrowtime like '$Temp%'";
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
					$tab_str.="<td style='width:75px'>".$row['booknumber']."</td>\n";
					$tab_str.="<td style='width:175px'>".$row['bookname']."</td>\n";
					$tab_str.="<td style='width:175px'>".$row['bookauthor']."</td>\n";
					$tab_str.="<td style='width:175px'>".$row['bookpublic']."</td>\n";
					$tab_str.="<td style='width:175px'>".$row['borrowtime']."</td>\n";
					$tab_str.="<td style='width:75px'>"."已归还"."</td>\n";
					$tab_str.="</tr>\n";
				}
				$Cost=$num+$Cost;
			}		
	
			$sql="select * from borrow_behind where time like '$Temp%'";
			$result=mysqli_query($test,$sql);
			if(!mysqli_fetch_array($result))
			{
					
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
						$tab_str.="<td style='width:75px'>".$row['booknumber']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookname']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookauthor']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['bookpublic']."</td>\n";
						$tab_str.="<td style='width:175px'>".$row['time']."</td>\n";
						$tab_str.="<td style='width:75px;color:red'>"."未归还"."</td>\n";
						$tab_str.="</tr>\n";
					}
					$Cost=$Cost+$num;				
			}
			switch($startmonth)
			{
			case 1:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>31)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 2:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>28)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 3:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>31)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 4:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>30)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 5:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>31)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 6:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>30)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 7:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>31)
				{
					$startday=01;
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;			
			case 8:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>31)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 9:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>30)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 10:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}				
				if($startday>31)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 11:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>30)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			case 12:
				$startday++;
				if($startday<10)
				{
					$startday="0".$startday;	
				}
				if($startday>31)
				{
					$startday="01";
					$startmonth++;
					if($startmonth<10)
					{
						$startmonth="0".$startmonth;
					}
					if($startmonth>12)
					{
						$startday="01";
						$startmonth="01";
						$startyear++;
					}
				}
				break;
			}		
			$Temp=$startyear."/".$startmonth."/".$startday;
		  }
		  
		}
		print $tab_str;
		echo "多日借阅人次:".$Cost;

		function CompareTo($startyear,$startmonth,$startday,$endyear,$endmonth,$endday)
		{
		if($startyear>$endyear)
		{
			return false;
		}
		else
		{
			if($startyear==$endyear)
			{
				if($startmonth>$endmonth)
				{
					return false;	
				}
				else
				{
					if($startmonth==$endmonth)
					{
						if($startday>$endday)
						{
							return false;
						}
						else
						{
							return true;
						}
					}
					else
					{
						 return true;
					}
				}
			}
			else
			{
				 return true;
			}
		}
	}
	
?>
	</table>
</div>
</body>
</html>