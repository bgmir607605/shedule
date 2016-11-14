function exportExcel(){
	var date = $('#dateShedule').val();
	if (date != ''){
		window.location = "./excel/test.php?date=" + date;
	}
	else {
		alert('укажите дату');
	}
	
}

function isTeacherDuplication(){
	var date = $('#dateShedule').val();
	if (date != ''){
		$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/teacherDuplication.php",
			data: 'date=' + date,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				alert(response);
			}
		});
	}
	else {
		alert('укажите дату');
	}
	
}

function getGroups(){
	var curValue = $('#group').val();
	var date = $('#dateShedule').val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/shedule.php",
			data: 'action=showGroup&date=' + date,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#group').html(response);
			}
	});
	$('#group').val(curValue);
	
}

//Добавляет в комбобокс список доступных для этой группы нагрузок
function getDisciplines(el) {
	var groupId = $('#group').val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/shedule.php",
			data: 'action=getDisciplines&groupId=' + groupId,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#' + el.id).html(response);
			}
	});
}

//Переключает тип пары {общ, I, II}
function toogleTotal(ch){
	if ($('#' + ch.id).prop("checked")){
		$('#lesson' + ch.id + '_2').prop('disabled', true);
	}
	else {
		$('#lesson' + ch.id + '_2').prop('disabled', false);
	}
}


//Сохраняет расписание
function saveShedule(){
	var ok;
	var dateShedule = $('#dateShedule').val();
	var idTeacherLoad;
	var type;
	var number;
	ok = cleanOldShedule();
	if (!ok){
		alert('произошла ошибка');
		return;
	}
	for (number = 1; number <= 5; number++){
		if ($('#lesson' + number + '_2').prop("disabled")){
			idTeacherLoad = $('#lesson' + number).val();
			type = '';
			ok = addLesson(dateShedule, idTeacherLoad, type, number)
			if (!ok){
				alert('произошла ошибка');
				return;
			}
		}
		else {
			type = 'I';
			idTeacherLoad = $('#lesson' + number).val();
			ok = addLesson(dateShedule, idTeacherLoad, type, number)
			if (!ok){
				alert('произошла ошибка');
				return;
			}
			
			if (!$('#lesson' + number + '_2').prop("disabled")){
				type = 'II';
				idTeacherLoad = $('#lesson' + number + '_2').val();
				ok = addLesson(dateShedule, idTeacherLoad, type, number)
				if (!ok){
					alert('произошла ошибка');
					return;
				}
			}
		};
	}
	clearLessons();
	$('#group').val('');
	alert('Расписание сохранено');
}

//Запись в БД рдного занятия
function addLesson(dateShedule, idTeacherLoad, type, number){
	if(idTeacherLoad == null){return true;};
	var post = 'action=addLesson&date=' + dateShedule + '&teacherLoad=' + idTeacherLoad;
	post = post + '&type=' + type + '&number=' + number;
	var ok;
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/shedule.php",
			data: post,
			dataType:"text",
			error: function () {	
				ok = false;
			},
			success: function (response) {
				ok = true;
			}
	});
	return ok;
}

//Очистка комбобоксов всех занятий
function clearLessons(){
	var number;
	for (number = 1; number <= 5; number++){
		$('#lesson' + number).val('');
		$('#lesson' + number + '_2').val('');
	}
}   

//Получение у становка имеющегося в БД расписания
//на выбранную дату и группу
function getAvailableSedule(){
	
	var date = $('#dateShedule').val();
	var groupId = $('#group').val();
	clearLessons();
	$.ajax({
		async: false,			
		type: "POST",
		url: "./ajax/shedule.php",
		data: 'action=getAvailable&date=' + date + '&groupId=' + groupId,
		dataType:'json',
		error: function () {	
			alert('error');
		},
		success: function (response) {
			for (key in response) {
 				if (response.hasOwnProperty(key)) {
					if (response[key][3] == ''){//если общее занятие
						$('#' + response[key][1]).prop("checked", true);
						$('#lesson' + response[key][1] + '_2').prop('disabled', true);
						getDisciplines(document.getElementById('lesson' + response[key][1]));
						$('#lesson' + response[key][1]).val(response[key][0]);
					}
					else{
						if (response[key][3] == 'I'){//если первая подгруппа
							$('#' + response[key][1]).prop("checked", false);
							$('#lesson' + response[key][1] + '_2').prop('disabled', false);
							getDisciplines(document.getElementById('lesson' + response[key][1]));
							$('#lesson' + response[key][1]).val(response[key][0]);
						};
						if (response[key][3] == 'II'){//если вторая подгруппа
							$('#' + response[key][1]).prop("checked", false);
							$('#lesson' + response[key][1] + '_2').prop('disabled', false);
							
							getDisciplines(document.getElementById('lesson' + response[key][1] + '_2'));
							$('#lesson' + response[key][1] + '_2').val(response[key][0]);
						}
					}
  				} 
			}
			
		}
	});
}

//Затирает в БД старое расписание на дату и группу
//Вызывается перед записью нового расписания
function cleanOldShedule(){
	var groupId = $('#group').val();
	var dateShedule = $('#dateShedule').val();
	var post = 'action=cleanBeforeWrite&date=' + dateShedule + '&groupId=' + groupId;
	var ok;
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/shedule.php",
			data: post,
			dataType:"text",
			error: function () {	
				ok = false;
			},
			success: function (response) {
				ok = true;
			}
	});
	return ok;
}
