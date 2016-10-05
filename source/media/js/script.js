$(function() {

// Отправка AJAX запросов
function sb(nm){
	$('#'+nm).submit(function(e){
		e.preventDefault();
		var name = $(this).find("#name").val(),
			days_in = $(this).find("#days_in").val(), 
			days_out = $(this).find("#days_out").val();
		$.ajax({
			type: "POST",
			dataType:"text",
			url:"/main/"+nm,
			data: "name="+name+"&days_in="+days_in+"&days_out="+days_out+"&ajax=1",
			beforeSend:function(xhr, setting){
				if(name.length == 0 || name == 0 || ( !(days_in == undefined || days_out == undefined) && (days_in.length == 0 || days_out.length == 0 || days_in == 0 || days_out == 0))) xhr.abort();
				else{
					$(".-alert").hide().removeClass("-primary-").removeClass("-error-");
					$('#'+nm).find("input[type=submit]").addClass("_disabled_");
				}
			},
			success:function(text){
				if(text === 'success'){
					$(".-alert").addClass("-primary-").html('Операция выполнена успешно.').show();
					$('#'+nm).find("input[type=text]").val("");
				}
				else $(".-alert").addClass("-error-").html(text).show();
				$('#'+nm).find("input[type=submit]").removeClass("_disabled_");
			},
			error:function(){
				$(".-alert").addClass("-error-").html('При выполнении операции произошла ошибка.').show();
				$('#'+nm).find("input[type=submit]").removeClass("_disabled_");
			}
		});
	});
}

sb("add_region");
sb("add_courier");

$.datepicker.setDefaults($.datepicker.regional["ru"]);
$("#datepicker, .datepicker").datepicker({firstDay: 1, dateFormat: "dd-mm-yy"});

Date.prototype.ddmmyyyy = function() {
   var yyyy = this.getFullYear().toString();
   var mm = (this.getMonth()+1).toString();
   var dd = this.getDate().toString();
   return (dd[1]?dd:"0"+dd[0]) + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + yyyy;
};

// Формирование даты прибытия
$("#add #region, #add #courier, #add #datepicker").change(function() {
	var selected = $("#add #region").find('option:selected'),
		daysIn = selected.data('days-in'),
		daysOut = selected.data('days-out');
	if(daysIn == undefined || daysOut == undefined) return;
	var days = daysIn + daysOut;
	
	var d = $("#add #datepicker").val().split('-');
	if(d[0] == "") return;
	var newDate = new Date(d[2], (d[1]-1), d[0]);
	newDate.setDate(newDate.getDate() + days);
	
	$("#add #arrival").val(newDate.ddmmyyyy());
});

// Отправка AJAX запросов: форма добавления поездки
$('#add').submit(function(e){
		e.preventDefault();
		var courier = $(this).find("#courier").find('option:selected').val(),
			region = $(this).find("#region").find('option:selected').val(),
			date = $(this).find("#datepicker").val();
		$.ajax({
			type: "POST",
			dataType:"text",
			url:"/main/add",
			data: "region="+region+"&courier="+courier+"&date="+date+"&ajax=1",
			beforeSend:function(xhr, setting){
				if(region.length == 0 || region == 0 || courier.length == 0 || courier == 0 || date.length == 0 || date == 0) xhr.abort();
				else{
					$(".-alert").hide().removeClass("-primary-").removeClass("-error-");
					$('#add').find("input[type=submit]").addClass("_disabled_");
				}
			},
			success:function(text){
				if(text === 'success'){
					$(".-alert").addClass("-primary-").html('Операция выполнена успешно.').show();
					$("#add").find("#courier").find("option").each(function() { this.selected = (this.text == "---"); });
					$("#add").find("#region").find("option").each(function() { this.selected = (this.text == "---"); });
					$("#add").find("#datepicker").val("");
					$("#add").find("#arrival").val("");
				}
				else $(".-alert").addClass("-error-").html(text).show();
				$('#add').find("input[type=submit]").removeClass("_disabled_");
			},
			error:function(){
				$(".-alert").addClass("-error-").html('При выполнении операции произошла ошибка.').show();
				$('#add').find("input[type=submit]").removeClass("_disabled_");
			}
		});
	});
});