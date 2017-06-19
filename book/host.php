<!doctype html>
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<title>主页</title>
 <script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<script src="jquery.cookie.js" type="text/javascript"></script> 
 <script src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"> </script> 
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
?>

<?php
class JSSDK {
  				private $appId;
 				private $appSecret;

 			 public function __construct($appId, $appSecret) {
    			$this->appId = $appId;
    			$this->appSecret = $appSecret;
  			}

  			public function getSignPackage() {
    			$jsapiTicket = $this->getJsApiTicket();
    			$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
   				$timestamp = time();
    			$nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = 				"jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
	
    $signature = sha1($string);
	
    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode(file_get_contents("jsapi_ticket.json"));
    if ($data->expire_time < time()) {
      $accessToken = $this->getAccessToken();
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));
      $ticket = $res->ticket;
      if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->jsapi_ticket = $ticket;
        $fp = fopen("jsapi_ticket.json", "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $ticket = $data->jsapi_ticket;
    }
    return $ticket;
  }

  private function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode(file_get_contents("access_token.json"));
    if ($data->expire_time < time()) {
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
      $res = json_decode($this->httpGet($url));
      $access_token = $res->access_token;
      if ($access_token) {
        $data->expire_time = time() + 7000;
        $data->access_token = $access_token;
        $fp = fopen("access_token.json", "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $access_token = $data->access_token;
    }
    return $access_token;
  }

  private function httpGet($url) {
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
}
			$jssdk = new JSSDK("wx43a6e29aa069d1e2", "872f71bc3e388c0f251859dd8c2223e9");
			$signPackage = $jssdk->GetSignPackage();
?>
  <div id="container"  >
   
   <div id="line1">
    <div id="part1" style="background-repeat:no-repeat;background: url(picture/left.png);background-size:100% 100%;background-position:   center center;width:5%;float:left">
    </div>
    <div id="container24" style="width:90%;float:left;">
    	<div id="part2" style="background-repeat:no-repeat;background: url(picture/center.png);background-size:100% 100%;background-position:   center center;">
        	<div id="canledary" style="float:left;width:46%;background-repeat:no-repeat;background: url(picture/canledary.png);background-size:100% 100%;background-position:   center center;">
            	<p style="text-align: center;" id="canledaryword">
                团栾の图书馆
                </p>
            </div>
	    <div id="search" style="float:right;border:2px solid #3B3939;width:14%;background-repeat:no-repeat;background: url(picture/book1.png);background-size:100% 100%;background-position:   center center;">
            	<p style="text-align: center;margin:0px" id="searchword" onclick="searchQR()">扫<br />二<br />微<br />码</p>
	    </div>
            <a href="classifyofbook.php" style="text-decoration: none;" >
            	<div id="catalogue" style="float:right;border:2px solid  #3B3939;width:14%;background-repeat:no-repeat;background: url(picture/book3.png);background-size:100% 100%;background-position:   center center;">
            		<p style="text-align: center;color:#FDFDFD;margin:0px" id="catalogueword">图<br />书<br />分<br />类</p>
            	</div>
            </a>
            <a href="usermanagement.php" style="text-decoration: none;" >
            	<div id="myself" style="float:right;border:2px solid #3B3939;width:14%;background-repeat:no-repeat;background: url(picture/book2.png);background-size:100% 100%;background-position:   center center;">
                	<p style="text-align: center;color:black;margin:0px" id="myselfword">用<br />户<br />管<br />理
                    </p>
            	</div>
            </a>
        </div>
        <div id="part4" style="background-repeat:no-repeat;background: url(picture/btm.png);background-size:100% 100%;background-position:   center center;">
        </div>
    </div>
    <div id="part3" style="background-repeat:no-repeat;background: url(picture/right.png);background-size:100% 100%;background-position:  center center;float:left;width:5%">
    </div>
   </div>
   
   <div id="line2">
    <div id="part5" style="background-repeat:no-repeat;background: url(picture/left.png);background-size:100% 100%;background-position:   center center;width:5%;float:left">
    </div>
    <div id="container68" style="width:90%;float:left;">
    	<div id="part6" style="background-repeat:no-repeat;background: url(picture/center.png);background-size:100% 100%;background-position:   center center;">
         	<form  method="post" style="float:left;background:#F6F2F2;" id="searchbox" action="searchtransmit.php">
            	<select name="identification" style="float:left;  appearance:none  ;-moz-appearance: none;
    -webkit-appearance:none; background: url(picture/blackdown.png) no-repeat  right center ; border-top:0px;border-left:0px;border-bottom:0px;border-right:1px solid #979595;outline: none;  " id="identification">
<option value="书名">书名</option>
<option value="isbn">isbn</option>
<option value="编号">编号</option>
				</select>
                <input name="searchinput" style=" float:left;border-top:0px;border-left:0px;border-bottom:0px;border-right:1px solid #979595;" required id="searchinput" type="search" autocomplete="off" onclick="findrecord()"/>
                <input type="button"  id="find button" style="float:left;background-repeat:no-repeat;background: url(picture/search.png);background-size:100% 100%;background-position:   center center;" value="" onclick="findcheck()"/>
            </form>
            <div style="float:left;display:none" id="searchbox0">
        		<ul style="width:100%;float:left;list-style:none;padding:0px;margin:0px">
        			<li style="width:100%;border:1px solid black;height:20px;float:left;list-style:none;background:#F5EAC8;display:none" id="li1" onclick="conduct(1)"><p style="margin:0px" id="lip1"></p></li>
            		<li style="width:100%;border:1px solid black;height:20px;float:left;list-style:none;background:#F5EAC8;display:none" id="li2" onclick="conduct(2)"><p style="margin:0px" id="lip2" ></p></li>
					<li style="width:100%;border:1px solid black;height:20px;float:left;list-style:none;background:#F5EAC8;display:none" id="li3" onclick="conduct(3)"><p style="margin:0px" id="lip3" ></p></li>
            		<li style="width:100%;border:1px solid black;height:20px;float:left;list-style:none;background:#F5EAC8;display:none" id="li4" onclick="conduct(4)"><p style="margin:0px" id="lip4" ></p></li>
            		<li style="width:100%;border:1px solid black;height:20px;float:left;list-style:none;background:#F5EAC8;display:none" id="li5" onclick="conduct(5)"><p style="margin:0px" id="lip5" ></p></li>
            		<li style="width:100%;border:1px solid black;height:20px;float:left;list-style:none;background:#F5EAC8;display:none" id="li6"><p style="margin:0px;float:right" id="lip6" onclick="conduct(6)">清除历史记录</p></li>
        		</ul>
        	</div>
        </div>
        
        <div id="part8" style="background-repeat:no-repeat;background: url(picture/btm.png);background-size:100% 100%;background-position:   center center;">
        </div>
    </div>
    <div id="part7" style="background-repeat:no-repeat;background: url(picture/right.png);background-size:100% 100%;background-position:  center center;float:left;width:5%">
    </div>
   </div>
   
   <div id="line3">
    <div id="part9" style="background-repeat:no-repeat;background: url(picture/left.png);background-size:100% 100%;background-position:   center center;width:5%;float:left">
    </div>
    <div id="container1012" style="width:90%;float:left;">
    	<div id="part10" style="background-repeat:no-repeat;background: url(picture/center.png);background-size:100% 100%;background-position:   center center;">
        
        </div>
        <div id="part12" style="background-repeat:no-repeat;background: url(picture/btm.png);background-size:100% 100%;background-position:   center center;">
        </div>
    </div>
    <div id="part11" style="background-repeat:no-repeat;background: url(picture/right.png);background-size:100% 100%;background-position:  center center;float:left;width:5%">
    </div>
   </div>
   
      <div id="line4">
    <div id="part13" style="background-repeat:no-repeat;background: url(picture/left.png);background-size:100% 100%;background-position:   center center;width:5%;float:left">
    </div>
    <div id="container1416" style="width:90%;float:left;">
    	<div id="part14" style="background-repeat:no-repeat;background: url(picture/center.png);background-size:100% 100%;background-position:   center center;">
        
        </div>
        <div id="part16" style="background-repeat:no-repeat;background: url(picture/btm.png);background-size:100% 100%;background-position:   center center;">
        </div>
    </div>
    <div id="part15" style="background-repeat:no-repeat;background: url(picture/right.png);background-size:100% 100%;background-position:  center center;float:left;width:5%">
    </div>
   </div>
   
  </div>
</body>

<script>
			var H=document.documentElement.clientHeight;
		var W=document.documentElement.clientWidth;
	document.getElementById("part1").style.height=H*0.28+"px";
	document.getElementById("part2").style.height=H*0.25+"px";
	document.getElementById("part4").style.height=H*0.03+"px";
	document.getElementById("part3").style.height=H*0.28+"px";
	
	document.getElementById("part5").style.height=H*0.22+"px";
	document.getElementById("part6").style.height=H*0.19+"px";
	document.getElementById("part8").style.height=H*0.03+"px";
	document.getElementById("container68").style.height=H*0.22+"px";
	document.getElementById("part7").style.height=H*0.22+"px";
	
    document.getElementById("part9").style.height=H*0.22+"px";
	document.getElementById("part10").style.height=H*0.19+"px";
	document.getElementById("part12").style.height=H*0.03+"px";
	document.getElementById("part11").style.height=H*0.22+"px";
	
    document.getElementById("part13").style.height=H*0.28+"px";
	document.getElementById("part14").style.height=H*0.25+"px";
	document.getElementById("part16").style.height=H*0.03+"px";
	document.getElementById("part15").style.height=H*0.28+"px";
	
	var canledary=document.getElementById("canledary");
	canledary.style.height=H*0.22+"px";
	canledary.style.position="relative";
    canledary.style.top=H*0.03+"px";
	canledary.style.left=H*0.01+"px";
	
	document.getElementById("canledaryword").style.fontSize=H*0.033+"px";
	document.getElementById("canledaryword").style.position="relative";
	document.getElementById("canledaryword").style.top=H*0.02+"px";
	
	var search= document.getElementById("search");
	search.style.height=H*0.22+"px";
	search.style.position="relative";
    search.style.top=H*0.03+"px";
	
	var catalogue= document.getElementById("catalogue");
	catalogue.style.height=H*0.20+"px";
	catalogue.style.position="relative";
    catalogue.style.top=H*0.05+"px";
	
	var myself= document.getElementById("myself");
	myself.style.height=H*0.22+"px";
	myself.style.position="relative";
    myself.style.top=H*0.03+"px";
	
	var searchword=document.getElementById("searchword");
	searchword.style.fontSize=H*0.031+"px";
searchword.style.marginTop=H*0.015+"px";
	
	var catalogueword=document.getElementById("catalogueword");
	catalogueword.style.fontSize=H*0.031+"px";
catalogueword.style.marginTop=H*0.015+"px";
	
	var myselfword=document.getElementById("myselfword");
	myselfword.style.fontSize=H*0.031+"px";
myselfword.style.marginTop=H*0.015+"px";
	
	var searchbox=document.getElementById("searchbox");
	searchbox.style.position="relative";
	searchbox.style.top=H*0.05+"px";
	searchbox.style.left=H*0.02+"px";
	
	var identification=document.getElementById("identification");
	identification.style.height=H*0.07+"px";
	identification.style.fontSize=H*0.031+"px";
	identification.style.width=W*0.2+"px";
	
	var searchinput=document.getElementById("searchinput");
	searchinput.style.height=H*0.07+"px";
	searchinput.style.fontSize=H*0.031+"px";
	searchinput.style.width=W*0.495+"px";
	
	var searchsubmit=document.getElementById("find button");
	searchsubmit.style.height=H*0.07+"px";
	searchsubmit.style.width=W*0.117+"px"; 
	
	var searchbox0=document.getElementById("searchbox0");
	searchbox0.style.position="relative";
	searchbox0.style.top=H*0.05+"px";
	searchbox0.style.left=H*0.02+W*0.2+"px";
	searchbox0.style.width=W*0.495+"px";
	searchbox0.style.height=H*0.3+"px";
	
	document.getElementById("li1").style.height=H*0.05+"px";
	document.getElementById("lip1").style.fontSize=H*0.031+"px";
	document.getElementById("li2").style.height=H*0.05+"px";
	document.getElementById("lip2").style.fontSize=H*0.031+"px";
	document.getElementById("li3").style.height=H*0.05+"px";
	document.getElementById("lip3").style.fontSize=H*0.031+"px";
	document.getElementById("li4").style.height=H*0.05+"px";
	document.getElementById("lip4").style.fontSize=H*0.031+"px";
	document.getElementById("li5").style.height=H*0.05+"px";
	document.getElementById("lip5").style.fontSize=H*0.031+"px";
	document.getElementById("li6").style.height=H*0.05+"px";
	document.getElementById("lip6").style.fontSize=H*0.031+"px";
	document.getElementById("lip6").style.marginTop=H*0.01+"px";
	document.getElementById("lip6").style.marginRight=H*0.01+"px";
</script>
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
			alert("请填写内容");
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
		//准备跳转到searchtransmit.php
		document.getElementById("searchbox").submit();
		 
}

