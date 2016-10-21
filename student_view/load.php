<?php
$day = htmlspecialchars($_POST['date']);
$group = htmlspecialchars($_POST['group']); 
if (!empty($day)){
	//Получаем id группы
	$connect->qr("select * from `groups` where `name` ='". $group . "' ");
	while($data = mysql_fetch_array($connect->qr_res)){$groupId = $data['id'];};
	//Получаем список нагрузок по указанной группе и дате
	$i = 0;
	$connect->qr("select `teacherLoadId`, `number`, `type` from `shedule` where `teacherLoadId` IN (select `id` from `teacherLoad` where `groupId` ='" . $groupId . "') and `date` = '" . $day . "' ORDER BY `number`");
	while($data = mysql_fetch_array($connect->qr_res)){
		$arrLoads[$i][0] = $data['teacherLoadId'];
		$arrLoads[$i][1] = $data['number'];
		$arrLoads[$i][3] = $data['type'];
		$i++;
		}
	if (count($arrLoads) == 0){
		echo "Нет занятий";
		}
	else {
		echo "Расписание на $day  группа $group <br>";
		for ($j = 0; $j <= count($arrLoads); $j++){
			$connect->qr("SELECT shortName FROM discipline WHERE id IN (SELECT disciplineId FROM teacherLoad where id = '".$arrLoads[$j][0] . "' )");
			while($data = mysql_fetch_array($connect->qr_res)){
				$arrLoads[$j][2] = $data['shortName'];
				}
			}	
		foreach ($arrLoads as $v1){
			echo "<br>" . $v1["1"] . ") " . $v1["2"] . " " . $v1["3"];
			}
		}
	} 
else {
	echo "Не указана дата";
	}

unset($day);
unset($group);
	
		
	
?>