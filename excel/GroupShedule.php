<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

//require_once 'connectParams.php';
require_once 'Classes/PHPExcel.php';

class GroupShedule{
	function GroupShedule($group, $date, $iRow){
		$this->id = $group["id"];
		$this->name = $group["name"];
		$phpexcel = PHPExcel_IOFactory::load('test.xlsx'); // Создаём объект PHPExcel
		$page = $phpexcel->setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
		$page->setCellValue("A".$iRow, $this->name); 
		$page->setCellValue("A20", $date);
		$page->setCellValue("E".$iRow, $this->id);
		////////
		$day = $date;
		$groupId = $group["id"]; 

		$mysqli = new mysqli("localhost", "bpt", "0000", "bpt");
		$query = "set names utf8";
		$mysqli->query($query);
		
		//Получаем список нагрузок по указанной группе и дате
		$i = 0;
		$arrLoads;
		$query = "select `teacherLoadId`, `number`, `type` from `shedule` where `teacherLoadId` IN (select `id` from `teacherLoad` where `groupId` ='" . $groupId . "') and `date` = '" . $day . "' ORDER BY `number`";
		if ($result = $mysqli->query($query)) {
        		while ($row = $result->fetch_assoc()){
					$arrLoads[$i][0] = $row['teacherLoadId'];
					$arrLoads[$i][1] = $row['number'];
					$arrLoads[$i][3] = $row['type'];
					$i++;
				}
        	$result->free();
    		}
			
		for ($j = 0; $j <= count($arrLoads); $j++){
			$query = "SELECT shortName FROM discipline WHERE id IN (SELECT disciplineId FROM teacherLoad where id = '".$arrLoads[$j][0] . "' )";
			if ($result = $mysqli->query($query)) {
        		while ($row = $result->fetch_assoc()){
					$arrLoads[$j][2] = $row['shortName'];
				}
				$result->free();
    		}	
		}	
		foreach ($arrLoads as $v1){
			
			//1 - номер пары
			//2 - Название дисциплины
			//3 - Тип занятия
			
			$cell = $this->getCellname($v1["1"], $iRow);
			$discipline = $v1["2"];
			$type = $v1["3"];
			$page->setCellValue($cell, $discipline.' '.$type);
			}
		
		
		$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
		$objWriter->save("test.xlsx");
	}
	
	
	function getCellname($number, $row){
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
	
	
}
?>