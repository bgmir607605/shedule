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
	case 'addLesson':
		addLesson($mysqli);
        break;
    case 'getAvailable':
		getAvailable($mysqli);
        break;
	case 'cleanBeforeWrite':
		cleanBeforeWrite($mysqli);
        break;
	case 'showGroup':
		showGroup($mysqli);
        break;

};
$mysqli->close();

function showGroup($mysqli){
	$query = "SELECT * FROM groups";
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<option '.availableSheduleForGroup($mysqli, $row["id"]).' value="'.$row["id"].'">'.$row["name"].'</option>';
		}
		$result->free();
	}
};


function availableSheduleForGroup($mysqli, $groupId){
    $date = $_POST["date"];
    
	//Получаем список нагрузок по указанной группе и дате
	$i = 0;
    $query = "select `teacherLoadId`, `number`, `type` from `shedule` where `teacherLoadId` 
    IN (select `id` from `teacherLoad` where `groupId` ='" . $groupId . "') 
	and `date` = '" . $date . "' ORDER BY `number`";
	if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()){
		    $i++;
		}
        $result->free();
	};
	//if ($i > 0){echo 'class="available"';}
	if ($i > 0){return 'class="available"';}
}

//Возвращает список нагрузок с именами дисциплин в комбобоксы при выставлении расписания
function getDisciplines($mysqli){
	$groupId = $_POST["groupId"];
	$query = "SELECT teacherLoad.id, discipline.shortName FROM `teacherLoad` 
	join discipline on discipline.id = teacherLoad.disciplineId 
	WHERE teacherLoad.groupId=".$groupId." order by discipline.shortName";
	//Печатаем пустое значение
	echo '<option value=""></option>';
	//Печатаем имеющиеся результаты
	if ($result = $mysqli->query($query)) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value="'.$row["id"].'">'.$row["shortName"].'</option>';
		}
		$result->free();
	}
};

//Записывает пару в БД
function addLesson($mysqli){
	$date = $_POST["date"];
	$teacherLoad = $_POST["teacherLoad"];
	$type = $_POST["type"];
	$number = $_POST["number"];
	
	$query = "insert into shedule (date, number, teacherLoadId, type) values
	('".$date."', $number, $teacherLoad, '".$type."')";
	$mysqli->query($query);
};

//Возвращает JSON с имеющимся расписанием по группе и дате
function getAvailable($mysqli){ 
	$groupId = $_POST["groupId"];
    $date = $_POST["date"];
    
	//Получаем список нагрузок по указанной группе и дате
	$i = 0;
    $query = "select `teacherLoadId`, `number`, `type` from `shedule` where `teacherLoadId` 
    IN (select `id` from `teacherLoad` where `groupId` ='" . $groupId . "') 
	and `date` = '" . $date . "' ORDER BY `number`";
	if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()){
		    $arrLoads[$i][0] = $row['teacherLoadId'];
		    $arrLoads[$i][1] = $row['number'];
		    $arrLoads[$i][3] = $row['type'];
		    $i++;
		}
        $result->free();
    }
	
	echo json_encode($arrLoads);
};

//Удаляет стаые записи по заданной групе и дате перед записью новых значений
function cleanBeforeWrite($mysqli){
	$groupId = $_POST["groupId"];
	$date = $_POST["date"];
	$query ="delete from shedule where teacherLoadId IN (select id from teacherLoad where groupId=$groupId) and date = '".$date."'";
	$mysqli->query($query);
};

?>
