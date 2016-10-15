<!DOCTYPE html>
<html>
<head>
<title>Нагрузки</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/1.js"></script>
</head>
<body>
<?php require_once 'menu.php'; ?>
<div id="content">
	<h2>Нагрузки</h2>
	<form>
		<table>
		<tr>
			<td>Фамилия</td>
			<td>Имя</td>
			<td>Отчество</td>
			<td></td>
		</tr>
		<tr>
			<td><select id="lastName" placeHolder="Фамилия" onFocus="showlName()"></select></td>
			<td><select id="firstName" placeHolder="Имя" onFocus="showfName()"></select></td>
			<td><select id="midName" placeHolder="Имя" onFocus="showmName()"></select></td>
			<td></td>
		</tr>
		<tr></tr>
		<tr>
			<td>Группа</td>
			<td>Дисциплина (Модуль)</td>
		</tr>
			<tr>
			<td><select id="group" placeHolder="Группа" onFocus="showGroup()" ></select></td>
			<td><select id="discipline" placeHolder="Дисциплина Модуль" onFocus="showDiscipline()"></select></td>
		</tr>
		</table>
	<input type="button" value="Добавить" onClick=addTeacherLoad()>
	</form>
<div id="teacherLoads">
</div>
</div>
</body>
</html>
