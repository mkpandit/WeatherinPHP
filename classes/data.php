<?php
	require_once('Weather.class.php');

	$weather = new Weather();

	$weather->latitude = "-26.984500";
	$weather->longitude = "-48.631668";
	
	$weather->unit = "C"; // units can be: "F" for Fahrenheit, "C" for Celsius, "K" for Kelvin
	$weather->apiKey = "b094ab99e1483f600148b79e6202ae1f";


	if(isset($_GET['city']) && !empty($_GET['city'])) {
		$weather->cityName = $_GET['city'];
	} 
	if(isset($_GET['country']) && !empty($_GET['country'])) {
		$weather->countryName = $_GET['country'];
	}

	if ($weather->cityName) {
		if ($weather->loadWeather() == true){
			$weatherForeCast = "";
			/*echo 'weather now is: <br />';
			echo $weather->general.'<br />';
			echo '('.$weather->detailed.')<br />';
			echo '<img src="http://openweathermap.org/img/w/'.$weather->icon.'.png"><br />';
			echo $weather->temperature.' '.$weather->unit.' <br /> ';
			echo 'min.:'.$weather->temp_min.' / max.:'.$weather->temp_min.'<br />';
			echo 'pressure: '.$weather->pressure.' hpa<br /> ';
			echo 'humidity: '.$weather->humidity.'% <br /> ';*/
			$weatherForeCast .= 'Current temperature in '.$weather->cityName.': '.$weather->temperature.' '.$weather->unit. '<br />';
			$weatherForeCast .= '<img src="http://openweathermap.org/img/w/'.$weather->icon.'.png"><br />';
			$weatherForeCast .= 'Minimum: '.$weather->temp_min.', Maximum: '.$weather->temp_max. '<br />';
		} else {
			$weatherForeCast = "Weather service is not available at this moment.";
		}
	} else {
		$weatherForeCast = "Not a valid location";
	}
	echo $weatherForeCast;
?>