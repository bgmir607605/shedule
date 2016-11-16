function getTeachers(){
	//Фокус на комбике с преподом
	//Добавляет в комбик всех преподов
	var curValue = $('#teacher').val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/report.php",
			data: 'fun=getTeachers',
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#teacher').html(response);
			}
	});
	$('#teacher').val(curValue);
}

function setTeacher(){
	//При смене значения комбика с преподами
	//Очищает все другие элементы на странице, зависящие от него:
	//комбик группы, а также блок с нагрузками и отчётом
	$('#group').html('');
	$('#teacherLoads').html('');
	$('#report').html('');
	// Вызывает функцию showTeacherLoads()
	showTeacherLoads();
}

function getGroups(){
	// Фокус на комбике с группами
	// Добавляет в комбик группы, в которых выбранный препод имеет нагрузки
	var curValue = $('#group').val();
		$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/report.php",
			data: 'fun=getGroups&teacherId=' + $('#teacher').val(),
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

function setGroup(){
	// При смене значения комбика с группами
	// Очищает все другие элементы на странице, зависящие от него:
	// блок с нагрузками и отчётом
	$('#teacherLoads').html('');
	$('#report').html('');
	// Вызывет функцию showTeacherLoads()
	showTeacherLoads();
}


function showTeacherLoads(){
	//Вызывается при загрузке страницы, смене значений комбиков-фильтров
	//Смотрит значения фильтров и выводит соответствующие множества нагрузок
	var filter = '';
	var teacher = $('#teacher').val();
	if (teacher > 0){ filter = filter + '&teacher=' + teacher;};
	var group = $('#group').val();
	if (group > 0){ filter = filter + '&group=' + group;};
	
	$.ajax({
		async: false,			
		type: "POST",
		url: "./ajax/report.php",
		data: 'fun=getTeacherLoads' + filter,
		dataType:"text",
		error: function () {	
			alert( "При считывании флага обновления произошла ошибка" );
		},
		success: function (response) {
			$('#teacherLoads').html(response);
		}
	});
	
}

function showReport(teacherLoadId){
	// Вызывается при клике по нагрузке
	// Выводит список занятий по указанной нагрузке
	$.ajax({
		async: false,			
		type: "POST",
		url: "./ajax/report.php",
		data: 'fun=showReport&teacherLoadId=' + teacherLoadId,
		dataType:"text",
		error: function () {	
			alert( "При считывании флага обновления произошла ошибка" );
		},
		success: function (response) {
			$('#report').html(response);
		}
	});
}
