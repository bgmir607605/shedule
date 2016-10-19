function getDisciplines(el) {
	var groupId = $('#group').val();
	//alert(groupId);
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
	//$('#' + el.id).html('<option>Дисциплины</option><option>Для</option><option>' + $('#group').val() + '</option>')



}

function ok(ch){
	
if ($('#' + ch.id).prop("checked")){
	$('#lesson' + ch.id + '_2').prop('disabled', true);
}
else {
	$('#lesson' + ch.id + '_2').prop('disabled', false);
}
}