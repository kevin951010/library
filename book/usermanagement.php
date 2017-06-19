  <!doctype html>
<html>
<head>
<meta charset="utf-8" name="viewport" >
<title>用户管理</title>
<script src="http://blinkofwings.xyz/book/jquery-3.2.1.min.js"></script>
<script src="http://blinkofwings.xyz/book/jquery-confirm.js"></script>
       <link rel="stylesheet" type="text/css" href="http://blinkofwings.xyz/book/buttons.css">
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
	$bookinformation=array('0','0');
	$book=array(array('0','0','0','0','0','0'),array('0','0','0','0','0','0'));
	$j=0;
	$availbook;
	mysql_query("SET NAMES 'utf-8'");
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	if(mysqli_connect_errno())
	{
		
	}
	else
	{
		$sql="select * from user where username='$username'";
		$result=mysqli_query($test,$sql);
		if(!mysqli_fetch_array($result))
		{
				
		}
		else
		{
			$result=mysqli_query($test,$sql); 
			$num=mysqli_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				$row=mysqli_fetch_array($result);
				$availbook=$row['availbooknumber'];
			}
		}
		
		$sql="select * from reservation where people='$username'";
		$result=mysqli_query($test,$sql);
		if(!mysqli_fetch_array($result))
		{
				
		}
		else
		{
			$result=mysqli_query($test,$sql); 
			$num=mysqli_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				$bookinformation[$j]='1';
				$row=mysqli_fetch_array($result);
				$book[$j][0]=$row['isbn'];
				$book[$j][1]=$row['bookname'];
				$book[$j][2]=$row['bookaurhor'];
				$book[$j][3]=$row['bookpublic'];
				$book[$j][4]=$row['people'];
				$book[$j][5]=$row['time'];
				$j++;
			}
		}
		
		$sql="select * from borrow_behind where people='$username'";
		$result=mysqli_query($test,$sql);
		if(!mysqli_fetch_array($result))
		{
			
		}
		else
		{
			$result=mysqli_query($test,$sql);
			$num=mysqli_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				$bookinformation[$j]='2';
				$row=mysqli_fetch_array($result);
				$book[$j][0]=$row['booknumber'];
				$book[$j][1]=$row['bookname'];
				$book[$j][2]=$row['bookauthor'];
				$book[$j][3]=$row['bookpublic'];
				$book[$j][4]=$row['people'];
				$book[$j][5]=$row['time'];
				$j++;
			}
		} 
		
		$sql="select * from borrow_before where people='$username'";
		$result=mysqli_query($test,$sql);
		if(!mysqli_fetch_array($result))
		{
			
		}
		else
		{
			$result=mysqli_query($test,$sql);
			$num=mysqli_num_rows($result);
			for($i=0;$i<$num;$i++)
			{
				$bookinformation[$j]='3';
				$row=mysqli_fetch_array($result);
				$book[$j][0]=$row['booknumber'];
				$book[$j][1]=$row['bookname'];
				$book[$j][2]=$row['bookauthor'];
				$book[$j][3]=$row['bookpublic'];
				$book[$j][4]=$row['people'];
				$book[$j][5]=$row['time'];
				$j++;
			}
		} 
	}
