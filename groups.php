<!DOCTYPE html>
<html>
<head>
<title>Группы</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/1.js"></script>
</head>
<body onLoad="showEntity('group')">
<?php require_once 'menu.php'; ?>
<div id="content">
	<h2>Группы</h2>
	<form>
		<table>
		<tr>
			<td>Название</td>
			<td>Специальность</td>
			<td></td>
		</tr>
			<tr>
			<td><input type="text" id="name"></td>
			<td><select id="specialty" placeHolder="Специальность" onFocus="showField('specialty')"></select></td>
			<td><input type="button" value="Добавить" onClick=addGroup()></td>
		</tr>
		</table>
	</form>
<div id="group">
</div>
</div>
</body>
</html>
