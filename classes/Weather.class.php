<?php
	require_once('WeatherCondition.class.php');

    /**
     * Weather class
	 *
	 * Used to get weather from openweather.org.
	 *
	 * @author Marcel Kohls
     */

	class Weather
	{
		private $units = array('C'=>'metric', 'F'=>'Imperial', 'K'=>'');

		public $cityName;
		public $countyName;
		
		public $latitude;
		public $longitude;
		public $apiKey;
		public $icon;
		public $general;
		public $detailed;
		public $weatherId;
		public $unit;
		public $temperature;
		public $pressure;
		public $humidity;
		public $temp_min;
		public $temp_max;

		function __construct($pLatitude="", $pLongitude="", $pApiKey="", $cityName="", $countryName="")
		{
			$this->clearFields();

			$this->latitude = (strlen($pLatitude)>0?$pLatitude:'');
			$this->longitude = (strlen($pLongitude)>0?$pLongitude:'');
			$this->key = (strlen($pApiKey)>0?$pApiKey:'');
			$this->cityName = (strlen($cityName)>2?$cityName:'');
			$this->countryName = strlen($countryName>1?$countryName:'');

			if (strlen($pLatitude)>0 && strlen($pLongitude)>0 && strlen($pApiKey)>0) {
				$this->loadWeather();
			}
		}

		private function clearFields()
		{
			$this->latitude = '';
			$this->longitude = '';
			$this->key = '';
			$this->icon = -1;
			$this->general  = '';
			$this->detailed = '';
			$this->weatherId = -1;
			$this->unit = 'C';
			$this->temperature = '';
			$this->pressure = '';
			$this->humidity = '';
			$this->temp_min = '';
			$this->temp_max = '';
		}


		public function loadWeather()
		{
			$result = false;
			$unit = (strlen($this->unit) > 0?'&units='.$this->units[$this->unit]:'');
			if ($this->cityName && $this->countryName){
				$url = 'http://api.openweathermap.org/data/2.5/weather?q='.$this->cityName.','.$this->countryName.'&APPID='.$this->apiKey.$unit;
			} else if($this->cityName && !$this->countryName) {
				$url = 'http://api.openweathermap.org/data/2.5/weather?q='.$this->cityName.'&APPID='.$this->apiKey.$unit;
			} else {
				$url = 'http://api.openweathermap.org/data/2.5/weather?lat='.$this->latitude.'&lon='.$this->longitude.'&APPID='.$this->apiKey.$unit;
			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,$url);
			$json = curl_exec($ch);
			curl_close($ch);


			if (strpos($json, '}') > 0) {
				$jsonIterator = new RecursiveIteratorIterator(new RecursiveArrayIterator(json_decode($json, TRUE)), RecursiveIteratorIterator::SELF_FIRST);
				$_weatherId = -1;
				$_icon = -1;

				foreach ($jsonIterator as $key => $val) {
					if(!is_array($val) && $key=='icon') { $_icon = $val; }
					if(!is_array($val) && $key=='id' && $_weatherId==-1) { $_weatherId = $val; }
					if(!is_array($val) && $key=='temp') { $this->temperature = $val; }
					if(!is_array($val) && $key=='humidity') { $this->humidity = $val; }
					if(!is_array($val) && $key=='pressure') { $this->pressure = $val; }
					if(!is_array($val) && $key=='temp_max') { $this->temp_max = $val; }
					if(!is_array($val) && $key=='temp_min') { $this->temp_min = $val; }
				}

				$condition = new WeatherCondition($_weatherId);

				$this->icon     = $_icon;
				$this->general  = $condition->mainDescription;
				$this->detailed = $condition->fullDescription;
				$this->weatherId = $_weatherId;

				$result = true;
			}

			return $result;
		}
	}