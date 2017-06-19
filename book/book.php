<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" >
<title>书本介绍</title>

    <script src="http://blinkofwings.xyz/book/jquery-3.2.1.min.js"></script>
    <script src="http://blinkofwings.xyz/book/jquery.star-rating-svg.js"></script>
    <script src="http://blinkofwings.xyz/book/checkbix.js"></script>
    <script src="http://blinkofwings.xyz/book/jquery-confirm.js"></script>
    <link rel="stylesheet" type="text/css" href="http://blinkofwings.xyz/book/star-rating-svg.css">
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
	$isbn = $_GET['isbn'];
	$book=array('0','0','0','0','0','0','0','0','0','0','0');
	$classify=array('0','0','0','0','0','0','0','0','0');
	$remark=array('0','0','0','0');
	$tab="";
	$urlimg='0';
	$point="暂无分数";
	header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		echo "数据库连接失败";
	}
	else
		{	
			
			$sql="select * from book where isbn='$isbn'";
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
						$book[8]=$row['classify'];
						$book[9]=$row['classify2'];
						$book[10]=$row['price'];
					}
			}
			$sql="select * from search where username='$username'";
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
						$classify[0]=$row['science'];
						$classify[1]=$row['economy'];
						$classify[2]=$row['military'];
						$classify[3]=$row['literary'];
						$classify[4]=$row['art'];
						$classify[5]=$row['philosophy'];
						$classify[6]=$row['political'];
						$classify[7]=$row['education'];
					} 
				if($book[8]=='科学/科技')
				{
					$classify[0]++;
				}
				if($book[8]=='经济')
				{
					$classify[1]++;
				}
				if($book[8]=='军事')
				{
					$classify[2]++;
				}
				if($book[8]=='文学/历史')
				{
					$classify[3]++;
				}
				if($book[8]=='艺术')
				{
					$classify[4]++;
				}
				if($book[8]=='哲学')
				{
					$classify[5]++;
				}
				if($book[8]=='政治/法律')
				{
					$classify[6]++;
				}
				if($book[8]=='教育/体育')
				{
					$classify[7]++;
				}
				$sql="update `search` set `science`='$classify[0]',`economy`='$classify[1]',`military`='$classify[2]',`literary`='$classify[3]',`art`='$classify[4]',`philosophy`='$classify[5]',`political`='$classify[6]',`education`='$classify[7]' where username='$username'";
			mysqli_query($test,$sql);																	
			}
		}
		
				$bookisbn=array('0','0','0');
				$resultnumber=array('0','0','0');
				$bookname=array('0','0','0');
				$bookimg=array('0','0','0');			
				mysql_query("SET NAMES 'utf-8'");
				$test=mysqli_connect('localhost:3306','root',''); 
				mysqli_select_db($test,'library');
				if(mysqli_connect_errno())
				{
		
				}
				else
				{
					$sql="select * from number where classify='$book[8]'";
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
					}
				}
	
	for($i=0;$i<3;$i++)
	{
		$filename="C:/xampp/htdocs/book/summaryfile/".$bookisbn[$i].".txt";
		if(file_get_contents($filename)=="")
		{
			$url= "https://api.douban.com/v2/book/isbn/".$bookisbn[$i];
			$beforeres=httpGet($url);
			$res=json_decode($beforeres,true);
			file_put_contents($filename,$beforeres);
			if($res['msg']=='book_not_found')
			{
				
			}
			else
			{
				$bookimg[$i]=$res['images']['large'];
			}
		}
		else
		{	 
			$beforeres=file_get_contents($filename); 
			$res=json_decode($beforeres,true);
			if($res['msg']=='book_not_found')
			{

			}
			else
			{
				$bookimg[$i]=$res['images']['large'];
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
		$beforeres=file_get_contents($filename); 
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
    
        <?php 
			$sql="select * from remark where isbn='$isbn' ";
			$result=mysqli_query($test,$sql);
			if(!mysqli_fetch_array($result))
			{
				
			}
			else
			{
				$point=0;
				$result=mysqli_query($test,$sql);
				$num=mysqli_num_rows($result);
				for($i=0;$i<$num;$i++)
					{
						$row=mysqli_fetch_array($result);
						$point=$point+$row['point'];		
					}
				$point=number_format($point/$num,1)."分";
			}
?>
    
<body style="margin: 0px;">
		<div id="background"  style="background-repeat:no-repeat;background:url('http://blinkofwings.xyz/book/picture/sky-bgimg.jpg');background-size:100% 100%;background-position:   center center;width:100 %;">
             	<div id="example1" >
                             
                	<div style="background-repeat:no-repeat;background-size:100% 100%;background-position:   center center;border:2px solid black;float:left;" id="bookpicture1">
                    </div>
                    
        			<div style="float:left;" id="example1box">
                    	<p id="classify" style="margin:0px">分类:<?php echo $book[9] ?></p>
            			<p id="number" style="margin:0px">数量:<?php echo $book[7] ?>(可借)/<?php echo $book[6] ?>(馆藏)</p>
     <p id="price" style="margin:0px">图书价格:<?php echo $book[10] ?>元</p>
     <p id="bookpoint" style="margin:0px">团栾评分:<?php echo $point ?></p>
                    
            		</div>
                    
                 <div style="float:right;" id="example2box">
					<img src="http://blinkofwings.xyz/book/picture/home.svg" style="vertical-align:middle" id="refresh" onclick="host()"/>
				</div>
                    
        		</div>
                
                               
                   <div style="float:left;width:100%;overflow:auto" id="bookmain">
                    	<p id="isbn" style="width:95%;margin:0px">isbn:<?php echo $book[5] ?></p> 
			<p id="bookname" style="width:95%;margin:0px">书名:<?php echo $book[1] ?></p>
                        <p id="bookauthor" style="width:95%;margin:0px">作者:<?php echo $book[2] ?></p>
                        <p id="bookpublic" style="width:95%;margin:0px">出版社:<?php echo $book[3] ?></p>

                        <p id="urlimg" style="display:none"><?php echo $urlimg ?></p>
                        <p id="username" style="display:none"><?php echo $username ?></p>
                        <p id="CY" style="display:none"><?php echo $book[8] ?></p>
                	</div>
                    
        			<div id="navigeter" style="float:left;width:93%;">
            			<div id="label" style="float:left;width:99%;">
                    		<div id="label1" style="float:left;width:20%;border-left:1px solid gray;border-top:5px solid #F40;border-bottom:none" align="center" onClick="label1click()"> 
                        		<p id="label1word" style="float:left;margin:0px;color:#F40" >简介</p>
                        	</div>
                        	<div id="label2" style="float:left;width:20%;border:1px solid gray;background:#DCDCDC;" align="center" onClick="label2click()"><p id="label2word" style="float:left;margin:0px">评论</p>
                        	</div>
                       		 <div id="label3" style="float:left;width:30%;border:1px solid gray;background:#DCDCDC;" align="center" onClick="label3click()">					<p id="label3word" style="float:left;margin:0px">书籍推荐</p>
                        	</div>
                        	<div id="label4" style="float:left;width:29%;border-bottom:1px solid gray"></div>
                    	</div>
                   		<div id="details1" style="width:99%;overflow:auto;border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray">
  							<p id="introduction" style="width:98%;margin:0px;word-break:break-all"><?php echo $introduction ?></p>
                       		<p id="unfold" style="width:98%;color:#DC7577" onclick="unfold()">展开</p>
                    	</div>
                    	<div id="details2" style="width:99%;border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray;display:none;float:left">
                    		<div id="remark" style="width:90%;">
                        		<form >
                            		<textarea  name="introduction" style="width:99%;overflow:auto;"   id="remarksaid" autocomplete="off" placeholder="想说点啥" onkeyup="keypress()" onblur="keypress()"></textarea>	
                               	 		<div id="handinbox" style="width:99%">
                                			<input type="button" id="handinbutton" value="发布" style="float:right;width:20%" onClick="remarkbutton()"/>
                                    		<label id="hidenamebox" style="float:right"><input id="hidename" type="checkbox" class="checkbix" data-shape="circled" data-color="orange" data-text="" name="hidename" value="">匿名 </label> 
                                    		<p id="wordlength" style="float:left;margin:0px">0/100</p>
                                    		<div class="my-rating-6" style="float:left"></div>
                                		</div>
                            	</form>
                        	</div>
							<div id="userremark" style="width:90%;overflow:auto;">
     <?php 
			$sql="select * from remark where isbn='$isbn' order by time desc";
			$result=mysqli_query($test,$sql);
			if(!mysqli_fetch_array($result))
			{
				$tab.="<div class='user'  style='width:100%'>"."暂无评论"."</div>";
				print $tab;
			}
			else
			{
				$result=mysqli_query($test,$sql);
				$num=mysqli_num_rows($result);
				for($i=0;$i<$num;$i++)
					{
						$row=mysqli_fetch_array($result);
						$remark[0]=$row['remarkpeople'];
						$remark[1]=$row['time'];
						$remark[2]=$row['remark'];
						$remark[3]=$row['point'];
						$remark[1]=substr($remark[1],0,10);
						$tab.="<div class='user'  style='width:100%'>";
						$tab.="<p class='username' style='float:left;margin:0px'>".$remark[0]."</p>";

						$tab.="<p class='point' style='float:left;margin:0px'>".$remark[3]."分"."</p>";
						$tab.="<p class='usertime' style='float:left;margin:0px'>".$remark[1]."</p>";
						$tab.="<p class='userremark' style='width:98%;margin:0px;word-break:break-all;clear:both'>".$remark[2]."</p>"."</div>"."<hr/>";				
					}
					print $tab;
			}
?>
                        </div>
					 </div>
                    <div id="details3" style="width:99%;border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray;display:none;float:left;">
                    	<div id="youlike" style="width:100%;">
                			<p style="float:left;margin:0px" id="youlikeword" > 你可能喜欢的书：</p>
                    		<p style="float:right;margin:0px;text-decoration:underline;color:#2F2F2F" id="changeword" onclick="change()">换一批</p>
                		</div>
                        <div style="width:100%" id="imgbox">
                        	<div id="img1" style="float:left;width:30%;border:1px solid black;background-repeat:no-repeat;background-size:100% 100%;background-position:   center center;">
                            	<p id="img1word" style="display:none"><?php echo $bookimg[0]?></p>
                            </div>
                            <div id="img2" style="float:left;width:30%;border:1px solid black;background-repeat:no-repeat;background-size:100% 100%;background-position:   center center;">
                            	<p id="img2word" style="display:none"><?php echo $bookimg[1]?></p>
                            </div>
                            <div id="img3" style="float:left;width:30%;border:1px solid black;background-repeat:no-repeat;background-size:100% 100%;background-position:   center center;">
                            	<p id="img3word" style="display:none"><?php echo $bookimg[2]?></p>
                            </div>
                        </div>
                        <div style="float:left;width:100%;" id="recommend">
                    	<a  id="a0" style="text-decoration: none;">
                        	<p style="float:left;width:32%;margin:0px;color:#890204;word-break:break-all" id="book1"><?php echo $bookname[0] ?></p>
                        	<p style="display:none" id="book1isbn"><?php echo $bookisbn[0]?></p>
                    	</a>
                    	<a  id="a1" style="text-decoration: none;">
                    		<p style="float:left;width:32%;margin:0px;color:#890204;word-break:break-all" id="book2"><?php echo $bookname[1] ?></p>
                        	<p style="display:none" id="book2isbn"><?php echo $bookisbn[1]?></p>
                    	</a>
                    	<a  id="a2" style="text-decoration: none;">
                    		<p style="float:left;width:30%;margin:0px;color:#890204;word-break:break-all" id="book3"><?php echo $bookname[2] ?></p>
                        	<p style="display:none" id="book3isbn"><?php echo $bookisbn[2]?></p>
                    	</a>
            			</div> 
  					</div>
              	</div>
              	
        		<div id="cancel" style="width:100%;border-top:2px solid black;background-color:#47E459;float:left" align="center">
       				<p style="float:left;width:50%;" id="collect" onclick="collect()"> 收藏</p>
                	<p style="float:left;width:50%;" id="book" onclick="firm()" > 预订</p>
       			</div>
  
            
     </div>
</body>
<script >
	var H=document.documentElement.clientHeight;
	var Refresh=document.getElementById("refresh");
	Refresh.style.height=H*0.1+"px";
	Refresh.style.width=H*0.1+"px";

	function host()
	{
		location.href="http://blinkofwings.xyz/book/host.php";
	}
	document.getElementById("background").style.height=H*1+"px";
	

	var cancel=document.getElementById("cancel");	
	cancel.style.height=H*0.08+"px";
	document.getElementById("collect").style.fontSize=H*0.035+"px";
	document.getElementById("collect").style.marginTop=H*0.02+'px';
	document.getElementById("book").style.fontSize=H*0.035+"px";
	document.getElementById("book").style.marginTop=H*0.02+"px";
		
	document.getElementById("example1").style.height=H*0.24+"px";
	var bookpicture1=document.getElementById("bookpicture1");
	bookpicture1.style.position="relative";
	bookpicture1.style.height=H*0.20+"px";
	bookpicture1.style.width=H*0.16+"px";
	bookpicture1.style.top=H*0.02+"px";
	bookpicture1.style.left=H*0.03+"px";
	bookpicture1.style.backgroundImage="url"+"("+document.getElementById("urlimg").innerHTML+")";
	//"url"+"("+"http://localhost/book/picture/"+document.getElementById("isbn").innerHTML+".jpg"+")";
	console.log(document.getElementById("urlimg").innerHTML);
	
	var classify=document.getElementById("classify");
	classify.style.fontSize=H*0.03+"px";
	classify.style.marginLeft=H*0.05+"px";
	classify.style.marginTop=H*0.02+"px";
	var example1box=document.getElementById("example1box");
	example1box.style.height=H*0.20+"px";
	example1box.style.position="relative";
	var number=document.getElementById("number");
	number.style.marginLeft=H*0.05+"px";
	number.style.fontSize=H*0.03+"px";
	number.style.marginTop=H*0.01+"px";
	var price=document.getElementById("price");
	price.style.marginLeft=H*0.05+"px";
	price.style.fontSize=H*0.03+"px";
	price.style.marginTop=H*0.01+"px";
	var bookpoint=document.getElementById("bookpoint");
	bookpoint.style.marginLeft=H*0.05+"px";
	bookpoint.style.fontSize=H*0.03+"px";
	bookpoint.style.marginTop=H*0.01+"px";
	var bookmain=document.getElementById("bookmain");
	bookmain.style.height=H*0.18+"px";
		
	var N=document.getElementById("bookname");
	N.style.fontSize=H*0.03+"px";
	N.style.marginLeft=H*0.03+"px";
	//N.style.marginBottom=H*0.01+"px";
	N .style.position="relative";
	var temp_N=N.innerHTML.slice(3);
	N.style.top=-H*0.005+"px";
	N.innerHTML="书名:"+cutstr(N.innerHTML.slice(3),30 );
	
	var A=document.getElementById("bookauthor");
	A.style.fontSize=H*0.03+"px";
	A.style.position="relative";
	A.style.left=H*0.03+"px";
	A.style.top=-H*0.005+"px";
	//A.style.marginBottom=H*0.01+"px";

	var isbn=document.getElementById("isbn");
	isbn.style.position="relative";
	isbn.style.top=-H*0.005+"px";
	isbn.style.left=H*0.03+"px";
	//isbn.style.marginBottom=H*0.01+"px";
	isbn.style.fontSize=H*0.03+"px";
	
	var P=document.getElementById("bookpublic");
	P.style.fontSize=H*0.03+"px";
	P.style.position="relative";
	P.style.left=H*0.03+"px";
	P.style.top=-H*0.005+"px";
	//P.style.marginBottom=H*0.01+"px";
	
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
	
	
	
	function firm()
	{    
		$.confirm({
		 title:'',
		 content:'你确信要预订该书吗？',
		 confirm:function(){
			var Data="isbn=" + document.getElementById('isbn').innerHTML.slice(5) + "&bookname=" + temp_N + "&bookauthor=" +document.getElementById('bookauthor').innerHTML.slice(3) + "&bookpublic=" + document.getElementById('bookpublic').innerHTML.slice(4) + "&people="+document.getElementById('username').innerHTML + "&availnumber=" + document.getElementById('number').innerHTML.slice(3,4);
			 $.ajax({
             type:'POST',
             url: 'http://blinkofwings.xyz/book/reservation_options.php',
             data:Data,
			 dataType:'json',
             success: function(data){
							 $.alert(data.mes);
							number.innerHTML="数量:"+data.ava+number.innerHTML.slice(4);
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
	
	var label1=document.getElementById("label1");
	var label2=document.getElementById("label2");
	var label3=document.getElementById("label3");
	document.getElementById("navigeter").style.height=H*0.5+"px";
	document.getElementById("navigeter").style.marginLeft=H*0.03+"px";
	document.getElementById("label").style.height=H*0.05+"px";
	document.getElementById("label1").style.height=H*0.05+"px";
	document.getElementById("label2").style.height=H*0.05+"px";
	document.getElementById("label3").style.height=H*0.05+"px";
	document.getElementById("label4").style.height=H*0.05+"px";
	document.getElementById("label1word").style.fontSize=H*0.03+"px";
	document.getElementById("label1word").style.marginTop=H*0.01+'px';
	document.getElementById("label1word").style.marginLeft=H*0.01+'px';
	document.getElementById("label2word").style.fontSize=H*0.03+"px";
	document.getElementById("label2word").style.marginTop=H*0.01+"px";
	document.getElementById("label2word").style.marginLeft=H*0.01+'px';
	document.getElementById("label3word").style.fontSize=H*0.03+"px";
	document.getElementById("label3word").style.marginTop=H*0.01+"px";
	document.getElementById("label3word").style.marginLeft=H*0.01+'px';
	document.getElementById("details1").style.height=H*0.44+"px";
	document.getElementById("details2").style.height=H*0.44+"px";
	document.getElementById("details3").style.height=H*0.44+"px";
	document.getElementById("youlikeword").style.marginLeft=H*0.01+"px";
	document.getElementById("youlikeword").style.marginTop=H*0.01+"px";
	document.getElementById("youlikeword").style.fontSize=H*0.035+"px";
	document.getElementById("changeword").style.marginRight=H*0.03+"px";
	document.getElementById("changeword").style.fontSize=H*0.03+"px";
	document.getElementById("changeword").style.marginTop=H*0.01+"px";
	var youlike=document.getElementById("youlike");	
	youlike.style.height=H*0.04+"px";
	youlike.style.marginBottom=H*0.01+"px";
	document.getElementById("img1").style.height=H*0.2+"px";
	document.getElementById("img1").style.marginLeft=H*0.012+"px";
	document.getElementById("img2").style.height=H*0.2+"px";
	document.getElementById("img2").style.marginLeft=H*0.012+"px";
	document.getElementById("img3").style.height=H*0.2+"px";
	document.getElementById("img3").style.marginLeft=H*0.012+"px";
	document.getElementById("imgbox").style.marginTop=H*0.05+"px";
	var book1=document.getElementById("book1");
	book1.style.fontSize=H*0.03+"px";
	book1.style.paddingLeft=H*0.02+"px";
	book1.style.paddingTop=H*0.005+"px";
	book1.innerHTML=cutstr(book1.innerHTML,26);
	var book2=document.getElementById("book2");
	book2.style.fontSize=H*0.03+"px";
	book2.style.paddingLeft=H*0.005+"px";
	book2.style.paddingTop=H*0.005+"px";
	book2.innerHTML=cutstr(book2.innerHTML,26);
	var book3=document.getElementById("book3");
	book3.style.fontSize=H*0.03+"px";
	book3.style.paddingLeft=H*0.005+"px";
	book3.style.paddingTop=H*0.005+"px";
	book3.innerHTML=cutstr(book3.innerHTML,26);
	document.getElementById("a0").href='book.php/?isbn='+document.getElementById("book1isbn").innerHTML;
	document.getElementById("a1").href='book.php/?isbn='+document.getElementById("book2isbn").innerHTML;
	document.getElementById("a2").href='book.php/?isbn='+document.getElementById("book3isbn").innerHTML;
	document.getElementById("img1").style.backgroundImage="url"+"("+document.getElementById("img1word").innerHTML+")";
	document.getElementById("img2").style.backgroundImage="url"+"("+document.getElementById("img2word").innerHTML+")";
	document.getElementById("img3").style.backgroundImage="url"+"("+document.getElementById("img3word").innerHTML+")";
	document.getElementById("remark").style.height=H*0.19+"px";
	document.getElementById("remark").style.marginLeft=H*0.02+"px";
	document.getElementById("remark").style.marginTop=H*0.01+"px";
	document.getElementById("userremark").style.marginTop=H*0.01+"px";
	document.getElementById("userremark").style.height=H*0.225+"px";
	document.getElementById("userremark").style.marginLeft=H*0.02+"px";
	document.getElementById("remarksaid").style.height=H*0.14+"px";
	document.getElementById("remarksaid").style.fontSize=H*0.026+"px";
	document.getElementById("handinbox").style.height=H*0.05+"px";
	document.getElementById("handinbutton").style.fontSize=H*0.03+"px";
	document.getElementById("handinbutton").style.marginTop=H*0.005+"px";
	document.getElementById("hidenamebox").style.fontSize=H*0.03+"px";
	document.getElementById("hidenamebox").style.marginRight=H*0.01+"px";
	document.getElementById("hidenamebox").style.marginTop=H*0.005+"px";
	document.getElementById("hidename").style.height=H*0.03+"px";
	document.getElementById("hidename").style.width=H*0.03+"px";
	document.getElementById("hidename").style.marginRight=H*0.01+"px";
	document.getElementById("wordlength").style.fontSize=H*0.03+"px";
	var user=document.getElementsByClassName("user");
	for(var i=0;i<user.length;i++)
	{
		user[i].style.fontSize=H*0.03+"px";
	}
	var point=document.getElementsByClassName("point");
	for(var i=0;i<point.length;i++)
	{
		point[i].style.marginLeft=H*0.015+"px";
	}
	var usertime=document.getElementsByClassName("usertime");
	for(var i=0;i<usertime.length;i++)
	{
		usertime[i].style.marginLeft=H*0.015+"px";
	}
	var userremark=document.getElementsByClassName("userremark");
	for(var i=0;i<userremark.length;i++)
	{
		userremark[i].style.fontSize=H*0.026+"px";
	}
	
    function label1click()
	{
		label1.style.borderTop="5px solid #F40";
		label1.style.borderBottom="none";
		label1.style.background="none";
		document.getElementById("label1word").style.color="#F40";
		label2.style.border="1px solid gray";
		label2.style.background="#DCDCDC";
		document.getElementById("label2word").style.color="black";
		label3.style.border="1px solid gray";
		label3.style.background="#DCDCDC";
		document.getElementById("label3word").style.color="black";
		document.getElementById("details1").style.display="block";
		document.getElementById("details2").style.display="none";
		document.getElementById("details3").style.display="none";
	}
	
	function label2click()
	{
		label2.style.borderTop="5px solid #F40";
		label2.style.borderBottom="none";
		label2.style.background="none";
		document.getElementById("label2word").style.color="#F40";
		label1.style.border="1px solid gray";
		label1.style.background="#DCDCDC";
		document.getElementById("label1word").style.color="black";
		label3.style.border="1px solid gray";
		label3.style.background="#DCDCDC";
		document.getElementById("label3word").style.color="black";
		document.getElementById("details1").style.display="none";
		document.getElementById("details2").style.display="block";
		document.getElementById("details3").style.display="none";
	}
	
	function label3click()
	{
		label3.style.borderTop="5px solid #F40";
		label3.style.borderBottom="none";
		label3.style.background="none";
		document.getElementById("label3word").style.color="#F40";
		label2.style.border="1px solid gray";
		label2.style.background="#DCDCDC";
		document.getElementById("label2word").style.color="black";
		label1.style.border="1px solid gray";
		label1.style.background="#DCDCDC";
		document.getElementById("label1word").style.color="black";
		document.getElementById("details1").style.display="none";
		document.getElementById("details2").style.display="none";
		document.getElementById("details3").style.display="block";
	}
	
	var I=document.getElementById("introduction");
	I.style.fontSize=H*0.03+"px";
	I.style.marginTop=H*0.01+"px";
	I.style.marginLeft=H*0.01+"px";
	I.style.marginBottom=H*0.01+"px";
	var temp=I.innerHTML.slice(3);
	I.innerHTML=cutstr(I.innerHTML.slice(3),110);

	var Z=document.getElementById("unfold");
	Z.style.fontSize=H*0.03+"px";
	Z.style.marginLeft=H*0.01+"px";
	Z.style.marginTop=H*0.01+"px";
	
	var unfold_flag=true;
	function unfold(){
		if(unfold_flag)
		{
			I.innerHTML=temp;
			Z.innerHTML="收起";
			//recommend.style.position="relative";
			unfold_flag=false;
		}
		else
		{
			I.innerHTML=cutstr(I.innerHTML,110);
			Z.innerHTML="展开";
			//recommend.style.position="fixed";
			unfold_flag=true;
		}
	}
	
		function change()
	{
		var Data="classify="+document.getElementById("CY").innerHTML;
			 $.ajax({
             type:'POST',
             url: 'http://blinkofwings.xyz/book/classify_optionsother.php',
             data:Data,
			 dataType:'json',
             success: function(data){
							book1.innerHTML=cutstr(data.bookname[0],26);
							book2.innerHTML=cutstr(data.bookname[1],26);
							book3.innerHTML=cutstr(data.bookname[2],26);

							document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
							document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
							document.getElementById("a2").href='book.php/?isbn='+data.bookisbn[2];
							
	document.getElementById("img1").style.backgroundImage="url"+"("+data.bookimg[0]+")";
	document.getElementById("img2").style.backgroundImage="url"+"("+data.bookimg[1]+")";
	document.getElementById("img3").style.backgroundImage="url"+"("+data.bookimg[2]+")";
							
							console.log(data.bookimg[1]+data.bookimg[2]+data.bookimg[0])		
                      },
			 error : function(XMLHttpRequest, textStatus, errorThrown) {　
					$.alert(XMLHttpRequest.responseText); 
			 		$.alert(XMLHttpRequest.status);
			 		$.alert(XMLHttpRequest.readyState);
			 		$.alert(textStatus); 
			 	}
         	});	
	}
	
	function keypress()
	{
		document.getElementById("wordlength").innerHTML=document.getElementById("remarksaid").value.length+"/"+"100";
		if(document.getElementById("remarksaid").value.length>100)
		{
			$.alert("您的评论超过字数限制了");	
		}
	}
</script>
<script>
var point=8;
var name;
$(function() {
  $(".my-rating-6").starRating({
    totalStars: 5,
    emptyColor: 'deepgray',
    hoverColor: 'slategray',
    activeColor: '#ffa419',
    initialRating: 4,
    strokeWidth: 0,
    useGradient: false,
	disableAfterRate: false,
    callback: function(currentRating, $el){
      console.log('DOM Element ',currentRating);
	  point=currentRating*2;
    }
  });
});

 function remarkbutton()
 {
	if(document.getElementById("remarksaid").value>=100)
	{
		$.alert("评论内容过长，无法提交");
	}
	else
	{
	 	if(document.getElementById("remarksaid").value=="")
		{
			$.alert("请填写评论内容");
		}
		else
		{
			if(document.getElementById("hidename").checked){
    			name="匿名";
			}
			else
			{
				name=document.getElementById("username").innerHTML;	
			}
			 var Data="classify="+document.getElementById("classify").innerHTML.slice(3)+"&isbn="+document.getElementById("isbn").innerHTML.slice(5)+"&username="+name+"&point="+point+"&remarksaid="+document.getElementById("remarksaid").value;
			 $.ajax({
             type:'POST',
             url: 'http://blinkofwings.xyz/book/remark.php',
             data:Data,
			 dataType:'json',
             success: function(data){
				 	if(data.status=='1')
					{
						$.alert("评论发布成功！");
						window.location.reload();
					}
                      },
			 error : function(XMLHttpRequest, textStatus, errorThrown) {　
					$.alert(XMLHttpRequest.responseText); 
			 		$.alert(XMLHttpRequest.status);
			 		$.alert(XMLHttpRequest.readyState);
			 		$.alert(textStatus); 
			 	}
         	});	
		}
	}
 }
 Checkbix.init();
</script>
</html>
