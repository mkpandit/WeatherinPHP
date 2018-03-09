<?php
	require_once('database.php');
	$database = new Database();
	$db = $database->getConnection();
	if ($_POST) {
		$keyWord = $_POST['keyword'];
	} else {
		$keyWord = $_GET['keyword'];
	}
	if (isset($_GET['country'])) {
		$countryName = $_GET['country'];
	}
	$stmt = $db->prepare("SELECT name FROM cities_light_city WHERE name LIKE '" . $keyWord . "%' ORDER BY name LIMIT 10" ); /* START PREPARED STATEMENT */
	$stmt->execute();
	$city = array();
	
	$cityList = '<ul id="cityList" class="city-country-list">';
	
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		array_push($city, $name);
		//echo $name;
		$cityList .= '<li onClick="selectCity(\''.$name.'\')">'.$name.'</li>';
	}
	$cityList .= '</ul>';
	echo $cityList;
	//echo json_encode($city);
?>