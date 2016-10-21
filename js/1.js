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
//
function addDiscipline(){
	var fullName = $("#fullName").val();
	var shortName = $("#shortName").val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/addEntity.php",
			data: 'entity=discipline&fullName=' + fullName + '&shortName=' + shortName,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				showEntity('discipline');
				$("#fullName").val('');
				$("#shortName").val('');
				$('#fullName').focus();
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

//
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