?>
	<div id="container"  style="background-repeat:no-repeat;background: url(picture/notebook.png);background-size:100% 100%;background-position:   center center;width:96%;">
    	<div id="userbox" style="width:90%">
            <div style="float:left" id="containername">
            	<p id="username" style="color:#979595;">用户名:<?php echo $username?></p>
                <p id="availbook" style="color:#979595;">可借书本:<?php echo $availbook?></p>
                <p id="bookone" style="display:none"><?php echo $bookinformation[0]?></p>
                <p id="booktwo" style="display:none"><?php echo $bookinformation[1] ?></p>
                <p id="people" style="display:none"><?php echo $username?></p>
            </div>
        </div>
	<hr style="width:90%"/> 
        <div id="containerbox1" style="width:90%;">
                <p id="isbn1" style="display:none"><?php echo $book[0][0]?></p>
        		<p id="containerbox1date" style="color:#979595;width:90%"><?php echo $book[0][5]?></p>
            	<p id="containerbox1name" style="color:#979595;width:90%"><?php echo $book[0][1]?></p>
                <p id="containerbox1notice" style="color:#979595;width:90%">应于2017-04-10前去借阅</p>
                <button id="cansel_reservation" style="width:30% ;float:right" onClick="cancel('bookone')" class="button button-caution button-box button-raised button-giant button-longshadow">取消预订</button>
        </div>
	<hr style="width:90%"/>
        <div id="containerbox2" style="width:90%;">
        		<p id="isbn2" style="display:none"><?php echo $book[1][0]?></p>
        		<p id="containerbox2date" style="color:#979595;width:90%"><?php echo $book[1][5]?></p>
            	<p id="containerbox2name" style="color:#979595;width:90%"><?php echo $book[1][1]?></p>
                <p id="containerbox2notice" style="color:#979595;width:90%">应于2017-04-10前去借阅</p>
                <button id="cansel_reservation2" style="width:30% ;float:right" onClick="cancel('booktwo')" class="button button-caution button-box button-raised button-giant button-longshadow">取消预订</button>
        </div>
	<hr style="width:90%"/>
    </div>
    <div id="nav" style="width:100%;border-top:2px solid #979595;">
     	<a href="safemanage.php" style="text-decoration: none;" >
    		<div style="width:33%;float:left;" align="center">
        		<img src="picture/setting.png" id="setting" />
            	<p id="favouriteword" style="color:#979595;margin:0px">安全管理</p>
        	</div>
        </a>
        <a href="personalcollection.php" style="text-decoration: none;" >
        	<div style="width:33%;float:left;"align="center">
        		<img src="picture/favourite.png" id="favourite" />
           	 	<p id="settingword" style="color:#979595;margin:0px">个人收藏</p>
        	</div>
         </a>
         <a href="histroyfootprint.php" style="text-decoration: none;" >
         	<div style="width:33%;float:left;" align="center">
        		<img src="picture/footprint.png" id="footprint" />
            	<p id="footprintword" style="color:#979595;margin:0px">我的足迹</p>
       		</div>
         </a>
    </div>
</body>

