<!DOCTYPE html>
<html>
<head>
<title>Отчёты</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

</head>
<body>
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
<br /><input name="filter" type="radio" value="all" checked> Все
<br /><input name="filter" type="radio" value="teacher"> По преподаватлю
<br /><input name="filter" type="radio" value="group"> По группе
<br /><input name="filter" type="radio" value="dicipline"> По дисциплине
<div id="teacherLoad">
</div>
</div>
</body>
</html>
