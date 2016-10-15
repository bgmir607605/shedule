<!DOCTYPE html>
<html>
<head>
<title>Специальности</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/1.js"></script>
</head>
<body>
<?php require_once 'menu.php'; ?>
<div id="content">
	<h2>Специальности</h2>
	<form>
		<table>
		<tr>
			<td>Код</td>
			<td>Наименование</td>
			<td></td>
		</tr>
			<tr>
			<td><input type="text" id="code"></td>
			<td><input type="text" id="name"></td>
			<td><input type="button" value="Добавить" onClick=addSpecialty()></td>
		</tr>
		</table>
	</form>
<div id="specialties">

<?php
$mysqli = new mysqli("localhost", "bpt", "0000", "bpt");

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Соединение не удалось: %s\n", $mysqli->connect_error);
    exit();
}

$query = "set names utf8";
$mysqli->query($query);

$query = "SELECT * FROM specialty";

if ($result = $mysqli->query($query)) {

    /* извлечение ассоциативного массива */
    while ($row = $result->fetch_assoc()) {
		echo $row["code"].' '.$row["name"].'<br/>';
    }

    /* удаление выборки */
    $result->free();
}

/* закрытие соединения */
$mysqli->close();
?>
</div>
</div>
</body>
</html>