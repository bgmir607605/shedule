﻿<?php
require_once 'connectParams.php';
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    printf("Соединение не удалось: %s\n", $mysqli->connect_error);
    exit();
};
$query = "set names utf8";
$mysqli->query($query);

$action = $_POST["action"];
switch ($action) {
    case 'getDisciplines':
		getDisciplines($mysqli);
        break;
	case 'addLesson':
		addLesson($mysqli);
        break;
};
$mysqli->close();


function getDisciplines($mysqli){
	$groupId = $_POST["groupId"];
	$query = "SELECT teacherLoad.id, discipline.shortName FROM `teacherLoad` 
	join discipline on discipline.id = teacherLoad.disciplineId 
	WHERE teacherLoad.groupId=".$groupId."";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["id"].'">'.$row["shortName"].'</option>';
		}
		$result->free();
	}
};

function addLesson($mysqli){
	$date = $_POST["date"];
	$teacherLoad = $_POST["teacherLoad"];
	$type = $_POST["type"];
	$number = $_POST["number"];
	
	$query = "insert into shedule (date, number, teacherLoadId, type) values
	('".$date."', $number, $teacherLoad, '".$type."')";
	if ($result = $mysqli->query($query)) {
		/*while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["id"].'">'.$row["shortName"].'</option>';
		}
		$result->free();*/
	}
};


?>