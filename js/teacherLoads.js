function addTeacherLoad(){
	var teacher = $("#teacher").val();
	var group = $("#group").val();
	var discipline = $("#discipline").val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/addEntity.php",
			data: 'entity=teacherLoad&teacher=' + teacher + '&group=' + group + '&discipline=' + discipline,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				showEntity('teacherLoad');
				$("#teacher").val('');
				$("#group").val('');
				$("#discipline").val('');
				$('#lName').focus();
			}
	});
}
//

//Устанавливает список значений в комбобокс
function showDisciplinesForGroup() {
	var group = $('#group').val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showList.php",
			data: 'field=discipline&group=' + group,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#discipline').html(response);
			}
	});
}

//Выводит список экземляров сущности из БД
function showEntity() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showEntity.php",
			data: 'entity=teacherLoad',
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#teacherLoad').html(response);
			}
	});

}



function getTeachers() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showList.php",
			data: 'field=teacher',
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#teacher').html(response);
			}
	});
}

function getGroups() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showList.php",
			data: 'field=group',
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#group').html(response);
			}
	});
}