<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

require_once 'connectParams.php';
require_once 'GroupShedule.php';

$date = $_GET["date"];
$tempFile = $date.'.xlsx';
//echo $tempFile;
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);

$query = "set names utf8";
$mysqli->query($query);


  require_once 'Classes/PHPExcel.php';
  $phpexcel = PHPExcel_IOFactory::load('example.xlsx'); // Создаём объект PHPExcel
  $page = $phpexcel->setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
  $page->setCellValue("F1", $date);
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  $objWriter->save($tempFile);
  
  $iRow = 4;//омер строки, с которойначинаются группы
  $query = "SELECT * FROM groups";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			$groupShedule = new GroupShedule($row, $date, $iRow, $tempFile);
			$iRow++;
		}
		$result->free();
	}
	

  
  
  
  if (file_exists($tempFile)) { 
    $filename = basename($tempFile); 
    $size = filesize($tempFile); 
    header("Content-Disposition: attachment; filename=$filename"); 
    header("Content-Length: $size"); 
    header("Charset: UTF-8"); 
    header("Content-Type: application/unknown"); 
    if (@readfile($tempFile)) { 
        unlink($tempFile); 
    } 
}
?>