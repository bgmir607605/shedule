<?php
require_once 'connectParams.php';
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
    printf("Соединение не удалось: %s\n", $mysqli->connect_error);
    exit();
};
$query = "set names utf8";
$mysqli->query($query);
$entity = $_POST["entity"];
switch ($entity) {
    case 'teacher':
		showTeacher($mysqli);
        break;
	case 'discipline':
		showDiscipline($mysqli);
        break;
    case 'specialty':
        showSpecialty($mysqli);
        break;
	case 'group':
        showGroup($mysqli);
        break;
	case 'teacherLoad':
        showTeacherLoad($mysqli);
        break;
};
$mysqli->close();

//Реализация для каждой сущности
function showTeacher($mysqli){
	$query = "SELECT * FROM teachers";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["lName"].' '.$row["fName"].' '.$row["mName"].'<br/>';
		}
    $result->free();
	}
};
//
function showDiscipline($mysqli){
	$query = "SELECT * FROM discipline";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["fullName"].' '.$row["shortName"].'<br/>';
		}
    $result->free();
	}
};
//
function showSpecialty($mysqli){
	$query = "SELECT * FROM specialty";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["code"].' '.$row["name"].'<br/>';
		}
    $result->free();
	}
};

function showGroup($mysqli){
	$query = "SELECT groups.name, specialty.name as 'specialty'
				FROM groups
				INNER JOIN specialty ON specialty.id = groups.specialtyId;";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["name"].' '.$row["specialty"].'<br/>';
		}
    $result->free();
	}
};

function showTeacherLoad($mysqli){
	$query = "SELECT teacherLoad.id, teachers.lName, teachers.fName, teachers.mName, groups.name as 'group', discipline.shortName as 'discipline'  FROM teacherLoad 
		JOIN teachers ON teachers.id = teacherLoad.teacherId
		JOIN groups ON groups.id = teacherLoad.groupId
		JOIN discipline ON discipline.id = teacherLoad.disciplineId";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["lName"].' '.$row["fName"].' '.$row["mName"].' '.$row["group"].' '.$row["discipline"].'<br/>';
		}
    $result->free();
	
	}
};
?>