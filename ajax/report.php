<?php
require_once 'connectParams.php';
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
	printf("Соединение не удалось: %s\n", $mysqli->connect_error);
	exit();
};
$query = "set names utf8";
$mysqli->query($query);

$fun = $_POST["fun"];
switch ($fun) {
   	 case 'getTeachers':
		getTeachers($mysqli);
		break;
	case 'getGroups':
		getGroups($mysqli);
		break;
	case 'getTeacherLoads':
		getTeacherLoads($mysqli);
		break;
	case 'showReport':
		showReport($mysqli);
		break;
};
$mysqli->close();


function getTeachers($mysqli){
	$query = "SELECT * FROM teachers order by lName";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["id"].'">'.$row["lName"].' '.$row["fName"].' '.$row["mName"].'</option>';
		}
		$result->free();
	}
};

function getGroups($mysqli){
	$teacherId = $_POST["teacherId"];
	$query = "SELECT teacherLoad.groupId, groups.name from teacherLoad 
	JOIN groups ON groups.id = teacherLoad.groupId where teacherLoad.teacherId = ".$teacherId."";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["groupId"].'">'.$row["name"].'</option>';
		}
		$result->free();
	}
};

function getTeacherLoads($mysqli){
	$condition = '';
	if (isset($_POST["teacher"])) {$condition = $condition.' where teacherId = '.$_POST["teacher"];};
	if (isset($_POST["group"])) {$condition = $condition.' and groupId = '.$_POST["group"];};
	
	$query = "SELECT teacherLoad.id, teachers.lName, teachers.fName, teachers.mName, groups.name as 'group', discipline.shortName as 'discipline'  FROM teacherLoad 
		JOIN teachers ON teachers.id = teacherLoad.teacherId
		JOIN groups ON groups.id = teacherLoad.groupId
		JOIN discipline ON discipline.id = teacherLoad.disciplineId".$condition." order by teachers.lName";
	
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			$id = $row["id"];
			echo $row["lName"].' '.$row["fName"].' '.$row["mName"].' '.$row["group"].' '.$row["discipline"].'<input type="button" value="Отчёт" onClick="showReport('.$id.')" ><br/>';
		}
	$result->free();
	
	}
};

function showReport($mysqli){
	$teacherLoadId = $_POST["teacherLoadId"];
	$query = "SELECT * from shedule where teacherLoadId = ".$teacherLoadId."";
	//echo $query;
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["date"].' '.$row["type"].'<br>';
		}
		$result->free();
	}
	
}


?>