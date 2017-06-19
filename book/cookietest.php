<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>cookie测试</title>
 <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
 <script src="jquery.cookie.js" type="text/javascript"></script> 
</head>

<body style="margin:8px;height:500px">
	<div>
   	    <input type="text" id="searchinput" autocomplete="off" onclick="findrecord()" style="width:100px"  required/>
    	<input type="button" value="确认" id="find button" onclick="findcheck()"/>
    </div>
    <div style="width:100px;display:none" id="searchbox0">
    	<ul style="width:100px;float:left;list-style:none;padding:0px;margin:0px">
        	<li style="width:100px;border:1px solid black;height:20px;float:left;list-style:none;display:none" id="li1" onclick="conduct(1)"><p style="margin:0px" id="lip1">fuck you</p></li>
            <li style="width:100px;border:1px solid black;height:20px;float:left;list-style:none;display:none" id="li2" onclick="conduct(2)"><p style="margin:0px" id="lip2" >fuck you</p></li>
			<li style="width:100px;border:1px solid black;height:20px;float:left;list-style:none;display:none" id="li3" onclick="conduct(3)"><p style="margin:0px" id="lip3" >fuck you</p></li>
            <li style="width:100px;border:1px solid black;height:20px;float:left;list-style:none;display:none" id="li4" onclick="conduct(4)"><p style="margin:0px" id="lip4" >fuck you</p></li>
            <li style="width:100px;border:1px solid black;height:20px;float:left;list-style:none;display:none" id="li5" onclick="conduct(5)"><p style="margin:0px" id="lip5" >fuck you</p></li>
            <li style="width:100px;border:1px solid black;height:20px;float:left;list-style:none;display:none" id="li6"><p style="margin:0px;fontsize:12px" id="lip6" onclick="conduct(6)">清除历史记录</p></li>
        </ul>
    </div>
</body>
<script>
	var countnumber;
	$(document).ready(function() {
	if($.cookie("number")!==undefined)
	{
		countnumber=$.cookie("number");
	}
	else
	{
		countnumber=1;
	}
});

	function findrecord()
	{
		loadcookie();
	}
	function loadcookie()
	{
		document.getElementById("searchbox0").style.display="block";
		if($.cookie("search1")!==undefined)
		{
			console.log($.cookie("search1"));
			document.getElementById("lip1").innerHTML=$.cookie("search1");
			document.getElementById("li1").style.display="block";
			document.getElementById("li6").style.display="block";
		}
		if($.cookie("search2")!==undefined)
		{
			console.log($.cookie("search2"));
			document.getElementById("lip2").innerHTML=$.cookie("search2");
			document.getElementById("li2").style.display="block";
			document.getElementById("li6").style.display="block";
		}
		if($.cookie("search3")!==undefined)
		{
			console.log($.cookie("search3"));
			document.getElementById("lip3").innerHTML=$.cookie("search3");
			document.getElementById("li3").style.display="block";
			document.getElementById("li6").style.display="block";
		}		
		if($.cookie("search4")!==undefined)
		{
			console.log($.cookie("search4"));
			document.getElementById("lip4").innerHTML=$.cookie("search4");
			document.getElementById("li4").style.display="block";
			document.getElementById("li6").style.display="block";
		}		
		if($.cookie("search5")!==undefined)
		{
			console.log($.cookie("search5"));
			document.getElementById("lip5").innerHTML=$.cookie("search5");
			document.getElementById("li5").style.display="block";
			document.getElementById("li6").style.display="block";
		}		
		
	}
	
	function findcheck()
	{
		if(document.getElementById("searchinput").value=="")
		{
			alert("填写内容");
		}
		else
		{
			saveUserInfo();
		}
	}
	
function saveUserInfo() {
        var searchrecord = $("#searchinput").val();
        switch(countnumber%5)
		{
			case 0:	$.cookie("search5", searchrecord  ,{ expires: 7 });break;
			case 1:	$.cookie("search1", searchrecord  ,{ expires: 7 });break;
			case 2:	$.cookie("search2", searchrecord  ,{ expires: 7 });break;
			case 3:	$.cookie("search3", searchrecord  ,{ expires: 7 });break;
			case 4:	$.cookie("search4", searchrecord  ,{ expires: 7 });break;
		}
		countnumber++;
		$.cookie("number", countnumber  ,{ expires: 7 });
}

function conduct(a)
{
	switch(a)
	{
		case 1:document.getElementById("searchinput").value=document.getElementById("lip1").innerHTML;break;
		case 2:document.getElementById("searchinput").value=document.getElementById("lip2").innerHTML;break;
		case 3:document.getElementById("searchinupt").value=document.getElementById("lip3").innerHTML;break;
		case 4:document.getElementById("searchinput").value=document.getElementById("lip4").innerHTML;break;
		case 5:document.getElementById("searchinput").value=document.getElementById("lip5").innerHTML;break;
		case 6:
				clearrecord=false;
				if($.cookie("search1")!==undefined)
				{
					  $.cookie("search1", '', { expires: -1 });	
				}
				if($.cookie("search2")!==undefined)
				{
					  $.cookie("search2", '', { expires: -1 });	
				}if($.cookie("search3")!==undefined)
				{
					  $.cookie("search3", '', { expires: -1 });	
				}if($.cookie("search4")!==undefined)
				{
					  $.cookie("search4", '', { expires: -1 });	
				}if($.cookie("search5")!==undefined)
				{
					  $.cookie("search5", '', { expires: -1 });	
				}
				$.cookie("number", '', { expires: -1 });
				//恢复初始状态
				countnumber=1;
				document.getElementById("searchbox0").style.display="none";	
				document.getElementById("li1").style.display="none";
				document.getElementById("li2").style.display="none";
				document.getElementById("li3").style.display="none";
				document.getElementById("li4").style.display="none";
				document.getElementById("li5").style.display="none";
				document.getElementById("li6").style.display="none";
	}
}


 $(document).on({
            "click": function(e){
                var src = e.target;
 
                if((src.id && src.id ==="searchbox0")||(src.id && src.id ==="searchinput")){
                    return false;
                }else{
                    $("#searchbox0").hide();
                }
            }
        });
</script>
</html>
