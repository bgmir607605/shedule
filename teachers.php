<!DOCTYPE html>
<html>
<head>
<title>Преподаватели</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/1.js"></script>
</head>
<body>
<?php require_once 'menu.php'; ?>
<div id="content">
	<h2>Преподаватели</h2>
	<form>
		<table>
		<tr>
			<td>Фамилия</td>
			<td>Имя</td>
			<td>Отчество</td>
			<td></td>
		</tr>
			<tr>
			<td><input type="text" id="lastName" placeHolder="Фамилия" autofocus></td>
			<td><input type="text" id="firstName" placeHolder="Имя"></td>
			<td><input type="text" id="midName" placeHolder="Отчество"></td>
			<td><input type="button" value="Добавить" onClick=addTeacher() ></td>
			<!--onkeypress="if (event.charCode == 13) {addTeacher();}"-->
		</tr>
		</table>
	</form>
<div id="teachers">

<?php
$mysqli = new mysqli("localhost", "bpt", "0000", "bpt");

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Соединение не удалось: %s\n", $mysqli->connect_error);
    exit();
}

$query = "set names utf8";
$mysqli->query($query);

$query = "SELECT * FROM teachers";

if ($result = $mysqli->query($query)) {

    /* извлечение ассоциативного массива */
    while ($row = $result->fetch_assoc()) {
		echo $row["lName"].' '.$row["fName"].' '.$row["mName"].'<br/>';
    }

    /* удаление выборки */
    $result->free();
}

/* закрытие соединения */
$mysqli->close();
?>

<!--<input onkeypress="if (event.charCode == 13) {alert('tadam')}">-->

</div>
</div>
</body>
</html>
