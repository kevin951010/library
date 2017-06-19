<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登陆界面</title>
<script src="jquery-1.7.1.min.js" type="text/javascript"></script>
</head>
<body>
<p style="position:absolute;top:25px;left:600px;font-size:25px" >欢迎登录后台系统</p>
<div style="position:absolute;top:100px;left:550px" >
<form  id="formlogin">
<table border="1" bordercolor="#111111" width ="300" height="100"
bordercolorlight="#FFFFFF" bordercolordark="#FFFFFF">
<tr>
	<td width:"300" colspan="2" height="20" bgcolor="#A8A3AD">
    <p align="center"><b><font color="#FFFFFF">后台管理系统</font></b></td>
</tr>
   <tr>
   <td  style="height:15px;width:80px" bgcolor="#E3E1E6">
   <p align="center">账&nbsp;号:</td>
   <td height="10" bgcolor="#E3E1E6" width="220">
   <input type="text" name="username" size="20" style="color:#A8A3AD;border-style:solid;border-width:1;padding-left:4;padding-right:4;padding-top:1;padding-bottom:1;width:180px" required="required" autocomplete="off" id="username"></td>
   </tr>
   <tr>
   <td width="80" style="height:15px" bgcolor="#E3E1E6">
   <p align="center">密&nbsp;码:</td>
   <td height="10" bgcolor="#E3E1E6" width="220">
   <input type="password" name="password" size="20" style="color:#A8A3AD;border-style:solid;border-width:1;padding-left:4;padding-right:4;padding-top:1;padding-bottom:1;width:180px;" required="required" autocomplete="off" id="password"></td>
   </tr>
   <tr> 
   <td width="300" height="29" bgcolor="#E3E1E6" colspan="2">
   <p align="center">
   <input type="button" value="登录" name="login" onclick="check()">
   <input type="reset" value="取消"  name="cancel"></td>
   </tr>
   <tr>
   <td width=300" colspan="2" height="20" bgcolor="#A8A3AD"></td>
   </tr>
   </form>
</table>
</form>
</div>
</body>
<script>
	function check()
	{
		if((document.getElementById("password").value=="")||(document.getElementById("username").value==""))
		{
			alert("完善相应字段");
		}
		else
		{
			var Data="username=" + document.getElementById("username").value +"&password="+document.getElementById("password").value;
			 $.ajax({
             type:'POST',
            // url: 'http://localhost/bookmanager/testdouban.php',
	     url: 'http://118.89.45.193/bookmanager/checkbook.php',
             data:Data,
	     dataType:'json',
             success: function(data){
							if(data.status=="1")
							{
								document.getElementById("formlogin").method="post";								
								document.getElementById("formlogin").action="transmit.php";
								document.getElementById("formlogin").submit();
							}
							else
							{
								alert("登陆失败");
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
</script>

</html>