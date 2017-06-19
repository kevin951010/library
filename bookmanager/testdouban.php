<?php
	error_reporting(0);
	header('Content-type: text/json; charset:utf-8');
	$isbn=$_POST['isbn'];

	$url= "https://api.douban.com/v2/book/isbn/".$isbn;
	$beforeres=httpGet($url);
	$res=json_decode($beforeres,true);
	
	if($res['msg']=='book_not_found')
	{
			echo json_encode(array("status" => "-1"));
	}
	else
	{
			echo json_encode(array("status" => "1"));
	}
	
	function httpGet($url) {
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
?>