<!doctype html>
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>搜索结果</title>
</head>

<body style="margin: 0px;">

			<div id="background"  style="background-repeat:no-repeat;background:url(picture/sky-bgimg.jpg);background-size:100% 100%;background-position:   center center;width:100 %;overflow:auto">
            	<div id="title" style="float:left;width:100%;border-bottom:1px solid black">
                	<p id="searchtitle"><b>查询结果:</b>加载中</p>
                </div>
<?php
	header('Content-type: text/html; charset:utf-8');
	$tab="";
	$username='';
	$identification='';
	$context='';
	session_start();
	if((isset($_SESSION['username']))&&(isset($_SESSION['identification']))&&(isset($_SESSION['searchinput']))){
    	$username=$_SESSION['username'];
		$context=$_SESSION['searchinput'];
		$identification=$_SESSION['identification'];
	}else{
   		echo "<script>location.href='index.php';</script>";
	}
	mysql_query("SET NAMES 'utf-8'");
	if($identification=='书名')
	{
		$test=mysqli_connect('localhost:3306','root','');
		mysqli_select_db($test,'library');
		if(mysqli_connect_errno())
		{
			
		}
		else
		{
			$sql="select distinct `bookname`,`bookauthor`,`isbn`,`bookpublic` from book where bookname like '%$context%' or initial = '$context' or fullspell like '%$context%'";
			if(!mysqli_query($test,$sql))
			{	

			}
			else
			{
				$result=mysqli_query($test,$sql);
				$num=mysqli_num_rows($result);
				if($num==0)
				{
					$tab.="<div class='example'  style='float:left;width:100%'>";
					$tab.="<a href=''>";
					$tab.="<p class='bookname' style='display:none'>"."</p>"."</a>";
					$tab.="<p class='bookauthor' style='display:none'>"."</p>";
					$tab.="<p class='isbn' style='display:none'>"."</p>";
					$tab.="<p class='bookpublic' style='display:none' >"."</p>"."</div>";
					$tab.="<div id='resultbox' style='float:left;width:100%'>"."<p id='result' >"."没有搜索到结果"."</p>"."</div>";
					print $tab;
				}
				else
				{
					for($i=0;$i<$num;$i++)
					{
						$row=mysqli_fetch_array($result);
						$isbn=$row['isbn'];
						$tab.="<div class='example'  style='float:left;width:100%'>";
						$tab.="<a href='book.php/?isbn=$isbn'>";
						$tab.="<p class='bookname' >"."书名:".$row['bookname']."</p>"."</a>";
						$tab.="<p class='bookauthor' >"."作者:".$row['bookauthor']."</p>";
						$tab.="<p class='isbn' style='display:none'>".$isbn."</p>";
						$tab.="<p class='bookpublic' >"."出版社:".$row['bookpublic']."</p>"."<hr/>"."</div>";
					}
					$tab.="<div id='resultbox' style='float:left;width:100%'>"."<p id='result' >"."</p>"."</div>";
					print $tab;
				}
			}
		}
	}
	else
	{
		if($identification=='isbn')
		{
			$test=mysqli_connect('localhost:3306','root','');
			mysqli_select_db($test,'library');
			if(mysqli_connect_errno())
			{
			
			}
			else
			{
				$sql="select distinct `bookname`,`bookauthor`,`isbn`,`bookpublic` from book where isbn ='$context'";
				if(!mysqli_query($test,$sql))
				{	

				}
				else
				{
					$result=mysqli_query($test,$sql);
					$num=mysqli_num_rows($result);
					if($num==0)
					{
						$tab.="<div class='example'  style='float:left;width:100%'>";
						$tab.="<a href=''>";
						$tab.="<p class='bookname' style='display:none'>"."</p>"."</a>";
						$tab.="<p class='bookauthor' style='display:none'>"."</p>";
						$tab.="<p class='isbn' style='display:none'>"."</p>";
						$tab.="<p class='bookpublic' style='display:none' >"."</p>"."</div>";
						$tab.="<div id='resultbox' style='float:left;width:100%'>"."<p id='result' >"."没有搜索到结果"."</p>"."</div>";
						print $tab;
					}
					else
					{
						for($i=0;$i<$num;$i++)
						{
							$row=mysqli_fetch_array($result);
							$isbn=$row['isbn'];
							$tab.="<div class='example'  style='float:left;width:100%'>";
							$tab.="<a href='book.php/?isbn=$isbn'>";
							$tab.="<p class='bookname' >"."书名:".$row['bookname']."</p>"."</a>";
							$tab.="<p class='bookauthor' >"."作者:".$row['bookauthor']."</p>";
							$tab.="<p class='isbn' style='display:none'>".$isbn."</p>";
							$tab.="<p class='bookpublic' >"."出版社:".$row['bookpublic']."</p>"."<hr/>"."</div>";
						}
						$tab.="<div id='resultbox' style='float:left;width:100%'>"."<p id='result' >"."</p>"."</div>";
						print $tab;
					}
				}
			}
		}
		else
		{
			$test=mysqli_connect('localhost:3306','root','');
			mysqli_select_db($test,'library');
			if(mysqli_connect_errno())
			{
			
			}
			else
			{
				$sql="select * from book where booknumber ='$context'";
				if(!mysqli_query($test,$sql))
				{	

				}
				else
				{
					$result=mysqli_query($test,$sql);
					$num=mysqli_num_rows($result);
					if($num==0)
					{
						$tab.="<div class='example'  style='float:left;width:100%'>";
						$tab.="<a href=''>";
						$tab.="<p class='bookname' style='display:none'>"."</p>"."</a>";
						$tab.="<p class='bookauthor' style='display:none'>"."</p>";
						$tab.="<p class='isbn' style='display:none'>"."</p>";
						$tab.="<p class='bookpublic' style='display:none' >"."</p>"."</div>";
						$tab.="<div id='resultbox' style='float:left;width:100%'>"."<p id='result' >"."没有搜索到结果"."</p>"."</div>";
						print $tab;
					}
					else
					{
						for($i=0;$i<$num;$i++)
						{
							$row=mysqli_fetch_array($result);
							$isbn=$row['isbn'];
							$tab.="<div class='example'  style='float:left;width:100%'>";
							$tab.="<a href='book.php/?isbn=$isbn'>";
							$tab.="<p class='bookname' >"."书名:".$row['bookname']."</p>"."</a>";
							$tab.="<p class='bookauthor' >"."作者:".$row['bookauthor']."</p>";
							$tab.="<p class='isbn' style='display:none'>".$isbn."</p>";
							$tab.="<p class='bookpublic' >"."出版社:".$row['bookpublic']."</p>"."<hr/>"."</div>";
						}
						$tab.="<div id='resultbox' style='float:left;width:100%'>"."<p id='result' >"."</p>"."</div>";
						print $tab;
					}
				}
			}			
		}
	}
