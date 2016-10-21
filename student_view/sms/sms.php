<?php
require_once 'connect.php';//Подключаем класс 'Connect'
$connect = new connect();// Подключаемся к БД

	//загружаем список студентов
	$i = 0;
	$connect->qr("select * from `students`;");
	while($data = mysql_fetch_array($connect->qr_res)){
		$students[$i][0] = $data['id'];
		$students[$i][1] = $data['lastName'];
		$students[$i][2] = $data['parentPhone'];
		$i++;
		}
	//Выбираем временной интервал	
	$today = date("Y-m-d");
	$fromDay = strtotime('-7 days', strtotime($today));
	$fromDay = date('Y-m-j', $fromDay);
	echo "<br>Пропуски с " . $fromDay . " по " . $today ;
	//Перебираем каждого студента и считаем часы
	foreach ($students as $student){
		$connect->qr("select hours from `skips` where idStudent = '" . $student[0] . "' and date between '" . $fromDay . "' AND  '" . $today . "';");
		$hours = 0;
		while($data = mysql_fetch_array($connect->qr_res)){
		$hours = $hours + $data['hours'];
		}
		if ($hours > 0) {
			echo "<br>" . $student["1"] . " " . $hours;
			echo $student["1"];
			$text = "Ваш+ребёнок+пропустил+за+неделю+" . $hours . "+час.";
			$parentPhone = $student["2"];
			$body=file_get_contents("http://sms.ru/sms/send?api_id=24f8dacb-859a-8e04-3515-f1d7bd7c3ca8&to=7" . $parentPhone . "&text=".$text);
			}
	}
	$text = "Родители+оповещены";
	$body=file_get_contents("http://sms.ru/sms/send?api_id=24f8dacb-859a-8e04-3515-f1d7bd7c3ca8&to=79616307282&text=".$text);
	echo $body;
	echo "<br>ok";

?>