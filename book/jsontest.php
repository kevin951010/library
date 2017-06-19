<?php
header('Content-type: text/json; charset:utf-8');
error_reporting(0);
 $a='object(stdClass)#5 (5) {
  ["code"]=>
  int(15)
  ["msg"]=>
  string(20) "Remote service error"
  ["sub_code"]=>
  string(26) "isv.BUSINESS_LIMIT_CONTROL"
  ["sub_msg"]=>
  string(18) "触发业务流控"
  ["request_id"]=>
  string(13) "10fbz65kt5ex7"
}';

// var_dump(json_decode($a,true));

 $c=json_decode($a,true);

 if($c['result']['err_code']=='0')
{
	echo "fuck you";
}
else
{
	echo "shit";
}
?>