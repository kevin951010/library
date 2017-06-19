 <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加书籍</title>
<script src="jquery-1.7.1.min.js"></script>
</head>

<?php
session_start();
if(isset($_SESSION['user'])){
    
}else{
   echo "<script>location.href='loginbook.php';</script>";
}
	header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	$test=mysqli_connect('localhost:3306','root','');
	mysqli_select_db($test,'library');
	$num="0";
	$lastbooknumber="";
	if(mysqli_connect_errno())
	{
	
	}
	else
	{
		$sql="select * from book order by `booknumber` desc";	
		$result=mysqli_query($test,$sql);
		$row=mysqli_fetch_array($result);
		$num=$row['booknumber'];
		//for($i=0;$i<$num;$i++)
		//{
		//	$row=mysqli_fetch_array($result);
		//	if($i==$num-1)
		//	{
		//		$num=$row['booknumber'];
		//		break;
		//	}
		//}
		$num++;
		if(($num>0)&&($num<10))
		{
			$num="0000".$num;
		}
		if(($num>=10)&&($num<100))
		{
			$num="000".$num;
		}
		if(($num>=100)&&($num<1000))
		{
			$num="00".$num;
		}
		if(($num>=1000)&&($num<10000))
		{
			$num="0".$num;
		}
	}
?>
<body>
<p id="number" style="display:none"><?php echo $num ?></p>
<iframe id="iframe_display" name="iframe_display" style="display:none"></iframe> 
<div style="margin-left:30px;" >
 <div style="float:left;" id="example2box">
	<img src="http://blinkofwings.xyz/book/picture/home.svg" style="vertical-align:middle;width:100px;height:100px;margin-left:0px;margin-top:0px;cursor:pointer" id="refresh" onclick="host()"/>
 	<p style="margin-left:30px;margin-top:0px"> 主页</p>
 </div>
<form action="deletbookt.php" method="post" id="form3" style="float:left;margin-left:50px">
	<h3>删除书籍</h3>
    <table style="width:100px;" border="3"  >
	<tr> 
		<td width="100">图书编号</td>
	</tr>
    <tr>
        <td ><input type="booknumber" name="booknumber"  value="" style="width:100px" id="deletebooknumber" required/></td>
    </tr>
    </table> 
       <input type="button" value="删除书籍" style="width:120px;height:35px;margin-top:10px" onclick="deletecheck()"/>
   </form>
</div>

<div style="margin-left:30px;float:left">
<form  method="post" id="form1" target="iframe_display" action="fileupload.php" enctype="multipart/form-data" >
	<h3>添加书籍</h3>
    <table  border="3"  >
	<tr> 
		<td width="70">图书编号</td>
		<td width="130" >书名</td>
		<td width="130" >作者</td>
		<td width="130" >出版社</td>
        <td width="70" >图书价格</td>
		<td width="110" >图书一级分类</td>
        <td width="110" >图书二级分类</td>
		<td width="130" >isbn编号</td>
		<td width="130" >全拼</td>
		<td width="130" >简拼</td>
	</tr>
     <tr>
        <td ><input type="text" name="booknumber"  value="" style="width:70px" id="idbooknumber" required/></td>
        <td ><input type="text" name="bookname"  value="" style="width:130px" required id="insertbookname"/></td>
        <td ><input type="text" name="bookauthor"  value="" style="width:130px" required id="insertbookauthor"/></td>
        <td ><input type="text" name="bookpublic"  value="" style="width:130px" required id="insertbookpublic"/></td>
        <td ><input type="number" name="bookprice"  value="" style="width:70px" required id="insertbookprice"/></td>
        <td > <select name="classify" style="width:110px" id="bookclassify" onChange="myfunction('bookclassify','classifybelow')">
<option value="科学/科技">科学/科技</option>
<option value="军事">军事</option>
<option value="教育/体育">教育/体育</option>
<option value="艺术">艺术</option>
<option value="经济">经济</option>
<option value="哲学">哲学</option>
<option value="政治/法律">政治/法律</option>
<option value="文学/历史">文学/历史</option>
       <td > <select name="classifybelow" style="width:110px" id="classifybelow">
