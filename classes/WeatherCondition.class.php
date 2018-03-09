<?php

	/**
	 * Weather condition descriptions and codes.
     * based on API do OpenWeatherMaps
     * http://openweathermap.org/weather-conditions
     */

	class WeatherCondition
    {
		public $mainDescription;
		public $fullDescription;
		public $code;

		private $_mainDescriptions = array(0=>'', 200=>'Thunderstorm', 300=>'Drizzle', 500=>'Rain', 600=>'Snow', 700=>'Atmosphere', 800=>'Clouds', 900=>'Extreme', 950=>'Additional');
		private $_fullDescriptions = array(	200=>'thunderstorm with light rain', 201=>'thunderstorm with rain', 202=>'thunderstorm with heavy rain', 210=>'light thunderstorm', 211=>'thunderstorm', 212=>'heavy thunderstorm', 221=>'ragged thunderstorm', 230=>'thunderstorm with light drizzle', 231=>'thunderstorm with drizzle', 232=>'thunderstorm with heavy drizzle',
											300=>'light intensity drizzle',301=>'drizzle',302=>'heavy intensity drizzle',310=>'light intensity drizzle rain',311=>'drizzle rain',312=>'heavy intensity drizzle rain',313=>'shower rain and drizzle',314=>'heavy shower rain and drizzle',321=>'shower drizzle',
											500=>'light rain',501=>'moderate rain',502=>'heavy intensity rain',503=>'very heavy rain',504=>'extreme rain',511=>'freezing rain',520=>'light intensity shower rain',521=>'shower rain',522=>'heavy intensity shower rain',531=>'ragged shower rain',
											600=>'light snow',601=>'snow',602=>'heavy snow',611=>'sleet',612=>'shower sleet',615=>'light rain and snow',616=>'rain and snow',620=>'light shower snow',621=>'shower snow',622=>'heavy shower snow',
											701=>'mist',711=>'smoke',721=>'haze',731=>'sand, dust whirls',741=>'fog',751=>'sand',761=>'dust',762=>'volcanic ash',771=>'squalls',781=>'tornado',
											800=>'clear sky',801=>'few clouds',802=>'scattered clouds',803=>'broken clouds',804=>'overcast clouds',
											900=>'tornado',901=>'tropical storm',902=>'hurricane',903=>'cold',904=>'hot',905=>'windy',906=>'hail',
											951=>'calm', 952=>'light breeze',953=>'gentle breeze',954=>'moderate breeze',955=>'fresh breeze',956=>'strong breeze',957=>'high wind, near gale',958=>'gale',959=>'severe gale',960=>'storm',961=>'violent storm',962=>'hurricane'
		);

		/**
         * Create method
         *
         * @param integer $pWeatherCode
         */
		public function __construct($pWeatherCode)
        {
			$this->code = -1;
			$this->mainDescription = '';
			$this->fullDescription = '';

			if (array_key_exists($pWeatherCode, $this->_fullDescriptions)) {
				$this->loadWeatherCondition($pWeatherCode);
			}
		}

		/**
         * load information on the object
         *
         * @param integer $pWeatherCode
         */
		public function loadWeatherCondition($pWeatherCode)
        {
			$strWeatherCode = (string)$pWeatherCode;
			$pMainCode = '0';

			if ($strWeatherCode[0] == '9') {
				if ($strWeatherCode[1] == 0) {
					$pMainCode = $strWeatherCode[0].'00';
				} else {
					$pMainCode = $strWeatherCode[0].'50';
				}
			} else {
				$pMainCode = $strWeatherCode[0].'00';
			}

			// define object and its descriptions
			$this->code = $pWeatherCode;
			$this->fullDescription = $this->_fullDescriptions[$pWeatherCode];
			$this->mainDescription = $this->_mainDescriptions[$pMainCode];
		}
	}