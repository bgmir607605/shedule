function addTeacher(){
	var lastName = $("#lastName").val();
	var firstName = $("#firstName").val();
	var midName = $("#midName").val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/addEntity.php",
			data: 'entity=teacher&lName=' + lastName + '&fName=' + firstName + '&mName='+ midName,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				showEntity('teacher');
				$("#lastName").val('');
				$("#firstName").val('');
				$("#midName").val('');
				$('#lastName').focus();
			}
	});
}

function delTeacher(teacher){
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/deleteEntity.php",
			data: 'entity=teacher&id=' + teacher.id,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				showEntity('teacher')
			}
	});
}
//
function addSpecialty(){
	var code = $("#code").val();
	var name = $("#name").val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/addEntity.php",
			data: 'entity=specialty&code=' + code + '&name=' + name,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				showEntity('specialty');
				$("#code").val('');
				$("#name").val('');
				$('#code').focus();
			}
	});
}


function addGroup(){
	var name = $("#name").val();
	var specialty = $("#specialty").val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/addEntity.php",
			data: 'entity=group&name=' + name + '&specialty=' + specialty,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				showEntity('group');
				$("#name").val('');
				$("#specialty").val('');
				$('#name').focus();
			}
	});
}


//Устанавливает список значений в комбобокс
function showField(field) {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showList.php",
			data: 'field=' + field,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#' + field).html(response);
			}
	});
}

//Выводит список экземляров сущности из БД
function showEntity(entity) {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showEntity.php",
			data: 'entity=' + entity,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#' + entity).html(response);
			}
	});

}