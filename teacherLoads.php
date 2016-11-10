<!DOCTYPE html>
<html>
<head>
<title>Нагрузки</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/teacherLoads.js"></script>
</head>
<body onLoad="showEntity()">
<?php require_once 'menu.php'; ?>
<div id="content">
	<h2>Нагрузки</h2>
	<form>
		<table>
		<tr>
			<td>Преподаватель</td>
			<td>Группа</td>
			<td>Дисциплина (Модуль)</td>
			<td></td>
		</tr>
		<tr>
			<td><select id="teacher" placeHolder="Преподаватель" onFocus="getTeachers()"></select></td>
			<td><select id="group" placeHolder="Группа" onFocus="getGroups()" ></select></td>
			<td><select id="discipline" placeHolder="Дисциплина Модуль" onFocus="showDisciplinesForGroup()"></select></td>
			<td></td>
		</tr>
		</table>
	<input type="button" value="Добавить" onClick=addTeacherLoad()>
	</form>
<div id="teacherLoad">
</div>
</div>
</body>
</html>
