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

function ok(ch){
	
	if ($('#' + ch.id).prop("checked")){
		$('#lesson' + ch.id + '_2').prop('disabled', true);
	}
	else {
		$('#lesson' + ch.id + '_2').prop('disabled', false);
	}
}

function saveShedule(){
	var ok;
	var dateShedule = $('#dateShedule').val();
	var idTeacherLoad;
	var type;
	var number;
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
			
			type = 'II';
			idTeacherLoad = $('#lesson' + number + '_2').val();
			ok = addLesson(dateShedule, idTeacherLoad, type, number)
			if (!ok){
				alert('произошла ошибка');
				return;
			}
		};
	}
	clearLessons();
	$('#group').val('');
	alert('Расписание сохранено');
}

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

function clearLessons(){
	var number;
	for (number = 1; number <= 5; number++){
		$('#lesson' + number).val('');
		$('#lesson' + number + '_2').val('');
	}
}           