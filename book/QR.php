 <!DOCTYPE html>  
    <html>  
    <head>  
        <title>微信扫一扫</title>  
        <meta charset="utf-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">  
        <script src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"> </script> 
   		<script src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
    </head>          
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
    <script type="text/javascript">  

	wx.config({
	debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: ['scanQRCode']
  });
  
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
				document.location.reload();
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
    		});
	});

 wx.error(function (res) {
  alert("调用微信jsapi返回的状态:"+res.errMsg);
	});

    </script>   
    </html>  