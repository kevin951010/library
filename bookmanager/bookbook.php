<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>查询</title>
</head>

<body>
<?php
	$username='';
	session_start();
	if(isset($_SESSION['user'])){
    	$username=$_SESSION['user'];
	}else{
   		echo "<script>location.href='loginbook.php';</script>";
	}
?>
<div style="position:absolute;top:40px;left:100px;padding-left:5px;padding-right:5px;">
<form action="showbookbook1.php" method="post" style="clear:both;">
<div style="clear:both;">
<p style="font-size:20px; float:left;margin-top:20px" id="notice">当日书本<span style="text-decoration:underline">预订</span>人次查询:</p>
<select name="thisyear" style="float:left;margin-left:70px;margin-top:20px">
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">年</p>
<select name="thismonth" style="float:left;margin-left:30px;margin-top:20px;" id="thismonth"  onchange="myfunction('thismonth','thisday')">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">月</p>
<select name="thisday" style="float:left;margin-left:30px;margin-top:20px;" id="thisday"  >
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">日</p>
<input type="submit" value="开始查询" id="submit0" style="float:left;margin-left:30px;margin-top:20px;width:80px;height:25px;"/>
</div>
</form>

<form action="showborrowbook1.php" method="post" style="clear:both;">
<div style="clear:both;">
<p style="font-size:20px; float:left;margin-top:20px" id="notice">当日书本<span style="text-decoration:underline">借阅</span>人次查询:</p>
<select name="thisyear0" style="float:left;margin-left:70px;margin-top:20px">
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">年</p>
<select name="thismonth0" style="float:left;margin-left:30px;margin-top:20px;" id="thismonth0"  onchange="myfunction('thismonth0','thisday0')">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">月</p>
<select name="thisday0" style="float:left;margin-left:30px;margin-top:20px;" id="thisday0"  >
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">日</p>
<input type="submit" value="开始查询" id="submit1" style="float:left;margin-left:30px;margin-top:20px;width:80px;height:25px;"/>
</div>
</form>


 <form action="showborrowbook.php" method="post" style="clear:both;">
<div style="clear:both;">
<p style="font-size:20px; clear:both;" id="notice">多日书本<span style="text-decoration:underline">借阅</span>人次查询:</p>
<p style="font-size:20px; float:left; margin-left:200px;margin-top:20px" id="notice">查询开始时间:</p>
<select name="startyear" style="float:left;margin-left:30px;margin-top:20px">
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">年</p>
<select name="startmonth" style="float:left;margin-left:30px;margin-top:20px;"  id="startmonth" onchange="myfunction('startmonth','startday')">
<option value="01"  >01</option>
<option value="02"  >02</option>
<option value="03"  >03</option>
<option value="04"  >04</option>
<option value="05"  >05</option>
<option value="06"  >06</option>
<option value="07"  >07</option>
<option value="08"  >08</option>
<option value="09"  >09</option>
<option value="10"  >10</option>
<option value="11"  >11</option>
<option value="12"  >12</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">月</p>
<select name="startday" style="float:left;margin-left:30px;margin-top:20px;" id="startday">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">日</p>
</div>


<div style="clear:both;">
<p style="font-size:20px; float:left;margin-left:200px;margin-top:20px" id="notice">查询截止时间:</p>
<select name="endyear" style="float:left;margin-left:30px;margin-top:20px">
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">年</p>
<select name="endmonth" style="float:left;margin-left:30px;margin-top:20px;" id="endmonth"  onchange="myfunction('endmonth','endday')">
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">月</p>
<select name="endday" style="float:left;margin-left:30px;margin-top:20px;" id="endday"  >
<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<p style="float:left;margin-left:30px;font-size:20px;margin-top:20px">日</p>
<input type="submit" value="开始查询" id="submit0" style="float:left;margin-left:30px;margin-top:20px;width:80px;height:25px;"/>
</div>

</form>


</div>

<script>
 function myfunction(month,day)
 {
	 var objmonth=document.getElementById(month);
	 var value=objmonth.options[objmonth.selectedIndex].value;
	 var objday=document.getElementById(day);
	 var daylength=objday.options.length;
	 switch(value)
	 {
		case "01":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			if(daylength==30)
			{
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			break;
		case "02":
			if(daylength==30)
			{
				objday.options.remove(29);
				objday.options.remove(28);
			}
			if(daylength==31)
			{
				objday.options.remove(30);
				objday.options.remove(29);
				objday.options.remove(28);
			}
			break;
		case "03":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			if(daylength==30)
			{
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			break;
		case "04":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
			}
			if(daylength==31)
			{
				objday.options.remove(30);
			}
			break;
		case "05":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			if(daylength==30)
			{
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			break;
		case "06":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
			}
			if(daylength==31)
			{
				objday.options.remove(30);
			}
			break;
		case "07":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			if(daylength==30)
			{
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			break;
		case "08":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			if(daylength==30)
			{
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			break;
		case "09":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
			}
			if(daylength==31)
			{
				objday.options.remove(30);
			}
			break;			
		case "10":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			if(daylength==30)
			{
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			break;
		case "11":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
			}
			if(daylength==31)
			{
				objday.options.remove(30);
			}
			break;			
		case "12":
			if(daylength==28)
			{
				var varItem29=new Option(29,"29");
				objday.options.add(varItem29);
				var varItem30=new Option(30,"30");
				objday.options.add(varItem30);
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			if(daylength==30)
			{
				var varItem31=new Option(31,"31");
				objday.options.add(varItem31);
			}
			break;			
	 }	 
 }
</script>
</body>
</html>