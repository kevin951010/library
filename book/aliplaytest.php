<?php
 header('Content-type: text/json; charset:utf-8');
 $GLOBALS['temp']='';
include("top/TopClient.php");
include("top/request/AlibabaAliqinFcSmsNumSendRequest.php");
include("top/ResultSet.php");
include("top/RequestCheckUtil.php");
include("top/TopLogger.php");
error_reporting(0);
$phonenumber=$_POST['phonenumber'];
//$phonenumber='18361275769';
$c = new TopClient;
$c ->appkey = '23754474' ;
$c ->secretKey = '146bdc848b132686e11c0d6a20e769e3' ;
$verify = rand(123456, 999999);
$req = new AlibabaAliqinFcSmsNumSendRequest;
$req ->setExtend( "" ); 
$req ->setSmsType( "normal" );
$req ->setSmsFreeSignName( "团栾的小书柜" ); 
$req ->setSmsParam( "{code:'$verify'}" );
$req ->setRecNum($phonenumber);
$req ->setSmsTemplateCode( "SMS_62145057" );
$resp = $c ->execute( $req );

//var_dump($GLOBALS['temp']);
//echo $GLOBALS['temp']['alibaba_aliqin_fc_sms_num_send_response']['error_response']['code'];
 if($GLOBALS['temp']['alibaba_aliqin_fc_sms_num_send_response']['result']['err_code']=='0')
{
	echo json_encode(array("status" => "1","number" => $phonenumber,"verify" => $verify));
	//echo "传值成功";
}
else
{
	echo json_encode(array("status" => "-1"));
	//echo "传值失败";
}

?>