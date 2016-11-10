<?php
require_once 'connectParams.php';
$mysqli = new mysqli("localhost", $dbUser, $dbPass, $dbName);
if ($mysqli->connect_errno) {
	printf("Соединение не удалось: %s\n", $mysqli->connect_error);
	exit();
};
$query = "set names utf8";
$mysqli->query($query);

$field = $_POST["field"];
switch ($field) {
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
};
$mysqli->close();


function showTeacher($mysqli){
	$query = "SELECT * FROM teachers order by lName";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["id"].'">'.$row["lName"].' '.$row["fName"].' '.$row["mName"].'</option>';
		}
		$result->free();
	}
};

function showDiscipline($mysqli){
	$query = "SELECT * FROM discipline order by shortName";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["id"].'">'.$row["shortName"].'</option>';
		}
		$result->free();
	}
};

function showSpecialty($mysqli){
	$query = "SELECT * FROM specialty order by code";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["id"].'">'.$row["code"].'</option>';
		}
		$result->free();
	}
};

function showGroup($mysqli){
	$query = "SELECT * FROM groups order by name";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
		}
		$result->free();
	}
};


?>