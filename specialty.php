<!DOCTYPE html>
<html>
<head>
<title>Специальности</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/1.js"></script>
</head>
<body onLoad="showEntity('specialty')">
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
<div id="specialty">


</div>
</div>
</body>
</html>