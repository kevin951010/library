
 <?php
	error_reporting(0);
	header("Content-type: text/json; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	$booknumber=$_POST['booknumber'];
	$bookname=$_POST['bookname'];
	$bookauthor=$_POST['bookauthor'];
	$bookpublic=$_POST['bookpublic'];
	$classify=$_POST['classify'];
	$classifybelow=$_POST['classifybelow'];
	$price=$_POST['price'];
	$isbn=$_POST['isbn'];
	$fullspell=$_POST['fullspell'];
	$initial=$_POST['initial'];
	$introduction=$_POST['introduction'];
	$bookurl=$_POST['bookurl'];
	$imgurl=$_POST['imgurl'];
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	
	if(($bookurl!="")||($imgurl!=""))
	{
		$filename="C:/xampp/htdocs/book/summaryfile/".$isbn.".txt";
		$content="{\"summary\":"."\"".$introduction."\","."\"images\":{\"large\":"."\"".$imgurl."\"},"."\"alt\":"."\"".$bookurl."\"}";
		$content=str_replace("\t","",$content);
		file_put_contents($filename,$content);
		$auto = 1;
		$contents = file_get_contents($filename);
		$charset[1] = substr($contents, 0, 1);
		$charset[2] = substr($contents, 1, 1);
		$charset[3] = substr($contents, 2, 1);
		if (ord($charset[1]) == 239 && ord($charset[2]) == 187 && ord($charset[3]) == 191) 
		{
  			if ($auto == 1) 
			{
   				$rest = substr($contents, 3);
				$filenum = fopen($filename, "w");
				flock($filenum, LOCK_EX);
				fwrite($filenum, $rest);
				fclose($filenum);
  			}
		}
	}
	
	if(mysqli_connect_errno())
	{
		echo json_encode(array("status" => "-3"));
	}
	else
	{ 
    	$sql="insert into book(`booknumber`, `bookname`, `bookauthor`, `bookpublic`, `classify`, `isbn`, `fullspell`, `initial`) values('$booknumber','$bookname','$bookauthor','$bookpublic','$classify','$isbn','$fullspell','$initial' )";
				if(!mysqli_query($test,$sql))
				{	
					echo json_encode(array("status" => "-2"));
				}
				else
				{
					$sql="select * from number where isbn='$isbn'";
					$result=mysqli_query($test,$sql);
					$num=mysqli_num_rows($result);
					if($num>0)
					{
						$row=mysqli_fetch_array($result);
						$availnumber=$row['availnumber'];
						$totalnumber=$row['totalnumber'];
						$availnumber++;
						$totalnumber++;
						$sql="update `number` set `totalnumber`='$totalnumber',`availnumber`='$availnumber' where `isbn`='$isbn'";
						mysqli_query($test,$sql);
					}
					else
					{
						$sql="insert into number(name,classify,isbn,totalnumber,availnumber,classify2,price) values('$bookname','$classify','$isbn','1','1','$classifybelow','$price' )";
						mysqli_query($test,$sql);
					}
					echo json_encode(array("status" => "1"));
				} 	
	} 

?>
