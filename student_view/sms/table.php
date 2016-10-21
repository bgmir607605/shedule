<html>
<head>
<title></title>
	</head>
	<body>
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
	echo "<table border=1>";
	echo "<th>Stud</th>";
	for ($d = 1; $d <= 31; $d++){
		echo "<th>".$d."</th>";
		};
	foreach ($students as $student){
	echo "<tr><td>".$student[1]."</td>";
		$connect->qr("select hours from `skips` where idStudent = '" . $student[0] . "' and date between '" . $fromDay . "' AND  '" . $today . "';");
		$hours = 0;
		while($data = mysql_fetch_array($connect->qr_res)){
		echo "<td>".$data['hours']."</td>";
		$hours = $hours + $data['hours'];
	
		}
		if ($hours > 0) {
			echo "<br>" . $student["1"] . " " . $hours;
			echo $student["1"];
			$text = "Ваш+ребёнок+пропустил+за+неделю+" . $hours . "+час.";
			$parentPhone = $student["2"];
			}
		echo "</tr>";
	}
	echo "</table>";
?>
</body>
</html>