?>
            </div>
</body>
<script>
	var H=document.documentElement.clientHeight;
	document.getElementById("background").style.height=H*1+"px";
	
	var searchtitle=document.getElementById("searchtitle");
	searchtitle.style.fontSize=H*0.03+"px";
	searchtitle.style.position="relative";
	searchtitle.style.top=H*0.02+"px";
	searchtitle.style.left=H*0.03+"px";
	
	var result=document.getElementById("result");
		result.style.position="relative";
		result.style.fontSize=H*0.03+"px";
		result.style.left=H*0.03+"px";
		result.style.top=H*0.02+"px";
	
	var example=document.getElementsByClassName("example");
	var isbn=document.getElementsByClassName("isbn");
	var bookname=document.getElementsByClassName("bookname");
	for(var i=0;i<bookname.length;i++)
	{
		bookname[i].style.position="relative";
		bookname[i].style.fontSize=H*0.03+"px";
		bookname[i].style.left=H*0.03+"px";
		bookname[i].innerHTML="书名:"+cutstr(bookname[i].innerHTML.slice(3),24);
	}
	
	var bookauthor=document.getElementsByClassName("bookauthor");
	for(var i=0;i<bookauthor.length;i++)
	{
		bookauthor[i].style.position="relative";
		bookauthor[i].style.fontSize=H*0.03+"px";
		bookauthor[i].style.left=H*0.03+"px";
	}
	
	var bookpublic=document.getElementsByClassName("bookpublic");
	for(var i=0;i<bookpublic.length;i++)
	{
		bookpublic[i].style.position="relative";
		bookpublic[i].style.fontSize=H*0.03+"px";
		bookpublic[i].style.left=H*0.03+"px";
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
	
	Ifhidden();
	function Ifhidden()
	{
		var nothiddennumber=1;
		if(result.innerHTML=='没有搜索到结果')
		{
			nothiddennumber=0;
		}

			else
			{
				nothiddennumber=example.length;
			}
		
		document.getElementById("searchtitle").innerHTML="<b>查询结果:</b>"+nothiddennumber+"条";
	}
</script>
</html>