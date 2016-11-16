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
function showEntity(filterCat ='', filterVal = '') {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showEntity.php",
			data: 'entity=teacherLoad&filterCat=' + filterCat + '&filterVal=' + filterVal,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#teacherLoad').html(response);
			}
	});

}



function getTeachers(field = 'teacher') {
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
				$('#' + field).html(response);
			}
	});
}

function getGroups(filter = 'group') {
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
				$('#' + filter).html(response);
			}
	});
}

function setCategoryFilter(){
	var filterCat = $('#filter').val();
	$('#value').html('');
	if (filterCat != '----') {
		$('#value').prop("disabled", false);
		$('#teacherLoad').html(filterCat);
	}
	else{
		$('#value').prop("disabled", true);
		showEntity();
	}
}

function setValFilterList(){
	var filterCat = $('#filter').val();
	if (filterCat == 'teacherLoad.teacherId') {
		getTeachers('value');
	}
	else{
		getGroups('value');
	}
}

function showFilteredEntities(){
	var filterCat = $('#filter').val();
	var filterVal = $('#value').val();
	$('#teacherLoad').html(filterCat + '=' + filterVal);
	showEntity(filterCat, filterVal);
}