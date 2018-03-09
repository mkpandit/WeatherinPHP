$(document).ready(function() {
	$("#searchSubmit").click( function() {
		var cityName = $("#cityName").val();
		var countryName = $("#countryName").val();
		$("#rightSide").html('<img src="assets/images/loading.gif" width="100" />');
		$.ajax({
			url: 'classes/data.php?city='+cityName+'&country='+countryName,
		})
		.done(function(data) {
			$("#rightSide").html('');
			$("#rightSide").append('<div class="alert alert-info" role="alert">'+data+'</div>');
		})
		.fail(function() {
			alert("Ajax failed to fetch data");
		});
		return false;
	});
	
	$("#countryName").keyup(function() {
		$.ajax({
			type: "POST",
			url: "classes/Country.php",
			data: "keyword="+$(this).val(),
			success: function(data) {
				$("#suggesstion-box-country").show();
				$("#suggesstion-box-country").html(data);
			}
		});
	});
	
	$("#cityName").keyup(function() {
		var countryName = $("#countryName").val();
		$.ajax({
			type: "POST",
			url: "classes/City.php?country="+countryName,
			data: "keyword="+$(this).val(),
			success: function(data) {
				$("#suggesstion-box").show();
				$("#suggesstion-box").html(data);
			}
		});
	});
	
});

//To select country name
function selectCountry(val) {
	$("#countryName").val(val);
	$("#suggesstion-box-country").hide();
}

//To select country name
function selectCity(val) {
	$("#cityName").val(val);
	$("#suggesstion-box").hide();
}

/*$(function() {
	$( "#cityName" ).autocomplete({
		source: "classes/City.php"
	});
});*/