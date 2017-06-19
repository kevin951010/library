<!doctype html>
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<title>个人足迹</title>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
</head>

<body style="margin: 0px;">
			<?php 				
				$username='';
				session_start();
				if(isset($_SESSION['username'])){
    				$username=$_SESSION['username'];
				}else{
   					echo "<script>location.href='index.php';</script>";
				}
			?>
	<div id="container"  style="background-repeat:no-repeat;background: url(picture/leaves.png);background-size:100% 100%;background-position:   center center;width:100%;">
    	<div class="box0" style="width:90%;margin:0px;float:left" id="box0">
        </div>
        <div id="container1" style="width:90%;margin:0px;float:left;overflow:auto" id="container1">
            <?php
				mysql_query("SET NAMES 'utf-8'");
				$test=mysqli_connect('localhost:3306','root',''); 
				mysqli_select_db($test,'library');
				$tab="";
				if(mysqli_connect_errno())
				{
		
				}
				else
				{
					$sql="select * from giveback where people='$username' order by givebacktime desc";
					if(!mysqli_query($test,$sql))
					{
				
					}
					else
					{
						$result=mysqli_query($test,$sql);
						$num=mysqli_num_rows($result);
						for($i=0;$i<$num;$i++)
						{
							$row=mysqli_fetch_array($result);
							$tab.="<div class='box1'  style='float:left;width:100%;border-bottom:1px solid black;margin:0px;'>";
							$tab.="<p class='p1' style='width:100%;margin:0px' >".$row['borrowtime']." "."借阅了"."</p>";
							$tab.="<p class='p2' style='width:100%;margin:0px' >".$row['bookname']."</p>";
							$tab.="<p class='p3' style='width:100%;margin:0px' >".$row['givebacktime']." "."归还了"."</p>";
							$tab.="<p class='p4' style='width:100%;margin:0px'>".$row['bookname']."</p>"."</div>";				
						}
						print $tab;
					}
				}
	?>
       	</div>
    </div>
</body>
<script>
			var H=document.documentElement.clientHeight;
	document.getElementById("container").style.height=H*1+"px";

	var box0=document.getElementById("box0");
	box0.style.height=H*0.1+"px";
	box0.style.marginLeft=H*0.05+"px";
	box0.style.marginRight=H*0.03+"px";
	
	var container1=document.getElementById("container1");
	container1.style.height=H*0.8+"px";
	container1.style.marginLeft=H*0.05+"px";
	container1.style.marginRight=H*0.03+"px";
	
	var box1=document.getElementsByClassName("box1");
	for(var i=0;i<box1.length;i++)
	{
		box1[i].style.height=H*0.26+"px";
	}
	
	var p1=document.getElementsByClassName("p1");
	for(var i=0;i<p1.length;i++)
	{
		p1[i].style.fontSize=H*0.03+"px";
		p1[i].style.marginTop=H*0.01+"px";
	}
	
	var p2=document.getElementsByClassName("p2");
	for(var i=0;i<p2.length;i++)
	{
		p2[i].style.fontSize=H*0.03+"px";
		p2[i].style.marginTop=H*0.01+"px";
		p2[i].innerHTML=cutstr(p2[i].innerHTML,34);
	}
	
	var p3=document.getElementsByClassName("p3");
	for(var i=0;i<p3.length;i++)
	{
		p3[i].style.fontSize=H*0.03+"px";
		p3[i].style.marginTop=H*0.01+"px";
	}
	
	var p4=document.getElementsByClassName("p4");
	for(var i=0;i<p4.length;i++)
	{
		p4[i].style.fontSize=H*0.03+"px";
		p4[i].style.marginTop=H*0.01+"px";
		p4[i].innerHTML=cutstr(p4[i].innerHTML,34);
	}

	function cutstr(str,len)
	{
  	 var str_length = 0;
  	 var str_len = 0;
      str_cut = new String();
      str_len = str.length;
       for(var i = 0;i<str_len;i++)
      {
        a = str.charAt(i);
        str_length++;
        if(escape(a).length > 4)
        {
         //中文字符的长度经编码之后大于4
         str_length++;
         }
         str_cut = str_cut.concat(a);
         if(str_length>=len)
         {
         str_cut = str_cut.concat("...");
         return str_cut;
         }
      }
	  
	    if(str_length<len)
		{
    	 return  str;
    	}

    }
</script>
</html>