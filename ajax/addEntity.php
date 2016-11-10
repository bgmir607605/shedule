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
	case 'teacherLoad':
        addTeacherLoad($mysqli);
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
	
};
//
function addDiscipline($mysqli){
	$fullName = $_POST["fullName"];
	$shortName = $_POST["shortName"];
	$shared = $_POST["shared"];
	$specialty = $_POST["specialty"];
	echo "$fullName $shortName $shared $specialty";
	$query = "insert into discipline (fullName, shortName, shared, specialtyId) values ('".$fullName."', '".$shortName."', ".$shared.", ".$specialty.")";
	$mysqli->query($query);
	$query = "SELECT * FROM discipline";
	
};
//
function addSpecialty($mysqli){
	$code = $_POST["code"];
	$name = $_POST["name"];
	$query = "insert into specialty (code, name) values ('".$code."', '".$name."')";
	$mysqli->query($query);
	$query = "SELECT * FROM specialty";
	
};

function addGroup($mysqli){
	$name = $_POST["name"];
	$specialty = $_POST["specialty"];
	$query = "insert into groups (name, specialtyId) values ('".$name."', '".$specialty."')";
	$mysqli->query($query);
	$query = "SELECT groups.name, specialty.name as 'specialty'
				FROM groups
				INNER JOIN specialty ON specialty.id = groups.specialtyId;";
	
};

function addTeacherLoad($mysqli){
	$teacher = $_POST["teacher"];
	$group = $_POST["group"];
	$discipline = $_POST["discipline"];
	
	$query = "insert into teacherLoad (teacherId, groupId, disciplineId) values (".$teacher.", ".$group.", ".$discipline.")";
	$mysqli->query($query);
	
	$query = "SELECT teacherLoad.id, teachers.lName, teachers.fName, teachers.mName, groups.name as 'group', discipline.shortName as 'discipline'  FROM teacherLoad 
		JOIN teachers ON teachers.id = teacherLoad.teacherId
		JOIN groups ON groups.id = teacherLoad.groupId
		JOIN discipline ON discipline.id = teacherLoad.disciplineId";
	
};
?>
