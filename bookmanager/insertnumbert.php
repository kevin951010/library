
<?php
	header("Content-type: text/json; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	$bookname=$_POST['bookname'];
	$classify=$_POST['classify'];
	$isbn=$_POST['isbn'];
	$totalnumber=$_POST['totalnumber'];
	$availnumber=$_POST['availnumber'];
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo json_encode(array("status" => "-3"));
	}
	else
	{ 
    	$sql="insert into number(name,classify,isbn,totalnumber,availnumber) values('$bookname','$classify','$isbn','$totalnumber','$availnumber' )";
				if(!mysqli_query($test,$sql))
				{	
					echo json_encode(array("status" => "-2"));
				}
				else
				{
					echo json_encode(array("status" => "1"));
				} 	
	} 
?>