<option value="计算机">计算机</option>
<option value="生物科学">生物科学</option>
<option value="交通运输">交通运输</option>
<option value="工业技术">工业技术</option>
<option value="农业技术">农业技术</option>
<option value="航空航天">航空航天</option>
<option value="数理化科学">数理化科学</option>
<option value="医学">医学</option>
<option value="环境安全">环境安全</option>
<option value="地质学">地质学</option>
<option value="心理学">心理学</option>
		</select></td>
        
       	<td ><input type="text" name="isbn"  value="" style="width:130px" required  id="isbn"/></td>
       	<td ><input type="text" name="fullspell"  value="" style="width:130px" required id="fullspell"/></td>
       	<td ><input type="text" name="initial" value="" style="width:130px" required id="initial"/></td>
   </tr>
       </table> 
       <div style="float:left;display:none" id="introductionbox">
       		<table id="table1" style="width:350px;">
  				<h3>书本简介</h3>
       			<tr>
            	<td> <textarea  name="introduction" style="width:350px;height:300px;overflow:auto;border:thin solid black"  id="introduction">			</textarea>						 </td>
            	</tr>
       		</table>
       </div>
       <div style="float:left;margin-left:50px;display:none"  id="imgbox">
       		<table id="table2" style="width:300px;">
  				<h3>图片地址</h3>
       			<tr>
            		<td> <input type="text" name="imgurl" value="" style="width:300px"  id="imgurl"/> </td>
            	</tr>
       		</table>
       </div>
       <div style="float:left;margin-left:50px;display:none"  id="bookurlbox">
       		<table id="table2" style="width:300px;">
  				<h3>书籍网络地址</h3>
       			<tr>
            		<td> <input type="text" name="bookurl" value="" style="width:300px"  id="bookurl"/> </td>
            	</tr>
       		</table>
       </div>
       <div style="clear:both">
			<input type="button" value="编号检测" style="width:100px;height:35px;margin-top:10px;float:left;margin-right:20px;margin-bottom:20px" id="testbooknumber" onclick="Testbooknumber()"/>
       		<input type="button" value="豆瓣检测" style="width:100px;height:35px;margin-top:10px;float:left;margin-right:20px;margin-bottom:20px" id="button" disabled onclick="testdouban()"/>
       		<input type="button" value="添加书本" style="width:100px;height:35px;margin-top:10px;float:left;margin-bottom:20px;margin-right:20px" disabled id="submit0" onclick="insertcheck()"/>
            <label for="file" style="float:left;margin-top:10px;;margin-bottom:20px;">上传文件:</label>
      		<input type="file" name="file" id="file" style="width:200px;margin-top:10px;float:left;margin-bottom:20px;margin-right:20px;border:1px solid black" accept="excel/csv,excel/xls,excel/xlsx"/>
      		<input type="button"  value="上传" style="width:100px;height:22px;margin-top:10px;float:left;margin-bottom:20px;margin-left:20px;"  onclick="ud()" id="fileupload"/>
       		<input type="button"  value="下载模板" style="width:100px;height:22px;margin-top:10px;float:left;margin-bottom:20px;margin-left:20px;"  onclick="dl()" id="fileupload"/>
       </div>
   </form>
</div>

<div style="height:0px;clear:both">
</div>

