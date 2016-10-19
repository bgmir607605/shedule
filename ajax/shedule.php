<?php
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


?>