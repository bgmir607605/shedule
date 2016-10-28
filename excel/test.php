<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

require_once 'connectParams.php';
require_once 'GroupShedule.php';
$date = '2016-10-22';
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);

$query = "set names utf8";
$mysqli->query($query);


  require_once 'Classes/PHPExcel.php';
  $phpexcel = PHPExcel_IOFactory::load('example.xlsx'); // Создаём объект PHPExcel
  $page = $phpexcel->setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  $objWriter->save("test.xlsx");
  
  $iRow = 4;//омер строки, с которойначинаются группы
  $query = "SELECT * FROM groups";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			$groupShedule = new GroupShedule($row, $date, $iRow);
			$iRow++;
		}
		$result->free();
	}
	

  
  
  
  //echo '<a href="test.xlsx"> Скачать </a>';
  if (file_exists("test.xlsx")) { 
    $filename = basename("test.xlsx"); 
    $size = filesize("test.xlsx"); 
    header("Content-Disposition: attachment; filename=$filename"); 
    header("Content-Length: $size"); 
    header("Charset: UTF-8"); 
    header("Content-Type: application/unknown"); 
    if (@readfile("test.xlsx")) { 
        unlink("test.xlsx"); 
    } 
}
?>