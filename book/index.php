<!DOCTYPE html>
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>

	
</script>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title> 图书馆登录</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="图书馆登录界面" />
        <meta name="keywords" content=" 图书馆, XX市, 登录,  注册" />
        <meta name="author" content="Codrops" />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
        <script src="jquery.cookie.js" type="text/javascript"></script> 
	<script type="text/javascript">
  		var system = {};
 		var p = navigator.platform;
 		var u = navigator.userAgent;
		system.win = p.indexOf("Win") == 0;
  		system.mac = p.indexOf("Mac") == 0;
  		system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
  		if (system.win || system.mac || system.xll) {//如果是PC转
   			 if (u.indexOf('Windows Phone') > -1) {  //win手机端
			}else {
      			window.location.href = "addChannelPCerror.html";
    			}
  		}
	</script>
    </head>
    <body style="background-repeat:no-repeat;background: url(picture/bg.jpg);background-size:100% 100%;background-position:   center center">
        <div class="container">
            <!-- Codrops top bar -->
            <!--/ Codrops top bar -->
            
            <section id="section">				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <a class="hiddenanchor" id="tofindpassword"></a>
                    <div id="wrapper" style="width:80%">
                        <div id="login" class="animate form">
                            <form  autocomplete="off" id="login_form"  > 
                                <h1 id="login_title">登录图书馆</h1> 
                                <p > 
                                    <label for="username" class="uname" id="login_username" style="float:left">账号:</label>
                                    <label id="login_username1" style="float:right;color:#FB0303"></label>
                                    <input id="usernameinput" name="username"  type="text" placeholder=""style="width:90%"/>
                                </p>
                                <p > 
                                    <label for="password" class="youpasswd" id="login_password" style="float:left">密码:</label>
                                    <label id="login_password1" style="float:right;color:#FB0303"></label>
                                    <input id="passwordinput" name="password"  type="password" placeholder="" style="width:90%"/> 
                                </p>
                                <p class="keeplogin" > 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping"  style="float:left" /> 
									<label for="loginkeeping" id="login_keeplogin"  style="float:left">记住密码</label>
                                   
								</p>
                                <p class="login button"> 
                                    <input type="button" value="登录" id="login button"  onclick="check()"> 
								</p>
                                <p class="change_link" id="loginchange_link" >
                                 <a href="#tofindpassword" class="to_findpassword" id="to_findpassword" style="float:left">忘记密码？</a>
									还没有账户?
									<a href="#toregister" class="to_register" id="to_register">注册</a>
								</p>
                            </form>
                        </div> 

                        <div id="register" class="animate form">
                            <form  action="#" autocomplete="on" > 
                                <h1 id="register_title">注册账号</h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" id="register_username" style="float:left">用户名:</label>
                                    <label id="register_username1" style="float:right;color:#FB0303"></label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder=""  />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail"  id="register_mail" style="float:left">手机号:</label>
                                    <label id="register_mail1" style="float:right;color:#FB0303"></label>
                                    <input name="emailsignup" type="number" required="required" id="emailsignup"  min="11"  max="11" lplaceholder="" oninvalid="this.setCustomValidity('请输入正确的手机号码');" /> 
                                </p>
                                <p>
                                <label  id="verification_notice" style="float:left;color:#FB0303;width:100%;"></label>
                                <input name="verification" type="number" required="required" id="verification"  lplaceholder=""  style="float:left;width:50%"/> 
                                <input type="button" value="获取验证码" id="get button"  style="float:right;width:40%" onclick="getverification()"> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" id="register_youpasswdfirst" style="float:left">请输入密码:</label>
                                    <label id="register_youpasswdfirst1" style="float:right;color:#FB0303"></label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder=""/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" id="register_youpasswdsecond" style="float:left">确认您的密码:</label>
                                    <label id="register_youpasswdsecond1" style="float:right;color:#FB0303"></label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder=""/>
                                </p>
                                <p class="signin button"> 
									<input type="button" value="提交" id="register button" onclick="registercheck()"/> 
								</p>
                                <p class="change_link" id="registerchange_link">  
									已经注册过了?
									<a href="#tologin" class="to_register">马上登录</a>
								</p>
                            </form>
                        </div>
						
                         <div id="findpassword" class="animate form">
                            <form  action="#" autocomplete="on" > 
                                <h1 id="findpassword_title">重置密码</h1> 
                                <p> 
                                    <label for="usernamefind" class="uname" id="find_username" style="float:left">用户名:</label>
                                    <label id="find_username1" style="float:right;color:#FB0303"></label>
                                    <input id="usernamefind" name="usernamefind" required="required" type="text" placeholder=""  />
                                </p>
                                <p>
                                <label  id="verification_noticefind" style="float:left;color:#FB0303;width:100%;"></label>
                                <input name="verificationfind" type="number" required="required" id="verificationfind"  lplaceholder=""  style="float:left;width:50%"/> 
                                <input type="button" value="获取验证码" id="get buttonfind"  style="float:right;width:40%" onclick="getverificationfind()"> 
                                </p>
                                <p> 
                                    <label for="passwordfind" class="youpasswd" id="find_youpasswdfirst" style="float:left">请输入密码:</label>
                                    <label id="find_youpasswdfirst1" style="float:right;color:#FB0303"></label>
                                    <input id="passwordfind" name="passwordfind" required="required" type="password" placeholder=""/>
                                </p>
                                <p> 
                                    <label for="passwordfind_confirm" class="youpasswd" id="find_youpasswdsecond" style="float:left">确认您的密码:</label>
                                    <label id="find_youpasswdsecond1" style="float:right;color:#FB0303"></label>
                                    <input id="passwordfind_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder=""/>
                                </p>
                                <p class="find button"> 
									<input type="button" value="确认" id="find button" onclick="findcheck()"/> 
								</p>
                                <p class="change_link" id="findchange_link">  
									重置密码完成?
									<a href="#tologin" class="to_register">马上登录</a>
								</p>
                            </form>
                        </div>
                        
                    </div>
                </div>  
            </section>
        </div>
    </body>
    <script>
		//初始化页面时验证是否记住了密码
	$(document).ready(function() {
    if ($.cookie("loginkeeping") == "true") {
        document.getElementById("loginkeeping").checked="true";
        $("#usernameinput").val($.cookie("userName"));
        $("#passwordinput").val($.cookie("passWord"));
    }
});
	
		var temp;
		var temp_number;
		
		var H=document.documentElement.clientHeight;
		var W=document.documentElement.clientWidth;
		var section=document.getElementById("section");
		section.style.position="relative";
		section.style.top=H*0.10+"px";
				
		var login_title=document.getElementById("login_title");
		login_title.style.fontSize=H*0.035+"px";
		login_title.style.marginBottom=H*0.01+"px";		
		
		var login_username=document.getElementById("login_username");
		login_username.style.fontSize=H*0.03+"px";	
		var login_username1=document.getElementById("login_username1");
		login_username1.style.fontSize=H*0.025+"px";	
		
		var usernameinput=document.getElementById("usernameinput");
		usernameinput.style.height=H*0.06+"px";
		usernameinput.style.fontSize=H*0.03+"px";
		usernameinput.style.marginBottom=H*0.01+"px";
		
		var login_password=document.getElementById("login_password");
		login_password.style.fontSize=H*0.03+"px";
		var login_password1=document.getElementById("login_password1");
		login_password1.style.fontSize=H*0.025+"px";
		
		var passwordinput=document.getElementById("passwordinput");
		passwordinput.style.height=H*0.06+"px";
		passwordinput.style.fontSize=H*0.03+"px";
		passwordinput.style.marginBottom=H*0.01+"px";
		
		var login_keeplogin=document.getElementById("login_keeplogin");
		login_keeplogin.style.fontSize=H*0.03+"px";
		
		var loginkeeping=document.getElementById("loginkeeping");
		loginkeeping.style.height=H*0.03+"px";
		loginkeeping.style.width=H*0.03+"px";
		loginkeeping.style.position="relative";
		loginkeeping.style.top=H*0.003+"px";
		
		var login_button=document.getElementById("login button");
		login_button.style.width=H*0.2+"px";
		login_button.style.height=H*0.05+"px";
		login_button.style.fontSize=H*0.03+"px";
		login_button.style.position="relative";
		login_button.style.right=H*0.01+"px";
		
		var loginchange_link=document.getElementById("loginchange_link");
		loginchange_link.style.position="relative";
		loginchange_link.style.height=H*0.05+"px";
		loginchange_link.style.fontSize=H*0.03+"px";
		loginchange_link.style.width=W*0.8+"px";
		loginchange_link.style.left=-W*0.048+"px";
		loginchange_link.style.marginTop=H*0.015+"px";
		
		document.getElementById("to_register").style.fontSize=H*0.03+"px";
		document.getElementById("to_findpassword").style.fontSize=H*0.03+"px";
		
		var register_title=document.getElementById("register_title");
		register_title.style.fontSize=H*0.035+"px";
		register_title.style.marginBottom=H*0.01+"px";	
		
		var register_username=document.getElementById("register_username");
		register_username.style.fontSize=H*0.03+"px";
		
		var usernamesignup=document.getElementById("usernamesignup");
		usernamesignup.style.height=H*0.06+"px";
		usernamesignup.style.fontSize=H*0.03+"px";
		usernamesignup.style.marginBottom=H*0.01+"px";
		
		var register_mail=document.getElementById("register_mail");
		register_mail.style.fontSize=H*0.03+"px";
			
		var verification=document.getElementById("verification");
		verification.style.height=H*0.06+"px";
		verification.style.fontSize=H*0.03+"px";
		verification.style.marginBottom=H*0.02+"px";
		
		var get_button=document.getElementById("get button");
		get_button.style.height=H*0.06+"px";
		get_button.style.fontSize=H*0.03+"px";
		get_button.style.marginBottom=H*0.02+"px";
		
		var verification_notice=document.getElementById("verification_notice");
		verification_notice.style.fontSize=H*0.03+"px";
		
		var emailsignup=document.getElementById("emailsignup");
		emailsignup.style.height=H*0.06+"px";
		emailsignup.style.fontSize=H*0.03+"px";
		emailsignup.style.marginBottom=H*0.01+"px";
		
		var register_youpasswdfirst=document.getElementById("register_youpasswdfirst");
		register_youpasswdfirst.style.fontSize=H*0.03+"px";

			
		var passwordsignup=document.getElementById("passwordsignup");
		passwordsignup.style.height=H*0.06+"px";
		passwordsignup.style.fontSize=H*0.03+"px";
		passwordsignup.style.marginBottom=H*0.01+"px";
		
		var register_youpasswdsecond=document.getElementById("register_youpasswdsecond");
		register_youpasswdsecond.style.fontSize=H*0.03+"px";

			
		var passwordsignup_confirm=document.getElementById("passwordsignup_confirm");
		passwordsignup_confirm.style.height=H*0.06+"px";
		passwordsignup_confirm.style.fontSize=H*0.03+"px";
		passwordsignup_confirm.style.marginBottom=H*0.01+"px";
		
		var register_button=document.getElementById("register button");
		register_button.style.width=H*0.2+"px";
		register_button.style.height=H*0.05+"px";
		register_button.style.fontSize=H*0.03+"px";
		register_button.style.position="relative";
	
		var registerchange_link=document.getElementById("registerchange_link");
		registerchange_link.style.position="relative";
		registerchange_link.style.height=H*0.05+"px";
		registerchange_link.style.fontSize=H*0.03+"px";
		registerchange_link.style.width=W*0.8+"px";
		registerchange_link.style.left=-W*0.048+"px";
		registerchange_link.style.marginTop=H*0.015+"px";
			
		var register_mail1=document.getElementById("register_mail1");
		register_mail1.style.fontSize=H*0.025+"px";

		var register_username1=document.getElementById("register_username1");
		register_username1.style.fontSize=H*0.025+"px";


		var register_youpasswdfirst1=document.getElementById("register_youpasswdfirst1");
		register_youpasswdfirst1.style.fontSize=H*0.025+"px";

		var register_youpasswdsecond1=document.getElementById("register_youpasswdsecond1");
		register_youpasswdsecond1.style.fontSize=H*0.025+"px";
		function check() {
			if(usernameinput.value=='')
			{
				login_username1.innerHTML="请输入用户名";
				login_password1.innerHTML="";
			}
			else
			{
				
				if(passwordinput.value=='')
				{
					login_username1.innerHTML="";
					login_password1.innerHTML="请输入密码";
				}
				else
				{
					var Data="username=" + document.getElementById("usernameinput").value + "&password=" + document.getElementById("passwordinput").value ;
			 		$.ajax({
             			type:'POST',
             			url: 'http://blinkofwings.xyz/book/checkpassword.php',
             			data:Data,
			 			dataType:'json',
             			success: function(data){
							if(data.status=="-1")
							{
								login_username1.innerHTML="没有这个用户";
								login_password1.innerHTML="";
							}
							if(data.status=='-2')
							{
								login_password1.innerHTML="密码错误";
								login_username1.innerHTML="";
							}
							if(data.status=='1')
							{
								saveUserInfo();
								login_password1.innerHTML="";
								login_username1.innerHTML="";
								var login_form=document.getElementById("login_form");
								login_form.method="post" ;
								login_form.action = 'transmit.php' ;
								login_form.submit() ;  
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
		}
	}
	function getverification()
	{
		if(emailsignup.value=='')
		{
			register_mail1.innerHTML="请输入手机号";
			register_username1.innerHTML="";
			register_youpasswdfirst1.innerHTML="";
			register_youpasswdsecond1.innerHTML="";
			verification_notice.innerHTML="";
		}
		else
		{
			if(emailsignup.value.toString().length!=11)
			{
				register_mail1.innerHTML="请输入正确的手机号";
				register_username1.innerHTML="";
				register_youpasswdfirst1.innerHTML="";
				register_youpasswdsecond1.innerHTML="";
				verification_notice.innerHTML="";
			}
			else
			{
				var Data="phonenumber=" + document.getElementById("emailsignup").value;
			 		$.ajax({
             			type:'POST',
             			url: 'http://blinkofwings.xyz/book/checkphone.php',
             			data:Data,
			 			dataType:'json',
             			success: function(data){
							if(data.status=="-1")
							{
								register_mail1.innerHTML="该手机号已经被注册";
								register_username1.innerHTML="";
								register_youpasswdfirst1.innerHTML="";
								register_youpasswdsecond1.innerHTML="";
								verification_notice.innerHTML="";
							}
							if(data.status=='1')
							{
								register_mail1.innerHTML="";
								register_username1.innerHTML="";
								register_youpasswdfirst1.innerHTML="";
								register_youpasswdsecond1.innerHTML="";
								verification_notice.innerHTML=""; 
								//执行发送验证码的代码
								var Data="phonenumber=" + document.getElementById("emailsignup").value;
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
												alert("发送验证码失败，请稍候重试");
											}
                      					},
			 							error : function(XMLHttpRequest, textStatus, errorThrown) {　
											alert(XMLHttpRequest.responseText); 
			 								alert(XMLHttpRequest.status);
			 								alert(XMLHttpRequest.readyState);
			 								alert(textStatus); 
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
						alert(XMLHttpRequest.responseText); 
			 			alert(XMLHttpRequest.status);
			 			alert(XMLHttpRequest.readyState);
			 			alert(textStatus); 
			 		}
         		}); 
			}
		}
	}
	
	function registercheck()
	{
		if(usernamesignup.value=='')
		{
			register_username1.innerHTML="请输入用户名";
			register_mail1.innerHTML="";
			register_youpasswdfirst1.innerHTML="";
			register_youpasswdsecond1.innerHTML="";
			verification_notice.innerHTML=""; 
		}
		else
		{
			if(usernamesignup.value.toString().length>15)
			{
			  register_username1.innerHTML="用户名的长度要小于15";
			  register_mail1.innerHTML="";
			  register_youpasswdfirst1.innerHTML="";
			  register_youpasswdsecond1.innerHTML="";
			  verification_notice.innerHTML=""; 
			}
			else
			{
				var Data="username=" + document.getElementById("usernamesignup").value ;
			 		$.ajax({
             			type:'POST',
             			url: 'http://blinkofwings.xyz/book/loginusername.php',
             			data:Data,
			 			dataType:'json',
             			success: function(data){
							if(data.status=="-1")
							{
								register_username1.innerHTML="该用户名已经被注册";
								register_mail1.innerHTML="";
								register_youpasswdfirst1.innerHTML="";
								register_youpasswdsecond1.innerHTML="";
								verification_notice.innerHTML=""; 
							}
							if(data.status=='1')
							{
								if(emailsignup.value=='')
								{
									register_mail1.innerHTML="请输入手机号";
									register_username1.innerHTML="";
									register_youpasswdfirst1.innerHTML="";
									register_youpasswdsecond1.innerHTML="";
									verification_notice.innerHTML=""; 
								}
								else
								{
									if(emailsignup.value.toString().length!=11)
									{
										register_mail1.innerHTML="请输入正确的手机号";
										register_username1.innerHTML="";
										register_youpasswdfirst1.innerHTML="";
										register_youpasswdsecond1.innerHTML="";
										verification_notice.innerHTML=""; 
									}
									else
									{
										if(verification.value=='')
										{
											register_mail1.innerHTML="";
											register_username1.innerHTML="";
											register_youpasswdfirst1.innerHTML="";
											register_youpasswdsecond1.innerHTML="";
											verification_notice.innerHTML="请输入验证码"; 
										}
										else
										{
											if((verification.value!=temp)||(emailsignup.value!=temp_number))
											{
												register_mail1.innerHTML="";
												register_username1.innerHTML="";
												register_youpasswdfirst1.innerHTML="";
												register_youpasswdsecond1.innerHTML="";
												verification_notice.innerHTML="验证码不正确"; 
											}
											else
											{
												if(passwordsignup.value=='')
												{
													register_youpasswdfirst1.innerHTML="请输入密码";
													register_username1.innerHTML="";
													register_mail1.innerHTML="";
													register_youpasswdsecond1.innerHTML="";
													verification_notice.innerHTML="";
												}	
												else
												{
													if((passwordsignup.value.toString().length>15)||(passwordsignup.value.toString().length<6))
													{
														register_youpasswdfirst1.innerHTML="密码格式不正确";
														register_username1.innerHTML="";
														register_mail1.innerHTML="";
														register_youpasswdsecond1.innerHTML="";
														verification_notice.innerHTML="";
													}
													else
													{
														if(passwordsignup_confirm.value=='')
														{
															register_youpasswdsecond1.innerHTML="请确认密码";
															register_username1.innerHTML="";
															register_youpasswdfirst1.innerHTML="";
															register_mail1.innerHTML="";
															verification_notice.innerHTML="";
														}
														else
														{
															if(passwordsignup_confirm.value!=passwordsignup.value)
															{
																register_youpasswdsecond1.innerHTML="两次输入的密码不同";
																register_username1.innerHTML="";
																register_youpasswdfirst1.innerHTML="";
																register_mail1.innerHTML="";
																verification_notice.innerHTML="";
															}
															else
															{																																						                             									register_youpasswdsecond1.innerHTML="";
																register_username1.innerHTML="";
																register_youpasswdfirst1.innerHTML="";
																register_mail1.innerHTML="";
																verification_notice.innerHTML="";
																var Data="username=" + document.getElementById("usernamesignup").value +"&phonenumber=" + emailsignup.value +"&password=" + passwordsignup.value;
														
																		$.ajax({
             															type:'POST',
             															url: 'http://blinkofwings.xyz/book/registernewuser.php',
             															data:Data,
			 															dataType:'json',
             															success: function(data)
																		{
																			if(data.status=='-2')
																			{
																				alert("对不起，注册失败 ");
																			}
																			if(data.status=='1')
																			{
																				alert("新用户注册成功，快去找找喜欢的书吧");
																			}
                      													},
			 															error : function(XMLHttpRequest, textStatus,errorThrown) {　
																			alert(XMLHttpRequest.responseText); 
			 																alert(XMLHttpRequest.status);
			 																alert(XMLHttpRequest.readyState);
			 																alert(textStatus); 
			 															}
         															});
																}
															}
														}
													}
											}
										}
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
	    }
	}
	
function saveUserInfo() {
		
    if ($("#loginkeeping").prop("checked") == true) {
		console.log("存放cookie");
        var userName = $("#usernameinput").val();
        var passWord = $("#passwordinput").val();
        $.cookie("loginkeeping", "true" ,{ expires: 7 }); // 存储一个 cookie
        $.cookie("userName", userName,{ expires: 7 }); // 存储一个 cookie
        $.cookie("passWord", passWord,{ expires: 7 }); // 存储一个 cookie
    }
    else {
		console.log("删除cookie");
        $.cookie("loginkeeping", "false", { expires: -1 });        // 删除 cookie
        $.cookie("userName", '', { expires: -1 });
        $.cookie("passWord", '', { expires: -1 });
    }
}
	</script>
     
    <script>
		var temp1;
		var find_title=document.getElementById("findpassword_title");
		find_title.style.fontSize=H*0.035+"px";
		find_title.style.marginBottom=H*0.01+"px";	
		
		var find_username=document.getElementById("find_username");
		find_username.style.fontSize=H*0.03+"px";
		var find_username1=document.getElementById("find_username1");
		find_username1.style.fontSize=H*0.025+"px";
		
		var usernamefind=document.getElementById("usernamefind");
		usernamefind.style.height=H*0.06+"px";
		usernamefind.style.fontSize=H*0.03+"px";
		usernamefind.style.marginBottom=H*0.01+"px";
			
		var verificationfind=document.getElementById("verificationfind");
		verificationfind.style.height=H*0.06+"px";
		verificationfind.style.fontSize=H*0.03+"px";
		verificationfind.style.marginBottom=H*0.02+"px";
		
		var get_buttonfind=document.getElementById("get buttonfind");
		get_buttonfind.style.height=H*0.06+"px";
		get_buttonfind.style.fontSize=H*0.03+"px";
		get_buttonfind.style.marginBottom=H*0.02+"px";
		
		var verification_noticefind=document.getElementById("verification_noticefind");
		verification_noticefind.style.fontSize=H*0.03+"px";
				
		var find_youpasswdfirst=document.getElementById("find_youpasswdfirst");
		find_youpasswdfirst.style.fontSize=H*0.03+"px";

			
		var passwordfind=document.getElementById("passwordfind");
		passwordfind.style.height=H*0.06+"px";
		passwordfind.style.fontSize=H*0.03+"px";
		passwordfind.style.marginBottom=H*0.01+"px";
		
		var find_youpasswdsecond=document.getElementById("find_youpasswdsecond");
		find_youpasswdsecond.style.fontSize=H*0.03+"px";

			
		var passwordfind_confirm=document.getElementById("passwordfind_confirm");
		passwordfind_confirm.style.height=H*0.06+"px";
		passwordfind_confirm.style.fontSize=H*0.03+"px";
		passwordfind_confirm.style.marginBottom=H*0.01+"px";
		
		var find_button=document.getElementById("find button");
		find_button.style.width=H*0.2+"px";
		find_button.style.height=H*0.05+"px";
		find_button.style.fontSize=H*0.03+"px";
		find_button.style.position="relative";
	
		var findchange_link=document.getElementById("findchange_link");
		findchange_link.style.position="relative";
		findchange_link.style.height=H*0.05+"px";
		findchange_link.style.fontSize=H*0.03+"px";
		findchange_link.style.width=W*0.8+"px";
		findchange_link.style.left=-W*0.048+"px";
		findchange_link.style.marginTop=H*0.015+"px";
			
		var find_username1=document.getElementById("find_username1");
		find_username1.style.fontSize=H*0.025+"px";

		var find_youpasswdfirst1=document.getElementById("find_youpasswdfirst1");
		find_youpasswdfirst1.style.fontSize=H*0.025+"px";

		var find_youpasswdsecond1=document.getElementById("find_youpasswdsecond1");
		find_youpasswdsecond1.style.fontSize=H*0.025+"px";

	function getverificationfind()
	{
		if(usernamefind.value=='')
		{
			find_username1.innerHTML="请输入用户名";
			find_youpasswdfirst1.innerHTML="";
			find_youpasswdsecond1.innerHTML="";
			verification_noticefind.innerHTML="";
		}
		else
		{
								find_username1.innerHTML="";
								find_youpasswdfirst1.innerHTML="";
								find_youpasswdsecond1.innerHTML="";
								verification_noticefind.innerHTML=""; 
								//执行发送验证码的代码
								var Data="username=" + usernamefind.value;
								$.ajax({
             							type:'POST',
             							url: 'http://blinkofwings.xyz/book/aliplaytest1.php',
             							data:Data,
			 							dataType:'json',
             							success: function(data)
										{
											if(data.status=='1')
											{
												temp1=data.verify;
												console.log(temp1);																									
											}
											else
											{
												if(data.status=='-2')
												{
													find_username1.innerHTML="没有该用户";
													find_youpasswdfirst1.innerHTML="";
													find_youpasswdsecond1.innerHTML="";
													verification_noticefind.innerHTML="";
												}
												else
												{
													alert("发送验证码失败，请稍后重试");
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
												var times=60;      
												var timer=null;     
												get_buttonfind.disabled=true;      
												timer = setInterval(function(){       
	    										times --;       
	   							 				get_buttonfind.value = times + "s后重试";        
												if(times <= 0)
												{          
													get_buttonfind.disabled =false;          
								 					get_buttonfind.value = "获取验证码";         
													clearInterval(timer);          
													times = 60;        
												}       
												console.log(times);     
							 					},1000);
								  
			}
	}
	
	function findcheck()
	{
		console.log("函数执行了");	
		if(usernamefind.value=='')
		{
			find_username1.innerHTML="请输入用户名";
			find_youpasswdfirst1.innerHTML="";
			find_youpasswdsecond1.innerHTML="";
			verification_noticefind.innerHTML=""; 
		}
		else
		{
			var Data="username=" + document.getElementById("usernamefind").value ;
			 		$.ajax({
             			type:'POST',
             			url: 'http://blinkofwings.xyz/book/loginusername.php',
             			data:Data,
			 			dataType:'json',
             			success: function(data){
							if(data.status=="1")
							{
								find_username1.innerHTML="没有该用户";
								find_youpasswdfirst1.innerHTML="";
								find_youpasswdsecond1.innerHTML="";
								verification_noticefind.innerHTML=""; 
							}
							else
							{
								if(verificationfind.value=='')
								{
									find_username1.innerHTML="";
									find_youpasswdfirst1.innerHTML="";
									find_youpasswdsecond1.innerHTML="";
									verification_noticefind.innerHTML="请输入验证码"; 
								}
								else
								{
									if(verificationfind.value!=temp1)
									{
										find_username1.innerHTML="";
										find_youpasswdfirst1.innerHTML="";
										find_youpasswdsecond1.innerHTML="";
										verification_noticefind.innerHTML="验证码不正确"; 
									}
									else
									{
												if(passwordfind.value=='')
												{
													find_youpasswdfirst1.innerHTML="请输入密码";
													find_username1.innerHTML="";
													find_youpasswdsecond1.innerHTML="";
													verification_noticefind.innerHTML="";
												}	
												else
												{
													if((passwordfind.value.toString().length>15)||(passwordfind.value.toString().length<6))
													{
														find_youpasswdfirst1.innerHTML="密码格式不正确";
														find_username1.innerHTML="";
														find_youpasswdsecond1.innerHTML="";
														verification_noticefind.innerHTML="";
													}
													else
													{
														if(passwordfind_confirm.value=='')
														{
															find_youpasswdsecond1.innerHTML="请确认密码";
															find_username1.innerHTML="";
															find_youpasswdfirst1.innerHTML="";
															verification_noticefind.innerHTML="";
														}
														else
														{
															if(passwordfind_confirm.value!=passwordfind.value)
															{
																find_youpasswdsecond1.innerHTML="两次输入的密码不同";
																find_username1.innerHTML="";
																find_youpasswdfirst1.innerHTML="";
																verification_noticefind.innerHTML="";
															}
															else
															{																																						                             									find_youpasswdsecond1.innerHTML="";
																find_username1.innerHTML="";
																find_youpasswdfirst1.innerHTML="";
																verification_noticefind.innerHTML="";
																var Data="username=" + document.getElementById("usernamefind").value +"&password=" + passwordfind.value;
																		$.ajax({
             															type:'POST',
             															url: 'http://blinkofwings.xyz/book/updatepassword.php',
             															data:Data,
			 															dataType:'json',
             															success: function(data)
																		{
																			if(data.status=='-2')
																			{
																				alert("对不起，重置密码失败");
																			}
																			if(data.status=='1')
																			{
																				alert("重置密码成功，快去找找喜欢的书吧");
																			}
                      													},
			 															error : function(XMLHttpRequest, textStatus,errorThrown) {　
																			alert(XMLHttpRequest.responseText); 
			 																alert(XMLHttpRequest.status);
			 																alert(XMLHttpRequest.readyState);
			 																alert(textStatus); 
			 															}
         															});
																}
														}
													}
												}
									}
								}
							}
						},
						error : function(XMLHttpRequest, textStatus, errorThrown) 
						{　
							alert(XMLHttpRequest.responseText); 
			 				alert(XMLHttpRequest.status);
			 				alert(XMLHttpRequest.readyState);
			 				alert(textStatus); 
						}
					});
		}											
	}


	</script>
</html>