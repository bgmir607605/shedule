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
		addTeacher($mysqli);
        break;
	case 'discipline':
		addDiscipline($mysqli);
        break;
    case 'specialty':
        addSpecialty($mysqli);
        break;
	case 'group':
        addGroup($mysqli);
        break;
};
$mysqli->close();

//Реализация для каждой сущности
function addTeacher($mysqli){
	$lName = $_POST["lName"];
	$fName = $_POST["fName"];
	$mName = $_POST["mName"];
	$query = "insert into teachers (lName, fName, mName) values ('".$lName."', '".$fName."', '".$mName."')";
	$mysqli->query($query);
	$query = "SELECT * FROM teachers";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["lName"].' '.$row["fName"].' '.$row["mName"].'<br/>';
		}
    $result->free();
	}
};
//
function addDiscipline($mysqli){
	$fullName = $_POST["fullName"];
	$shortName = $_POST["shortName"];
	$query = "insert into discipline (fullName, shortName) values ('".$fullName."', '".$shortName."')";
	$mysqli->query($query);
	$query = "SELECT * FROM discipline";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["fullName"].' '.$row["shortName"].'<br/>';
		}
    $result->free();
	}
};
//
function addSpecialty($mysqli){
	$code = $_POST["code"];
	$name = $_POST["name"];
	$query = "insert into specialty (code, name) values ('".$code."', '".$name."')";
	$mysqli->query($query);
	$query = "SELECT * FROM specialty";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["code"].' '.$row["name"].'<br/>';
		}
    $result->free();
	}
};

function addGroup($mysqli){
	$name = $_POST["name"];
	$specialty = $_POST["specialty"];
	$query = "insert into groups (name, specialtyId) values ('".$name."', '".$specialty."')";
	$mysqli->query($query);
	$query = "SELECT * FROM groups";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo $row["name"].' '.$row["specialtyId"].'<br/>';
		}
    $result->free();
	}
};
?>
