<?php 
require_once 'connect.php';//Подключаем класс 'Connect'
$connect = new connect();// Подключаемся к БД
?>
<!DOCTYPE html>
<html>
<head>
<title>В помощь студенту</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
</head>
<body>
<h2 align="left">Расписание занятий</h2>
<form action="index.php" method="post">
 <p>Выберите дату: <input type="date" name="date" атрибуты></p>
 <p>Выберите группу: <select name="group">
 <?php
	$connect->qr("select * from `groups`");
			while($data = mysql_fetch_array($connect->qr_res)){
			echo '<option>' . $data['name'] . '</option>';
			};			
	?>
</select></p>
 <p><input type="submit" value="Смотреть расписание"/></p>
</form>

<?php
require_once 'load.php';
$text = "зашли+на+сайт";
//$body=file_get_contents("http://sms.ru/sms/send?api_id=24f8dacb-859a-8e04-3515-f1d7bd7c3ca8&to=79616307282&text=".$text);
?>
<BR>
<h2 align="left">Материалы для студентов и их родителей</h2>
<BR><a href="I.php">Для 1-2 ТП группы</a>
<BR><a href="II.php">Для 3-4 ДП группы</a>
<BR><a href="III.php">Для 5-6 ДП группы</a>
<br>
<br>
</body>
</html>
<?php unset($connect);?>
