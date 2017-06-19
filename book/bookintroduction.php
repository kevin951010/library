<!doctype html>
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>书本介绍</title>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
 <script src="http://blinkofwings.xyz/book/jquery-confirm.js"></script>
 <link rel="stylesheet" type="text/css" href="http://blinkofwings.xyz/book/jquery-confirm.css">
</head>
 
<?php 
	$username='';
	session_start();
	if(isset($_SESSION['username'])){
    	$username=$_SESSION['username'];
	}else{
   		echo "<script>location.href='index.php';</script>";
	}
	error_reporting(0);
	$booknumber =  $_GET['booknumber'];
	$book=array('0','0','0','0','0','0','0','0');
	header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	$urlimg='';
	if(mysqli_connect_errno())
	{
		echo "数据库连接失败";
	}
	else
		{	
			$sql="select * from book where booknumber='$booknumber'";
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
						$book[0]=$row['booknumber'];
						$book[1]=$row['bookname'];
						$book[2]=$row['bookauthor'];
						$book[3]=$row['bookpublic'];
						$book[4]=$row['classify'];
						$book[5]=$row['isbn'];
					}
			}
			$sql="select * from number where isbn='$book[5]'";
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
						$book[6]=$row['totalnumber'];
						$book[7]=$row['availnumber'];
					}
			}
		}
	$filename="C:/xampp/htdocs/book/summaryfile/".$book[5].".txt";
	if(file_get_contents($filename)=="")
	{
		$url= "https://api.douban.com/v2/book/isbn/".$book[5];
		$beforeres=httpGet($url);
		$res=json_decode($beforeres,true);
		file_put_contents($filename,$beforeres);
		if($res['msg']=='book_not_found')
		{
			$introduction='暂无书本简介';
		}
		else
		{
			$introduction=$res['summary'];
			$urlimg=$res['images']['large'];
		}
	}
	else
	{
		$beforeres=	file_get_contents($filename);
		$res=json_decode($beforeres,true);
		if($res['msg']=='book_not_found')
		{
			$introduction='暂无书本简介';
		}
		else
		{
			$introduction=$res['summary'];
			$urlimg=$res['images']['large'];
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
    
<body style="margin: 0px;">
		<div id="background"  style="background-repeat:no-repeat;background:url(picture/sky-bgimg.jpg);background-size:100% 100%;background-position:   center center;width:100 %;">
             	<div id="example1" >
                             
                	<div style="background-repeat:no-repeat;background:url(picture/9787302224464.jpg);background-size:100% 100%;background-position:   center center;border:2px solid black;float:left;" id="bookpicture1">
                    </div>
                    
        			<div style="float:left;" id="example1box">
                    	<p id="classify">分类:<?php echo $book[4] ?></p>
            			<p id="totalnumber"> 馆藏数量:<?php echo $book[6] ?></p>
                        <p id="availnumber">可借数量:<?php echo $book[7] ?></p>
            		</div>
        		</div>
                
                <div id="example2"  style="width:100%;overflow:auto" >                  
                   <div style="float:left;width:100%" id="bookmain">
                    	<p id="bookname" style="width:90%;margin:0px">书名:<?php echo $book[1] ?></p>
                        <p id="bookauthor" style="width:90%;margin:0px">作者:<?php echo $book[2] ?></p>
                        <p id="bookpublic" style="width:90%;margin:0px">出版社:<?php echo $book[3] ?></p>
                        <p id="introduction" style="width:90%;margin:0px">简介:<?php echo $introduction ?></p>
                        <p id="unfold" style="width:90%;color:#DC7577;margin:0px" onclick="unfold()">展开</p>
                        <p id="isbn" style="display:none"><?php echo $book[5] ?></p>
                        <p id="booknumber" style="display:none"><?php echo $book[0]?></p>
                        <p id="username" style="display:none"><?php echo $username ?></p>
                        <p id="urlimg" style="display:none"><?php echo $urlimg ?></p>
                	</div>
        		</div>
                               
        	<div id="cancel" style="width:100%;border-top:2px solid black;background-color:#47E459;float:left" align="center">
       			<p style="float:left;width:50%;" id="collect"  onclick="collect()"> 收藏</p>
                <p style="float:left;width:50%;" id="book" onclick="firm()" > 借阅</p>
       		</div>
     </div>
</body>
<script>
	var H=document.documentElement.clientHeight;

	document.getElementById("background").style.height=H*1+"px";
	var cancel=document.getElementById("cancel");	
	cancel.style.height=H*0.1+"px";
	//cancel.style.position="fixed";
	//cancel.style.bottom=0+"px";

	document.getElementById("collect").style.fontSize=H*0.035+"px";
	document.getElementById("book").style.fontSize=H*0.035+"px";		
	
	document.getElementById("example1").style.height=H*0.24+"px";
	var bookpicture1=document.getElementById("bookpicture1");
	bookpicture1.style.position="relative";
	bookpicture1.style.height=H*0.20+"px";
	bookpicture1.style.width=H*0.16+"px";
	bookpicture1.style.top=H*0.03+"px";
	bookpicture1.style.left=H*0.03+"px";
	bookpicture1.style.backgroundImage="url"+"("+document.getElementById("urlimg").innerHTML+")";
	
	var classify=document.getElementById("classify");
	classify.style.fontSize=H*0.03+"px";
	classify.style.position="relative";
	classify.style.left=H*0.05+"px";
	
	var example1box=document.getElementById("example1box");
	example1box.style.height=H*0.20+"px";
	example1box.style.position="relative";

	document.getElementById("totalnumber").style.fontSize=H*0.03+"px";
	document.getElementById("totalnumber").style.position="relative";
	document.getElementById("totalnumber").style.left=H*0.05+"px";
	
	var availnumber=document.getElementById("availnumber");
	availnumber.style.fontSize=H*0.03+"px";
	availnumber.style.position="relative";
	availnumber.style.left=H*0.05+"px";
	
	var bookmain =document.getElementById("bookmain");
	bookmain.style.height=H*0.66+"px";

		
	var N=document.getElementById("bookname");
	N.style.fontSize=H*0.03+"px";
	N.style.marginLeft=H*0.03+"px";
        N.style.marginTop=H*0.015+"px";
	var temp_N=N.innerHTML.slice(3);
	
	var A=document.getElementById("bookauthor");
	A.style.fontSize=H*0.03+"px";
	A.style.marginLeft=H*0.03+"px";
        A.style.marginTop=H*0.015+"px";
	
	var P=document.getElementById("bookpublic");
	P.style.fontSize=H*0.03+"px";
	P.style.marginLeft=H*0.03+"px";
        P.style.marginTop=H*0.015+"px";
	
	var I=document.getElementById("introduction");
	I.style.fontSize=H*0.03+"px";
	I.style.marginLeft=H*0.03+"px";
        I.style.marginTop=H*0.015+"px";
	var temp=I.innerHTML.slice(3);
	I.innerHTML="简介:"+cutstr(I.innerHTML.slice(3),100);

	var Z=document.getElementById("unfold");
	Z.style.fontSize=H*0.03+"px";
	Z.style.marginLeft=H*0.03+"px";
        Z.style.marginTop=H*0.015+"px";
	
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
	
	var unfold_flag=true;
	function unfold(){
		if(unfold_flag)
		{
			I.innerHTML="简介:"+temp;
			Z.innerHTML="收起";
			//cancel.style.position="relative";
			unfold_flag=false;
		}
		else
		{
			I.innerHTML="简介:"+cutstr(I.innerHTML.slice(3),110);
			Z.innerHTML="展开";
			//cancel.style.position="fixed";
			unfold_flag=true;
		}
	}
	
	function collect()
	{
		$.confirm({
		 title:'',
		 content:'你确信要收藏该书吗？',
		 confirm:function(){
			
			var Data="isbn=" + document.getElementById('isbn').innerHTML.slice(5) + "&bookname=" + temp_N + "&people="+document.getElementById('username').innerHTML;
			$.ajax({
             type:'POST',
             url: 'http://blinkofwings.xyz/book/collect_options.php',
             data:Data,
			 dataType:'json',
             success: function(data){
							$.alert(data.mes);
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
	
	function firm()
	{    
		$.confirm({
		 title:'',
		 content:'你确信要借阅该书吗？',
		 confirm:function(){
				var Data="isbn=" + document.getElementById('isbn').innerHTML + "&bookname=" + temp_N + "&bookauthor=" +document.getElementById('bookauthor').innerHTML.slice(3) + "&bookpublic=" + document.getElementById('bookpublic').innerHTML.slice(4) + "&people="+document.getElementById('username').innerHTML + "&availnumber=" + document.getElementById('availnumber').innerHTML.slice(5)+"&booknumber="+document.getElementById('booknumber').innerHTML;
			 $.ajax({
             type:'POST',
             url: 'http://blinkofwings.xyz/book/borrowbook.php',
             data:Data,
			 dataType:'json',
             success: function(data){
							$.alert(data.mes);
							availnumber.innerHTML="可借数量:"+data.ava;
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
