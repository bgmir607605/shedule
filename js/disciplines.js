//Добавляет в комбобокс список специальностей
//+
function getSpecialtyList() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showList.php",
			data: 'field=specialty',
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#specialty').html(response);
			}
	});
}

//+
//Переключает общ/ не общ
function isShared(){
	if ($('#shared').prop("checked")){
		$('#specialty').prop('disabled', true);
		$('#specialty').val('');
	}
	else {
		$('#specialty').prop('disabled', false);
	}
}

function showAvailable() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showEntity.php",
			data: 'entity=discipline',
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#discipline').html(response);
			}
	});

}

function addDiscipline(){
	var fullName = $("#fullName").val();
	var shortName = $("#shortName").val();
	var shared = $('#shared').prop("checked");
	var specialty = $('#specialty').val();
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/addEntity.php",
			data: 'entity=discipline&fullName=' + fullName + '&shortName=' + shortName + '&shared=' + shared + '&specialty=' + specialty,
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				//alert(response);
				showAvailable();
				$("#fullName").val('');
				$("#shortName").val('');
				$('#shared').prop('checked', true);
				$('#specialty').prop('disabled', true);
				$('#specialty').val('');
				$('#fullName').focus();
			}
	});
}