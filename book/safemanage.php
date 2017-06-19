<!doctype html>
<html>
<head>
<meta charset="utf-8" name="viewport" >
<title>安全管理</title>
<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script> 
<script src="http://blinkofwings.xyz/book/jquery-confirm.js"></script>
    <link rel="stylesheet" type="text/css" href="http://blinkofwings.xyz/book/star-rating-svg.css">
    <link rel="stylesheet" type="text/css" href="http://blinkofwings.xyz/book/buttons.css">
    <link rel="stylesheet" type="text/css" href="http://blinkofwings.xyz/book/jquery-confirm.css">
</head>

<?php
	session_start();
	if(isset($_SESSION['username'])){
    	$username=$_SESSION['username'];
	}else{
   		echo "<script>location.href='index.php';</script>";
	}
	header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	$phonenumber='';
	$mail='';
	$frequency='';
	$isrecommend='';
	if(mysqli_connect_errno())
	{
		echo "数据库连接失败";
	}
	else
	{
		$sql="select * from user where username='$username'";
		$result=mysqli_query($test,$sql);
		if(!mysqli_fetch_array($result))
		{
				$array=""; 
		}
		else
		{
			$result=mysqli_query($test,$sql);
			$row=mysqli_fetch_array($result);
			$phonenumber=$row['phonenumber'];
			$mail=$row['mail'];
			$value=$row['qrcode'];
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
			$row=mysqli_fetch_array($result);
			$frequency=$row['frequency'];
			$isrecommend=$row['isrecommend'];
		}
		
	}
	

			include "phpqrcode.php"; 
			$errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H  
			$matrixPointSize = "3"; // 点的大小：1到10 
			$picturename=$username.".png"; 
			QRcode::png($value, $picturename, $errorCorrectionLevel, $matrixPointSize);
		
?>

