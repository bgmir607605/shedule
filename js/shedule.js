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

function setDisciplines(el) {
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
				$(el).html(response);
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
	getAvailableSedule();
}   

function getAvailableSedule(){
	var date = $('#dateShedule').val();
	var groupId = $('#group').val();
	$.ajax({
		async: false,			
		type: "POST",
		url: "./ajax/shedule.php",
		data: 'action=getJSON&date=' + date + '&groupId=' + groupId,
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
						setDisciplines('#lesson' + response[key][1]);
						$('#lesson' + response[key][1]).val(response[key][0]);
					}
					else{
						if (response[key][3] == 'I'){//если первая подгруппа
							$('#' + response[key][1]).prop("checked", false);
							$('#lesson' + response[key][1] + '_2').prop('disabled', false);
							setDisciplines('#lesson' + response[key][1]);
							$('#lesson' + response[key][1]).val(response[key][0]);
						};
						if (response[key][3] == 'II'){//если вторая подгруппа
							$('#' + response[key][1]).prop("checked", false);
							$('#lesson' + response[key][1] + '_2').prop('disabled', false);
							setDisciplines('#lesson' + response[key][1] + '_2');
							$('#lesson' + response[key][1] + '_2').val(response[key][0]);
						}
					}
   			 		console.log(response[key][1] + ') ' + response[key][2] + ' ' + response[key][3]);
  				} 
			}
			
		}
	});
}
