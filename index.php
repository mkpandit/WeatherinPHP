<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/dashboard.css" />
	<title>Weather forecast in PHP</title>
</head>

<body>
	<header>
		<nav class="navbar navbar-default navbar-fixed-top"><div class="container-fluid"><!-- <h2>Header</h2> --></div></nav>
	</header>
	
	<div class="container-fluid">
		<div class="row-fluid body-container">
			<div class="span10 left">
				<div class="weather-search-box">
					<form>
						<div class="form-group">
							<label for="countryName">Country</label>
							<input type="text" class="form-control" id="countryName" placeholder="Canada">
							<div id="suggesstion-box-country"></div>
						</div>
						<div class="form-group">
							<label for="cityName">City</label>
							<input type="text" class="form-control" id="cityName" placeholder="Torotno">
							<div id="suggesstion-box"></div>
						</div>
						<button type="submit" id="searchSubmit" class="btn btn-primary">Search</button>
					</form>
				</div>
			</div>
			<div class="span2 right" id="rightSide">
				
			</div>
		</div>
	</div>
	
	<footer>
		<nav class="navbar navbar-default navbar-fixed-bottom"><div class="container-fluid"><!-- <h4>Footer</h4> --></div></nav>
	</footer>
	
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery-ui.min.js"></script>
	<script src="assets/js/common.js"></script>
</body>
</html>