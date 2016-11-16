<!DOCTYPE html>
<head>
<html>
<title>Отчёты</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/report.js"></script>

</head>
<body onLoad="showTeacherLoads()">
<?php require_once 'menu.php'; ?>
<div id="content">
	<h2>Отчёты</h2>
		<table>
		<tr>
			<td>Преподаватель</td>
			<td>Группа</td>
			<td></td>
		</tr>
		<tr>
			<td><select id="teacher" placeHolder="Преподаватель" onFocus="getTeachers()" onChange="setTeacher()"></select></td>
			<td><select id="group" placeHolder="Группа" onFocus="getGroups()" onChange="setGroup()"></select></td>
			<td></td>
		</tr>
		</table>
<div id="teacherLoads">
</div>
<div id="report">
</div>
</div>
</body>
</html>