function conduct(a)
{
	switch(a)
	{
		case 1:document.getElementById("searchinput").value=document.getElementById("lip1").innerHTML;break;
		case 2:document.getElementById("searchinput").value=document.getElementById("lip2").innerHTML;break;
		case 3:document.getElementById("searchinput").value=document.getElementById("lip3").innerHTML;break;
		case 4:document.getElementById("searchinput").value=document.getElementById("lip4").innerHTML;break;
		case 5:document.getElementById("searchinput").value=document.getElementById("lip5").innerHTML;break;
		case 6:
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
				 if((src.id && src.id ==="li1")||(src.id && src.id ==="searchinput")||(src.id && src.id ==="li2")||(src.id && src.id ==="li3")||(src.id && src.id ==="li4")||(src.id && src.id ==="li5")||(src.id && src.id ==="li6")){
                    return false;
                }else{
                    $("#searchbox0").hide();
                }
            }
        });

wx.config({
	debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: ['scanQRCode']
  });

function searchQR()
{
   if(is_weixin())
  {
   var booknumber;
   wx.ready(function(){
    wx.scanQRCode({
      needResult: 1,
      desc: 'scanQRCode desc',
      success: function (res) {
        	  booknumber = res.resultStr;
		  var Data="booknumber=" + booknumber;
			 $.ajax({
             type:'POST',
             url: 'http://blinkofwings.xyz/book/checkbooknumber.php',
             data:Data,
			 dataType:'json',
             success: function(data){
			if(data.status=='1')
				  location.href='bookintroduction.php?booknumber='+booknumber;
			else
			{
				alert("没有该书本信息,请再次扫描");
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
    		});
	});

 wx.error(function (res) {
  alert("调用微信jsapi返回的状态:"+res.errMsg);
	});
    }
    else
    {
	alert("请使用微信内置浏览器");
    }
}

function is_weixin(){
	var ua=navigator.userAgent.toLowerCase();
	if(ua.match(/MicroMessenger/i)=="micromessenger")
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
</html>
