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
		$m=2;
 		//循环读取excel文件,读取一条,插入一条
		$objExcel = new PHPExcel();
		$objExcel->getDefaultStyle()->getFont()->setName('宋体');
		$objExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$objExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

	        $objExcel->getActiveSheet()->setCellValue("A1", "图书编号");
	        $objExcel->getActiveSheet()->setCellValue("B1", "书名");
		$objExcel->getActiveSheet()->setCellValue("C1", "作者");
		$objExcel->getActiveSheet()->setCellValue("D1", "出版社");
		$objExcel->getActiveSheet()->setCellValue("E1", "图书价格");
	        $objExcel->getActiveSheet()->setCellValue("F1", "图书一级分类");
	        $objExcel->getActiveSheet()->setCellValue("G1", "图书二级分类");
	        $objExcel->getActiveSheet()->setCellValue("H1", "isbn编号");
	        $objExcel->getActiveSheet()->setCellValue("I1", "全拼");
		$objExcel->getActiveSheet()->setCellValue("J1", "简拼");	
		$objExcel->getActiveSheet()->setCellValue("K1", "问题");	
		$title='豆瓣错误';	  
		
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
			
			//file_put_contents('filedownload.txt',"booknumber:".$booknumber." bookname:".$bookname." bookauthor:".$bookauthor);
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
				$objExcel->getActiveSheet()->setCellValueExplicit("A".$m, $booknumber,PHPExcel_Cell_DataType::TYPE_STRING);  
				$objExcel->getActiveSheet()->setCellValue("B".$m, $bookname);
				$objExcel->getActiveSheet()->setCellValue("C".$m, $bookauthor);  
				$objExcel->getActiveSheet()->setCellValue("D".$m, $bookpublic);
				$objExcel->getActiveSheet()->setCellValue("E".$m, $price);  
				$objExcel->getActiveSheet()->setCellValue("F".$m, $classify);
				$objExcel->getActiveSheet()->setCellValue("G".$m, $classifytwo);  
				$objExcel->getActiveSheet()->setCellValue("H".$m, $isbn);
				$objExcel->getActiveSheet()->setCellValue("I".$m, $fullspell);  
				$objExcel->getActiveSheet()->setCellValue("J".$m, $initial);
				$objExcel->getActiveSheet()->setCellValue("K".$m, "图书编号重复");
				$m++;
				$flagdownload=true;   
				continue;
			    }
			}
			else
			{
				if(($booknumber=="")||($bookname=="")||($bookauthor=="")||($bookpublic=="")||($price=="")||($classify=="")||($classifytwo=="")||($isbn=="")||($fullspell=="")||($initial==""))
				{
					
					$objExcel->getActiveSheet()->setCellValueExplicit("A".$m, $booknumber,PHPExcel_Cell_DataType::TYPE_STRING);  
					$objExcel->getActiveSheet()->setCellValue("B".$m, $bookname);
					$objExcel->getActiveSheet()->setCellValue("C".$m, $bookauthor);  
					$objExcel->getActiveSheet()->setCellValue("D".$m, $bookpublic);
					$objExcel->getActiveSheet()->setCellValue("E".$m, $price);  
					$objExcel->getActiveSheet()->setCellValue("F".$m, $classify);
					$objExcel->getActiveSheet()->setCellValue("G".$m, $classifytwo);  
					$objExcel->getActiveSheet()->setCellValue("H".$m, $isbn);
					$objExcel->getActiveSheet()->setCellValue("I".$m, $fullspell);  
					$objExcel->getActiveSheet()->setCellValue("J".$m, $initial);
					$objExcel->getActiveSheet()->setCellValue("K".$m, "完善相应内容"); 
					$m++;
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
						
						$objExcel->getActiveSheet()->setCellValueExplicit("A".$m, $booknumber,PHPExcel_Cell_DataType::TYPE_STRING);  
						$objExcel->getActiveSheet()->setCellValue("B".$m, $bookname);
						$objExcel->getActiveSheet()->setCellValue("C".$m, $bookauthor);  
						$objExcel->getActiveSheet()->setCellValue("D".$m, $bookpublic);
						$objExcel->getActiveSheet()->setCellValue("E".$m, $price);  
						$objExcel->getActiveSheet()->setCellValue("F".$m, $classify);
						$objExcel->getActiveSheet()->setCellValue("G".$m, $classifytwo);  
						$objExcel->getActiveSheet()->setCellValue("H".$m, $isbn);
						$objExcel->getActiveSheet()->setCellValue("I".$m, $fullspell);  
						$objExcel->getActiveSheet()->setCellValue("J".$m, $initial);
						$objExcel->getActiveSheet()->setCellValue("K".$m, "豆瓣没有接口");
						$m++; 
						$flagdownload=true; 
						continue;	
					}
					else
					{
						$flagupload=true;
						continue; 
					}
				}
			} 
		}
		
			if(!$flagupload)
			{
				file_put_contents('filedownload.txt',"文件导入失败，原因：所有行都有问题");
				$timestamp = time();
  				header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
				header('Content-Disposition: attachment;filename="'.$timestamp.'.xls"');  
				header('Cache-Control: max-age=0');//缓存时间 
				header("Pragma: no-cache");//禁止缓存  
    				$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
				ob_clean();
				$objWriter->save('php://output');   
			}
		
			if($flagupload)
			{
				file_put_contents('filedownload.txt',"部分数据有问题");
				$timestamp = time();
  				header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
				header('Content-Disposition: attachment;filename="'.$timestamp.'.xls"');  
				header('Cache-Control: max-age=0');//缓存时间 
				header("Pragma: no-cache");//禁止缓存  
    				$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
				ob_clean();  
				$objWriter->save('php://output');  
			} 
	}
?>