</body>
<script>
var timestamp = Date.parse(new Date());
console.log(timestamp);

	function myfunction(firstclassify,secondclassify)
	{
		var firstclassify=document.getElementById(firstclassify);
	 	var value=firstclassify.options[firstclassify.selectedIndex].value;
		var secondclassify=document.getElementById(secondclassify);
		switch(value)
	 	{
			case "科学/科技":
					secondclassify.innerHTML = "";
					secondclassify.add(new Option("计算机","计算机"));
					secondclassify.add(new Option("生物科学","生物科学"));
					secondclassify.add(new Option("交通运输","交通运输"));
					secondclassify.add(new Option("工业技术","工业技术"));
					secondclassify.add(new Option("农业技术","农业技术"));
					secondclassify.add(new Option("航空航天","航空航天"));
					secondclassify.add(new Option("数理化科学","数理化科学"));
					secondclassify.add(new Option("医学","医学"));
					secondclassify.add(new Option("环境安全","环境安全"));
					secondclassify.add(new Option("地质学","地质学"));
					secondclassify.add(new Option("心理学","心理学"));
					break;
			case "军事":
					secondclassify.innerHTML = "";
					secondclassify.add(new Option("武器","武器"));
					secondclassify.add(new Option("战争论","战争论"));
					secondclassify.add(new Option("战争史","战争史"));
					break;
			
			case "政治/法律":
					secondclassify.innerHTML = "";
					secondclassify.add(new Option("政治理论","政治理论"));
					secondclassify.add(new Option("世界政治","世界政治"));
					secondclassify.add(new Option("法律","法律"));
					secondclassify.add(new Option("法学","法学"));
					secondclassify.add(new Option("国际关系","国际关系"));
					secondclassify.add(new Option("中国政治","中国政治"));
					break;
			case "文学/历史":
					secondclassify.innerHTML = "";
					secondclassify.add(new Option("日本文学","日本文学"));
					secondclassify.add(new Option("外国文学","外国文学"));
					secondclassify.add(new Option("古典文学","古典文学"));
					secondclassify.add(new Option("现代文学","现代文学"));
					secondclassify.add(new Option("旅行游记","旅行游记"));
					secondclassify.add(new Option("中国历史","中国历史"));
					secondclassify.add(new Option("外国历史","外国历史"));
					break;
			case "教育/体育":
					secondclassify.innerHTML = "";
					secondclassify.add(new Option("教育学","教育学"));
					secondclassify.add(new Option("教师与学生","教师与学生"));
					secondclassify.add(new Option("学校管理","学校管理"));
					secondclassify.add(new Option("家庭教育","家庭教育"));
					secondclassify.add(new Option("体育理论","体育理论"));
					break;			
			case "哲学":
					secondclassify.innerHTML = "";
					secondclassify.add(new Option("西方哲学","西方哲学"));
					secondclassify.add(new Option("东方哲学","东方哲学"));
					secondclassify.add(new Option("哲学理论","哲学理论"));
					secondclassify.add(new Option("伦理学","伦理学"));
					secondclassify.add(new Option("逻辑学","逻辑学"));
					break;
			case "经济":
					secondclassify.innerHTML = "";
					secondclassify.add(new Option("经济学","经济学"));
					secondclassify.add(new Option("金融","金融"));
					secondclassify.add(new Option("投资","投资"));
					secondclassify.add(new Option("管理","管理"));
					secondclassify.add(new Option("企业史","企业史"));
					secondclassify.add(new Option("股票","股票"));	
					break;		
			case "艺术":	
					secondclassify.innerHTML = "";
					secondclassify.add(new Option("设计","设计"));
					secondclassify.add(new Option("建筑","建筑"));
					secondclassify.add(new Option("摄影","摄影"));
					secondclassify.add(new Option("美术","美术"));
					secondclassify.add(new Option("音乐","音乐"));
					secondclassify.add(new Option("雕刻","雕刻"));
					secondclassify.add(new Option("电影","电影"));
					secondclassify.add(new Option("美学","美学"));
					secondclassify.add(new Option("戏剧","戏剧"));
					secondclassify.add(new Option("古玩","古玩"));
					break;			
		}
	}
	
	var flag=true;
	document.getElementById("idbooknumber").value=document.getElementById("number").innerHTML;
	function Testbooknumber()
	{
		var Data="booknumber=" + document.getElementById("idbooknumber").value ;
			 $.ajax({
             type:'POST',
             url: 'http://118.89.45.193/bookmanager/testbooknumber.php',
             data:Data,
	     dataType:'json',
             success: function(data){
							if(data.status=="1")
							{
								document.getElementById("button").disabled=false;
							}
							else
							{
								alert("该书编号重复了");
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

	function testdouban()
	{
		if(document.getElementById("isbn").value=="")
		{
			alert("请输入isbn编号");	
		}
		else
		{
			var Data="isbn=" + document.getElementById("isbn").value ;
			$.ajax({
             type:'POST',
             url: 'http://118.89.45.193/bookmanager/testdouban.php',
             data:Data,
			 dataType:'json',
             success: function(data){
							if(data.status=="-1")
							{
								document.getElementById("introductionbox").style.display="inline";
								document.getElementById("imgbox").style.display="inline";
								document.getElementById("bookurlbox").style.display="inline";
								document.getElementById("imgurl").required=true;
								document.getElementById("bookurl").required=true;
								flag=false;
							}
							else
							{
								alert("豆瓣有该书接口");
							}
							document.getElementById("submit0").disabled=false;
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
	
	function insertcheck()
	{
		if(flag)
		{
			if((document.getElementById("isbn").value=="")||(document.getElementById("insertbookpublic").value=="")||(document.getElementById("insertbookauthor").value=="")||(document.getElementById("insertbookname").value=="")||(document.getElementById("idbooknumber").value=="")||(document.getElementById("fullspell").value=="")||(document.getElementById("initial").value=="")||(document.getElementById("insertbookprice").value==""))
			{
				alert("请完善相应输入框信息");
			}
			else
			{
				var Data="isbn=" + document.getElementById("isbn").value +"&bookpublic="+document.getElementById("insertbookpublic").value+"&bookauthor="+document.getElementById("insertbookauthor").value+"&bookname="+document.getElementById("insertbookname").value+"&booknumber="+document.getElementById("idbooknumber").value+"&fullspell="+document.getElementById("fullspell").value+"&initial="+document.getElementById("initial").value+"&classify="+document.getElementById("bookclassify").value+"&classifybelow="+document.getElementById("classifybelow").value+"&price="+document.getElementById("insertbookprice").value;
			$.ajax({
             type:'POST',
             url: 'http://118.89.45.193/bookmanager/insertbookt.php',
             data:Data,
			 dataType:'json',
             success: function(data){
							if(data.status!="1")
							{
								alert("插入失败");
							}
							else
							{
								alert("插入成功");
								window.location.reload();
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
		else
		{
			if((document.getElementById("isbn").value=="")||(document.getElementById("insertbookpublic").value=="")||(document.getElementById("insertbookauthor").value=="")||(document.getElementById("insertbookname").value=="")||(document.getElementById("idbooknumber").value=="")||(document.getElementById("fullspell").value=="")||(document.getElementById("initial").value=="")||(document.getElementById("imgurl").value=="")||(document.getElementById("bookurl").value=="")||(document.getElementById("insertbookprice").value==""))
			{
				alert("请完善相应输入框信息");
			}
			else
			{
			   var Data="isbn=" + document.getElementById("isbn").value +"&bookpublic="+document.getElementById("insertbookpublic").value+"&bookauthor="+document.getElementById("insertbookauthor").value+"&bookname="+document.getElementById("insertbookname").value+"&booknumber="+document.getElementById("idbooknumber").value+"&fullspell="+document.getElementById("fullspell").value+"&initial="+document.getElementById("initial").value+"&imgurl="+document.getElementById("imgurl").value+"&bookurl="+document.getElementById("bookurl").value+"&introduction="+document.getElementById("introduction").value+"&classify="+document.getElementById("bookclassify").value+"&classifybelow="+document.getElementById("classifybelow").value+"&price="+document.getElementById("insertbookprice").value;
			$.ajax({
             type:'POST',
             url: 'http://118.89.45.193/bookmanager/insertbookt.php',
             data:Data,
			 dataType:'json',
             success: function(data){
							if(data.status!="1")
							{
								alert("插入失败");
							}
							else
							{
								alert("插入成功");
								window.location.reload();
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

	

	function deletecheck()
	{
		if(document.getElementById("deletebooknumber").value=="")
		{
			alert("请完善相应输入框信息");
		}
		else
		{
			var Data="booknumber=" + document.getElementById("deletebooknumber").value; 
	     $.ajax({
             type:'POST',
             url:'http://118.89.45.193/bookmanager/deletbookt.php',
             data:Data,
			 dataType:'json',
             success: function(data){
							if(data.status!="1")
							{
								alert("插入失败");
							}
							else
							{
								alert("删除成功");
								window.location.reload();
							}
							
                      },
			 error : function(XMLHttpRequest, textStatus, errorThrown) {　
			
			 	}
         	});
		}
	}
</script>

<script>
	function ud()
	{
          var string=document.getElementById("file").value;
		  if(string!="")
		  {
				string=string.substring(string.lastIndexOf('.'),string.length);
				console.log(string);
				if((string==".xls")||(string==".xlsx")||(string==".csv"))
				{
					console.log("执行");
					document.getElementById("form1").method="post" ;
					document.getElementById("form1").action = 'fileupload.php' ;
					document.getElementById("form1").submit();
					document.getElementById("fileupload").disabled="true";
					document.getElementById("fileupload").value="文件上传中";
					console.log(timestamp);
				}
				else
				{
					alert("文件格式错误");
				}
		  }
		  else
		  {
				alert("请选择文件");  
		  }
	}
	
	$('#iframe_display').load(function()
	{
    	var body = $(window.frames['iframe_display'].document.body);
		var data = eval('(' + body[0].textContent + ')');  
       // 根据后台返回值处理结
		document.getElementById("fileupload").disabled=false;
		document.getElementById("fileupload").value="上传";
		switch(data.status)
		{
			case "-1":alert("上传文件失败，原因：文件格式错误");break;
			case "-2":alert("上传文件失败，原因：数据库连接失败");break;
			case "-3":alert("上传文件失败，原因：excel文件缺少必要列");break;
			case "1":alert("文件上传成功，全部数据完成导入");break;
			case "-4":
			document.getElementById("form1").method="post" ;
			document.getElementById("form1").action = 'filedownload.php' ;
			document.getElementById("form1").submit();
			alert("部分数据有问题，将要下载excel文件请等待,下载过程中请不要再次点击上传按钮");			
		}
	});

	function dl()
	{
		document.getElementById("form1").method="post" ;
		document.getElementById("form1").action = 'downloadmodel.php' ;
		document.getElementById("form1").submit();
	}
	
	
	function host()
	{
		location.href="boxbook.php";
	}
</script>
</html>