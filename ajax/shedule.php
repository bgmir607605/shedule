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
	case 'getJSON':
		getJSON($mysqli);
        break;
	case 'cleanBeforeWrite':
		cleanBeforeWrite($mysqli);
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

function getAvailable($mysqli){
	$groupId = $_POST["groupId"];
    $date = $_POST["date"];
    
	//Получаем список нагрузок по указанной группе и дате
	$i = 0;
    $query = "select `teacherLoadId`, `number`, `type` from `shedule` where `teacherLoadId` 
    IN (select `id` from `teacherLoad` 
    where `groupId` ='" . $groupId . "') and `date` = '" . $date . "' ORDER BY `number`";
	if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()){
		    $arrLoads[$i][0] = $row['teacherLoadId'];
		    $arrLoads[$i][1] = $row['number'];
		    $arrLoads[$i][3] = $row['type'];
		    $i++;
		}
        $result->free();
    }
	if (count($arrLoads) == 0){
		echo "Нет занятий";
	}
	else {
		echo "Расписание на $date  группа $group <br>";
		for ($j = 0; $j <= count($arrLoads); $j++){
            $query = "SELECT shortName FROM discipline WHERE id IN (SELECT disciplineId FROM teacherLoad where id = '".$arrLoads[$j][0] . "' )";
			if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()){
				    $arrLoads[$j][2] = $row['shortName'];
				}
                $result->free();
			}	
        }
		foreach ($arrLoads as $v1){
			echo "<br>" . $v1["1"] . ") " . $v1["2"] . " " . $v1["3"];
			}
		}
};

function getJSON($mysqli){
/*$z['object_or_array'] = "string value";
$z['empty'] = false;
$z['parse_time_nanoseconds'] = 19608;
$z['validate'] = true;
$z['size'] = 1;*/
 
$groupId = $_POST["groupId"];
    $date = $_POST["date"];
    
	//Получаем список нагрузок по указанной группе и дате
	$i = 0;
    $query = "select `teacherLoadId`, `number`, `type` from `shedule` where `teacherLoadId` 
    IN (select `id` from `teacherLoad` 
    where `groupId` ='" . $groupId . "') and `date` = '" . $date . "' ORDER BY `number`";
	if ($result = $mysqli->query($query)) {
        while ($row = $result->fetch_assoc()){
		    $arrLoads[$i][0] = $row['teacherLoadId'];
		    $arrLoads[$i][1] = $row['number'];
		    $arrLoads[$i][3] = $row['type'];
		    $i++;
		}
        $result->free();
    }
	if (count($arrLoads) == 0){
		//	echo "Нет занятий";
	}
	else {
		//echo "Расписание на $date  группа $group <br>";
		for ($j = 0; $j <= count($arrLoads); $j++){
            $query = "SELECT shortName FROM discipline WHERE id IN (SELECT disciplineId FROM teacherLoad where id = '".$arrLoads[$j][0] . "' )";
			if ($result = $mysqli->query($query)) {
                while ($row = $result->fetch_assoc()){
				    $arrLoads[$j][2] = $row['shortName'];
				}
                $result->free();
			}	
        }
		/*foreach ($arrLoads as $v1){
			echo "<br>" . $v1["1"] . ") " . $v1["2"] . " " . $v1["3"];
			}*/
		}	
	
	
echo json_encode($arrLoads);

	
};

function cleanBeforeWrite($mysqli){
	$groupId = $_POST["groupId"];
	$date = $_POST["date"];
	$query ="delete from shedule where teacherLoadId IN (select id from teacherLoad where groupId=$groupId) and date = '".$date."'";
	$mysqli->query($query);
};

?>
