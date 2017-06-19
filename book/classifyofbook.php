<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>图书分类</title>
	<link rel='stylesheet prefetch' href='cssnav/foundation.css'>
	<link rel="stylesheet" type="text/css" href="cssnav/styles.css">
	<script src='stopExecutionOnTimeout.js?t=1'></script>
	<script src='jquery-3.2.1.min.js'></script>
	<script src='jquery.velocity.min.js'></script>
</head>

<?php
				$username='';
				session_start();
				if(isset($_SESSION['username'])){
    				$username=$_SESSION['username'];
				}else{
   					echo "<script>location.href='index.php';</script>";
				}
				$bookisbn=array('0','0','0','0','0','0','0','0','0','0');
				$resultnumber=array('0','0','0','0','0','0','0','0','0','0');
				$bookname=array('0','0','0','0','0','0','0','0','0','0');			
				mysql_query("SET NAMES 'utf-8'");
				$test=mysqli_connect('localhost:3306','root',''); 
				mysqli_select_db($test,'library');
				if(mysqli_connect_errno())
				{
		
				}
				else
				{
					$sql="select * from number where `classify`='科学/科技'";
					if(!mysqli_query($test,$sql))
					{
				
					}
					else
					{
						$result=mysqli_query($test,$sql);
						$num=mysqli_num_rows($result);
						$tmp=range(1,$num);
						$a=array_rand($tmp,10);
						
						for($i=0;$i<10;$i++)
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
			?>
            
<body style="margin: 0px;background:#FFD588" id="box0"  >
	<div id="box" style="width:100%">
    	<div id="left" style="float:left;width:30%;background:#FFD588" >
 			<ul class=mtree bubba id="bubba">
			  <li><a href="#" onclick="classify('科学/科技')">科学/科技</a>
			    <ul>
			      <li><a href="#" onclick="classify('计算机')">计算机</a></li>
			      <li><a href="#" onclick="classify('生物科学')">生物科学</a></li>
			      <li><a href="#" onclick="classify('交通运输')">交通运输</a></li>
			      <li><a href="#" onclick="classify('工业技术')">工业技术</a></li>
			      <li><a href="#" onclick="classify('农业技术')">农业技术</a></li>
			      <li><a href="#" onclick="classify('航空航天')">航空航天</a></li>
                   <li><a href="#" onclick="classify('数理化科学')">数·理·化</a></li>
			      <li><a href="#" onclick="classify('医学')">医学</a></li>
				  <li><a href="#" onclick="classify('环境安全')">环境安全</a></li>
				  <li><a href="#" onclick="classify('地质学')">地质学</a></li>
				  <li><a href="#" onclick="classify('心理学')">心理学</a></li>
			    </ul>
			  </li>
			  <li><a href="#" onclick="classify('经济')">经济</a>
			    <ul>
			      <li><a href="#" onclick="classify('经济学')">经济学</a></li>
			      <li><a href="#" onclick="classify('金融')">金融</a></li>
			      <li><a href="#" onclick="classify('投资')">投资</a></li>
				  <li><a href="#" onclick="classify('管理')">管理</a></li>
				  <li><a href="#" onclick="classify('企业史')">企业史</a></li>
				  <li><a href="#" onclick="classify('股票')">股票</a></li>
			    </ul>
			  </li>
			  <li><a href="#" onclick="classify('文学/历史')">文学/历史</a>
			    <ul>
			      <li><a href="#" onclick="classify('日本文学')">日本文学</a></li>
			      <li><a href="#" onclick="classify('外国文学')">外国文学</a></li>
			      <li><a href="#" onclick="classify('古典文学')">古典文学</a></li>
			      <li><a href="#" onclick="classify('现代文学')">现代文学</a></li>
			      <li><a href="#" onclick="classify('旅行游记')">旅行游记</a></li>
			      <li><a href="#" onclick="classify('中国历史')">中国历史</a></li>
			      <li><a href="#" onclick="classify('外国历史')">外国历史</a></li>
			   </ul>
			  </li>
			  <li><a href="#" onclick="classify('艺术')">艺术</a>
			    <ul>
			      <li><a href="#" onclick="classify('设计')">设计</a></li>
			      <li><a href="#" onclick="classify('建筑')">建筑</a></li>
			      <li><a href="#" onclick="classify('摄影')">摄影</a></li>
			      <li><a href="#" onclick="classify('美术')">美术</a></li>
				  <li><a href="#" onclick="classify('音乐')">音乐</a></li>
				  <li><a href="#" onclick="classify('雕刻')">雕刻</a></li>
				  <li><a href="#" onclick="classify('影视')">影视</a></li>
				  <li><a href="#" onclick="classify('美学')">美学</a></li>
				  <li><a href="#" onclick="classify('戏剧')">戏剧</a></li>
				  <li><a href="#" onclick="classify('古玩')">古玩</a></li>
			   </ul>
			  </li>
			  <li><a href="#" onclick="classify('军事')">军事</a>
			    <ul>
			      <li><a href="#" onclick="classify('武器')">武器</a></li>
			      <li><a href="#" onclick="classify('战争史')">战争史</a></li>
				  <li><a href="#" onclick="classify('战争论')">战争论</a></li>
			    </ul>
			  </li>
			  <li><a href="#" onclick="classify('哲学')">哲学</a>
			  	<ul>
			      <li><a href="#" onclick="classify('西方哲学')">西方哲学</a></li>
			      <li><a href="#" onclick="classify('东方哲学')">东方哲学</a></li>
				  <li><a href="#" onclick="classify('哲学理论')">哲学理论</a></li>
				  <li><a href="#" onclick="classify('伦理学科')">伦理学科</a></li>
				  <li><a href="#" onclick="classify('逻辑学科')">逻辑学科</a></li>
			    </ul>
			  </li>
			  <li><a href="#" onclick="classify('政治/法律')">政治/法律</a>
			  	<ul>
			      <li><a href="#" onclick="classify('政治理论')">政治理论</a></li>
			      <li><a href="#" onclick="classify('世界政治')">世界政治</a></li>
				  <li><a href="#" onclick="classify('法律')">法律</a></li>
				  <li><a href="#" onclick="classify('法学')">法学</a></li>
				  <li><a href="#" onclick="classify('国际关系')">国际关系</a></li>
				  <li><a href="#" onclick="classify('中国政治')">中国政治</a></li>
			    </ul>
			  </li>
			  <li><a href="#" onclick="classify('教育/体育')">教育/体育</a>
			  	<ul>
			      <li><a href="#" onclick="classify('教育学')">教育学</a></li>
			      <li><a href="#" onclick="classify('教师与学生')">教师与学生</a></li>
				  <li><a href="#" onclick="classify('学校管理')">学校管理</a></li>
                  <li><a href="#" onclick="classify('家庭教育')">家庭教育</a></li>
				  <li><a href="#" onclick="classify('体育理论')">体育理论</a></li>
			    </ul>
			  </li>
			</ul>
        </div>
        <div id="right" style="float:left;width:70%;background:#FFD588">
        	<div id="technology" style="width:95%;">
            	<div id="technology1" style="width:99%">
                	<a  id="a0" style="text-decoration: none;">
                    	<p id="technology1word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[0] ?></p>
                        <p id="word1" style="display:none" ><?php echo $bookisbn[0] ?></p>
                    </a>
                </div>
                <div id="technology2" style="width:99%">
                	<a id="a1" style="text-decoration: none;">
                    	<p id="technology2word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[1] ?></p>
                        <p id="word2" style="display:none" ><?php echo $bookisbn[1] ?></p>
                    </a>
                </div>
                <div id="technology3" style="width:99%">
                	<a  id="a2" style="text-decoration: none;">
                    	<p id="technology3word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[2] ?></p>
                        <p id="word3" style="display:none" ><?php echo $bookisbn[2] ?></p>
                    </a>
                </div>
                <div id="technology4" style="width:99%">
                	<a  id="a3" style="text-decoration: none;">
                    	<p id="technology4word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[3] ?></p>
                        <p id="word4" style="display:none" ><?php echo $bookisbn[3] ?></p>
                    </a>
                </div>
                <div id="technology5" style="width:99%">
                	<a  id="a4" style="text-decoration: none;">
                    	<p id="technology5word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[4] ?></p>
                        <p id="word5" style="display:none" ><?php echo $bookisbn[4] ?></p>
                    </a>   
                </div>
                <div id="technology6" style="width:99%">
                	<a  id="a5" style="text-decoration: none;">
                    	<p id="technology6word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[5] ?></p>
                        <p id="word6" style="display:none" ><?php echo $bookisbn[5] ?></p>
                    </a>
                </div>            	
                <div id="technology7" style="width:99%">
                	<a  id="a6" style="text-decoration: none;">
                    	<p id="technology7word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[6] ?></p>
                   		<p id="word7" style="display:none" ><?php echo $bookisbn[6] ?></p>
                    </a>
                </div>
                <div id="technology8" style="width:99%">
                	<a  id="a7" style="text-decoration: none;">
                    	<p id="technology8word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[7] ?></p>
                    	<p id="word8" style="display:none" ><?php echo $bookisbn[7] ?></p>
                    </a>
                </div>
                <div id="technology9" style="width:99%">
                	<a  id="a8" style="text-decoration: none;">
                    	<p id="technology9word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[8] ?></p>
                    	<p id="word9" style="display:none" ><?php echo $bookisbn[8] ?></p>
                    </a>
                </div>
                <div id="technology10" style="width:99%">
                	<a  id="a9" style="text-decoration: none;">	
                    	<p id="technology10word" style="color:#2B5AED;word-break:break-all"><?php echo $bookname[9] ?></p>						<p id="word10" style="display:none" ><?php echo $bookisbn[9] ?></p>
                    </a>
                </div>
                <div id="left9" style="width:99%;text-align:center">
            		<img src="picture/refresh.svg" style="vertical-align:middle;width:30%"  id="refresh" onClick="change()"/>
            	</div>
            </div>
        </div>
    </div>
</body>

<script>
	var H=document.documentElement.clientHeight;
	var W=document.documentElement.clientWidth;
	var R='科技';
	var By=document.getElementById("box0");
	By.style.height=H*1+"px";
	By.style.width=W*1+"px";
	var box=document.getElementById("box");
	box.style.margin=H*0+"px";
	box.style.height=H*0.99+"px";
	box.style.width=W*1+"px";
	
	var left=document.getElementById("left");
	left.style.height=H*0.99+"px";
	
	var right=document.getElementById("right");
	right.style.height=H*0.99+"px";
	

	
	var technology=document.getElementById("technology");
	technology.style.height=H*0.99+"px";
	
	var technology1=document.getElementById("technology1");
	technology1.style.height=H*0.08+"px";
	var technology1word=document.getElementById("technology1word");
	technology1word.style.fontSize=H*0.03+"px";
	technology1word.style.margin=0+"px";
	technology1word.style.position="relative";
	technology1word.style.top=H*0.015+"px";
	technology1word.style.left=H*0.015+"px";
	technology1word.innerHTML=cutstr(technology1word.innerHTML,23);
	
	var technology2=document.getElementById("technology2");
	technology2.style.height=H*0.08+"px";
	var technology2word=document.getElementById("technology2word");
	technology2word.style.fontSize=H*0.03+"px";
	technology2word.style.margin=0+"px";
	technology2word.style.position="relative";
	technology2word.style.top=H*0.015+"px";
	technology2word.style.left=H*0.015+"px";
	technology2word.innerHTML=cutstr(technology2word.innerHTML,23);
	
	var technology3=document.getElementById("technology3");
	technology3.style.height=H*0.08+"px";
	var technology3word=document.getElementById("technology3word");
	technology3word.style.fontSize=H*0.03+"px";
	technology3word.style.margin=0+"px";
	technology3word.style.position="relative";
	technology3word.style.top=H*0.015+"px";
	technology3word.style.left=H*0.015+"px";
	technology3word.innerHTML=cutstr(technology3word.innerHTML,23);
	
	var technology4=document.getElementById("technology4");
	technology4.style.height=H*0.08+"px";
	var technology4word=document.getElementById("technology4word");
	technology4word.style.fontSize=H*0.03+"px";
	technology4word.style.margin=0+"px";
	technology4word.style.position="relative";
	technology4word.style.top=H*0.015+"px";
	technology4word.style.left=H*0.015+"px";
	technology4word.innerHTML=cutstr(technology4word.innerHTML,23);
	
	var technology5=document.getElementById("technology5");
	technology5.style.height=H*0.08+"px";
	var technology5word=document.getElementById("technology5word");
	technology5word.style.fontSize=H*0.03+"px";
	technology5word.style.margin=0+"px";
	technology5word.style.position="relative";
	technology5word.style.top=H*0.015+"px";
	technology5word.style.left=H*0.015+"px";
	technology5word.innerHTML=cutstr(technology5word.innerHTML,23);
	
	var technology6=document.getElementById("technology6");
	technology6.style.height=H*0.08+"px";
	var technology6word=document.getElementById("technology6word");
	technology6word.style.fontSize=H*0.03+"px";
	technology6word.style.margin=0+"px";
	technology6word.style.position="relative";
	technology6word.style.top=H*0.015+"px";
	technology6word.style.left=H*0.015+"px";
	technology6word.innerHTML=cutstr(technology6word.innerHTML,23);
	
	var technology7=document.getElementById("technology7");
	technology7.style.height=H*0.08+"px";
	var technology7word=document.getElementById("technology7word");
	technology7word.style.fontSize=H*0.03+"px";
	technology7word.style.margin=0+"px";
	technology7word.style.position="relative";
	technology7word.style.top=H*0.015+"px";
	technology7word.style.left=H*0.015+"px";
	technology7word.innerHTML=cutstr(technology7word.innerHTML,23);
	
	var technology8=document.getElementById("technology8");
	technology8.style.height=H*0.08+"px";
	var technology8word=document.getElementById("technology8word");
	technology8word.style.fontSize=H*0.03+"px";
	technology8word.style.margin=0+"px";
	technology8word.style.position="relative";
	technology8word.style.top=H*0.015+"px";
	technology8word.style.left=H*0.015+"px";
	technology8word.innerHTML=cutstr(technology8word.innerHTML,23);
	
	var technology9=document.getElementById("technology9");
	technology9.style.height=H*0.08+"px";
	var technology9word=document.getElementById("technology9word");
	technology9word.style.fontSize=H*0.03+"px";
	technology9word.style.margin=0+"px";
	technology9word.style.position="relative";
	technology9word.style.top=H*0.015+"px";
	technology9word.style.left=H*0.015+"px";
	technology9word.innerHTML=cutstr(technology9word.innerHTML,23);
	
	var technology10=document.getElementById("technology10");
	technology10.style.height=H*0.08+"px";
	var technology10word=document.getElementById("technology10word");
	technology10word.style.fontSize=H*0.03+"px";
	technology10word.style.margin=0+"px";
	technology10word.style.position="relative";
	technology10word.style.top=H*0.015+"px";
	technology10word.style.left=H*0.015+"px";
	technology10word.innerHTML=cutstr(technology10word.innerHTML,23);
	
							document.getElementById("a0").href='book.php/?isbn='+document.getElementById("word1").innerHTML;
							document.getElementById("a1").href='book.php/?isbn='+document.getElementById("word2").innerHTML;
							document.getElementById("a2").href='book.php/?isbn='+document.getElementById("word3").innerHTML;
							document.getElementById("a3").href='book.php/?isbn='+document.getElementById("word4").innerHTML;
							document.getElementById("a4").href='book.php/?isbn='+document.getElementById("word5").innerHTML;
							document.getElementById("a5").href='book.php/?isbn='+document.getElementById("word6").innerHTML;
							document.getElementById("a6").href='book.php/?isbn='+document.getElementById("word7").innerHTML;
							document.getElementById("a7").href='book.php/?isbn='+document.getElementById("word8").innerHTML;
							document.getElementById("a8").href='book.php/?isbn='+document.getElementById("word9").innerHTML;
							document.getElementById("a9").href='book.php/?isbn='+document.getElementById("word10").innerHTML;
	
	
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

<script>
	var left9=document.getElementById("left9");
	left9.style.height=H*0.20+"px";
	var Refresh=document.getElementById("refresh");
	Refresh.style.height=H*0.1+"px";
	Refresh.style.marginTop=H*0.02+"px";
	var flag="科学/科技";
	
	function change(){
		classify(flag);
	}
	
	function classify(c){
		var Data="classify="+c;
		flag=c;
		$.ajax({
             type:'POST',
             url: 'http://blinkofwings.xyz/book/classify_options.php',
             data:Data,
			 dataType:'json',
             success: function(data){
							if(data.status=="2")
							{
								technology1word.innerHTML="暂时没有该类书籍";
								technology2word.innerHTML="";
								technology3word.innerHTML="";
								technology4word.innerHTML="";
								technology5word.innerHTML="";
								technology6word.innerHTML="";
								technology7word.innerHTML="";
								technology8word.innerHTML="";
								technology9word.innerHTML="";
								technology10word.innerHTML="";
								document.getElementById("a0").href="#";
								document.getElementById("a1").href="#";
								document.getElementById("a2").href="#";
								document.getElementById("a3").href="#";
								document.getElementById("a4").href="#";
								document.getElementById("a5").href="#";
								document.getElementById("a6").href="#";
								document.getElementById("a7").href="#";
								document.getElementById("a8").href="#";
								document.getElementById("a9").href="#";
							}
							else
							{
								if(data.num>=10)
								{
									technology1word.innerHTML=cutstr(data.bookname[0],23);
									technology2word.innerHTML=cutstr(data.bookname[1],23);
									technology3word.innerHTML=cutstr(data.bookname[2],23);
									technology4word.innerHTML=cutstr(data.bookname[3],23);
									technology5word.innerHTML=cutstr(data.bookname[4],23);
									technology6word.innerHTML=cutstr(data.bookname[5],23);
									technology7word.innerHTML=cutstr(data.bookname[6],23);
									technology8word.innerHTML=cutstr(data.bookname[7],23);
									technology9word.innerHTML=cutstr(data.bookname[8],23);
									technology10word.innerHTML=cutstr(data.bookname[9],23);	
									document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
									document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
									document.getElementById("a2").href='book.php/?isbn='+data.bookisbn[2];
									document.getElementById("a3").href='book.php/?isbn='+data.bookisbn[3];
									document.getElementById("a4").href='book.php/?isbn='+data.bookisbn[4];
									document.getElementById("a5").href='book.php/?isbn='+data.bookisbn[5];
									document.getElementById("a6").href='book.php/?isbn='+data.bookisbn[6];
									document.getElementById("a7").href='book.php/?isbn='+data.bookisbn[7];
									document.getElementById("a8").href='book.php/?isbn='+data.bookisbn[8];
									document.getElementById("a9").href='book.php/?isbn='+data.bookisbn[9];
								}
								else
								{
									switch(data.num)
									{
										case 1:	technology1word.innerHTML=cutstr(data.bookname[0],23);
												technology2word.innerHTML="";
												technology3word.innerHTML="";
												technology4word.innerHTML="";
												technology5word.innerHTML="";
												technology6word.innerHTML="";
												technology7word.innerHTML="";
												technology8word.innerHTML="";
												technology9word.innerHTML="";
												technology10word.innerHTML="";
												document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
												document.getElementById("a1").href="#";
												document.getElementById("a2").href="#";
												document.getElementById("a3").href="#";
												document.getElementById("a4").href="#";
												document.getElementById("a5").href="#";
												document.getElementById("a6").href="#";
												document.getElementById("a7").href="#";
												document.getElementById("a8").href="#";
												document.getElementById("a9").href="#";												
												break;
										case 2:	technology1word.innerHTML=cutstr(data.bookname[0],23);
												technology2word.innerHTML=cutstr(data.bookname[1],23);
												technology3word.innerHTML="";
												technology4word.innerHTML="";
												technology5word.innerHTML="";
												technology6word.innerHTML="";
												technology7word.innerHTML="";
												technology8word.innerHTML="";
												technology9word.innerHTML="";
												technology10word.innerHTML="";
												document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
												document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
												document.getElementById("a2").href="#";
												document.getElementById("a3").href="#";
												document.getElementById("a4").href="#";
												document.getElementById("a5").href="#";
												document.getElementById("a6").href="#";
												document.getElementById("a7").href="#";
												document.getElementById("a8").href="#";
												document.getElementById("a9").href="#";											
												break;
										case 3:	technology1word.innerHTML=cutstr(data.bookname[0],23);
												technology2word.innerHTML=cutstr(data.bookname[1],23);
												technology3word.innerHTML=cutstr(data.bookname[2],23);
												technology4word.innerHTML="";
												technology5word.innerHTML="";
												technology6word.innerHTML="";
												technology7word.innerHTML="";
												technology8word.innerHTML="";
												technology9word.innerHTML="";
												technology10word.innerHTML="";
												document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
												document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
												document.getElementById("a2").href='book.php/?isbn='+data.bookisbn[2];
												document.getElementById("a3").href="#";
												document.getElementById("a4").href="#";
												document.getElementById("a5").href="#";
												document.getElementById("a6").href="#";
												document.getElementById("a7").href="#";
												document.getElementById("a8").href="#";
												document.getElementById("a9").href="#";													
												break;
										case 4:	technology1word.innerHTML=cutstr(data.bookname[0],23);
												technology2word.innerHTML=cutstr(data.bookname[1],23);
												technology3word.innerHTML=cutstr(data.bookname[2],23);
												technology4word.innerHTML=cutstr(data.bookname[3],23);
												technology5word.innerHTML="";
												technology6word.innerHTML="";
												technology7word.innerHTML="";
												technology8word.innerHTML="";
												technology9word.innerHTML="";
												technology10word.innerHTML="";
												document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
												document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
												document.getElementById("a2").href='book.php/?isbn='+data.bookisbn[2];
												document.getElementById("a3").href='book.php/?isbn='+data.bookisbn[3];
												document.getElementById("a4").href="#";
												document.getElementById("a5").href="#";
												document.getElementById("a6").href="#";
												document.getElementById("a7").href="#";
												document.getElementById("a8").href="#";
												document.getElementById("a9").href="#";												
												break;
										case 5:	technology1word.innerHTML=cutstr(data.bookname[0],23);
												technology2word.innerHTML=cutstr(data.bookname[1],23);
												technology3word.innerHTML=cutstr(data.bookname[2],23);
												technology4word.innerHTML=cutstr(data.bookname[3],23);
												technology5word.innerHTML=cutstr(data.bookname[4],23);
												technology6word.innerHTML="";
												technology7word.innerHTML="";
												technology8word.innerHTML="";
												technology9word.innerHTML="";
												technology10word.innerHTML="";
												document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
												document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
												document.getElementById("a2").href='book.php/?isbn='+data.bookisbn[2];
												document.getElementById("a3").href='book.php/?isbn='+data.bookisbn[3];
												document.getElementById("a4").href='book.php/?isbn='+data.bookisbn[4];
												document.getElementById("a5").href="#";
												document.getElementById("a6").href="#";
												document.getElementById("a7").href="#";
												document.getElementById("a8").href="#";
												document.getElementById("a9").href="#";												
												break;
										case 6:	technology1word.innerHTML=cutstr(data.bookname[0],23);
												technology2word.innerHTML=cutstr(data.bookname[1],23);
												technology3word.innerHTML=cutstr(data.bookname[2],23);
												technology4word.innerHTML=cutstr(data.bookname[3],23);
												technology5word.innerHTML=cutstr(data.bookname[4],23);
												technology6word.innerHTML=cutstr(data.bookname[5],23);
												technology7word.innerHTML="";
												technology8word.innerHTML="";
												technology9word.innerHTML="";
												technology10word.innerHTML="";
												document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
												document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
												document.getElementById("a2").href='book.php/?isbn='+data.bookisbn[2];
												document.getElementById("a3").href='book.php/?isbn='+data.bookisbn[3];
												document.getElementById("a4").href='book.php/?isbn='+data.bookisbn[4];
												document.getElementById("a5").href='book.php/?isbn='+data.bookisbn[5];
												document.getElementById("a6").href="#";
												document.getElementById("a7").href="#";
												document.getElementById("a8").href="#";
												document.getElementById("a9").href="#";													
												break;
										case 7:	technology1word.innerHTML=cutstr(data.bookname[0],23);
												technology2word.innerHTML=cutstr(data.bookname[1],23);
												technology3word.innerHTML=cutstr(data.bookname[2],23);
												technology4word.innerHTML=cutstr(data.bookname[3],23);
												technology5word.innerHTML=cutstr(data.bookname[4],23);
												technology6word.innerHTML=cutstr(data.bookname[5],23);
												technology7word.innerHTML=cutstr(data.bookname[6],23);
												technology8word.innerHTML="";
												technology9word.innerHTML="";
												technology10word.innerHTML="";
												document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
												document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
												document.getElementById("a2").href='book.php/?isbn='+data.bookisbn[2];
												document.getElementById("a3").href='book.php/?isbn='+data.bookisbn[3];
												document.getElementById("a4").href='book.php/?isbn='+data.bookisbn[4];
												document.getElementById("a5").href='book.php/?isbn='+data.bookisbn[5];
												document.getElementById("a6").href='book.php/?isbn='+data.bookisbn[6];
												document.getElementById("a7").href="#";
												document.getElementById("a8").href="#";
												document.getElementById("a9").href="#";												
												break;
										case 8:	technology1word.innerHTML=cutstr(data.bookname[0],23);
												technology2word.innerHTML=cutstr(data.bookname[1],23);
												technology3word.innerHTML=cutstr(data.bookname[2],23);
												technology4word.innerHTML=cutstr(data.bookname[3],23);
												technology5word.innerHTML=cutstr(data.bookname[4],23);
												technology6word.innerHTML=cutstr(data.bookname[5],23);
												technology7word.innerHTML=cutstr(data.bookname[6],23);
												technology8word.innerHTML=cutstr(data.bookname[7],23);
												technology9word.innerHTML="";
												technology10word.innerHTML="";
												document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
												document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
												document.getElementById("a2").href='book.php/?isbn='+data.bookisbn[2];
												document.getElementById("a3").href='book.php/?isbn='+data.bookisbn[3];
												document.getElementById("a4").href='book.php/?isbn='+data.bookisbn[4];
												document.getElementById("a5").href='book.php/?isbn='+data.bookisbn[5];
												document.getElementById("a6").href='book.php/?isbn='+data.bookisbn[6];
												document.getElementById("a7").href='book.php/?isbn='+data.bookisbn[7];
												document.getElementById("a8").href="#";
												document.getElementById("a9").href="#";													
												break;
										case 9:	technology1word.innerHTML=cutstr(data.bookname[0],23);
												technology2word.innerHTML=cutstr(data.bookname[1],23);
												technology3word.innerHTML=cutstr(data.bookname[2],23);
												technology4word.innerHTML=cutstr(data.bookname[3],23);
												technology5word.innerHTML=cutstr(data.bookname[4],23);
												technology6word.innerHTML=cutstr(data.bookname[5],23);
												technology7word.innerHTML=cutstr(data.bookname[6],23);
												technology8word.innerHTML=cutstr(data.bookname[7],23);
												technology9word.innerHTML=cutstr(data.bookname[8],23);
												technology10word.innerHTML="";
												document.getElementById("a0").href='book.php/?isbn='+data.bookisbn[0];
												document.getElementById("a1").href='book.php/?isbn='+data.bookisbn[1];
												document.getElementById("a2").href='book.php/?isbn='+data.bookisbn[2];
												document.getElementById("a3").href='book.php/?isbn='+data.bookisbn[3];
												document.getElementById("a4").href='book.php/?isbn='+data.bookisbn[4];
												document.getElementById("a5").href='book.php/?isbn='+data.bookisbn[5];
												document.getElementById("a6").href='book.php/?isbn='+data.bookisbn[6];
												document.getElementById("a7").href='book.php/?isbn='+data.bookisbn[7];
												document.getElementById("a8").href='book.php/?isbn='+data.bookisbn[8];
												document.getElementById("a9").href="#";												
												break;																																																																																																
									}
								}
							}
                      },
			 error : function(XMLHttpRequest, textStatus, errorThrown) {　
					alert(XMLHttpRequest.responseText); 
			 		alert(XMLHttpRequest.status);
			 		alert(XMLHttpRequest.readyState);
			 		alert(textStatus); 
			 	}
         	});
	}
	//document.getElementById("bubba").style.fontSize=H*0.03+"px";
	var mtree=document.getElementsByTagName("li");
	for(var i=0;i<mtree.length;i++)
	{
		mtree[i].style.fontSize=H*0.03+"px";
		//mtree[i].style.height=H*0.09+"px";
		mtree[i].style.width="99%";	
	}

	(function ($, window, document, undefined) {
	    if ($('ul.mtree').length) {
	        var collapsed = true;
	        var close_same_level = true;
	        var duration = 100;
	        var listAnim = true;
	        var easing = 'easeOutQuart';
	        $('.mtree ul').css({
	            'overflow': 'hidden',
	            'height': collapsed ? 0 : 'auto',
	            'display': collapsed ? 'none' : 'block'
	        });
	        var node = $('.mtree li:has(ul)');
	        node.each(function (index, val) {
	            $(this).children(':first-child').css('cursor', 'pointer');
	            $(this).addClass('mtree-node mtree-' + (collapsed ? 'closed' : 'open'));
	            $(this).children('ul').addClass('mtree-level-' + ($(this).parentsUntil($('ul.mtree'), 'ul').length + 1));
	        });
	        $('.mtree li > *:first-child').on('click.mtree-active', function (e) {
	            if ($(this).parent().hasClass('mtree-closed')) {
	                $('.mtree-active').not($(this).parent()).removeClass('mtree-active');
	                $(this).parent().addClass('mtree-active');
	            } else if ($(this).parent().hasClass('mtree-open')) {
	                $(this).parent().removeClass('mtree-active');
	            } else {
	                $('.mtree-active').not($(this).parent()).removeClass('mtree-active');
	                $(this).parent().toggleClass('mtree-active');
	            }
	        });
	        node.children(':first-child').on('click.mtree', function (e) {
	            var el = $(this).parent().children('ul').first();
	            var isOpen = $(this).parent().hasClass('mtree-open');
	            if ((close_same_level || $('.csl').hasClass('active')) && !isOpen) {
	                var close_items = $(this).closest('ul').children('.mtree-open').not($(this).parent()).children('ul');
	                if ($.Velocity) {
	                    close_items.velocity({ height: 0 }, {
	                        duration: duration,
	                        easing: easing,
	                        display: 'none',
	                        delay: 100,
	                        complete: function () {
	                            setNodeClass($(this).parent(), true);
	                        }
	                    });
	                } else {
	                    close_items.delay(100).slideToggle(duration, function () {
	                        setNodeClass($(this).parent(), true);
	                    });
	                }
	            }
	            el.css({ 'height': 'auto' });
	            if (!isOpen && $.Velocity && listAnim)
	                el.find(' > li, li.mtree-open > ul > li').css({ 'opacity': 0 }).velocity('stop').velocity('list');
	            if ($.Velocity) {
	                el.velocity('stop').velocity({
	                    height: isOpen ? [
	                        0,
	                        el.outerHeight()
	                    ] : [
	                        el.outerHeight(),
	                        0
	                    ]
	                }, {
	                    queue: false,
	                    duration: duration,
	                    easing: easing,
	                    display: isOpen ? 'none' : 'block',
	                    begin: setNodeClass($(this).parent(), isOpen),
	                    complete: function () {
	                        if (!isOpen)
	                            $(this).css('height', 'auto');
	                    }
	                });
	            } else {
	                setNodeClass($(this).parent(), isOpen);
	                el.slideToggle(duration);
	            }
	            e.preventDefault();
	        });
	        function setNodeClass(el, isOpen) {
	            if (isOpen) {
	                el.removeClass('mtree-open').addClass('mtree-closed');
	            } else {
	                el.removeClass('mtree-closed').addClass('mtree-open');
	            }
	        }
	        if ($.Velocity && listAnim) {
	            $.Velocity.Sequences.list = function (element, options, index, size) {
	                $.Velocity.animate(element, {
	                    opacity: [
	                        1,
	                        0
	                    ],
	                    translateY: [
	                        0,
	                        -(index + 1)
	                    ]
	                }, {
	                    delay: index * (duration / size / 2),
	                    duration: duration,
	                    easing: easing
	                });
	            };
	        }
	        if ($('.mtree').css('opacity') == 0) {
	            if ($.Velocity) {
	                $('.mtree').css('opacity', 1).children().css('opacity', 0).velocity('list');
	            } else {
	                $('.mtree').show(200);
	            }
	        }
	    }
	}(jQuery, this, this.document));
	$(document).ready(function () {
	    var mtree = $('ul.mtree');
	    var skins = [
	        'bubba',
	        'skinny',
	        'transit',
	        'jet',
	        'nix'
	    ];
	    mtree.addClass(skins[0]);
	    //$('body').prepend('<div class="mtree-skin-selector"><ul class="button-group radius"></ul></div>');
	    var s = $('.mtree-skin-selector');
	    $.each(skins, function (index, val) {
	        s.find('ul').append('<li><button class="small skin">' + val + '</button></li>');
	    });
	    s.find('ul').append('<li><button class="small csl active">Close Same Level</button></li>');
	    s.find('button.skin').each(function (index) {
	        $(this).on('click.mtree-skin-selector', function () {
	            s.find('button.skin.active').removeClass('active');
	            $(this).addClass('active');
	            mtree.removeClass(skins.join(' ')).addClass(skins[index]);
	        });
	    });
	    s.find('button:first').addClass('active');
	    s.find('.csl').on('click.mtree-close-same-level', function () {
	        $(this).toggleClass('active');
	    });
	});
	</script>
</html>