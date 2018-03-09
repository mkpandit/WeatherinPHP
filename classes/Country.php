<?php
	require_once('database.php');
	$database = new Database();
	$db = $database->getConnection();
	if ($_POST) {
		$keyWord = $_POST['keyword'];
	} else {
		$keyWord = $_GET['keyword'];
	}
	$stmt = $db->prepare("SELECT name, code2 FROM cities_light_country WHERE name LIKE '" . $keyWord . "%' ORDER BY name LIMIT 10" ); /* START PREPARED STATEMENT */
	$stmt->execute();
	$countryList = '<ul id="countryList" class="city-country-list">';
	
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$countryList .= '<li onClick="selectCountry(\''.$code2.'\')">'.$name.'</li>';
	}
	$countryList .= '</ul>';
	echo $countryList;
?>