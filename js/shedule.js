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
	var dateShedule = $('#dateShedule').val();
	var idTeacherLoad;
	var type;
	var number;
	for (number = 1; number <= 5; number++){
		if ($('#lesson' + number + '_2').prop("disabled")){
			idTeacherLoad = $('#lesson' + number).val();
			type = '';
			addLesson(dateShedule, idTeacherLoad, type, number)
		}
		else {
			type = 'I';
			idTeacherLoad = $('#lesson' + number).val();
			addLesson(dateShedule, idTeacherLoad, type, number)
			
			type = 'II';
			idTeacherLoad = $('#lesson' + number + '_2').val();
			addLesson(dateShedule, idTeacherLoad, type, number)
		};
	}
	
}

function addLesson(dateShedule, idTeacherLoad, type, number){
	var post = 'action=addLesson&date=' + dateShedule + '&teacherLoad=' + idTeacherLoad;
	post = post + '&type=' + type + '&number=' + number; 
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/shedule.php",
			data: post,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
	});
}

