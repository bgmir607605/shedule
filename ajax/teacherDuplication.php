<?php

require_once 'connectParams.php';
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);

$query = "set names utf8";
$mysqli->query($query);

$date = $_POST["date"];
//$date = '2016-09-28';

//Перебираем все пары 
for ($i = 1; $i <= 5; $i++){
	isTeacherDuplications($mysqli, $i, $date);
}

$mysqli->close();

////

//Проверка на наличие дублирования преподавателей
function isTeacherDuplications($mysqli, $number, $date){
	echo $number.' - ая пара ';
	$flag = 0.0;
	$query = "select teacherId, count(*) from teacherLoad where id in
	(SELECT `teacherLoadId` FROM `shedule` where number = ".$number." and date = '".$date."') 
	GROUP BY teacherId HAVING count(*) > 1";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			if ($row["count(*)"] > 1){
				getTeacherLoad($mysqli, $row["teacherId"], $number, $date);
				$flag++;
			}
		}
	$result->free();
	}
	if ($flag == 0) {
		echo 'без дублирования<br>';
	}
};

//получить id параллельно выдаваемых нагрузок
function getTeacherLoad($mysqli, $teacherId, $number, $date){
	echo '<ul>';
	$query = "select type, teacherLoadId from shedule where date = '".$date."' and number = ".$number." and teacherLoadId in (select id from teacherLoad where teacherId = ".$teacherId.")";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			getDetails($mysqli, $row["type"], $row["teacherLoadId"]);		
		}
	$result->free();
	}
	echo '</ul>';
}

//получить детальную информацию по id нагрузки
function getDetails($mysqli, $type, $teacherLoadId){
	$query = "SELECT teacherLoad.id, teachers.lName, teachers.fName, teachers.mName, groups.name as 'group', discipline.shortName as 'discipline'  FROM teacherLoad 
		JOIN teachers ON teachers.id = teacherLoad.teacherId
		JOIN groups ON groups.id = teacherLoad.groupId
		JOIN discipline ON discipline.id = teacherLoad.disciplineId where teacherLoad.id = ".$teacherLoadId." order by teachers.lName";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<li>'.$row["lName"].' '.$row["fName"].' '.$row["mName"].' '.$row["group"].' '.$row["discipline"].' '.$type.'</li>';
		}
	$result->free();
	
	}
}


?>