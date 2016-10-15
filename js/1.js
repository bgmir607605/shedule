var block  = false;	
	function saveChanges() {
		if (!block){
			block = true;
			$("#button").html('<img src="3.gif">');
			//DONE: Очистить файл с адресами    	
			cleanFile();
			//DONE: Запись в файл		
			writeListToFile();
			//DONE: в файл needUpdate.txt установить единицу
			setNeedUpdate();
			//DONE: в цикле проверять выполнеие обновления с интервалом в секунду
			//DONE: при подтверждении обновления - вывести алерт
			waitUpdate();
		}
		else {
			alert('Пожалуйста,дождитесь сохранения предыдущих изменений');
		}
    }

//* Очистка файла whiteIP.txt
function cleanFile(){
		$.ajax({
			async: false,
			type: "POST",
			url: "./ajax/cleanWhiteIP.php",
			dataType:"text",
			error: function () {	
				alert( "При очистке файла произошла ошибка" );
			}
		});	
};

//* перебирает все адреса из класса разрешённых
//*записывает их значения в файл whiteIP.txt
function writeListToFile(){
	$('.dropAddress').each(function(i,elem) {
		$.ajax({
			async: false,
			type: "POST",
			url: "./ajax/writeAddresses.php",
			dataType:"text",
			data: "address=" + elem.parentNode.id,
			error: function () {	
				alert( "При выполнении запроса произошла ошибка" );
			}
		});	
	});
};

//* установка единицы в needUpdate.txt
function setNeedUpdate(){
		$.ajax({
			async: false,
			type: "POST",
			url: "./ajax/setNeedUpdate.php",
			dataType:"text",
			error: function () {	
				alert( "При установке флага обновления произошла ошибка" );
			}
		});	
};

//* Ожидание выполнения обновления
function waitUpdate(){
	var flag;
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/waitUpdate.php",
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				flag = response;
			}
	});
	if (flag == 1){		
					timerId = setTimeout(waitUpdate, 1000);
				}
				else {
					reprintWhiteIP();
					$("#button").html('Сохранить изменения');
				};
				
};

//Обновить на странице список адресов в соответствии с файлом whiteIP.txt
function reprintWhiteIP(){
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/printWhiteIP.php",
			dataType:"text",
			error: function () {	
				alert( "При обновлении произошла ошибка" );
			},
			success: function (response) {
				$("#whiteAddress").html(response);
				block = false;
			}
	});

}
//////////////////////////////////////

function changeAccess (el) {
	if (el.getAttribute("class") == 'acceptAddress') {
		$(el).removeClass("acceptAddress");
    	$(el).addClass("dropAddress");
    	$(el).html(' X ');
    	$('#whiteAddress').append( $('#blackAddress>#' + el.parentNode.id + '') );
	}
	else {
		$(el).removeClass("dropAddress");
    	$(el).addClass("acceptAddress");
    	$(el).html(' + ');
    	$('#blackAddress').append( $('#whiteAddress>#' + el.parentNode.id + '') );
	}


};



function acceptAddress(){
	var address = $("#newAddress").val();
	$("#whiteAddress").append('<div class="address" id="' + address + '">' + address + '<div class="dropAddress" onclick="changeAccess(this)"> X </div></div>');
	$("#newAddress").val('');
};

/////////

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
				$('#teachers').html(response);
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
				$('#disciplines').html(response);
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
				$('#specialties').html(response);
				$("#code").val('');
				$("#name").val('');
				$('#code').focus();
			}
	});
}

function showSpecialtyList() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showSpecialtyList.php",
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#specialty').html(response);
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
				$('#groups').html(response);
				$("#name").val('');
				$("#specialty").val('');
				$('#name').focus();
			}
	});
}

//

function showlName() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showlName.php",
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#lastName').html(response);
			}
	});
}

//

function showfName() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showfName.php",
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#firstName').html(response);
			}
	});
}

//

function showmName() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showmName.php",
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#midName').html(response);
			}
	});
}

//

function showGroup() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showGroup.php",
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#group').html(response);
			}
	});
}

//

function showDiscipline() {
	$.ajax({
			async: false,			
			type: "POST",
			url: "./ajax/showDiscipline.php",
			dataType:"text",
			error: function () {	
				alert( "При считывании флага обновления произошла ошибка" );
			},
			success: function (response) {
				$('#discipline').html(response);
			}
	});
}