<body style="margin: 0px;">
		<p id="username" style="display:none"><?php echo $username ?></p>
        <p id="frequency" style="display:none"><?php echo $frequency ?></p>
        <p id="isrecommend" style="display:none"><?php echo $isrecommend ?></p>
		<div id="container"  style="background-repeat:no-repeat;background: url(picture/document.png);background-size:100% 100%;background-position:   center center;width:98%;overflow:auto">
        	 <div id="containerbox0" style="width:97%;">
             	    <div style="background-repeat:no-repeat;background-size:100% 100%;background-position:   center center;border:2px solid black;float:left;border:2px solid black" id="bookpicture1">
                    </div>
                    
                     <div style="float:left;" id="example1box">
						<p id="myqrcode">我的二维码</p>
                        <input type="button" style="float:left;width:105%" id="updatepicture" onclick="Updatepicture()" value="刷新二维码" class="button button-raised button-royal"></input>
                        
            		</div>
             </div>
             <div id="containerbox1" style="width:97%;">
				<div style="width:100%;float:left">
                	<p id="phonetitle" style="float:left;">手机:</p>
                    <p id="phonenotice" style="float:left;color:red;"></p>
                </div>
                <div style="width:100%;float:left">
                	 <p id="phonenumber" style="float:left;"><?php echo $phonenumber ?></p>
               		 <input type="text" style="float:left;width:55%;display:none" id="phoneinput"></input>
                     <input type="button" style="float:right;width:28%" id="changephone" onclick="CP()" value="修改" class="button button-raised button-primary button-rounded"></input>
                </div>
                <div style="width:100%;float:left;display:none" id="Verification">
               		 <p id="verificationnotice" style="float:left;color:red;width:90%;"></p>
                     <input type="text" style="float:left;width:30%;" id="verification"></input>
                     <input type="button" style="float:right;width:30%" id="get button" onclick="getphoneverification()" value="获取验证码" class="button button-raised button-primary button-rounded"></input>
                </div>
                <div style="width:100%;float:left;display:none" id="Phonehandin">
                	 <input type="button" style="float:right;width:28%" id="change button" onclick="phonehandin()" value="确认" class="button button-raised button-glow button-action button-pill"></input>
                </div>
        	</div>
            
            <div id="containerbox2" style="width:97%;">
				<div style="width:100%;float:left">
                	<p id="mailtitle" style="float:left;">邮箱:</p>
                    <p id="mailnotice" style="float:left;color:red;"></p>
                </div>
                <div style="width:100%;float:left">
                	 <p id="mailnumber" style="float:left;"><?php echo $mail ?></p>
               		 <input type="text" style="float:left;width:55%;display:none" id="mailinput"></input>
                     <input type="button" style="float:right;width:28%" id="changemail" onclick="changemail()" value="修改" class="button button-raised button-primary button-rounded"></input>
                </div>
                <div style="width:100%;float:left;display:none" id="Verificationmail">
               		 <p id="verificationnoticemail" style="float:left;color:red;width:90%;"></p>
                     <input type="text" style="float:left;width:30%;" id="verificationmail"></input>
                     <input type="button" style="float:right;width:30%" id="getmail button" onclick="getmailverification()" value="获取验证码" class="button button-raised button-primary button-rounded"></input>
                </div>
                <div style="width:100%;float:left;display:none" id="Mailhandin">
                	 <input type="button" style="float:right;width:28%" id="changemail button" onclick="mailhandin()" value="确认" class="button button-raised button-glow button-action button-pill"></input>
                </div>
        	</div>
            
            <div id="containerbox3" style="width:97%">
            	<div style="width:100%;float:left">
                	<p id="recommendintime" style="float:left;margin:0px">定时推荐：</p>
                    <input type="button" style="float:right;width:28%" id="recommendintime button" value="禁用" onClick="recommend()" class="button button-caution button-box button-raised button-giant button-longshadow"></input>
                </div>
                <div style="width:100%;float:left;" id="checkbox">
                     <p id="10day" style="float:left"><input type="radio" name="category" value="10" id="checkbox1" checked="checked"/>10天</p>    
    				 <p id="20day" style="float:left"><input type="radio" name="category" value="20" id="checkbox2"/>20天</p>    
                     <p id="30day" style="float:left"><input type="radio" name="category" value="30" id="checkbox3"/>30天</p>  
                     <input type="button" style="float:right;width:28%" id="recommendbutton"  value="确定" onClick="handinrecommend()" class="button button-raised button-glow button-action button-pill"></input>
                </div>
            </div>
        </div>
</body>

