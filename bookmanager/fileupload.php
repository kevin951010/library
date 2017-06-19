<?php
	require_once 'phpexcel/Classes/PHPExcel.php';
	require_once 'phpexcel/Classes/PHPExcel/IOFactory.php';
	require_once 'phpexcel/Classes/PHPExcel/Reader/Excel5.php';
	require_once 'phpexcel/Classes/PHPExcel/Reader/CSV.php';
	require_once 'phpexcel/Classes/PHPExcel/Reader/Excel2007.php';
	require_once 'phpexcel/Classes/PHPExcel/Writer/Excel2007.php';
	require_once 'phpexcel/Classes/PHPExcel/Writer/Excel5.php';
	//error_reporting(0);
	header("Content-type: text/html; charset:utf-8");
	mysql_query("SET NAMES 'utf-8'");
	$test=mysqli_connect('localhost:3306','root',''); 
	mysqli_select_db($test,'library');
	$flagdownload=false;  
	$flagupload=false;

	if(mysqli_connect_errno())
	{
		 echo json_encode(array("status" => "-2"));
		 exit();
	}
	else
	{
		$file=$_FILES['file'];
		$fname=$file['name'];
		$ftype=strtolower(substr(strrchr($fname,'.'),1)); 
  		if($ftype=='xls')
  		{
    		$objReader = PHPExcel_IOFactory::createReader('Excel5');  
  		}
  		else
  		{
     		if($ftype=='xlsx') 
	 		{
		 		$objReader = PHPExcel_IOFactory::createReader('Excel2007');  
	 		}
	 		else
	 		{
				if($ftype=='csv') 
				{
					$objReader = PHPExcel_IOFactory::createReader('CSV');
				}
				else
				{
					echo json_encode(array("status" => "-1"));
					exit();
				}
	 		}
  		}  
  
		$objPHPExcel = $objReader->load($file['tmp_name']); 
		//$filename可以是上传的文件，或者是指定的文件
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		// 取得总行数
 		$highestColumn = $sheet->getHighestColumn(); 
 		// 取得总列数
		$j=1;	
		$title='豆瓣错误';	  
		
		//检查excel文件格式是否正确
		$booknumber = $objPHPExcel->getActiveSheet()->getCell("A1")->getValue();
		$bookname = $objPHPExcel->getActiveSheet()->getCell("B1")->getValue();
		$bookauthor = $objPHPExcel->getActiveSheet()->getCell("C1")->getValue();
		$bookpublic = $objPHPExcel->getActiveSheet()->getCell("D1")->getValue();
		//e是图书价格
		$price = $objPHPExcel->getActiveSheet()->getCell("E1")->getValue();
		$classify = $objPHPExcel->getActiveSheet()->getCell("F1")->getValue();
		//g是图书二级分类
		$classifytwo = $objPHPExcel->getActiveSheet()->getCell("G1")->getValue();
		$isbn = $objPHPExcel->getActiveSheet()->getCell("H1")->getValue();
		$fullspell = $objPHPExcel->getActiveSheet()->getCell("I1")->getValue();
		$initial = $objPHPExcel->getActiveSheet()->getCell("J1")->getValue();

		if(($booknumber=="")||($bookname=="")||($bookauthor=="")||($bookpublic=="")||($price=="")||($classify=="")||($classifytwo=="")||($isbn=="")||($fullspell=="")||($initial==""))
		{
			echo json_encode(array("status" => "-3"));
			exit();	
		}
		
 		
		for($j=2;$j<=$highestRow;$j++)
 		{ 
			$booknumber = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();
			$bookname = $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();
			$bookauthor = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();
			$bookpublic = $objPHPExcel->getActiveSheet()->getCell("D".$j)->getValue();
			///e是图书价格
			$price = $objPHPExcel->getActiveSheet()->getCell("E".$j)->getValue();
			$classify = $objPHPExcel->getActiveSheet()->getCell("F".$j)->getValue();
			//g是图书二级分类
			$classifytwo = $objPHPExcel->getActiveSheet()->getCell("G".$j)->getValue();
			$isbn = $objPHPExcel->getActiveSheet()->getCell("H".$j)->getValue();
			$fullspell = $objPHPExcel->getActiveSheet()->getCell("I".$j)->getValue();
			$initial = $objPHPExcel->getActiveSheet()->getCell("J".$j)->getValue();
			
			file_put_contents('fileupload.txt',$booknumber.$bookname.$bookauthor.$bookpublic.$price.$classify.$classifytwo.$isbn.$fullspell.$initial);
			//检查图书编号
			$sql="select * from `book` where `booknumber`='$booknumber'";
			$result=mysqli_query($test,$sql);
			if(mysqli_fetch_array($result))
			{
			    $sql="select * from `book` where `isbn`='$isbn' and `bookname`='$bookname'";		
			    $result=mysqli_query($test,$sql);
			    if(mysqli_fetch_array($result))
			    {
				$flagupload=true;
				continue;
			    }
			    else
			   {
				$flagdownload=true; 
				continue;
			    }
			}
			else
			{
				if(($booknumber=="")||($bookname=="")||($bookauthor=="")||($bookpublic=="")||($price=="")||($classify=="")||($classifytwo=="")||($isbn=="")||($fullspell=="")||($initial==""))
				{
					$flagdownload=true; 
					continue;	
				}
				else
				{
					$ch = curl_init();  //初始化curl句柄  
					$url="https://book.douban.com/isbn/".$isbn;  //要请求的url地址  
					curl_setopt($ch, CURLOPT_URL,$url);
					// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
					curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
					// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$store=curl_exec($ch);
					curl_close($ch);  //关闭句柄 
					preg_match("/<head.*>(.*)<\/head>/smUi",$store, $htmlHeaders);   
					if(!count($htmlHeaders))
					{   
   						//echo "无法解析数据中的 <head> 区段";   
   						//exit;   
					}
	
					// 取得 <head> 中 meta 设置的编码格式  
					if(preg_match("/<meta[^>]*http-equiv[^>]*charset=(.*)(\"|')/Ui",$htmlHeaders[1], $results))
					{   
   						$charset =  $results[1];  
					}
					else
					{    
   						$charset = "None";   
					}          
     
					if(preg_match("/<title>(.*)<\/title>/smUi",$htmlHeaders[1], $htmlTitles))
					{   
						if(!count($htmlTitles))
						{   
       						//echo "无法解析 <title> 的内容";   
       						//exit;   
   						}   
      						else
						{
   							// 将  <title> 的文字编码格式转成 UTF-8   
   							if($charset == "None")
							{   
								$title=$htmlTitles[1];   
   							}
							else
							{   
       							$title=iconv($charset, "UTF-8", $htmlTitles[1]);   
   							}   
   							//echo $title;
						}
					} 
					
					$title=mb_substr($title,mb_strpos($title,'豆'),4,'utf-8');					
					//判断豆瓣中有无isbn编号
					if($title=='豆瓣错误')
					{ 
						$flagdownload=true; 
						continue;	
					}
					else
					{
    					
						$sql="insert into `book`(`booknumber`, `bookname`, `bookauthor`, `bookpublic`, `classify`, `isbn`, `fullspell`, `initial`) values('$booknumber','$bookname','$bookauthor','$bookpublic','$classify','$isbn','$fullspell','$initial' )";
						if(!mysqli_query($test,$sql))
						{	
							
						}
						else
						{
							$sql="select * from `number` where `isbn`='$isbn'";
							$result=mysqli_query($test,$sql);
							$num=mysqli_num_rows($result);
							if($num>0)
							{
								$row=mysqli_fetch_array($result);
								$availnumber=$row['availnumber'];
								$totalnumber=$row['totalnumber'];
								$availnumber++;
								$totalnumber++;
								$sql="update `number` set `totalnumber`='$totalnumber',`availnumber`='$availnumber' where `isbn`='$isbn'";
								mysqli_query($test,$sql);
							}
							else
							{
								$sql="insert into `number`(`name`,`classify`,`isbn`,`totalnumber`,`availnumber`,`classify2`,`price`) values('$bookname','$classify','$isbn','1','1','$classifytwo','$price' )";
								mysqli_query($test,$sql);
							}
						}
						$flagupload=true; 	
					}
				}
			} 
		}
				
		if($flagupload)
		{
			if(!$flagdownload)
			{
				echo json_encode(array("status" => "1"));
				file_put_contents('fileupload.txt',"全部数据导入成功");
				exit();
			}
		} 
		echo json_encode(array("status" => "-4"));
	}
?>

