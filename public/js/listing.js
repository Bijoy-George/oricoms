$(document).ready(function() {
	$('#startdate').on('change', function(e) {
		console.log($(this).val());
		// console.log($('#enddate').data('datepicker'));
		$('#enddate').datepicker('option', 'minDate', $(this).val());
	});
	$('#enddate').on('change', function(e) {
		// console.log($('#enddate').data('datepicker'));
		$('#startdate').datepicker('option', 'maxDate', $(this).val());
	});
});