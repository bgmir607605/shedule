<!DOCTYPE html>
<html>
<head>
<title>Расписание</title>
<meta charset="utf-8"/>
<link rel="stylesheet" href="my.css">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/1.js"></script>
<script type="text/javascript" src="js/shedule.js"></script>

</head>
<body>
<?php require_once 'menu.php'; ?>
<div id="content">
	<h2>В процессе разработки</h2>
	
	<input type=date id="dateShedule"><br> <!--Дата-->
	<select id="group" onFocus="showField('group')"></select><br> <!--Группа-->

<table>
   <tr>
	<td>1.</td>
	<td><input checked class="totalCheck" id="1" type=checkbox onClick="ok(this)"> общ.</td>
	<td><select class="lesson" id="lesson1" onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   <tr>
    <td>-</td>
	<td></td>
	<td><select class="lesson" id="lesson1_2" disabled onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   
   
    <tr>
	<td>2.</td>
	<td><input checked class="totalCheck" id="2" type=checkbox onClick="ok(this)"> общ.</td>
	<td><select class="lesson" id="lesson2" onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   <tr>
    <td>-</td>
	<td></td>
	<td><select class="lesson" id="lesson2_2" disabled onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   
   <tr>
	<td>3.</td>
	<td><input checked class="totalCheck" id="3" type=checkbox onClick="ok(this)"> общ.</td>
	<td><select class="lesson" id="lesson3" onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   <tr>
    <td>-</td>
	<td></td>
	<td><select class="lesson" id="lesson3_2" disabled onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   
   <tr>
	<td>4.</td>
	<td><input checked class="totalCheck" id="4" type=checkbox onClick="ok(this)"> общ.</td>
	<td><select class="lesson" id="lesson4" onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   <tr>
    <td>-</td>
	<td></td>
	<td><select class="lesson" id="lesson4_2" disabled onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   
   <tr>
	<td>5.</td>
	<td><input checked class="totalCheck" id="5" type=checkbox onClick="ok(this)"> общ.</td>
	<td><select class="lesson" id="lesson5" onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   <tr>
    <td>-</td>
	<td></td>
	<td><select class="lesson" id="lesson5_2" disabled onFocus="getDisciplines(this)"></select></td>
	<td></td>
   </tr>
   
</table>
<input type="button" value="Сохранить" onClick="saveShedule()">   

</div>
</body>
</html>
