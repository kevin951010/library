<?php
 	header('Content-type: text/json; charset:utf-8');
	mysql_query("SET NAMES 'utf-8'");
 $booknumber=$_POST['booknumber'];
 $test=mysqli_connect('localhost:3306','root','');
 mysqli_select_db($test,'library');
 if(mysqli_connect_errno())
 {
		echo json_encode(array("status" => "-3"));
 }
 else
 {
	  $sql0="select * from book where booknumber='$booknumber' ";
				if(!mysqli_query($test,$sql0))
				{				
				
				}
				else
				{
					$result=mysqli_query($test,$sql0); 
					$row=mysqli_fetch_array($result);
					$isbn=$row['isbn'];
					$sql="select * from number where isbn='$isbn'";
					$result=mysqli_query($test,$sql); 
					$row=mysqli_fetch_array($result);
					$availnumber=$row['availnumber'];
					$totalnumber=$row['totalnumber'];
					if($availnumber>"0")
					{
						$sql="delete from `book` where `booknumber`='$booknumber'";
						mysqli_query($test,$sql);
						$availnumber--;
						$totalnumber--;
						$sql="update `number` set `totalnumber`='$totalnumber',`availnumber`='$availnumber' where `isbn`='$isbn'";
						mysqli_query($test,$sql);
						echo json_encode(array("status" => "1"));
					}
					else
					{
						echo json_encode(array("status" => "-2"));
					}
				}
	
 }
?>
