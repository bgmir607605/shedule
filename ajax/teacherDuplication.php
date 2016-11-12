<?php

require_once 'connectParams.php';
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);

$query = "set names utf8";
$mysqli->query($query);

$date = '2016-09-28';

//Перебираем все пары 
for ($i = 0; $i <= 5; $i++){
	isTeacherDuplications($mysqli, $i, $date);
}

$mysqli->close();



//Проверка на наличие дублирования преподавателей
function isTeacherDuplications($mysqli, $number, $date){
	$flag = 0.0;
	$query = "select teacherId, count(*) from teacherLoad where id in
	(SELECT `teacherLoadId` FROM `shedule` where number = ".$number." and date = '".$date."') 
	GROUP BY teacherId HAVING count(*) > 1";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			if ($row["count(*)"] > 1){
				getDetails($mysqli, $row["teacherId"], $number, $date);
				$flag++;
				//echo 'Дублируется преподаватель '.$row["teacherId"].' <br/>';
			}
		}
	$result->free();
	}
	if ($flag == 0) {
		echo $number.' - ая пара без дублирования';
	}
};

function getDetails($mysqli, $teacherId, $number, $date){
	echo $date.' '.$number.' дублируется '.$teacherId;
}


?>