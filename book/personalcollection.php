 <!doctype html>
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<title>个人收藏</title>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script src="http://blinkofwings.xyz/book/jquery-confirm.js"></script>
 <link rel="stylesheet" type="text/css" href="http://blinkofwings.xyz/book/jquery-confirm.css">
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
	<div id="container"  style="background-repeat:no-repeat;background: url(picture/bookmark.png);background-size:100% 100%;background-position:   center center;width:90%;">
    	<div id="title" style="width:100%;float:left;text-align:right">
        	<p id="titleword">我的&nbsp;&nbsp;&nbsp;<br>收藏</p>
            <p id="username" style="display:none"><?php echo $username?></p>
        </div>
        <div style="float:left;width:100%;overflow:auto" id="box">
			<?php
				error_reporting(0);
				mysql_query("SET NAMES 'utf-8'");
				$test=mysqli_connect('localhost:3306','root',''); 
				mysqli_select_db($test,'library');
				$tab="";
				if(mysqli_connect_errno())
				{
		
				}
				else
				{
					$sql="select * from collect where people='$username'";
					if(!mysqli_query($test,$sql))
					{
				
					}
					else
					{
						$result=mysqli_query($test,$sql);
						$num=mysqli_num_rows($result);
						for($i=0;$i<$num;$i++)
						{
							$urlimg='';
							$row=mysqli_fetch_array($result);
							$isbn=$row['isbn'];
							$filename="C:/xampp/htdocs/book/summaryfile/".$isbn.".txt";
							$beforeres=	file_get_contents($filename);
							$res=json_decode($beforeres,true);
							if($res['msg']=='book_not_found')
							{
								
							}
							else
							{
								$urlimg=$res['images']['large'];
							}
							$tab.="<div class='example'  style='float:left;width:100%'>";
							$tab.="<div style='background:url($urlimg);background-repeat:no-repeat;background-size:100% 100%;background-position:   center center;border:2px solid black;float:left;' class='bookpicture'>";
							$tab.="<div class='cancel' style='float:left;border-top:2px solid black;width:100%;background-color:#DD171A;opacity:0.4' align='center'>";
							$tab.="<p class='cancelword' style='color:white' onclick='Cancel($isbn,$i)'>"."取消收藏"."</p>"."</div>"."</div>";
							$tab.="<div style='float:left' class='containername'>";
							$tab.="<a href='book.php/?isbn=$isbn'>";
							$tab.="<p class='wanttotalk'>"."书本详情"."</p>"."</a>";
							$tab.="<p class='bookname' >"."<b>"."书名:"."</b>".$row['bookname']."</p>";
							$tab.="<p class='colletdate' >"."<b>"."收藏日期:"."</b>".$row['time']."</p>"."</div>"."</div>";				
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
	var container=document.getElementById("container");
	container.style.position="relative";
	container.style.top=H*0.01+"px";
	container.style.height=H*0.97+"px";
	container.style.left=H*0.03+"px";
	
	var titleword=document.getElementById("titleword");
	titleword.style.position="relative";
	titleword.style.fontSize=H*0.04+"px";
	titleword.style.top=-H*0.02+"px";
	titleword.style.left=-H*0.01+"px";
	
	var box=document.getElementById("box");
	box.style.height=H*0.8+"px";
	box.style.position='relative';
	box.style.top=-H*0.015+"px";
	
	var bookpicture=document.getElementsByClassName("bookpicture");
	for(var i=0;i<bookpicture.length;i++)
	{
		bookpicture[i].style.position="relative";
		bookpicture[i].style.height=H*0.20+"px";
		bookpicture[i].style.width=H*0.16+"px";
		bookpicture[i].style.top=H*0.01+"px";
		bookpicture[i].style.left=H*0.03+"px";
	}
	
	var bookname=document.getElementsByClassName("bookname");
	for(var i=0;i<bookname.length;i++)
	{
		bookname[i].style.position="relative";
		bookname[i].style.fontSize=H*0.03+"px";
		bookname[i].style.left=H*0.04+"px";
		bookname[i].innerHTML="<b>书名:</b>"+cutstr(bookname[i].innerHTML.slice(10),16);
	}
	
	var colletdate=document.getElementsByClassName("colletdate");
	for(var i=0;i<colletdate.length;i++)
	{
		colletdate[i].style.position="relative";
		colletdate[i].style.fontSize=H*0.03+"px";
		colletdate[i].style.left=H*0.04+"px";
	}
	
	var wanttotalk=document.getElementsByClassName("wanttotalk");
	for(var i=0;i<wanttotalk.length;i++)
	{
		wanttotalk[i].style.position="relative";
		wanttotalk[i].style.fontSize=H*0.03+"px"; 
		wanttotalk[i].style.left=H*0.04+"px";
	}
	
	var containername=document.getElementsByClassName("containername");
	for(var i=0;i<containername.length;i++)
	{
		containername[i].style.position="relative";
		containername[i].style.top=-H*0.02+"px";
	}
	
	var cancel=document.getElementsByClassName("cancel");
	for(var i=0;i<cancel.length;i++)
	{
		cancel[i].style.height=H*0.04+"px";
		cancel[i].style.position="absolute";
		cancel[i].style.bottom=0+"px";
	}
	
	var cancelword=document.getElementsByClassName("cancelword");
	for(var i=0;i<cancelword.length;i++)
	{
		cancelword[i].style.position="relative";
		cancelword[i].style.fontSize=H*0.03+"px";
		cancelword[i].style.top=-H*0.025+"px";
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
	
	function Cancel(a,b)
	{
		$.confirm({
		 title:'',
		 content:'你确信要取消收藏该书吗？',
		 confirm:function(){
			var Data="isbn=" + a + "&people="+document.getElementById("username").innerHTML ;
			$.ajax({
          	 	type:'POST',
             		url: 'http://blinkofwings.xyz/book/collect_delete.php',
             		data:Data,
			 dataType:'json',
             		success: function(data){
							$.alert(data.mes);
							if(data.status=='1')
							{
								document.getElementsByClassName("example")[b].style.display="none";
							}
                     },
			 error : function(XMLHttpRequest, textStatus, errorThrown) {　
					$.alert(XMLHttpRequest.responseText); 
			 		$.alert(XMLHttpRequest.status);
			 		$.alert(XMLHttpRequest.readyState);
			 		$.alert(textStatus); 
			 		}
         		}); 			
		 },
			cancel:function(){

			}
		});
	}
</script>
</html>
