<!DOCTYPE html>
<html>
<head>
<title>Дисциплины и модули</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/1.js"></script>
</head>
<body onLoad="showEntity('discipline')">
<?php require_once 'menu.php'; ?>
<div id="content">
	<h2>Дисциплины и модули</h2>
	<form>
		<table>
		<tr>
			<td>Полное название</td>
			<td>Краткое название</td>
			<td></td>
		</tr>
			<tr>
			<td><input type="text" id="fullName"></td>
			<td><input type="text" id="shortName"></td>
			<td><input type="button" value="Добавить" onClick="addDiscipline()"></td>
		</tr>
		</table>
	</form>
<div id="discipline">


</div>
</div>
</body>
</html>