<script>
	var H=document.documentElement.clientHeight;
	var container=document.getElementById("container");
	container.style.position="relative";
	container.style.height=H*1.15+"px";
	container.style.marginTop=H*0.005+"px";
	container.style.marginLeft=H*0.01+"px";
	var containerbox0=document.getElementById("containerbox0");
	containerbox0.style.position="relative";
	containerbox0.style.top=H*0.11+"px";
	containerbox0.style.height=H*0.32+"px";
	var bookpicture1=document.getElementById("bookpicture1");
	bookpicture1.style.position="relative";
	bookpicture1.style.height=H*0.27+"px";
	bookpicture1.style.width=H*0.27+"px";
	bookpicture1.style.top=H*0.03+"px";
	bookpicture1.style.left=H*0.02+"px";
	bookpicture1.style.backgroundImage="url"+"("+document.getElementById("username").innerHTML+".png"+")";
	var myqrcode=document.getElementById("myqrcode");
	myqrcode.style.fontSize=H*0.03+"px";
	myqrcode.style.position="relative";
	myqrcode.style.left=H*0.05+"px";
	myqrcode.style.top=H*0.01+"px";
	var updatepicture=document.getElementById("updatepicture");
	updatepicture.style.fontSize=H*0.03+"px";
	updatepicture.style.position="relative";
	updatepicture.style.left=H*0.04+"px";
	updatepicture.style.height=H*0.06+"px";
	updatepicture.style.marginTop=H*0.02+"px";
	updatepicture.disabled=true;
		
	var containerbox1=document.getElementById("containerbox1");
	containerbox1.style.position="relative";
	containerbox1.style.top=H*0.08+"px";
	
	var phonetitle=document.getElementById("phonetitle");
	phonetitle.style.fontSize=H*0.03+"px";
	phonetitle.style.position="relative";
	phonetitle.style.marginBottom=0+"px";
	phonetitle.style.marginTop=H*0.02+"px";
	phonetitle.style.marginLeft=H*0.02+"px";
	
	var phonenotice=document.getElementById("phonenotice");
	phonenotice.style.fontSize=H*0.03+"px";
	phonenotice.style.position="relative";
	phonenotice.style.marginBottom=0+"px";
	phonenotice.style.marginTop=H*0.03+"px";
	phonenotice.style.marginLeft=H*0.02+"px";
	
	var phonenumber=document.getElementById("phonenumber");
	phonenumber.style.fontSize=H*0.03+"px";
	phonenumber.style.position="relative";
	phonenumber.style.marginTop=H*0.01+"px";
	phonenumber.style.marginLeft=H*0.02+"px";
	phonenumber.style.marginBottom=H*0.01+"px";
	
	var phoneinput=document.getElementById("phoneinput");
	phoneinput.style.fontSize=H*0.03+"px";
	phoneinput.style.position="relative";
	phoneinput.style.marginTop=H*0.01+"px";
	phoneinput.style.marginLeft=H*0.05+"px";
	phoneinput.style.height=H*0.05+"px";
	
	var changphone=document.getElementById("changephone");
	changphone.style.fontSize=H*0.03+"px";
	changphone.style.position="relative";
	changphone.style.right=H*0.02+"px";
	changphone.style.height=H*0.05+"px";
	changphone.style.marginTop=H*0.01+"px";
	
	var verificationnotice=document.getElementById("verificationnotice");
	verificationnotice.style.fontSize=H*0.03+"px";
	verificationnotice.style.position="relative";
	verificationnotice.style.marginBottom=0+"px";
	verificationnotice.style.marginTop=0+"px";
	verificationnotice.style.marginLeft=H*0.05+"px";
	
	var verification=document.getElementById("verification");
	verification.style.fontSize=H*0.03+"px";
	verification.style.position="relative";
	verification.style.marginTop=H*0.01+"px";
	verification.style.marginLeft=H*0.05+"px";
	verification.style.height=H*0.05+"px";
	
	var get_button=document.getElementById("get button");
	get_button.style.fontSize=H*0.03+"px";
	get_button.style.position="relative";
	get_button.style.right=H*0.02+"px";
	get_button.style.height=H*0.05+"px";
	get_button.style.marginTop=H*0.01+"px";
	
	var change_button=document.getElementById("change button");
	change_button.style.fontSize=H*0.03+"px";
	change_button.style.position="relative";
	change_button.style.right=H*0.02+"px";
	change_button.style.height=H*0.05+"px";
	change_button.style.marginTop=H*0.015+"px";
	//change_button.style.marginButton=H*0.005+"px";
	
	function CP()
	{
		console.log("lalala");
		if(changphone.value=='修改')
		{

			$.confirm({
		 	title:'',
		 	content:'你确信修改手机号吗？',
		 	confirm:function(){
				
				phoneinput.style.display='block';
				phonenumber.style.display='none';
				changphone.setAttribute("value","取消");
				phoneinput.setAttribute("placeholder",phonenumber.innerHTML);
				document.getElementById("Phonehandin").style.display="block";
				document.getElementById("Verification").style.display="block";		
		 	},
			cancel:function(){

			}
			});
		}
		else
		{
			$.confirm({
		 	title:'',
		 	content:'你确信要取消修改吗？',
		 	confirm:function(){
				
				phoneinput.style.display='none';
				phonenumber.style.display='block';
				changphone.setAttribute("value","修改");
				document.getElementById("Phonehandin").style.display="none";
				document.getElementById("Verification").style.display="none";
				document.getElementById("phonenotice").innerHTML="";
		 	},
			cancel:function(){

			}
			});
		}
	}
	
	var temp='';
	var temp_number='';
	function getphoneverification()
	{
		if(phoneinput.value=='')
		{
			phonenotice.innerHTML="手机号不能为空";
			verificationnotice.innerHTML="";
		}
		else
		{
			if(phoneinput.value.toString().length!=11)
			{
				phonenotice.innerHTML="请输入正确的手机号";
				verificationnotice.innerHTML="";
			}
			else
			{
				var Data="phonenumber=" + document.getElementById("phoneinput").value;
			 		$.ajax({
             			type:'POST',
             			url: 'http://blinkofwings.xyz/book/checkphone.php',
             			data:Data,
			 			dataType:'json',
             			success: function(data){
							if(data.status=="-1")
							{
								phonenotice.innerHTML="该手机号已经被绑定";
								verificationnotice.innerHTML="";
							}
							if(data.status=='1')
							{
								phonenotice.innerHTML="";
								verificationnotice.innerHTML=""; 
								//执行发送验证码的代码
								var Data="phonenumber=" + document.getElementById("phoneinput").value;
								$.ajax({
             							type:'POST',
             							url: 'http://blinkofwings.xyz/book/aliplaytest.php',
             							data:Data,
			 							dataType:'json',
             							success: function(data)
										{
											if(data.status=='1')
											{
												temp=data.verify;
												temp_number=data.number;
												console.log(temp);
												console.log(temp_number);
											}
											else
											{
												$.alert("发送验证码失败，请稍候重试");
											}
                      					},
			 							error : function(XMLHttpRequest, textStatus, errorThrown) {　
											$.alert(XMLHttpRequest.responseText); 
			 								$.alert(XMLHttpRequest.status);
			 								$.alert(XMLHttpRequest.readyState);
			 								$.alert(textStatus); 
			 						}
         						});
								
								var times=60;      
								var timer=null;     
								get_button.disabled=true;      
								timer = setInterval(function(){       
	    						times --;       
	   							 get_button.value = times + "s后重试";        
								if(times <= 0)
								{          
									get_button.disabled =false;          
								 	get_button.value = "获取验证码";         
									clearInterval(timer);          
									times = 60;        
								}       
								console.log(times);     
							 },1000); 
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
	
	function phonehandin()
	{
		if(phoneinput.value=='')
		{
			phonenotice.innerHTML="手机号不能为空";
			verificationnotice.innerHTML="";
		}
		else
		{
			if(phoneinput.value.toString().length!=11)
			{
				phonenotice.innerHTML="请输入正确的手机号";
				verificationnotice.innerHTML="";
			}
			else
			{
				if((verification.value!=temp)||(phoneinput.value!=temp_number))
				{
					phonenotice.innerHTML="";
					verificationnotice.innerHTML="验证码不正确"; 
				}
				else
				{
					phonenotice.innerHTML="";
					verificationnotice.innerHTML="";
					var Data="username=" + document.getElementById("username").innerHTML +"&phonenumber=" + phoneinput.value ;
					$.ajax({
             				type:'POST',
             				url: 'http://blinkofwings.xyz/book/updatephonenumber.php',
             				data:Data,
			 				dataType:'json',
             				success: function(data)
							 {
								if(data.status=='-2')
								{
									$.alert("对不起，手机号更改失败");
								}
								if(data.status=='1')
								{
									$.alert("手机号更改成功");
									phonenumber.innerHTML=phoneinput.value;
									phoneinput.style.display='none';
									phonenumber.style.display='block';
									changphone.setAttribute("value","修改");
									document.getElementById("Phonehandin").style.display="none";
									document.getElementById("Verification").style.display="none";
								}
                      		},
			 				error : function(XMLHttpRequest, textStatus,errorThrown) 
							{　
								$.alert(XMLHttpRequest.responseText); 
			 					$.alert(XMLHttpRequest.status);
			 					$.alert(XMLHttpRequest.readyState);
			 					$.alert(textStatus); 
			 				}
         				});
				}
			}
		}
	}
	
	var containerbox2=document.getElementById("containerbox2");
	containerbox2.style.position="relative";
	containerbox2.style.top=H*0.05+"px";
	
	var mailtitle=document.getElementById("mailtitle");
	mailtitle.style.fontSize=H*0.03+"px";
	mailtitle.style.position="relative";
	mailtitle.style.marginBottom=0+"px";
	mailtitle.style.marginTop=H*0.03+"px";
	mailtitle.style.marginLeft=H*0.02+"px";
	
	var mailnotice=document.getElementById("mailnotice");
	mailnotice.style.fontSize=H*0.03+"px";
	mailnotice.style.position="relative";
	mailnotice.style.marginBottom=0+"px";
	mailnotice.style.marginTop=H*0.04+"px";
	mailnotice.style.marginLeft=H*0.02+"px";
	
	var mailnumber=document.getElementById("mailnumber");
	mailnumber.style.fontSize=H*0.03+"px";
	mailnumber.style.position="relative";
	mailnumber.style.marginTop=H*0.01+"px";
	mailnumber.style.marginLeft=H*0.02+"px";
	mailnumber.style.marginBottom=H*0.01+"px";
	
	var mailinput=document.getElementById("mailinput");
	mailinput.style.fontSize=H*0.03+"px";
	mailinput.style.position="relative";
	mailinput.style.marginTop=H*0.01+"px";
	mailinput.style.marginLeft=H*0.05+"px";
	mailinput.style.height=H*0.05+"px";
	
	var changmail=document.getElementById("changemail");
	changmail.style.fontSize=H*0.03+"px";
	changmail.style.position="relative";
	changmail.style.right=H*0.02+"px";
	changmail.style.height=H*0.05+"px";
	changmail.style.marginTop=H*0.01+"px";
	
	var verificationnoticemail=document.getElementById("verificationnoticemail");
	verificationnoticemail.style.fontSize=H*0.03+"px";
	verificationnoticemail.style.position="relative";
	verificationnoticemail.style.marginBottom=0+"px";
	verificationnoticemail.style.marginTop=0+"px";
	verificationnoticemail.style.marginLeft=H*0.05+"px";
	
	var verificationmail=document.getElementById("verificationmail");
	verificationmail.style.fontSize=H*0.03+"px";
	verificationmail.style.position="relative";
	verificationmail.style.marginTop=H*0.01+"px";
	verificationmail.style.marginLeft=H*0.05+"px";
	verificationmail.style.height=H*0.05+"px";
	
	var getmail_button=document.getElementById("getmail button");
	getmail_button.style.fontSize=H*0.03+"px";
	getmail_button.style.position="relative";
	getmail_button.style.right=H*0.02+"px";
	getmail_button.style.height=H*0.05+"px";
	getmail_button.style.marginTop=H*0.01+"px";
	
	var changemail_button=document.getElementById("changemail button");
	changemail_button.style.fontSize=H*0.03+"px";
	changemail_button.style.position="relative";
	changemail_button.style.right=H*0.02+"px";
	changemail_button.style.height=H*0.05+"px";
	changemail_button.style.marginTop=H*0.015+"px";
	
	var containerbox3=document.getElementById("containerbox3");
	containerbox3.style.position="relative";
	containerbox3.style.top=H*0.05+"px";
	
	var recommendintime=document.getElementById("recommendintime");
	recommendintime.style.fontSize=H*0.03+"px";
	recommendintime.style.position="relative";
	recommendintime.style.marginBottom=0+"px";
	recommendintime.style.marginTop=H*0.02+"px";
	recommendintime.style.marginLeft=H*0.02+"px";
	
	var recommendintimebutton=document.getElementById("recommendintime button");
	recommendintimebutton.style.fontSize=H*0.03+"px";
	recommendintimebutton.style.position="relative";
	recommendintimebutton.style.right=H*0.02+"px";
	recommendintimebutton.style.height=H*0.05+"px";
	recommendintimebutton.style.marginTop=H*0.02+"px";
	
	var tenday=document.getElementById("10day");
	tenday.style.fontSize=H*0.03+"px";
	tenday.style.position="relative";
	tenday.style.marginBottom=0+"px";
	tenday.style.marginTop=H*0.02+"px";
	tenday.style.marginLeft=H*0.02+"px";
	
	var twentyday=document.getElementById("20day");
	twentyday.style.fontSize=H*0.03+"px";
	twentyday.style.position="relative";
	twentyday.style.marginBottom=0+"px";
	twentyday.style.marginTop=H*0.02+"px";
	twentyday.style.marginLeft=H*0.02+"px";
	
	var thirtyday=document.getElementById("30day");
	thirtyday.style.fontSize=H*0.03+"px";
	thirtyday.style.position="relative";
	thirtyday.style.marginBottom=0+"px";
	thirtyday.style.marginTop=H*0.02+"px";
	thirtyday.style.marginLeft=H*0.02+"px";
	
	var checkbox1=document.getElementById("checkbox1");
	checkbox1.style.height=H*0.03+"px";
	checkbox1.style.width=H*0.03+"px";
	checkbox1.style.marginRight=H*0.005+"px";
	var checkbox2=document.getElementById("checkbox2");
	checkbox2.style.height=H*0.03+"px";
	checkbox2.style.width=H*0.03+"px";
	checkbox2.style.marginRight=H*0.005+"px";
	var checkbox3=document.getElementById("checkbox3");
	checkbox3.style.height=H*0.03+"px";
	checkbox3.style.width=H*0.03+"px";
	checkbox3.style.marginRight=H*0.005+"px";
	var recommendbutton=document.getElementById("recommendbutton");
	recommendbutton.style.fontSize=H*0.03+"px";
	recommendbutton.style.position="relative";
	recommendbutton.style.right=H*0.02+"px";
	recommendbutton.style.height=H*0.05+"px";
	recommendbutton.style.marginTop=H*0.01+"px";
	
	checkrecommend();
	function checkrecommend()
	{
		if(document.getElementById("isrecommend").innerHTML=="false")
		{
			document.getElementById("checkbox").style.display="none";
			recommendintimebutton.value="开启";
			recommendintimebutton.className="button button-action button-box button-raised button-giant button-longshadow";
		}
		else
		{
			if(document.getElementById("frequency").innerHTML=="10")
			{
				console.log("10");
				document.getElementById("checkbox1").checked="checked";
			}
			if(document.getElementById("frequency").innerHTML=="20")
			{
				console.log("20");
				document.getElementById("checkbox2").checked="checked";
			}
			if(document.getElementById("frequency").innerHTML=="30")
			{
				console.log("30");
				document.getElementById("checkbox3").checked="checked";
			}
		}
	}
	function recommend()
	{
		if(mailnumber.innerHTML=='空')
		{
			$.confirm({
		 	title:'',
		 	content:'开启定时推荐功能请先绑定邮箱',
		 	confirm:function(){
				
		 	},
			cancel:function(){

			}
			});
		}
		else
		{	
			if(recommendintimebutton.value=="禁用")
			{
				$.confirm({
		 		title:'',
		 		content:'你确信要禁用定时推荐吗？',
		 		confirm:function(){
				var Data="username=" + document.getElementById("username").innerHTML +"&isrecommend=false";
					$.ajax({
             				type:'POST',
             				url: 'http://blinkofwings.xyz/book/updateisrecommend.php',
             				data:Data,
			 				dataType:'json',
             				success: function(data)
							 {
								if(data.status=='-2')
								{
									$.alert("对不起，禁用失败");
								}
								if(data.status=='1')
								{
									$.alert("你已经关闭定时推荐功能");
									document.getElementById("checkbox").style.display="none";
									recommendintimebutton.setAttribute("value","开启");
									recommendintimebutton.className="button button-action button-box button-raised button-giant button-longshadow";
		
								}
                      					},
			 				error : function(XMLHttpRequest, textStatus,errorThrown) 
							{　
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
		 		content:'你确信要开启定时推荐吗？',
		 		confirm:function(){
					var Data="username=" + document.getElementById("username").innerHTML +"&isrecommend=true";
					$.ajax({
             				type:'POST',
             				url: 'http://blinkofwings.xyz/book/updateisrecommend.php',
             				data:Data,
			 				dataType:'json',
             				success: function(data)
							 {
								if(data.status=='-2')
								{
									$.alert("对不起，开启失败");
								}
								if(data.status=='1')
								{
									$.alert("你已经开启定时推荐功能");
									document.getElementById("checkbox").style.display="block";
									recommendintimebutton.setAttribute("value","禁用");
									recommendintimebutton.className="button button-caution button-box button-raised button-giant button-longshadow";
		
								}
                      		},
			 				error : function(XMLHttpRequest, textStatus,errorThrown) 
							{　
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
	}
	var fre;
	function handinrecommend()
	{
		var obj = document.getElementsByName("category");  
        for(i=0; i<obj.length;i++)    
		{
  			if(obj[i].checked)    
			{ 
              	fre = obj[i].value; 
            } 
         }
				 console.log(fre);
				$.confirm({
		 		title:'',
		 		content:'你确信要更改推荐时间吗？',
		 		confirm:function(){
					var Data="username=" + document.getElementById("username").innerHTML +"&frequency="+fre;
					$.ajax({
             				type:'POST',
             				url: 'http://blinkofwings.xyz/book/updatefrequency.php',
             				data:Data,
			 		dataType:'json',
             				success: function(data)
					{
						if(data.status=='-2')
						{
							$.alert("对不起，更改时间失败");
						}
						if(data.status=='1')
						{
							$.alert("你已经更改了推荐功能");
						}
                      			},
			 				error : function(XMLHttpRequest, textStatus,errorThrown) 
							{　
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
	
	changemailvalue();
	function changemailvalue()
	{
		if(mailnumber.innerHTML=='空')
		{
			changmail.setAttribute("value","绑定邮箱");
		}
	}
	
	function changemail()
	{		
		if(changmail.value=='修改')
		{
				$.confirm({
		 		title:'',
		 		content:'你确信修改邮箱吗？',
		 		confirm:function(){
					mailinput.style.display='block';
					mailnumber.style.display='none';
					changmail.setAttribute("value","取消");
					mailinput.setAttribute("placeholder",mailnumber.innerHTML);
					document.getElementById("Mailhandin").style.display="block";
					document.getElementById("Verificationmail").style.display="block";
		 		},
				cancel:function(){

				}
				});
		}
		else
		{
			if(changmail.value=='取消')
			{
				$.confirm({
		 		title:'',
		 		content:'你确信要取消修改吗？',
		 		confirm:function(){
					mailinput.style.display='none';
					mailnumber.style.display='block';
					changmail.setAttribute("value","修改");
					document.getElementById("Mailhandin").style.display="none";
					document.getElementById("Verificationmail").style.display="none";
					document.getElementById("mailnotice").innerHTML="";
				},
				cancel:function(){

				}
				});
			}
			else
			{
				if(changmail.value=='绑定邮箱')
				{
					$.confirm({
		 			title:'',
		 			content:'你确信要绑定邮箱吗？',
		 			confirm:function(){
						mailinput.style.display='block';
						mailnumber.style.display='none';
						changmail.setAttribute("value","取消绑定");
						mailinput.setAttribute("placeholder",mailnumber.innerHTML);
						document.getElementById("Mailhandin").style.display="block";
						document.getElementById("Verificationmail").style.display="block";
					},
					cancel:function(){

					}
					});
				}
				else
				{
					$.confirm({
		 			title:'',
		 			content:'你不想绑定邮箱吗？',
		 			confirm:function(){
						mailinput.style.display='none';
						mailnumber.style.display='block';
						changmail.setAttribute("value","绑定邮箱");
						document.getElementById("Mailhandin").style.display="none";
						document.getElementById("Verificationmail").style.display="none";
					},
					cancel:function(){

					}
					});
				}
			}
		}
	}
	
	var tempmail='';
	var tempmail_number='';
	function getmailverification()
	{
		if(mailinput.value=='')
		{
			mailnotice.innerHTML="邮箱不能为空";
			verificationnoticemail.innerHTML="";
		}
		else
		{
				var Data="mail=" + document.getElementById("mailinput").value;
			 		$.ajax({
             			type:'POST',
             			url: 'http://blinkofwings.xyz/book/checkmail.php',
             			data:Data,
			 			dataType:'json',
             			success: function(data){
							if(data.status=="-1")
							{
								mailnotice.innerHTML="该邮箱已经被绑定";
								verificationnoticemail.innerHTML="";
							}
							if(data.status=='1')
							{
								mailnotice.innerHTML="";
								verificationnoticemail.innerHTML=""; 
								//执行发送验证码的代码
								var Data="mail=" + document.getElementById("mailinput").value;
								$.ajax({
             							type:'POST',
             							url: 'http://blinkofwings.xyz/book/mailsend.php',
             							data:Data,
			 							dataType:'json',
             							success: function(data)
										{
											if(data.status=='1')
											{
												tempmail=data.verify;
												tempmail_number=data.number;
												console.log(tempmail);
												console.log(tempmail_number);
											}
											else
											{
												$.alert("发送验证码失败，请稍候重试");
											}
                      					},
			 							error : function(XMLHttpRequest, textStatus, errorThrown) {　
											$.alert(XMLHttpRequest.responseText); 
			 								$.alert(XMLHttpRequest.status);
			 								$.alert(XMLHttpRequest.readyState);
			 								$.alert(textStatus); 
			 						}
         						});
								
								var times=60;      
								var timer=null;     
								getmail_button.disabled=true;      
								timer = setInterval(function(){       
	    						times --;       
	   							getmail_button.value = times + "s后重试";        
								if(times <= 0)
								{          
									getmail_button.disabled =false;          
								 	getmail_button.value = "获取验证码";         
									clearInterval(timer);          
									times = 60;        
								}       
								console.log(times);     
							 },1000); 
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
	
	function mailhandin()
	{
		if(mailinput.value=='')
		{
			mailnotice.innerHTML="邮箱不能为空";
			verificationnoticemail.innerHTML="";
		}
		else
		{
				if((verificationmail.value!=tempmail)||(mailinput.value!=tempmail_number))
				{
					mailnotice.innerHTML="";
					verificationnoticemail.innerHTML="验证码不正确"; 
				}
				else
				{
					mailnotice.innerHTML="";
					verificationnoticemail.innerHTML="";
					var Data="username=" + document.getElementById("username").innerHTML +"&mail=" + mailinput.value ;
					$.ajax({
             				type:'POST',
             				url: 'http://blinkofwings.xyz/book/updatemail.php',
             				data:Data,
			 				dataType:'json',
             				success: function(data)
							 {
								if(data.status=='-2')
								{
									$.alert("对不起，邮箱号更改失败");
								}
								if(data.status=='1')
								{
									if(changmail.value=='修改')
									{
										$.alert("邮箱号更改成功");
									}
									else
									{
										$.alert("邮箱号绑定成功");
									}
									mailnumber.innerHTML=mailinput.value;
									mailinput.style.display='none';
									mailnumber.style.display='block';
									changmail.setAttribute("value","修改");
									document.getElementById("Mailhandin").style.display="none";
									document.getElementById("Verificationmail").style.display="none";
								}
                      		},
			 				error : function(XMLHttpRequest, textStatus,errorThrown) 
							{　
								$.alert(XMLHttpRequest.responseText); 
			 					$.alert(XMLHttpRequest.status);
			 					$.alert(XMLHttpRequest.readyState);
			 					$.alert(textStatus); 
			 				}
         				});
				}
			}
	}
	
	update();
	function update()
	{
		
			times=0;
	 		timer=null;       
	 		timer = setInterval(function(){       
	 		times ++;             
	 		if(times%60== 0)
			{          
				updatepicture.disabled=false;
				//修改数据库
				var Data="username=" + document.getElementById("username").innerHTML;
								$.ajax({
             							type:'POST',
             							url: 'http://blinkofwings.xyz/book/updateqrcode.php',
             							data:Data,
			 							dataType:'json',
             							success: function(data)
										{
											if(data.status=='1')
											{
												console.log(data.message);
											}
											else
											{
												console.log("二维码更新失败");
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
				if(times==600)
				{
					clearInterval(timer);          
					times = 0;	
				}
				console.log(times);     
				},1000);
				 						
	}
	
	function Updatepicture()
	{
		window.location.reload();
	}
</script>
</html>