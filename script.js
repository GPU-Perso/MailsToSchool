$(document).ready(function()
{
	$('.input-group.date').datepicker({
    format: "dd-mm-yyyy",
    language: "fr",
    daysOfWeekDisabled: "5,6",
    autoclose: true,
    todayHighlight: true
	});
});