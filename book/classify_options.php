<?php  
	header('Content-type: text/json; charset:utf-8');
	$classify=$_POST['classify'];
	file_put_contents('classify_option.txt',$classify);
	$bookisbn=array('0','0','0','0','0','0','0','0','0','0');
	$bookname=array('','','','','','','','','','');	
	mysql_query("SET NAMES 'utf-8'");
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，跟换失败"));
	}
	else
	{
		$sql="select * from number where classify='$classify' or classify2='$classify' ";
		if(!mysqli_query($test,$sql))
		{
				
		}
		else
		{
			$result=mysqli_query($test,$sql);
			$num=mysqli_num_rows($result);
			if($num==0)
			{
				echo json_encode(array("status" => "2", "mes" => "数据库连接成功，可以跟换","bookname"=>$bookname,"bookisbn"=>$bookisbn));
			}
			else
			{
				if($num>=10)
				{
					$tmp=range(1,$num);
					$a=array_rand($tmp,10);
					for($i=0;$i<10;$i++)
					{
						$resultnumber[$i]=$a[$i];
						$result=mysqli_query($test,$sql);
						for($j=0;$j<=$resultnumber[$i];$j++)
						{
							$row=mysqli_fetch_array($result);
							if($j==$resultnumber[$i])
							{
								$bookname[$i]=$row['name'];
								$bookisbn[$i]=$row['isbn'];
							}
						}
					}
					echo json_encode(array("status" => "1", "mes" => "数据库连接成功，可以跟换","bookname"=>$bookname,"bookisbn"=>$bookisbn,"num"=>$num));
				}
				else
				{
					for($i=0;$i<$num;$i++)
					{
							$row=mysqli_fetch_array($result);
							$bookname[$i]=$row['name'];
							$bookisbn[$i]=$row['isbn'];
					}
					echo json_encode(array("status" => "1", "mes" => "数据库连接成功，可以跟换","bookname"=>$bookname,"bookisbn"=>$bookisbn,"num"=>$num));
				}
			}
		}
	}
								
?>
