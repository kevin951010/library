
<?php
	header("content-type:text/json;charset=utf-8"); 
	require 'smtp.php'; 

	$mail=$_POST['mail'];
	$verify = rand(123456, 999999);
	file_put_contents('mailsend.txt',$mail);
	
	$smtpserver = "smtp.163.com";
	//163邮箱服务器端口 
	$smtpserverport = 25;
	//你的163服务器邮箱账号
	$smtpusermail = "18361222976@163.com";
	//收件人邮箱
	$smtpemailto = $mail;
	//你的邮箱账号(去掉@163.com)
	$smtpuser = "18361222976";//SMTP服务器的用户帐号 
	//你的邮箱密码
	$smtppass = "lhy001200"; //SMTP服务器的用户密码
	
	$mailsubject = "验证信息";
	//邮件内容 
	$mailbody = "您的验证码是".$verify;
	//邮件格式（HTML/TXT）,TXT为文本邮件 
	$mailtype = "TXT";
	//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
	//是否显示发送的调试信息 
	$smtp->debug = false;
	//发送邮件
	 if ($smtp->sendmail ($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype) )
	 {   
	 	echo json_encode(array("status" => "1","number" => $mail,"verify" => $verify));
	 } 
	 else 
	 {  
	 	echo json_encode(array("status" => "-1"));
	 }  
?>