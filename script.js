$(document).ready(function()
{
	$('#date-1').datepicker({
    format: "dd-mm-yyyy",
    language: "fr",
    daysOfWeekDisabled: "5,6",
    autoclose: true,
    todayHighlight: true
	});
	$('#date-2').datepicker({
    format: "dd-mm-yyyy",
    language: "fr",
    daysOfWeekDisabled: "5,6",
    autoclose: true,
    todayHighlight: true
	});
});