<?php
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);

//require_once 'connectParams.php';
require_once 'Classes/PHPExcel.php';

class GroupShedule{
	function GroupShedule($group, $date, $iRow, $tempFile){
		$this->id = $group["id"];
		$this->name = $group["name"];
		$phpexcel = PHPExcel_IOFactory::load($tempFile); // Создаём объект PHPExcel
		$page = $phpexcel->setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
		$page->setCellValue("A".$iRow, $this->name); 
		

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
		
		$bufNum='';//Номер пары в буфере
		$bufContent='';//Содержимое ячейки в буфере
		$toWrite='';//Данные для записи
		
		foreach ($arrLoads as $v1){
			$number = $v1["1"];
			$discipline = $v1["2"];
			$type = $v1["3"];
			
			
			
			if ($bufContent != ''){//Если в буфере не пусто
				if ($bufNum == $number){//И если номер текущей пары совпадает с номером пары в буфере
					//В буфере I п/г, текущая II
					$toWrite = $bufContent.'   '.$discipline.' '.$type;//Склеиваем буфер и текущую пару
					$cell = $this->getCellname($number, $iRow);
					$page->setCellValue($cell, $toWrite);//И записываем в ячейку
					$bufContent = '';//Очищаем буфер
					$bufNum = '';//Очищаем буфер
				}
				else{//Номера пар не совпадают
					//Пишем то что было в буфере
					$cell = $this->getCellname($bufNum, $iRow);//чейка, куда писать
					$toWrite = $bufContent;//Что писать
					$page->setCellValue($cell, $toWrite);//И записываем в ячейку
					$bufContent = '';//Очищаем буфер
					$bufNum = '';//Очищаем буфер
					//Дублируем решение для ситуации с пустывм буфером
					////////////////////////////////////
					if($type == 'I'){//Если I п/г
						$bufContent = $discipline.' '.$type;//Откладываем в буфер значение
						$bufNum = $number;//и адрес ячейки на случай если паралельно занимается II п/г
					}
					else{//II п/г и общ
						//сразу пишем
						$cell = $this->getCellname($number, $iRow);//чейка, куда писать
						$toWrite = $discipline.' '.$type;//Что писать
						$page->setCellValue($cell, $toWrite);//И записываем в ячейку
					}
					////////////////////////////////////
				}
			}
			else{//Если буфер пустой
				
				if($type == 'I'){//Если I п/г
					$bufContent = $discipline.' '.$type;//Откладываем в буфер значение
					$bufNum = $number;//и адрес ячейки на случай если паралельно занимается II п/г
				}
				else{//II п/г и общ
					//сразу пишем
					$cell = $this->getCellname($number, $iRow);//чейка, куда писать
					$toWrite = $discipline.' '.$type;//Что писать
					$page->setCellValue($cell, $toWrite);//И записываем в ячейку
				}
			}
			
			
			
		}
		
		if ($bufContent != ''){//Если в буфере не пусто
				//Пишем то что было в буфере
				$cell = $this->getCellname($bufNum, $iRow);//чейка, куда писать
				$toWrite = $bufContent;//Что писать
				$page->setCellValue($cell, $toWrite);//И записываем в ячейку
				$bufContent = '';//Очищаем буфер
				$bufNum = '';//Очищаем буфер	
			}
		
		
		$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
		$objWriter->save($tempFile);
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