<?php

namespace M2M\WeatherFromApi\Model;

use \Magento\Framework\HTTP\Client\Curl;

class Weather
{
    /**
     * @var Curl
     */
    protected $curl;

    public function __construct(
        Curl $curl,
    ) {
        $this->curl = $curl;
    }

    public function getWeatherByCity(string $cityName)
    {
        $url = "http://api.weatherapi.com/v1/current.json";

        $params = [
            "key" => "11dda6b506ab4695a4d100659231805",
            "q" => $cityName,
            "api" => "no"
            ];

        
        return $this->getWeather($this->generateQuery($url, $params));
    }
    
    private function generateQuery(string $url, array $params)
    {
        $generatedQuery = $url . "?";

        foreach ($params as $key => $value) {
            $generatedQuery = $generatedQuery . $key . "=" . $value . "&";
        }
        $generatedQuery = rtrim($generatedQuery, "&");

        return $generatedQuery;
    }

    public function getWeather(string $url): array
    {
        $this->curl->get($url);
        
        $result = $this->curl->getBody();

        $weather = json_decode($result, true);

        $weatherInfo = [
        "cityName" => $weather['location']['name'],
        "temp" => $weather['current']['temp_c'],
        "conditionIcon" => $weather['current']['condition']['icon']
        ];

        return $weatherInfo;
    }

    

}