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
	$num=00000;  
	if(mysqli_connect_errno())
	{
		 echo json_encode(array("status" => "-2"));
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
		$objExcel->getActiveSheet()->setCellValue("A1", "图书编号");  
		$objExcel->getActiveSheet()->setCellValueExplicit("A2", $num,PHPExcel_Cell_DataType::TYPE_STRING);  
	        $objExcel->getActiveSheet()->setCellValue("B1", "书名");
		$objExcel->getActiveSheet()->setCellValue("C1", "作者");
		$objExcel->getActiveSheet()->setCellValue("D1", "出版社");
		$objExcel->getActiveSheet()->setCellValue("E1", "图书价格");
	        $objExcel->getActiveSheet()->setCellValue("F1", "图书一级分类");
	        $objExcel->getActiveSheet()->setCellValue("G1", "图书二级分类");
	        $objExcel->getActiveSheet()->setCellValue("H1", "isbn编号");
	        $objExcel->getActiveSheet()->setCellValue("I1", "全拼");
		$objExcel->getActiveSheet()->setCellValue("J1", "简拼");		  
		
	}
				$filename='Excel模板';
				header('Content-Type: application/vnd.ms-excel;charset=utf-8');  
				header('Content-Disposition: attachment;filename="'.$filename.'.xls"');  
				header('Cache-Control: max-age=0');//缓存时间 
				header("Pragma: no-cache");//禁止缓存  
    				$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
				//$objWriter=new PHPExcel_Writer_Excel2007($objExcel);
				ob_clean();
				$objWriter->save('php://output');   
			
?>

