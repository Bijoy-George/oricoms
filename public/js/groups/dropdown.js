$(document).ready(function() {
	var groupJsonData	= $('#groupJsonData').val();
	var obj	= JSON.parse(groupJsonData);
	$('.dropdown-mul-1').dropdown({
		data: obj,
		limitCount: 4,
		input: '<input type="text" maxLength="20" placeholder="Search">'
	});
});