<script>
	var H=document.documentElement.clientHeight;
	var container=document.getElementById("container");
	container.style.position="relative";
	container.style.top=H*0.02+"px";
	container.style.height=H*0.84+"px";
	container.style.left=H*0.01+"px";
	
	var nav=document.getElementById("nav");
	nav.style.height=H*0.12+"px";
	nav.style.position="fixed";
	nav.style.bottom=0+"px";
	
	var setting=document.getElementById("setting");
	setting.style.height=H*0.08+"px";
	setting.style.width=H*0.08+"px";
	document.getElementById("settingword").style.position="relative";
	document.getElementById("settingword").style.top=-H*0.013+"px";
	document.getElementById("settingword").style.fontSize=H*0.03+"px";
	
	var favourite=document.getElementById("favourite");
	favourite.style.height=H*0.08+"px";
	favourite.style.width=H*0.08+"px";
	
	var favouriteword=document.getElementById("favouriteword");
	favouriteword.style.position="relative";
	favouriteword.style.top=-H*0.013+"px";
	favouriteword.style.fontSize=H*0.03+"px";
	
	var footprint=document.getElementById("footprint");
	footprint.style.position="relative";
	footprint.style.top=H*0.01+"px";
	footprint.style.height=H*0.07+"px";
	footprint.style.width=H*0.07+"px";
	
	var footprintword=document.getElementById("footprintword");
	footprintword.style.position="relative";
	footprintword.style.top=-H*0.003+"px";
	footprintword.style.fontSize=H*0.03+"px";
	
	var userbox=document.getElementById("userbox");
	userbox.style.height=H*0.15 +"px";
	userbox.style.position="relative";
	userbox.style.left=H*0.035+"px";
			
	var username=document.getElementById("username");
	username.style.fontSize=H*0.035+"px";
	username.style.margin="0"+"px";
	username.style.marginBotton=H*0.02+"px";
	var availbook=document.getElementById("availbook");
	availbook.style.fontSize=H*0.035+"px";
	availbook.style.marginLeft=H*0.04+"px";
	availbook.style.margin="0"+"px";
	availbook.style.marginTop=H*0.02+"px";
		
	var containername=document.getElementById("containername");
	containername.style.position="relative";
	containername.style.top=H*0.025+"px";
	containername.style.left=H*0.03+"px";
	
	var containerbox1=document.getElementById("containerbox1");
	containerbox1.style.position="relative";
	containerbox1.style.left=H*0.035+"px";
	containerbox1.style.height=H*0.23+"px";
	
	var containerbox1date=document.getElementById("containerbox1date");
	containerbox1date.style.fontSize=H*0.03+"px";
	containerbox1date.style.position="relative";
	containerbox1date.style.top=-H*0.01+"px";
	containerbox1date.style.left=H*0.04+"px";
	var date1=containerbox1date.innerHTML;
	date1=date1.substring(0,10);
	
	var containerbox1name=document.getElementById("containerbox1name");
	containerbox1name.style.fontSize=H*0.03+"px";
	containerbox1name.style.position="relative";
	containerbox1name.style.top=-H*0.02+"px";
	containerbox1name.style.left=H*0.04+"px";
	var name1=cutstr(containerbox1name.innerHTML,30);
	
	var containerbox1notice=document.getElementById("containerbox1notice");
	containerbox1notice.style.fontSize=H*0.03+"px";
	containerbox1notice.style.position="relative";
	containerbox1notice.style.top=-H*0.02+"px";
	containerbox1notice.style.left=H*0.04+"px";
	
	var cansel_reservation=document.getElementById("cansel_reservation");
	cansel_reservation.style.position="relative";
	cansel_reservation.style.height=H*0.05+"px";
	cansel_reservation.style.top=-H*0.03+"px";
	cansel_reservation.style.right=H*0.04+"px";
	cansel_reservation.style.fontSize=H*0.03+"px";
	
	var containerbox2=document.getElementById("containerbox2");
	containerbox2.style.position="relative";
	containerbox2.style.left=H*0.035+"px";
	containerbox2.style.height=H*0.23+"px";
	
	var containerbox2date=document.getElementById("containerbox2date");
	containerbox2date.style.fontSize=H*0.03+"px";
	containerbox2date.style.position="relative";
	containerbox2date.style.top=-H*0.01+"px";
	containerbox2date.style.left=H*0.04+"px";
	var date2=containerbox2date.innerHTML;
	date2=date2.substring(0,10);
	
	var containerbox2name=document.getElementById("containerbox2name");
	containerbox2name.style.fontSize=H*0.03+"px";
	containerbox2name.style.position="relative";
	containerbox2name.style.top=-H*0.02+"px";
	containerbox2name.style.left=H*0.04+"px";
	var name2=cutstr(containerbox2name.innerHTML,30);
	
	var containerbox2notice=document.getElementById("containerbox2notice");
	containerbox2notice.style.fontSize=H*0.03+"px";
	containerbox2notice.style.position="relative";
	containerbox2notice.style.top=-H*0.02+"px";
	containerbox2notice.style.left=H*0.04+"px";
	
	var cansel_reservation2=document.getElementById("cansel_reservation2");
	cansel_reservation2.style.position="relative";
	cansel_reservation2.style.height=H*0.05+"px";
	cansel_reservation2.style.top=-H*0.03+"px";
	cansel_reservation2.style.right=H*0.04+"px";
	cansel_reservation2.style.fontSize=H*0.03+"px";
	
	contextfill(document.getElementById("bookone").innerHTML,document.getElementById("booktwo").innerHTML);
	function contextfill(a,b)
	{
		if((a=='0')&&(b=='0'))
		{
			containerbox1.style.display="none";
			containerbox2.style.display="none";
		}
		if((a=='1')&&(b=='0'))
		{
			containerbox2.style.display="none";
			containerbox1notice.innerHTML="应于"+add(date1,3)+"前去借阅";
			containerbox1date.innerHTML=date1+"预订了";
			containerbox1name.innerHTML=name1;
		}
		if((a=='1')&&(b=='1'))
		{
			containerbox1notice.innerHTML="应于"+add(date1,3)+"前去借阅";
			containerbox1date.innerHTML=date1+"预订了";
			containerbox1name.innerHTML=name1;
			containerbox2notice.innerHTML="应于"+add(date2,3)+"前去借阅";
			containerbox2date.innerHTML=date2+"预订了";
			containerbox2name.innerHTML=name2;
		}
		if((a=='1')&&(b=='2'))
		{
			containerbox1notice.innerHTML="应于"+add(date1,3)+"前去借阅";
			containerbox1date.innerHTML=date1+"预订了";
			containerbox1name.innerHTML=name1;
			containerbox2notice.innerHTML="应于"+add(date2,30)+"前去归还";
			containerbox2date.innerHTML=date2+"借阅了";
			containerbox2name.innerHTML=name2;
			cansel_reservation2.style.display="none";
		}
		if((a=='1')&&(b=='3'))
		{
			containerbox1notice.innerHTML="应于"+add(date1,3)+"前去借阅";
			containerbox1date.innerHTML=date1+"预订了";
			containerbox1name.innerHTML=name1;
			containerbox2notice.innerHTML="应于8小时内去管理员处完成借阅";
			containerbox2date.innerHTML=date2+"扫码了";
			containerbox2name.innerHTML=name2;
			cansel_reservation2.style.display="none";
		}
		if((a=='2')&&(b=='2'))
		{
			containerbox1notice.innerHTML="应于"+add(date1,30)+"前去归还";
			containerbox1date.innerHTML=date1+"借阅了";
			containerbox1name.innerHTML=name1;
			cansel_reservation.style.display="none";
			containerbox2notice.innerHTML="应于"+add(date2,30)+"前去归还";
			containerbox2date.innerHTML=date2+"借阅了";
			containerbox2name.innerHTML=name2;
			cansel_reservation2.style.display="none";
		}
		if((a=='2')&&(b=='0'))
		{
			containerbox1notice.innerHTML="应于"+add(date1,30)+"前去归还";
			containerbox1date.innerHTML=date1+"借阅了";
			containerbox1name.innerHTML=name1;
			cansel_reservation.style.display="none";
			containerbox2.style.display="none";
		}
		if((a=='2')&&(b=='3'))
		{
			containerbox1notice.innerHTML="应于"+add(date1,30)+"前去归还";
			containerbox1date.innerHTML=date1+"借阅了";
			containerbox1name.innerHTML=name1;
			cansel_reservation.style.display="none";
			containerbox2notice.innerHTML="应于8小时内去管理员处完成借阅";
			containerbox2date.innerHTML=date2+"扫码了";
			containerbox2name.innerHTML=name2;
			cansel_reservation2.style.display="none";
		}
		if((a=='3')&&(b=='3'))
		{
			containerbox1notice.innerHTML="应于8小时内去管理员处完成借阅";
			containerbox1date.innerHTML=date1+"扫描了";
			containerbox1name.innerHTML=name1;
			cansel_reservation.style.display="none";
			containerbox2notice.innerHTML="应于8小时内去管理员处完成借阅";
			containerbox2date.innerHTML=date2+"扫码了";
			containerbox2name.innerHTML=name2;
			cansel_reservation2.style.display="none";
		}
		if((a=='3')&&(b=='0'))
		{
			containerbox1notice.innerHTML="应于8小时内去管理员处完成借阅";
			containerbox1date.innerHTML=date1+"扫描了";
			containerbox1name.innerHTML=name1;
			cansel_reservation.style.display="none";
			containerbox2.style.display="none";
		}
	}
	
	function cancel(a)
	{
		if(a=='bookone')
		{
		$.confirm({
		 title:'',
		 content:'你确信要取消预订该书吗？',
		 confirm:function(){
			var Data="isbn=" + document.getElementById('isbn1').innerHTML + "&people="+document.getElementById('people').innerHTML ;
			 	$.ajax({
             	type:'POST',
             	url: 'http://blinkofwings.xyz/book/reservation_delete.php',
            	data:Data,
			 	dataType:'json',
             	success: function(data){
							$.alert(data.mes);
							if(data.status=='1')
							{
								containerbox1.style.display="none";	
								availbook.innerHTML="可借书本:"+data.ava; 
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
		else
		{
			$.confirm({
		 title:'',
		 content:'你确信要取消预订该书吗？',
		 confirm:function(){
			var Data="isbn=" + document.getElementById('isbn2').innerHTML + "&people="+document.getElementById('people').innerHTML ;
			 	$.ajax({
             	type:'POST',
             	url: 'http://blinkofwings.xyz/book/reservation_delete.php',
            	data:Data,
			 	dataType:'json',
             	success: function(data){
							$.alert(data.mes);
							if(data.status=='1')
							{
								containerbox1.style.display="none";	
								availbook.innerHTML="可借书本:"+data.ava; 
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
	
	function add(dd,dadd){
		console.log(dd);
		var a=new Date(dd);
		a=a.valueOf();
		a=a+dadd*24*60*60*1000;
		a=new Date(a);
		var newtime=a.getFullYear()+"/"+(a.getMonth()+1)+"/"+a.getDate(); 
		return newtime;
	}
</script>
</html>
