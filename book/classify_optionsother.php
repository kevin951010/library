<?php  
	error_reporting(0);
	header('Content-type: text/json; charset:utf-8');
	$classify=$_POST['classify'];
	file_put_contents('classify_option.txt',$classify);
	$bookisbn=array('0','0','0');
	$resultnumber=array('0','0','0');
	$bookname=array('0','0','0');
	$bookimg=array('0','0','0');	
	mysql_query("SET NAMES 'utf-8'");
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo json_encode(array("status" => "-1", "mes" => "数据库连接错误，跟换失败"));
	}
	else
	{
		$sql="select * from number where classify='$classify'";
		if(!mysqli_query($test,$sql))
		{
				
		}
		else
		{
			$result=mysqli_query($test,$sql);
			$num=mysqli_num_rows($result);
			$tmp=range(1,$num);
			$a=array_rand($tmp,3);
			for($i=0;$i<3;$i++)
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
			
			for($i=0;$i<3;$i++)
			{
				$filename="D:/XAMPP/xampp/htdocs/book/summaryfile/".$bookisbn[$i].".txt";
				if(file_get_contents($filename)=="")
				{
					$url= "https://api.douban.com/v2/book/isbn/".$bookisbn[$i];
					$beforeres=httpGet($url);
					$res=json_decode($beforeres,true);
					file_put_contents($filename,$beforeres);
					$bookimg[$i]=$res['images']['large'];
				}
				else
				{	 
					$beforeres=file_get_contents($filename); 
					$res=json_decode($beforeres,true);
					$bookimg[$i]=$res['images']['large'];
				}
			}
			echo json_encode(array("status" => "1","bookname"=>$bookname,"bookisbn"=>$bookisbn,"bookimg"=>$bookimg));
		}
	}
	
	function httpGet($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$temp = curl_exec($ch);
	curl_close($ch);
	return $temp;
  }							
?>
