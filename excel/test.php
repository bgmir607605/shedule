<?php
require_once 'connectParams.php';
$date = '2016-10-22';
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    printf("—оединение не удалось: %s\n", $mysqli->connect_error);
    exit();
};
$query = "set names utf8";
$mysqli->query($query);

function getCell($number, $row){
	switch ($number) {
		case '1':
			return "C".$row;
			break;
		case '2':
			return "D".$row;
			break;
		case '3':
			return "F".$row;
			break;
		case '4':
			return "G".$row;
			break;
		case '5':
			return "H".$row;
			break;
	};
}



  require_once 'Classes/PHPExcel.php';
  $phpexcel = PHPExcel_IOFactory::load('example.xlsx'); // Создаём объект PHPExcel
  $page = $phpexcel->setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
  
  $iRow = 4;//омер строки, с которойначинаются группы
  $query = "SELECT * FROM groups";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			$page->setCellValue("A".$iRow, $row["name"]); 
			$groupId = $row["id"];
			
			
			$query2 = "select `teacherLoadId`, `number`, `type` from `shedule` where `teacherLoadId` 
    		IN (select `id` from `teacherLoad` where `groupId` ='" . $groupId . "') 
			and `date` = '" . $date . "' ORDER BY `number`";
			if ($result2 = $mysqli->query($query2)) {
        		while ($row2 = $result2->fetch_assoc()){
					$page->setCellValue(getCell($row2["number"], $iRow), $row2["teacherLoadId"].' '.$row2['type']); 
				}
        	$result2->free();
    		}
			
				
			$iRow++;
			
		}
		$result->free();
	}
	

  
  
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  $objWriter->save("test.xlsx");
  echo '<a href="test.xlsx"> Скачать </a>';
?>