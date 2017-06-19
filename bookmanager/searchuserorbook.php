<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>书籍/用户查询</title>
</head>

<body>
<?php
	$username='';
	session_start();
	if(isset($_SESSION['user'])){
    	$username=$_SESSION['user'];
	}else{
   		echo "<script>location.href='loginbook.php';</script>";
	}
?>
	<div style="width:600px;height:500px;margin:50px" >
		<form action="showuser.php" method="post" style="float:left;width:250px">
        		<p style="width:100%;font-size:20px">用户信息：</p>         	

		<p style="width:30%;font-size:18px;float:left;margin:0px;margin-top:10px">用户名：</p>
            	<input style="width:65%;font-size:18px;float:left;margin-top:10px" name="username"/>
            
            	<p style="width:30%;font-size:18px;float:left;margin:0px;margin-top:10px">手机号：</p>
            	<input style="width:65%;font-size:18px;float:left;margin-top:10px" name="phonenumber"/>

            	<p style="width:30%;font-size:18px;float:left;margin:0px;margin-top:10px" >邮箱：</p>
            	<input style="width:65%;font-size:18px;float:left;margin-top:10px" name="mail" />  
                
                <input type="submit" value="开始查询" id="submit1" style="margin:0px;margin-top:10px;float:left;width:80px;height:25px;"/>

       </form>
       
       	<form action="showbookinformation.php" method="post" style="float:left;width:300px;margin-left:30px">
        	<p style="width:100%;font-size:20px">书本信息：</p>
            
            	<p style="width:30%;font-size:18px;float:left;margin:0px;margin-top:10px">书名：</p>
            	<input style="width:65%;font-size:18px;float:left;margin-top:10px" name="bookname"/>
            
            	<p style="width:30%;font-size:18px;float:left;margin:0px;margin-top:10px">图书编号：</p>
            	<input style="width:65%;font-size:18px;float:left;margin-top:10px" name="booknumber"/>
            
            	<p style="width:30%;font-size:18px;float:left;margin:0px;margin-top:10px" id="isbnword">isbn编号：</p>
            	<input style="width:65%;font-size:18px;float:left;margin-top:10px" name="isbninput" id="isbninput"/>
                
            <input type="submit" value="开始查询" id="submit2" style="margin:0px;margin-top:10px;float:left;width:80px;height:25px;"/>
       </form>
</body>

</html>